<?php

namespace Mailchimp\Factory;

use Mailchimp\Controller\MailchimpController;
use Zend\Config\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class MailchimpControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return MailchimpController
     * @throws \Exception
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();

        $config = $serviceManager->get('config');
        if (is_array($config)) {
            $configArray = $config['mailchimp'];
        }

        if (isset($configArray) && is_array($configArray)) {
            return new MailchimpController($serviceManager, $configArray);
        } else {
            throw new \Exception('Failed getting config...');
        }
    }
}