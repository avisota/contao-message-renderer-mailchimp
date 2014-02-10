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

namespace Avisota\Contao\RendererMailChimp\DataContainer;

use Avisota\Contao\Entity\SalutationGroup;
use ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEvent;
use DcGeneral\DC_General;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OptionsBuilder extends \Controller implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	static public function getSubscribedEvents()
	{
		return array(
			''                                          => '',
			'avisota.create-mailchimp-template-options' => '',
			''                                          => '',
			''                                          => '',
		);
	}

	/**
	 * @param DC_General|\Avisota\Contao\Entity\Layout $layout
	 */
	public function createCellContentTypeOptions(CreateOptionsEvent $event)
	{
	}

	/**
	 * @param DC_General|\Avisota\Contao\Entity\Layout $layout
	 */
	public function getCellContentTypeOptions($layout)
	{
		$options = array();

		if ($layout instanceof DC_General) {
			$layout = $layout->getEnvironment()
				->getCurrentModel()
				->getEntity();
		}

		list($group, $mailChimpTemplate) = explode(':', $layout->getMailchimpTemplate());
		if (isset($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate])) {
			$config = $GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$group][$mailChimpTemplate];

			if (isset($config['cells'])) {
				foreach ($config['cells'] as $cellName => $cellConfig) {
					if (!isset($cellConfig['content'])) {
						foreach ($GLOBALS['TL_MCE'] as $elementGroup => $elements) {
							if (isset($GLOBALS['TL_LANG']['MCE'][$elementGroup])) {
								$elementGroupLabel = $GLOBALS['TL_LANG']['MCE'][$elementGroup];
							}
							else {
								$elementGroupLabel = $elementGroup;
							}
							foreach ($elements as $elementType) {
								if (isset($GLOBALS['TL_LANG']['MCE'][$elementType])) {
									$elementLabel = $GLOBALS['TL_LANG']['MCE'][$elementType][0];
								}
								else {
									$elementLabel = $elementType;
								}

								$options[$cellName][$cellName . ':' . $elementType] = sprintf(
									'[%s] %s',
									$elementGroupLabel,
									$elementLabel
								);
							}
						}
					}
				}
			}
		}

		return $options;
	}

	public function createMailChimpTemplateOptions(CreateOptionsEvent $event)
	{
		$this->getMailChimpTemplateOptions($event->getOptions());
	}

	public function getMailChimpTemplateOptions($options = array())
	{
		$this->loadLanguageFile('avisota_mailchimp_template');

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
	 * @param DC_General $dc
	 */
	public function getMessageContentCellOptions($dc, $options = array())
	{
		if ($dc instanceof DC_General && $dc->getEnvironment()
				->getCurrentModel()
		) {
			/** @var \Avisota\Contao\Entity\MessageContent $content */
			$content = $dc
				->getEnvironment()
				->getCurrentModel()
				->getEntity();
			$layout  = $content
				->getMessage()
				->getLayout();

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
					$options[] = $cellName . '[1]';
				}
			}
		}

		return $options;
	}
}
