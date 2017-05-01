<?php
namespace Bbmbuunk\Mailchimp;

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
                    __NAMESPACE__ => __DIR__ . '/src'
                ],
            ],
        ];
    }
}