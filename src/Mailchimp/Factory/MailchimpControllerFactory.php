<?php

namespace Mailchimp\Factory;

use Bbmbuunk\Mailchimp\Controller\MailchimpController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class MailchimpControllerFactory extends FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return IndexController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();
        /** @var IndexControllerService $entityService */
        return new MailchimpController($serviceManager);
    }
}