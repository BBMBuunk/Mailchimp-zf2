<?php

namespace MailchimpTest\Controller;
use MailchimpTest\Bootstrap;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class MailchimpControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $bootstrap = new Bootstrap('test');
        $this->bootstrap = array($bootstrap, 'start');
        parent::setUp();
    }

    public function testSubscribeAction()
    {
        $this->dispatch('/mailchimp/subscribe', 'POST',
            array(
                'email' => 'test@test.com'));

        $this->assertRedirectTo('home');
    }
}
