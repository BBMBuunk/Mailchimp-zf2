<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 18-12-2016
 * Time: 15:39
 */

namespace Mailchimp;

return array(
    // This lines opens the configuration for the RouteManager
    'controllers' => array(
        'invokables' => array(
            'Mailchimp\Controller\Mailchimp' => 'Mailchimp\Controller\MailchimpController',
        ),
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
                        'controller' => 'Mailchimp\Controller\Mailchimp',
                        'action'     => 'subscribe',
                    ),
                ),
            ),
        ),
    ),

    //Set Apikey and list id's from Mailchimp
    'mailchimp' => array(
        'apikey' => 'xxxxxx',
        'listid' => 'xxxxxx',
    ),
);