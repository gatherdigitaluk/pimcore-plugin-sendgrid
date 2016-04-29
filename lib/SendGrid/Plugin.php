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

namespace Sendgrid;

use Pimcore\API\Plugin as PluginLib;
use Pimcore\Model\WebsiteSetting;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
{

    /**
     * @throws \Zend_EventManager_Exception_InvalidArgumentException
     */
    public function init()
    {
        parent::init();
    }


    /**
     * @return bool
     */
    public static function install()
    {
        self::installSettings();
        return 'SendGrid Plugin Installed Successfully! Add SendGrid credentials via Website Settings';
    }

    public static function uninstall()
    {
        return 'SendGrid Plugin Uninstalled Successfully!';
    }

    public static function isInstalled()
    {
        $setting = WebsiteSetting::getByName('plugin_sendgrid_apikey');
        return $setting instanceof WebsiteSetting;
    }

    public static function installSettings() {

        $settings = [
            [
                'name' => 'plugin_sendgrid_apikey',
                'type' => 'text',
                'data' => 'YOUR_SENDGRID_APIKEY'
            ],
            [
                'name' => 'plugin_sendgrid_disable_ssl',
                'type' => 'bool',
                'data' => false
            ],
            [
                'name' => 'plugin_sendgrid_protocol',
                'type' => 'text',
                'data' => 'https'
            ],
            [
                'name' => 'plugin_sendgrid_host',
                'type' => 'text',
                'data' => 'api.sendgrid.com'
            ],
            [
                'name' => 'plugin_sendgrid_endpoint',
                'type' => 'text',
                'data' => '/api/mail.send.json'
            ],
            [
                'name' => 'plugin_sendgrid_port',
                'type' => 'text',
                'data' => null
            ],
            [
                'name' => 'plugin_sendgrid_url',
                'type' => 'text',
                'data' => null
            ],
            [
                'name' => 'plugin_sendgrid_raise_exceptions',
                'type' => 'bool',
                'data' => false
            ]
        ];

        foreach ($settings as $config) {

            $setting = WebsiteSetting::getByName($config['name']);
            if (!$setting) {
                $setting = new WebsiteSetting();
                $setting->setName($config['name']);
            }
            $setting->setType($config['type']);
            $setting->setData($config['data']);
            $setting->save();
        }

    }

}
