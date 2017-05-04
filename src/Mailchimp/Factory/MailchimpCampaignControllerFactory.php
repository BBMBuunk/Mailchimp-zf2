<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 4-5-2017
 * Time: 11:00
 */

namespace Mailchimp\Factory;

use Mailchimp\Controller\MailchimpCampaignController;
use Zend\Config\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class MailchimpCampaignControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return MailchimpCampaignController
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
            return new MailchimpCampaignController($serviceManager, $configArray);
        }

        throw new \Exception('Failed getting config...');
    }
}