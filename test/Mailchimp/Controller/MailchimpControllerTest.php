<?php

namespace Mailchimp\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class MailchimpControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include '/xampp/htdocs/zend-doctrine/config/application.config.php'
        );
        parent::setUp();
    }
}
