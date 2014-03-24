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


namespace Avisota\Contao\Message\Renderer\MailChimp\Renderer;

use Avisota\Contao\Entity\MessageContent;
use Avisota\Contao\Core\Message\Renderer;
use Avisota\Contao\Message\Core\Event\AvisotaMessageEvents;
use Avisota\Contao\Message\Core\Event\RenderMessageContentEvent;
use Avisota\Contao\Message\Core\Event\RenderMessageEvent;
use Avisota\Recipient\RecipientInterface;
use Contao\Doctrine\ORM\Entity;
use Contao\Doctrine\ORM\EntityAccessor;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class Text
 *
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-renderer-mailchimp
 */
class MailChimpRenderer implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	static public function getSubscribedEvents()
	{
		return array(
			AvisotaMessageEvents::RENDER_MESSAGE => array(
				array('renderMessage', 100),
			),
			AvisotaMessageEvents::RENDER_MESSAGE_CONTENT => array(
				array('renderHeadline', 100),
				array('renderHyperlink', 100),
				array('renderImage', 100),
				array('renderList', 100),
				array('renderTable', 100),
				array('renderText', 100),
			),
		);
	}

	public function renderMessage(RenderMessageEvent $event)
	{
		if ($event->getPreRenderedMessageTemplate()) {
			return;
		}

		$message = $event->getMessage();
		$layout  = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		$blueprintRenderer = new BlueprintRenderer();
		$preRenderedMessageTemplate = $blueprintRenderer->renderMessage($message, $layout);

		$event->setPreRenderedMessageTemplate($preRenderedMessageTemplate);
	}

	/**
	 * Render the headline content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderHeadline(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'headline' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_headline', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}

	/**
	 * Render the hyperlink content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderHyperlink(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'hyperlink' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_hyperlink', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}

	/**
	 * Render the image content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderImage(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'image' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_image', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}

	/**
	 * Render the list content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderList(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'list' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_list', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}

	/**
	 * Render the table content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderTable(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'table' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_table', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}

	/**
	 * Render the text content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderText(RenderMessageContentEvent $event)
	{
		$content = $event->getMessageContent();

		if ($content->getType() != 'text' || $event->getRenderedContent()) {
			return;
		}

		$layout = $event->getLayout();

		if ($layout->getType() != 'mailChimp') {
			return;
		}

		/** @var EntityAccessor $entityAccessor */
		$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

		$context = $entityAccessor->getProperties($content);

		$template = new \TwigTemplate('avisota/message/renderer/default/mce_text', 'html');
		$buffer   = $template->parse($context);

		$event->setRenderedContent($buffer);
	}
}
