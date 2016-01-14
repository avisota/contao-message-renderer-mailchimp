<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @package    avisota/contao-renderer-mailchimp
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Message\Renderer\MailChimp\Renderer;

use Avisota\Contao\Core\Message\Renderer;
use Avisota\Contao\Message\Core\Event\AvisotaMessageEvents;
use Avisota\Contao\Message\Core\Event\RenderMessageContentEvent;
use Avisota\Contao\Message\Core\Event\RenderMessageEvent;
use Contao\Doctrine\ORM\Entity;
use Contao\Doctrine\ORM\EntityAccessor;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class Text
 *
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @package    avisota/contao-renderer-mailchimp
 */
class MailChimpRenderer implements EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    static public function getSubscribedEvents()
    {
        return array(
            AvisotaMessageEvents::RENDER_MESSAGE         => array(
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

    /**
     * @param RenderMessageEvent $event
     *
     * @throws \Exception
     */
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

        $blueprintRenderer          = new BlueprintRenderer();
        $preRenderedMessageTemplate = $blueprintRenderer->renderMessage($message, $layout);

        $event->setPreRenderedMessageTemplate($preRenderedMessageTemplate);
    }

    /**
     * Render the headline content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_headline', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }

    /**
     * Render the hyperlink content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_hyperlink', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }

    /**
     * Render the image content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_image', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }

    /**
     * Render the list content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_list', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }

    /**
     * Render the table content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_table', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }

    /**
     * Render the text content element.
     *
     * @param RenderMessageContentEvent $event
     *
     * @return string
     * @internal param MessageContent $content
     * @internal param RecipientInterface $recipient
     *
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

        $template = new \TwigTemplate('avisota/message/renderer/mailchimp/mce_text', 'html');
        $buffer   = $template->parse($context);

        $event->setRenderedContent($buffer);
    }
}
