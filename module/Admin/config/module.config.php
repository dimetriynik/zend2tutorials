<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(


    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => Admin\Controller\IndexController::class,
            'category' => Admin\Controller\CategoryController::class
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,

                'child_routes' => [
                    'category' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => 'category/[:action/][:id/]',
                            'defaults' => [
                                'controller' => 'category',
                                'action' => 'index'
                            ]
                        ]
                    ]
                ] // < child routes

            ),




        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
);