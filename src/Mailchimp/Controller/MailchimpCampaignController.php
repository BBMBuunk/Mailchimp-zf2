<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 4-5-2017
 * Time: 10:59
 */

namespace Mailchimp\Controller;

use Mailchimp\Service\MailchimpCampaignService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class MailchimpCampaignController extends AbstractActionController
{
    /**
     * @var ServiceManager|ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * @var
     */
    protected $MailChimp;

    /**
     * @var array
     */
    protected $config;

    public function __construct(ServiceLocatorInterface $serviceManager, array $config)
    {
        $this->setConfig($config);
        $this->setServiceManager($serviceManager);
    }

    public function indexAction()
    {
        return $this->redirectToRoute('home');
    }

    public function subscribeAction()
    {
        $email = $this->MailChimp->validateEmail($this->getRequest()->getPost('email'));
        $email;
        return $this->redirectToRoute('home');
    }

    /**
     * Redirect to a route, or pass the url to the view for a javascript redirect
     *
     * @return mixed|\Zend\Http\Response
     */
    public function redirectToRoute()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            return [
                'redirect' => call_user_func_array([
                    $this->url(), 'fromRoute'
                ], func_get_args())
            ];
        }

        return call_user_func_array([
            $this->redirect(), 'toRoute'
        ], func_get_args());
    }

    /**
     * @param ServiceLocatorInterface|ServiceManager $serviceManager
     * @return MailchimpCampaignController
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return MailchimpCampaignController
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

}