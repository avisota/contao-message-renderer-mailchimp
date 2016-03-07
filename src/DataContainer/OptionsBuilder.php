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

namespace Avisota\Contao\Message\Renderer\MailChimp\DataContainer;

use Avisota\Contao\Core\Event\CreateOptionsEvent;
use Avisota\Contao\Entity\Layout;
use Avisota\Contao\Entity\MessageContent;
use Avisota\Contao\Message\Core\MessageEvents;
use Contao\Doctrine\ORM\DataContainer\General\EntityModel;
use ContaoCommunityAlliance\Contao\Bindings\ContaoEvents;
use ContaoCommunityAlliance\Contao\Bindings\Events\System\LoadLanguageFileEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\Compatibility\DcCompat;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class OptionsBuilder
 *
 * @package Avisota\Contao\Message\Renderer\MailChimp\DataContainer
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class OptionsBuilder implements EventSubscriberInterface
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
    public static function getSubscribedEvents()
    {
        return array(
            // Layout related options
            'avisota.create-mailchimp-template-options'        => 'createMailChimpTemplateOptions',
            GetPropertyOptionsEvent::NAME              => 'createContentTypeOptions',
            // Message content related options
            MessageEvents::CREATE_MESSAGE_CONTENT_CELL_OPTIONS => array(array('createMessageContentCellOptions', 100)),
            MessageEvents::CREATE_MESSAGE_CONTENT_TYPE_OPTIONS => array(array('createCellContentTypeOptions', -100)),
        );
    }

    /**
     * @param CreateOptionsEvent $event
     */
    public function createMailChimpTemplateOptions(CreateOptionsEvent $event)
    {
        $this->getMailChimpTemplateOptions($event->getOptions());
    }

    /**
     * @param array $options
     *
     * @return array
     * @SuppressWarnings(PHPMD.Superglobals)
     */
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
            } else {
                $groupLabel = $group;
            }
            foreach ($mailChimpTemplates as $name => $mailChimpTemplate) {
                if (isset($GLOBALS['TL_LANG']['avisota_mailchimp_template'][$name])) {
                    $label = $GLOBALS['TL_LANG']['avisota_mailchimp_template'][$name];
                } else {
                    $label = $name;
                }

                $label .= sprintf(' [%s]', strtoupper($mailChimpTemplate['mode']));

                $options[$groupLabel][$group . ':' . $name] = $label;
            }
        }
        return $options;
    }

    /**
     * @param CreateOptionsEvent $event
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.ShortVariables)
     */
    public function createContentTypeOptions(GetPropertyOptionsEvent $event, $name, EventDispatcher $eventDispatcher)
    {
        if ($event->getModel()->getProviderName() !== 'orm_avisota_layout'
            || $event->getPropertyName() !== 'allowedCellContents') {
            return;
        }

        $layout = $event->getModel()->getEntity();
        if ($layout->getType() !== 'mailChimp') {
            return;
        }

        $allTypes = $event->getOptions();
        $options = array();

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

        $event->setOptions($options);
    }

    /**
     * Get a list of areas from the parent category.
     *
     * @param CreateOptionsEvent $event
     *
     * @internal param DC_General $dc
     */
    public function createMessageContentCellOptions(CreateOptionsEvent $event)
    {
        $this->getMessageContentCellOptions($event->getDataContainer(), $event->getOptions(), $event);
    }

    /**
     * Get a list of areas from the parent category.
     *
     * @param DcCompat           $dc
     *
     * @param array              $options
     * @param CreateOptionsEvent $event
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ShortVariable)
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @return array
     */
    public function getMessageContentCellOptions($dc, $options = array(), CreateOptionsEvent $event = null)
    {
        if ($dc instanceof DcCompat) {
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
                    if (isset($GLOBALS['TL_LANG']['orm_avisota_message_content']['cells'][$cellName])) {
                        $label = $GLOBALS['TL_LANG']['orm_avisota_message_content']['cells'][$cellName];
                    } else {
                        $label = $cellName;
                    }

                    $options[$cellName] = $label;
                }
            }

            if ($event) {
                $event->preventDefault();
            }
        } else {
            foreach ($GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE'] as $templates) {
                foreach ($templates as $template) {
                    foreach ($template['cells'] as $cellName => $cell) {
                        if (!isset($options[$cellName])) {
                            if (isset($GLOBALS['TL_LANG']['orm_avisota_message_content']['cells'][$cellName])) {
                                $label = $GLOBALS['TL_LANG']['orm_avisota_message_content']['cells'][$cellName];
                            } else {
                                $label = $cellName;
                            }

                            $options[$cellName] = $label;
                        }
                    }
                }
            }

            if ($event) {
                $event->preventDefault();
            }
        }

        return $options;
    }

    /**
     * @param CreateOptionsEvent $event
     *
     * @internal param Layout $layout
     * @SuppressWarnings(PHPMD.ShortVariable)
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
     *
     * @return array|\ArrayObject
     * @SuppressWarnings(PHPMD.LongVariable)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function getCellContentTypeOptions($options = array(), MessageContent $content = null)
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
                        $allowedTypes = array_merge($allowedTypes, $cellConfig['preferredElements']);
                    } else {
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
                    if (!in_array($key, $allowedTypes)
                        && $value
                    ) {
                        unset($values[$key]);
                    }
                }
            } else {
                if (!in_array($group, $allowedTypes)) {
                    unset($options[$group]);
                }
            }
        }

        return $options;
    }
}
