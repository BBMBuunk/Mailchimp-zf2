<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 18-12-2016
 * Time: 19:20
 */

namespace Mailchimp\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Bbmbuunk\Mailchimp\Service\MailchimpService;

class MailchimpController extends AbstractActionController
{
    /**
     * @var ServiceManager|ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * @var
     */
    protected $MailChimp;

    public function __construct(ServiceLocatorInterface $serviceManager)
    {
        $this->setServiceManager($serviceManager);
    }

    /**
     * @return ServiceLocatorInterface|ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param ServiceLocatorInterface|ServiceManager $serviceManager
     * @return MailchimpController
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function subscribeAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($this->getRequest()->getPost('email'));
        $this->MailChimp->post("lists/".$this->getConfig()['mailchimp']['listid']."/members", [
            'email_address' => $email,
            'status'        => 'subscribed',
        ]);
        return $this->redirectToRoute('blog');
    }

    public function unsubscribeAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($this->getRequest()->getPost('email'));
        if ($email) {
            $emailHash = $this->MailChimp->subscriberHash($email);
        }
        $this->MailChimp->put("lists/".$this->getConfig()['mailchimp']['listid']."/members/". $emailHash, [
            'status'        => 'unsubscribed',
        ]);
        return $this->redirectToRoute('blog');
    }

    public function deleteAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($this->getRequest()->getPost('email'));
        if ($email) {
            $emailHash = $this->MailChimp->subscriberHash($email);
        }
        $this->MailChimp->delete("lists/".$this->getConfig()['mailchimp']['listid']."/members/". $emailHash);
        return $this->redirectToRoute('blog');
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

    public function getSubscriberAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($this->getRequest()->getPost('email'));
        if ($email) {
            $emailHash = $this->MailChimp->subscriberHash($email);
        }
        $result = $this->MailChimp->get("lists/".$this->getConfig()['mailchimp']['listid']."/members/". $emailHash);
        if(isset($result['status'])) {
            return $this->redirectToRoute('blog');
        }
        return "We found nothing at all.";
    }
} 