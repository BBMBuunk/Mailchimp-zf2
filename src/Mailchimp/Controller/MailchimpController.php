<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 18-12-2016
 * Time: 19:20
 */

namespace Mailchimp\Controller;

use DrewM\MailChimp\MailChimp;
use Zend\Mvc\Controller\AbstractActionController;


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
        $this->MailChimp = new MailChimp($this->getConfig()['mailchimp']['apikey']);
        $result = $this->MailChimp->post("lists/".$this->getConfig()['mailchimp']['listid']."/members", [
            'email_address' => 'davy@example.com',
            'status'        => 'subscribed',
        ]);

        print_r($result);
    }

    public function unsubscribeAction()
    {
        $apikey = $_GET['apikey'];
        $listid = $_GET['listid'];

    }
} 