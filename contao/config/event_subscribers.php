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

use Avisota\Contao\Message\Renderer\MailChimp\DataContainer\OptionsBuilder;
use Avisota\Contao\Message\Renderer\MailChimp\Renderer\MailChimpRenderer;

return array(
    new OptionsBuilder(),
    new MailChimpRenderer(),
);
