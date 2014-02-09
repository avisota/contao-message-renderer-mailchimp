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
	'theme'     => array('type', 'title', 'alias', 'preview'),
	'template' => array('mailChimpTemplate', 'allowedCellContents', 'clearStyles', 'stylesheets'),
	'expert'    => array(':hide', 'templateDirectory')
);

$GLOBALS['TL_DCA']['orm_avisota_layout']['fields']['mailChimpTemplate'] = array
(
	'label'            => &$GLOBALS['TL_LANG']['orm_avisota_layout']['mailChimpTemplate'],
	'exclude'          => true,
	'inputType'        => 'select',
	'options_callback' => array('Avisota\Contao\MailChimp\DataContainer\OptionsBuilder', 'getMailChimpTemplateOptions'),
	'options_callback' => CreateOptionsEventCallbackFactory::createCallback('avisota.create-mailchimp-template-options'),
	'eval'             => array(
		'mandatory'          => true,
		'includeBlankOption' => true,
		'submitOnChange'     => true,
	),
);
