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

/**
 * Table orm_avisota_layout
 * Entity Avisota\Contao:Layout
 */
$GLOBALS['TL_DCA']['orm_avisota_layout']['metapalettes']['mailChimp'] = array
(
    'layout'    => array('type', 'title', 'alias', 'preview'),
    'template'  => array('mailChimpTemplate', 'clearStyles', 'stylesheets'),
    'structure' => array('allowedCellContents'),
);

$GLOBALS['TL_DCA']['orm_avisota_layout']['fields']['mailChimpTemplate'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['orm_avisota_layout']['mailChimpTemplate'],
    'exclude'          => true,
    'inputType'        => 'select',
    'eval'             => array(
        'mandatory'          => true,
        'includeBlankOption' => true,
        'submitOnChange'     => true,
    ),
    'options_callback' =>
        \ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEventCallbackFactory::createCallback(
            'avisota.create-mailchimp-template-options',
            'Avisota\Contao\Core\Event\CreateOptionsEvent'
        ),
);
