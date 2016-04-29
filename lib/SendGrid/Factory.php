<?php

/**
 * Plugin
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md
 * file distributed with this source code.
 *
 * @copyright  Copyright (c) 2014-2016 Gather Digital Ltd (https://www.gatherdigital.co.uk)
 * @license    https://www.gatherdigital.co.uk/license     GNU General Public License version 3 (GPLv3)
 */
namespace SendGrid;

use SendGrid;

class Factory
{


    /**
     * Returns the fdefault sendgrid client for use elsewhere
     * @return \SendGrid
     * @throws \Exception
     */
    public static function getDefaultClient()
    {
        $config = \Pimcore\Config::getWebsiteConfig();

        $apiKey = $config->get('plugin_sendgrid_apikey');

        if (empty($apiKey) || $apiKey === 'YOUR_SENDGRID_APIKEY') {
            throw new \Exception('Sendgrid has not been setup, check Website Settings');
        }

        $options = [
            'turn_off_ssl_verification' => (bool) $config->get('plugin_sendgrid_apikey'),
            'protocol'                  => ($config->get('plugin_sendgrid_protocol') ?: 'https'),
            'host'                      => ($config->get('plugin_sendgrid_host') ?: 'api.sendgrid.com'),
            'endpoint'                  => ($config->get('plugin_sendgrid_endpoint') ?: '/api/mail.send.json'),
            'port'                      => ($config->get('plugin_sendgrid_port') ?: null),
            'url'                       => ($config->get('plugin_sendgrid_url') ?: null),
            'raise_exceptions'          => (bool) $config->get('plugin_sendgrid_raise_exceptions')
        ];

        return new SendGrid($apiKey, $options);
    }

}
