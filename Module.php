<?php
namespace Mailchimp;


class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
        //TODO: could be added i guess
        return array(
            'services' => array()
            );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}