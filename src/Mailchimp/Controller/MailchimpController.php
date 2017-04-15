<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 18-12-2016
 * Time: 19:20
 */

namespace Mailchimp\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Mailchimp\Service\MailchimpService;

class MailchimpController extends AbstractActionController
{
    protected $em;
    protected $config;
    protected $MailChimp;

    public function getConfig()
    {
        return $this->getServiceLocator()->get('Config');
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function subscribeAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($_GET['email']);
        $this->MailChimp->post("lists/".$this->getConfig()['mailchimp']['listid']."/members", [
            'email_address' => $email,
            'status'        => 'subscribed',
        ]);
        return $this->redirect()->toRoute('blog');
    }

    public function unsubscribeAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($_GET['email']);
        if ($email) {
            $emailHash = $this->MailChimp->subscriberHash($email);
        }
        $this->MailChimp->put("lists/".$this->getConfig()['mailchimp']['listid']."/members/". $emailHash, [
            'status'        => 'unsubscribed',
        ]);
        return $this->redirect()->toRoute('blog');
    }

    public function deleteAction()
    {
        $this->MailChimp = new MailchimpService($this->getConfig()['mailchimp']['apikey']);
        $email = $this->MailChimp->validateEmail($_GET['email']);
        if ($email) {
            $emailHash = $this->MailChimp->subscriberHash($email);
        }
        $this->MailChimp->delete("lists/".$this->getConfig()['mailchimp']['listid']."/members/". $emailHash);
        return $this->redirect()->toRoute('blog');
    }
} 