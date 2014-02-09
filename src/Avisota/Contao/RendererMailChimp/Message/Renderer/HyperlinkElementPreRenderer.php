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


namespace Avisota\Contao\RendererMailChimp\Message\Renderer;

use Avisota\Contao\Entity\MessageContent;
use Avisota\Contao\Core\Message\Renderer;
use Avisota\Recipient\RecipientInterface;
use Contao\Doctrine\ORM\Entity;


/**
 * Class Text
 *
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-renderer-mailchimp
 */
class HyperlinkElementPreRenderer implements Renderer\MessageContentPreRendererInterface
{
	/**
	 * @var string
	 */
	const TEMPLATE = 'avisota/message/renderer/mailchimp/mce_hyperlink';

	/**
	 * Render a single message content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return string
	 */
	public function renderContent(MessageContent $content)
	{
		$context = $content->toArray(Entity::REF_INCLUDE);
		$template = new \TwigTemplate(static::TEMPLATE, 'html');
		return $template->parse($context);
	}

	/**
	 * Check if this renderer can render the given message content element.
	 *
	 * @param MessageContent     $content
	 * @param RecipientInterface $recipient
	 *
	 * @return bool
	 */
	public function canRenderContent(MessageContent $content)
	{
		return $content->getType() == 'hyperlink';
	}
}
