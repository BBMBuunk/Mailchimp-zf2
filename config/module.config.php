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
                    'unsubscribe' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/unsubscribe',
                            'defaults' => [
                                'controller' => MailchimpController::class,
                                'action'     => 'unsubscribe',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => MailchimpController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                    'getsubscriber' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/get-subscriber',
                            'defaults' => [
                                'controller' => MailchimpController::class,
                                'action'     => 'getSubscriber',
                            ],
                        ],
                    ],
                    'search' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/search',
                            'defaults' => [
                                'controller' => MailchimpController::class,
                                'action'     => 'searchSubscriber',
                            ],
                        ],
                    ],
                ],
            ],
            'campaign' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/campaign',
                    'defaults' => [
                        'controller' => MailchimpCampaignController::class,
                        'action'     => 'index',
                    ],
                ],
                //Add every action like subscribe
                'may_terminate' => true,
                'child_routes' => [
                    'create' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => MailchimpCampaignController::class,
                                'action'     => 'createCampaign',
                            ],
                        ],
                    ],
                    'send' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/send',
                            'defaults' => [
                                'controller' => MailchimpCampaignController::class,
                                'action'     => 'sendCampaign',
                            ],
                        ],
                    ],
                    'getAllCampaigns' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/get-all-campaigns',
                            'defaults' => [
                                'controller' => MailchimpCampaignController::class,
                                'action'     => 'getAll',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];