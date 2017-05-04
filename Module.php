<?php
namespace Mailchimp;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        $config = [];

        foreach (glob(__DIR__ . DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR . '*.php') as $filename) {
            $config = array_merge($config, include $filename);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    //TODO: added __NAMESPACE__ to /src need to check if working
                    __NAMESPACE__ => __DIR__ . '/src' . __NAMESPACE__,
                ],
            ],
        ];
    }
}