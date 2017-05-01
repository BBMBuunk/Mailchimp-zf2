<?php

namespace Bbmbuunk\Mailchimp;

use Bbmbuunk\Mailchimp\Controller\MailchimpController;
use Bbmbuunk\Mailchimp\Factory\MailchimpControllerFactory;

return array(
    // This lines opens the configuration for the RouteManager
    'controllers' => array(
        'factories' => [
            MailchimpController::class => MailchimpControllerFactory::class
        ],
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'mailchimp' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/mailchimp[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => MailchimpController::class,
                        'action'     => 'subscribe',
                    ),
                ),
            ),
        ),
    ),
);