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

use Avisota\Contao\Entity\Layout;
use Avisota\Contao\Entity\Message;
use Avisota\Contao\Entity\MessageContent;
use Avisota\Contao\Message\Core\Event\AvisotaMessageEvents;
use Avisota\Contao\Message\Core\Event\RenderMessageContentEvent;
use Avisota\Contao\Message\Core\Event\RenderMessageHeadersEvent;
use Avisota\Contao\Message\Core\Renderer\MessageRendererInterface;
use Avisota\Contao\Message\Core\Template\MutablePreRenderedMessageTemplate;
use Contao\Doctrine\ORM\EntityHelper;
use ContaoCommunityAlliance\Contao\Bindings\ContaoEvents;
use ContaoCommunityAlliance\Contao\Bindings\Events\Controller\ReplaceInsertTagsEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class BlueprintRenderer implements MessageRendererInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function renderMessage(Message $message, Layout $layout = null)
	{
		if (!$layout || $layout->getType() != 'mailChimp') {
			return null;
		}

		try {
			$libxmlUseInternalErrors = libxml_use_internal_errors(true);

			/** @var EventDispatcher $eventDispatcher */
			$eventDispatcher = $GLOBALS['container']['event-dispatcher'];

			$environment = \Environment::getInstance();

			list($templateGroup, $templateName) = explode(':', $layout->getMailchimpTemplate());
			if (!isset($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$templateGroup][$templateName])) {
				throw new \RuntimeException('Mailchimp blueprint ' . $templateGroup . '/' . $templateName . ' was not found!');
			}
			$blueprint    = $GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'][$templateGroup][$templateName];
			$cells        = $blueprint['cells'];

			/** @var array[]|\ArrayObject[] $cellContents */
			$cellContents = array();

			foreach ($cells as $cellName => $cellConfig) {
				if (isset($cellConfig['content'])) {
					$cellContents[$cellName] = array($cellConfig['content']);
				}
				else {
					$cellContents[$cellName] = $this->renderCell($message, $cellName, $layout);
				}
			}

			$template = file_get_contents(TL_ROOT . '/' . $blueprint['template']);
			$template = str_replace('mc:', 'mc__', $template);
			$template = mb_convert_encoding($template, 'HTML-ENTITIES', 'UTF-8');

			$document               = new \DOMDocument('1.0', 'UTF-8');
			$document->formatOutput = true;
			$document->loadHTML($template);

			$xpath = new \DOMXPath($document);

			if ($layout->getClearStyles()) {
				$styles = $xpath->query('/html/head/style');
				for ($i = 0; $i < $styles->length; $i++) {
					$style = $styles->item($i);
					$style->parentNode->removeChild($style);
				}
			}

			$clearedCells = array();

			foreach ($cells as $cellName => $cellConfig) {
				$replace = isset($cellConfig['replace']) && $cellConfig['replace'];

				// remove empty nodes
				if (
					is_array($cellContents[$cellName]) &&
					!count(array_filter($cellContents[$cellName])) ||
					$cellContents[$cellName] instanceof \ArrayObject &&
					$cellContents[$cellName]->count() == 0
				) {
					if (isset($cellConfig['ifEmptyRemove'])) {
						$expression = $cellConfig['ifEmptyRemove'];
					}
					else if(isset($cellConfig['xpath'])) {
						$expression = $cellConfig['xpath'];
					}
					else {
						throw new \RuntimeException(sprintf('The cell "%s" does not have a valid selector', $cellName));
					}

					$nodes = $xpath->query(str_replace('mc:', 'mc__', $expression), $document->documentElement);

					if (!$nodes->length) {
						throw new \RuntimeException('Node "' . $expression . '" not found in ' . $blueprint['template']);
					}

					for ($i = 0; $i < $nodes->length; $i++) {
						$node = $nodes->item(0);
						$node->parentNode->removeChild($node);
					}
				}
				else if (!empty($cellContents[$cellName])) {
					/** @var \StringBuilder $cellContentRow */
					foreach ($cellContents[$cellName] as $index => $cellContentRow) {
						$cellContentRow    = mb_convert_encoding($cellContentRow, 'HTML-ENTITIES', 'UTF-8');
						$cellContentRowDoc = new \DOMDocument('1.0', 'UTF-8');
						$cellContentRowDoc->loadHTML('<html><body>' . $cellContentRow . '</body></html>');

						if (isset($cellConfig['wrapRow'])) {
							$cellConfig['wrapRow'] = mb_convert_encoding(
								$cellConfig['wrapRow'],
								'HTML-ENTITIES',
								'UTF-8'
							);
							$wrapRowDoc            = new \DOMDocument('1.0', 'UTF-8');
							$wrapRowDoc->loadHTML('<html><body>' . $cellConfig['wrapRow'] . '</body></html>');

							$wrapElement = $wrapRowDoc->documentElement;
							while ($wrapElement->firstChild) {
								$wrapElement = $wrapElement->firstChild;
							}

							for ($i = 0; $i < $cellContentRowDoc->documentElement->firstChild->childNodes->length; $i++)
							{
								$childNode = $cellContentRowDoc->documentElement->firstChild->childNodes->item($i);
								$childNode = $wrapRowDoc->importNode($childNode, true);
								$wrapElement->appendChild($childNode);
							}

							$cellContentRowDoc = $wrapRowDoc;
						}

						$cellContents[$cellName][$index] = $cellContentRowDoc;
					}

					$cellContentDoc = new \DOMDocument('1.0', 'UTF-8');
					$cellContentDoc->appendChild($cellContentDoc->createElement('html'));
					$cellContentDoc->documentElement->appendChild($cellContentDoc->createElement('body'));
					foreach ($cellContents[$cellName] as $cellContentRowDoc) {
						for ($i = 0; $i < $cellContentRowDoc->documentElement->firstChild->childNodes->length; $i++) {
							$childNode = $cellContentRowDoc->documentElement->firstChild->childNodes->item($i);
							$childNode = $cellContentDoc->importNode($childNode, true);
							$cellContentDoc->documentElement->firstChild->appendChild($childNode);
						}
					}

					if (isset($cellConfig['wrapContent'])) {
						$cellConfig['wrapContent'] = mb_convert_encoding(
							$cellConfig['wrapContent'],
							'HTML-ENTITIES',
							'UTF-8'
						);
						$wrapContentDoc            = new \DOMDocument('1.0', 'UTF-8');
						$wrapContentDoc->loadHTML('<html><body>' . $cellConfig['wrapContent'] . '</body></html>');

						$wrapElement = $wrapContentDoc->documentElement;
						while ($wrapElement->firstChild) {
							$wrapElement = $wrapElement->firstChild;
						}

						for ($i = 0; $i < $cellContentDoc->documentElement->firstChild->childNodes->length; $i++) {
							$childNode = $cellContentDoc->documentElement->firstChild->childNodes->item($i);
							$childNode = $wrapContentDoc->importNode($childNode, true);
							$wrapElement->appendChild($childNode);
						}

						$cellContentDoc = $wrapContentDoc;
					}

					$expression  = $cellConfig['xpath'];

					if (empty($expression)) {
						throw new \RuntimeException(sprintf('The cell "%s" does not have a valid selector', $cellName));
					}

					$targetNodes = $xpath->query(str_replace('mc:', 'mc__', $expression), $document->documentElement);

					if (!$targetNodes->length) {
						throw new \RuntimeException('Node "' . $expression . '" not found in ' . $blueprint['template']);
					}

					for ($i = 0; $i < $targetNodes->length; $i++) {
						$targetNode = $targetNodes->item($i);

						if ($targetNode->nodeType == XML_ATTRIBUTE_NODE) {
							$cellContent = $cellContentDoc->saveHTML();
							$cellContent = trim($cellContent);
							$cellContent = preg_replace('#^<html><body>#', '', $cellContent);
							$cellContent = preg_replace('#</body></html>$#', '', $cellContent);

							/** @var \DOMAttr $targetNode */
							$targetNode->value = $cellContent;
						}
						else {
							// if not replace, empty target node
							if (!$replace) {
								if (!in_array($cellName, $clearedCells)) {
									while ($targetNode->childNodes->length) {
										$childNode = $targetNode->childNodes->item(0);
										$targetNode->removeChild($childNode);
									}
									$clearedCells[] = $cellName;
								}
							}

							for ($j = 0; $j < $cellContentDoc->documentElement->firstChild->childNodes->length; $j++) {
								$childNode = $cellContentDoc->documentElement->firstChild->childNodes->item($j);
								$childNode = $document->importNode($childNode, true);

								// if replace, insert before target node
								if ($replace) {
									$targetNode->parentNode->insertBefore($childNode, $targetNode);
								}

								// if not replace, append into target node
								else {
									$targetNode->appendChild($childNode);
								}
							}

							// if replace it, remove the target node
							if ($replace) {
								$targetNode->parentNode->removeChild($targetNode);
							}
						}
					}
				}
			}

			$headers = new \ArrayObject();

			$styles      = new \StringBuilder();
			$stylesheets = $layout->getStylesheetPaths();
			foreach ($stylesheets as $stylesheet) {
				$file = new \File($stylesheet);
				$css  = $file->getContent();
				$styles
					->append($css)
					->append("\n");
			}
			$styles->trim();
			if ($styles->length()) {
				$styles->insert(0, "<style>\n");
				$styles->append("\n</style>");
				$headers['styles'] = $styles;
			}

			$eventDispatcher->dispatch(
				AvisotaMessageEvents::RENDER_MESSAGE_HEADERS,
				new RenderMessageHeadersEvent($this, $message, $headers)
			);

			$headElements = $xpath->query('/html/head', $document->documentElement);
			$headElement  = $headElements->item(0);

			$headerCode = trim(implode("\n", $headers->getArrayCopy()));
			if ($headerCode) {
				$headerCode = mb_convert_encoding($headerCode, 'HTML-ENTITIES', 'UTF-8');
				$headerDoc  = new \DOMDocument('1.0', 'UTF-8');
				$headerDoc->loadHTML('<html><head>' . $headerCode . '</head></html>');

				for ($i = 0; $i < $headerDoc->documentElement->firstChild->childNodes->length; $i++) {
					$childNode = $headerDoc->documentElement->firstChild->childNodes->item($i);
					$childNode = $document->importNode($childNode, true);
					$headElement->appendChild($childNode);
				}
			}

			$baseUrl = $environment->base;
			$links   = $xpath->query('//@href|//@src');
			for ($i = 0; $i < $links->length; $i++) {
				/** @var \DOMAttr $link */
				$link = $links->item($i);
				if (!preg_match('~(^\w+:|^#[^#]|##)~', $link->value)) {
					$link->value = $baseUrl . $link->value;
				}
			}

			$html = $document->saveHTML();
			$html = str_replace(
				array('%7B', '%7D', '%20'),
				array('{',   '}',   ' '),
				$html
			);
			$html = preg_replace_callback(
				'~\{%.*%\}~U',
				function ($matches) {
					return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
				},
				$html
			);
			$html = preg_replace_callback(
				'~##.*##~U',
				function ($matches) {
					return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
				},
				$html
			);

			$replaceInsertTags = new ReplaceInsertTagsEvent($html, false);
			$eventDispatcher->dispatch(ContaoEvents::CONTROLLER_REPLACE_INSERT_TAGS, $replaceInsertTags);

			$response = new MutablePreRenderedMessageTemplate(
				$message,
				$replaceInsertTags->getBuffer(),
				standardize($message->getSubject()) . '.html',
				'text/html',
				'utf-8'
			);

			libxml_use_internal_errors($libxmlUseInternalErrors);
			return $response;
		}
		catch (\Exception $exception) {
			libxml_use_internal_errors($libxmlUseInternalErrors);
			throw $exception;
		}
	}

	/**
	 * Render content for a specific cell.
	 *
	 * @param Message $message
	 * @param string  $cell
	 *
	 * @return \StringBuilder
	 */
	public function renderCell(Message $message, $cell, Layout $layout = null)
	{
		if (!$layout || $layout->getType() != 'mailChimp') {
			return null;
		}

		/** @var \Avisota\Contao\Message\Core\Renderer\MessageRendererInterface $renderer */
		$renderer = $GLOBALS['container']['avisota.message.renderer'];

		return $renderer->renderCell($message, $cell, $layout);
	}

	/**
	 * Render a single message content element.
	 *
	 * @param MessageContent $messageContent
	 *
	 * @return string
	 */
	public function renderContent(MessageContent $messageContent, Layout $layout = null)
	{
		/** @var \Avisota\Contao\Message\Core\Renderer\MessageRendererInterface $renderer */
		$renderer = $GLOBALS['container']['avisota.message.renderer'];

		return $renderer->renderContent($messageContent, $layout);
	}
}
