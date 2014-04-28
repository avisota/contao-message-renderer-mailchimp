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
	'options_callback' => \ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEventCallbackFactory::createCallback('avisota.create-mailchimp-template-options'),
	'eval'             => array(
		'mandatory'          => true,
		'includeBlankOption' => true,
		'submitOnChange'     => true,
	),
);
