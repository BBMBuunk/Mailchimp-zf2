<?php

namespace Mailchimp;

use Mailchimp\Controller\MailchimpController;
use Mailchimp\Factory\MailchimpControllerFactory;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return [
    // This lines opens the configuration for the RouteManager
    'controllers' => [
        'factories' => [
            MailchimpController::class => MailchimpControllerFactory::class
        ],
    ],

    // The following section is new and should be added to your file
    'router' => [
        'routes' => [
            'mailchimp' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/mailchimp',
                    'defaults' => [
                        'controller' => MailchimpController::class,
                        'action'     => 'index',
                    ],
                ],
                //Add every action like subscribe
                'may_terminate' => true,
                'child_routes' => [
                    'subscribe' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/subscribe',
                            'defaults' => [
                                'controller' => MailchimpController::class,
                                'action'     => 'subscribe',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];