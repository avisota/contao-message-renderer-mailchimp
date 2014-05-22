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
$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2-leftsidebar'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2-leftsidebar.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'sidebar'       => array(
			'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2-rightsidebar'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2-leftsidebar.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'sidebar'       => array(
			'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-2-1'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-2-1.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-basic2column'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-basic2column.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-asym'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-asym.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-leftsidebar'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-leftsidebar.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'sidebar'       => array(
			'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-rightsidebar'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-rightsidebar.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'sidebar'       => array(
			'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-3-1'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-3-1.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-3-1-asym'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-3-1-asym.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'right'      => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'main'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'footer'     => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);

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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
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
			'preferredElements' => array('text', 'image'),
		),
	),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-basic3column-asym'] = array(
	'mode'      => 'html',
	'template'  => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-basic3column-asym.html',
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
			'content' => '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
		),
		'header'     => array(
			'xpath'            => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
			'preferredElements' => array('image'),
		),
		'left'       => array(
			'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
			'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
			'wrapRow'     => '<tr><td valign="top"></td></tr>',
		),
		'center'       => array(
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
			'preferredElements' => array('text', 'image'),
		),
	),
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
			'preferredElements' => array('image'),
		),
		'left'     => array(
			'xpath' => '//table[@id="templateBody"]//td[@class="bodyContent"]',
		),
		'linkUrl'  => array(
			'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a/@href',
			'content' => '{% if link.url %}##link.url##{% else %}## \'##link.url##\' ##{% endif %}',
		),
		'linkText' => array(
			'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a',
			'content' => '{% if link.text %}##link.text##{% else %}## "##link.text##" ##{% endif %}',
		),
		'footer'   => array(
			'xpath'            => '//table[@id="templateFooter"]//td[@class="footerContent"]',
			'preferredElements' => array('text', 'image'),
		),
	),
);
