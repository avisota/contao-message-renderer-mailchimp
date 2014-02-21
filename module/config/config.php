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
 * Events
 */
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Avisota\Contao\Message\Renderer\MailChimp\DataContainer\OptionsBuilder';
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Avisota\Contao\Message\Renderer\MailChimp\Renderer\MailChimpRenderer';

/**
 * Message renderer
 */
$GLOBALS['AVISOTA_MESSAGE_RENDERER'][]  = 'mailChimp';

/**
 * MailChimp templates
 */
$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-basic3column'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-basic3column.html',
	'cells'     => array(
		'title'      => array(
			'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
			'content' => '##message.subject##',
		),
		'teaser'     => array(
			'xpath'         => '//div[@mc:edit="std_preheader_content"]',
			'content'       => '##message.description##',
			'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
		),
		'viewonline' => array(
			'xpath'   => '//div[@mc:edit="std_preheader_links"]',
			'content' => '##view_online_link##',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferedElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferedElements' => array('text', 'image'),
		),
	),
	'formation' => array(
		array(
			'cells' => array(
				'teaser' => array(),
			),
		),
		array(
			'cells' => array(
				'left'  => array(),
				'main'  => array(),
				'right' => array(),
			),
		),
		array(
			'cells' => array(
				'footer' => array(),
			),
		),
	)
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['transactional-basic'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/transactional_basic.html',
	'cells'     => array(
		'title'    => array(
			'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
			'content' => '##message.subject##',
		),
		'header'   => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferedElements' => array('image'),
		),
		'left'     => array(
			'xpath' => '//table[@id="templateBody"]//td[@class="bodyContent"]',
		),
		'linkUrl'  => array(
			'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a/@href',
			'content' => '##link.url##',
		),
		'linkText' => array(
			'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a',
			'content' => '##link.text##',
		),
		'footer'   => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferedElements' => array('text', 'image'),
		),
	),
	'formation' => array(
		array(
			'cells' => array(
				'teaser' => array(),
			),
		),
		array(
			'cells' => array(
				'left'  => array(),
				'main'  => array(),
				'right' => array(),
			),
		),
		array(
			'cells' => array(
				'footer' => array(),
			),
		),
	)
);
