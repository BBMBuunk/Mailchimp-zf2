<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 18-12-2016
 * Time: 19:20
 */

namespace Mailchimp\Controller;

use Zend\Mvc\Controller\AbstractActionController;


class MailchimpController extends AbstractActionController
{
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function subscribeAction()
    {
        $apikey = $_GET['apikey'];
        $listid = $_GET['listid'];

    }

    public function unsubscribeAction()
    {
        $apikey = $_GET['apikey'];
        $listid = $_GET['listid'];

    }
} 