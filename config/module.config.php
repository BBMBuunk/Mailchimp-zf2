<?php

namespace Mailchimp;

use Mailchimp\Controller\MailchimpController;
use Mailchimp\Factory\MailchimpControllerFactory;
use Mailchimp\Controller\MailchimpCampaignController;
use Mailchimp\Factory\MailchimpCampaignControllerFactory;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return [
    // This lines opens the configuration for the RouteManager
    'controllers' => [
        'factories' => [
            MailchimpController::class => MailchimpControllerFactory::class,
            MailchimpCampaignController::class => MailchimpCampaignControllerFactory::class
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
            'mailchimp' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/mailchimpcampaign',
                    'defaults' => [
                        'controller' => MailchimpCampaignController::class,
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
                                'controller' => MailchimpCampaignController::class,
                                'action'     => 'subscribe',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];