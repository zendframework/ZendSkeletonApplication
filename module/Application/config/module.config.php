<?php
namespace Application;

return array(
    'router' => array(
        'routes' => array(
            /**
             * This is where you define which controller and action is loaded based on the url.
             * We'll probably only use two types of routes: 'Literal' and 'Segment'.
             * The Literal and Segment routes only pay attention to what comes after the domain name.
             * So, for example, if the url for your site is "http://www.mysite.com/test123", the Literal and
             * Segment routes will only see "/test123".
             */

            /**
             * Routes are always named. This first one is named 'home'. It's defined as a literal route by the
             * 'type' option. A literal route is only used when the url matches exactly what's defined by the
             * 'route' key under 'options'. For the route named 'home', that's "/".
             *
             * When a route is matched, its job is to tell the framework which controller and action to load.
             * You can define the controller and action under the 'defaults' element under 'options'. By itself,
             * a Literal route can only match one thing, so it can only load one controller and action.
             * For the 'home' route, it tells the framework to load a controller named 'Application\Controller\Index',
             * and run a method called 'index' (which the framework internally changes to indexAction)
             *
             */
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
                
            
            
            
            
            /**
             * Here's a Segment route. Segment routes allow you to define variables that can be used to change
             * the controller, action, and even add new variables that you can use any way you like.
             *
             * I've called this one 'course' to make it easier to refer to in the application. Just like the Literal
             * route, it only matches when the url looks like what's defined under the 'route' option. In this case,
             * "/course".
             *
             * However, this one allows you to define variables through the url. Variables can be defined with a
             * colon character ':' followed by the variable name. So, ":action" means that whatever value appears
             * in the url at that position will be assigned to the "action" variable. The brackets [...] make the
             * variable optional. Since this is written as /course[/:action], this route will match "/course/add"
             * "/course/edit", "/course/custom-action", or just "/course".
             * If those brackets were not there, the action would be mandatory and the route "/course/:action" would not
             * understand a url that just had "/course".
             */
           
            
            'course' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/course[/:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Course', // The controller will always be the same for the 'course' route
                        'action'     => 'index' // By default, the action is index. But if you type in /course/add,
                                                // the action will become "add" and the framework will run addAction
                    )
                ),
                'may_terminate' => true, // This key just means it's ok for the match to stop here. If this was false,
                                         // the url would have to include some variables for the child route below
                /**
                 * Here's a child route. Child routes let you pick up where the parent route left off. Since the 'course'
                 * route only lets you assign a value to 'action', we need some way to allow additional variables to be
                 * passed along in the url. Usually you see that with something that looks like: "?name1=value1&name2=value2"
                 * but we'll get a little fancier with this application. The Wildcard route lets us specify almost any
                 * parameter delimiter and key value delimiter we like. In this case I used "/" and "=" respectively, so
                 * we can pass variables to the controller as: "/name1=value1/name2=value2".
                 *
                 * Notice that you can have more than one child route, but these too have to be named! In this case, I
                 * named the child route 'wildcard'. Since it's a child of 'course', we will refer to it throughout the
                 * application as 'course/wildcard'.
                 */
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard',
                        'secret'=>array(
                            'type'=> 'Secret',
                              
                           'options' => array(
                            'param_delimiter'     => '/',
                            'key_value_delimiter' => '='
                                
                           ) 
                        )
                    )
                )
                
                
                
                
                
                
                
                
                
            ),

            /**
             * TODO: Task 1 - Add a route for each of your controllers.
             * This may be a bit tedious, but it will make it MUCH easier to build your links
             * everywhere else in the application
             *
             * Next: open view/zfc-user/user/index.phtml
             * 
             */
            

            'major' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/major[/:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Major',
                        'action'     => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard',
                        'secret'=>array(
                            'type'=> 'Secret',
                            'options' => array(
                                'param_delimiter'     => '/',
                                'key_value_delimiter' => '='
                            )
                        )
                    )
               
                )
                
                
            )
            
            
            
        ),
        
        'student' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/student[/:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Student',
                        'action'     => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard',
                        'secret'=>array(
                            'type'=> 'Secret',
                            'options' => array(
                                'param_delimiter'     => '/',
                                'key_value_delimiter' => '='
                            )
                        )
                    )
               
                )
                
                
            )
            
            
            
        ),
        
        
    
                
    /**
     * IMPORTANT:
     * This is the all important 'controllers' configuration.
     * The system WILL NOT load a controller unless it is defined in this list.
     * If you add a new controller, make sure you add it here!
     */
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'   => 'Application\Controller\IndexController',
            'Application\Controller\Major'   => 'Application\Controller\MajorController',
            'Application\Controller\Admin'   => 'Application\Controller\AdminController',
            'Application\Controller\Course'  => 'Application\Controller\CourseController',
            'Application\Controller\Schedule'=> 'Application\Controller\ScheduleController',
            'Application\Controller\Student' => 'Application\Controller\StudentController',   
        ),
    ),

    /**
     * STOP: You shouldn't have to edit anything below this line.
     */
    'service_manager' => array(
        'aliases'   => array(
            'EntityManager' => 'Doctrine\ORM\EntityManager',
        ),
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),

    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'zfcuser' => __DIR__ . '/../view/zfc-user/',
            __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    )
);
