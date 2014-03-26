<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-renderer-mailchimp
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Message\Renderer\MailChimp\DataContainer;

use Avisota\Contao\Entity\Layout;
use Avisota\Contao\Entity\MessageContent;
use Contao\Doctrine\ORM\DataContainer\General\EntityModel;
use ContaoCommunityAlliance\Contao\Bindings\ContaoEvents;
use ContaoCommunityAlliance\Contao\Bindings\Events\System\LoadLanguageFileEvent;
use ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\Compatibility\DcCompat;
use ContaoCommunityAlliance\DcGeneral\DC_General;
use ContaoCommunityAlliance\DcGeneral\DcGeneral;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OptionsBuilder implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	static public function getSubscribedEvents()
	{
		return array(
			// Layout related options
			'avisota.create-mailchimp-template-options'   => 'createMailChimpTemplateOptions',
			'avisota.create-content-type-options'         => 'createContentTypeOptions',
			// Message content related options
			'avisota.create-message-content-type-options' => 'createCellContentTypeOptions',
			'avisota.create-message-content-cell-options' => 'createMessageContentCellOptions',
		);
	}

	public function createMailChimpTemplateOptions(CreateOptionsEvent $event)
	{
		$this->getMailChimpTemplateOptions($event->getOptions());
	}

	public function getMailChimpTemplateOptions($options = array())
	{
		/** @var EventDispatcher $eventDispatcher */
		$eventDispatcher = $GLOBALS['container']['event-dispatcher'];

		$eventDispatcher->dispatch(
			ContaoEvents::SYSTEM_LOAD_LANGUAGE_FILE,
			new LoadLanguageFileEvent('avisota_mailchimp_template')
		);

		foreach ($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'] as $group => $mailChimpTemplates) {
			if (isset($GLOBALS['TL_LANG']['avisota_mailchimp_template'][$group])) {
				$groupLabel = $GLOBALS['TL_LANG']['avisota_mailchimp_template'][$group];
			}
			else {
				$groupLabel = $group;
			}
			foreach ($mailChimpTemplates as $name => $mailChimpTemplate) {
				if (isset($GLOBALS['TL_LANG']['avisota_mailchimp_template'][$name])) {
					$label = $GLOBALS['TL_LANG']['avisota_mailchimp_template'][$name];
				}
				else {
					$label = $name;
				}

				$label .= sprintf(' [%s]', strtoupper($mailChimpTemplate['mode']));

				$options[$groupLabel][$group . ':' . $name] = $label;
			}
		}
		return $options;
	}

	public function createContentTypeOptions(CreateOptionsEvent $event)
	{
		/** @var DcCompat $dc */
		$dc = $event->getDataContainer();
		/** @var EntityModel $model */
		$model = $dc->getModel();
		/** @var Layout $layout */
		$layout = $model->getEntity();

		if (!$layout || $layout->getType() != 'mailChimp') {
			return;
		}

		$options = $event->getOptions();

		$allTypes = $options->getArrayCopy();
		$options->exchangeArray(array());

		list($group, $mailChimpTemplate) = explode(':', $layout->getMailchimpTemplate());
		if (isset($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate])) {
			$config = $GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate];

			foreach ($config['cells'] as $cellName => $cellConfig) {
				if (!isset($cellConfig['content'])) {
					if (!isset($options[$cellName])) {
						$options[$cellName] = array();
					}

					foreach ($allTypes as $elements) {
						foreach ($elements as $elementType => $elementLabel) {
							$options[$cellName][$cellName . ':' . $elementType] = $elementLabel;
						}
					}
				}
			}
		}
	}

	/**
	 * @param Layout $layout
	 */
	public function createCellContentTypeOptions(CreateOptionsEvent $event)
	{
		/** @var DcCompat $dc */
		$dc = $event->getDataContainer();
		/** @var EntityModel $model */
		$model  = $dc->getModel();
		$entity = $model->getEntity();

		if (!$entity instanceof MessageContent) {
			return;
		}

		$this->getCellContentTypeOptions(
			$event->getOptions(),
			$entity
		);
	}

	/**
	 * @param array|\ArrayObject $options
	 * @param MessageContent     $content
	 */
	public function getCellContentTypeOptions($options = array(), MessageContent $content)
	{
		$message = $content->getMessage();
		$layout  = $message->getLayout();

		if (!$layout || $layout->getType() != 'mailChimp') {
			return $options;
		}

		$allowedTypes = array($content->getType());

		list($group, $mailChimpTemplate) = explode(':', $layout->getMailchimpTemplate());
		if (isset($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate])) {
			$config = $GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate];

			if (isset($config['cells'][$content->getCell()])) {
				$cellConfig = $config['cells'][$content->getCell()];

				if (!isset($cellConfig['content'])) {
					if (isset($cellConfig['preferredElements'])) {
						$allowedTypes = $cellConfig['preferredElements'];
					}
					else {
						foreach ($GLOBALS['TL_MCE'] as $elements) {
							foreach ($elements as $elementType) {
								$allowedTypes[] = $elementType;
							}
						}
					}
				}
			}
		}

		foreach ($layout->getAllowedCellContents() as $allowedCellContentType) {
			list($cell, $elementType) = explode(':', $allowedCellContentType);
			if ($cell == $content->getCell()) {
				$allowedTypes[] = $elementType;
			}
		}

		foreach ($options as $group => &$values) {
			if (is_array($values)) {
				foreach ($values as $key => $value) {
					if (!in_array($key, $allowedTypes)) {
						unset($values[$key]);
					}
				}
			}
			else {
				if (!in_array($group, $allowedTypes)) {
					unset($options[$group]);
				}
			}
		}

		return $options;
	}

	/**
	 * Get a list of areas from the parent category.
	 *
	 * @param DC_General $dc
	 */
	public function createMessageContentCellOptions(CreateOptionsEvent $event)
	{
		$this->getMessageContentCellOptions($event->getDataContainer(), $event->getOptions());
	}

	/**
	 * Get a list of areas from the parent category.
	 *
	 * @param DcCompat $dc
	 */
	public function getMessageContentCellOptions($dc, $options = array())
	{
		/** @var EntityModel $model */
		$model = $dc->getModel();
		/** @var \Avisota\Contao\Entity\MessageContent $content */
		$content = $model->getEntity();
		$message = $content->getMessage();
		$layout  = $message->getLayout();

		if (!$layout || $layout->getType() != 'mailChimp') {
			return $options;
		}

		list($templateGroup, $templateName) = explode(':', $layout->getMailchimpTemplate());
		$mailChimpTemplate = $GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$templateGroup][$templateName];
		$cells             = $mailChimpTemplate['cells'];
		$rows              = isset($mailChimpTemplate['rows']) ? $mailChimpTemplate['rows'] : array();

		$repeatableCells = array();
		foreach ($rows as $row) {
			$repeatableCells = array_merge($repeatableCells, $row['affectedCells']);
		}

		foreach ($cells as $cellName => $cell) {
			if (!isset($cell['content'])) {
				$options[] = $cellName;
			}
		}

		return $options;
	}
}
