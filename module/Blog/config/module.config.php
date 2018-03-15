<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(

        'doctrine' => [
            'driver' => [
                // defines an annotation driver with two paths, and names it `my_annotation_driver`
                'blog_entity' => [
                    'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [
                        __DIR__.'/../src/Blog/Entity',
                    ],
                ],

                // default metadata driver, aggregates all other drivers into a single one.
                // Override `orm_default` only if you know what you're doing
                'orm_default' => [
                    'drivers' => [
                        // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                        'Blog\Entity' => 'blog_entity',
                    ],
                ],
            ],
        ],


    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Index' => Blog\Controller\IndexController::class,
        ),
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
    ),
);