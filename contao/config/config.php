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
 * Message renderer
 */
$GLOBALS['AVISOTA_MESSAGE_RENDERER'][] = 'mailChimp';

/**
 * MailChimp templates
 */
$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2-leftsidebar'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2-leftsidebar.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'sidebar'      => array(
            'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-1-2-rightsidebar'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-1-2-leftsidebar.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'sidebar'      => array(
            'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-2-1'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-2-1.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['2col-basic2column'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/2col-basic2column.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-asym'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-asym.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-leftsidebar'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-leftsidebar.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'sidebar'      => array(
            'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-1-3-rightsidebar'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-1-3-rightsidebar.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'sidebar'      => array(
            'xpath'       => '//table[@id="templateSidebar"]//td[@class="sidebarContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-3-1'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-3-1.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-3-1-asym'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-3-1-asym.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'main'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-basic3column'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-basic3column.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['3col-basic3column-asym'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/3col-basic3column-asym.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'       => array(
            'xpath'         => '//div[@mc:edit="std_preheader_content"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//div[@mc:edit="std_preheader_content"]/..',
        ),
        'viewonline'   => array(
            'xpath'   => '//div[@mc:edit="std_preheader_links"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="leftColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'center'       => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="centerColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'right'        => array(
            'xpath'       => '//table[@id="templateBody"]//td[@class="rightColumnContent"]',
            'wrapContent' => '<table border="0" cellpadding="20" cellspacing="0" width="100%"></table>',
            'wrapRow'     => '<tr><td valign="top"></td></tr>',
        ),
        'social'       => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="social"]/..',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'rewards'      => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
            'content'       => '',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="monkeyRewards"]',
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['templates']['transactional-basic'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/templates/transactional_basic.html',
    'cells'    => array(
        'title'        => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'header'       => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'left'         => array(
            'xpath' => '//table[@id="templateBody"]//td[@class="bodyContent"]',
        ),
        'linkUrl'      => array(
            'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a/@href',
            'content' => '{% if link.url %}##link.url##{% else %}## \'##link.url##\' ##{% endif %}',
        ),
        'linkText'     => array(
            'xpath'   => '//table[@id="templateBody"]//td[@class="templateButtonContent"]//a',
            'content' => '{% if link.text %}##link.text##{% else %}## "##link.text##" ##{% endif %}',
        ),
        'footer'       => array(
            'xpath'             =>
                '//table[@id="templateFooter"]//td[@class="footerContent"]//div[@mc:edit="std_footer"]/..',
            'preferredElements' => array('text', 'image'),
        ),
        'subscription' => array(
            'xpath'         => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@class="footerContent"]//td[@id="utility"]/..',
        ),
    ),
);

$GLOBALS['AVISOTA_MAILCHIMP_TEMPLATE']['responsive-templates']['base_boxed_2column_query'] = array(
    'mode'     => 'html',
    'template' => 'system/modules/avisota-message-renderer-mailchimp/blueprints/responsive-templates/base_boxed_2column_query.html',
    'cells'    => array(
        'title'      => array(
            'xpath'   => '/html/head/meta[@property="og:title"]/@content|/html/head/title',
            'content' => '##message.subject##',
        ),
        'teaser'     => array(
            'xpath'         => '//td[@mc:edit="preheader_content00"]',
            'content'       => '##message.description##',
            'ifEmptyRemove' => '//td[@mc:edit="preheader_content00"]/..',
        ),
        'viewonline' => array(
            'xpath'   => '//td[@mc:edit="preheader_content01"]',
            'content' =>
                '{% if view_online_link is defined and view_online_link|length > 0 %}##view_online_link##{% endif %}',
        ),
        'header'     => array(
            'xpath'             => '//table[@id="templateHeader"]//img[@mc:edit="header_image"]/..',
            'preferredElements' => array('image'),
        ),
        'main'       => array(
            'xpath'             => '//table[@id="templateBody"]//td[@class="bodyContent"]',
            'preferredElements' => array('text'),
        ),
        'left'       => array(
            'xpath'             => '//table[@id="templateColumns"]//img[@mc:edit="left_column_image"]/..',
            'preferredElements' => array('text'),
        ),
        'leftAfter'  => array(
            'xpath'             => '//table[@id="templateColumns"]//td[@mc:edit="left_column_content"]',
            'content' => ''
        ),
        'right'      => array(
            'xpath'             => '//table[@id="templateColumns"]//img[@mc:edit="right_column_image"]/..',
            'preferredElements' => array('text'),
        ),
        'rightAfter' => array(
            'xpath'             => '//table[@id="templateColumns"]//td[@mc:edit="right_column_content"]',
            'content' => ''
        ),
        'footer'     => array(
            'xpath'             => '//table[@id="templateFooter"]//td[@mc:edit="footer_content00"]',
            'preferredElements' => array('text', 'image'),
        ),
        'footerAfter'     => array(
            'xpath'             => '//table[@id="templateFooter"]//td[@mc:edit="footer_content01"]',
            'content' => ''
        ),
        'subscription' => array(
            'xpath'             => '//table[@id="templateFooter"]//td[@mc:edit="footer_content02"]',
            'content'       =>
                '{% if recipient.manage_subscription_link is defined and ' .
                'recipient.manage_subscription_link.url|length > 0 %}' .
                '<a href="##recipient.manage_subscription_link.url##">##recipient.manage_subscription_link.text##</a>' .
                '{% elseif recipient.unsubscribe_link is defined and recipient.unsubscribe_link.url|length > 0 %}' .
                '<a href="##recipient.unsubscribe_link.url##">##recipient.unsubscribe_link.text##</a>' .
                '{% endif %}',
            'ifEmptyRemove' => '//table[@id="templateFooter"]//td[@mc:edit="footer_content02"]/..',
        ),
    )
);
