<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    //$routes->connect('/', ['controller' => 'Home', 'action' => 'index', 'home'=>true]);


    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    //$routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    $routes->connect('/', ['controller' => 'homes', 'action' => 'index']);
    $routes->connect('event/:slug/*', ['controller' => 'event', 'action' => 'eventdetail'], ['pass' => ['slug']]);
    $routes->connect('event/myevent/*', ['controller' => 'event', 'action' => 'myevent']);
    $routes->connect('event/postevent/*', ['controller' => 'event', 'action' => 'postevent']);
    $routes->connect('event/upcomingevent/*', ['controller' => 'event', 'action' => 'upcomingevent']);
    $routes->connect('event/loctionsearch/*', ['controller' => 'event', 'action' => 'loctionsearch']);
    $routes->connect('event/upcomingeventsearch/*', ['controller' => 'event', 'action' => 'upcomingeventsearch']);
    $routes->connect('event/checkexist/*', ['controller' => 'event', 'action' => 'checkexist']);
    $routes->connect('event/settings/*', ['controller' => 'event', 'action' => 'settings']);
    $routes->connect('event/manage/*', ['controller' => 'event', 'action' => 'manage']);
    $routes->connect('event/package/*', ['controller' => 'event', 'action' => 'package']);
    $routes->connect('event/editpackage/*', ['controller' => 'event', 'action' => 'editpackage']);
    $routes->connect('event/toggle/*', ['controller' => 'event', 'action' => 'toggle']);
    $routes->connect('event/edittickets/*', ['controller' => 'event', 'action' => 'edittickets']);
    $routes->connect('event/addons/*', ['controller' => 'event', 'action' => 'addons']);
    $routes->connect('event/editaddon/*', ['controller' => 'event', 'action' => 'editaddon']);
    $routes->connect('event/questions/*', ['controller' => 'event', 'action' => 'questions']);
    $routes->connect('event/linktickets/*', ['controller' => 'event', 'action' => 'linktickets']);
    $routes->connect('event/editquestion/*', ['controller' => 'event', 'action' => 'editquestion']);
    $routes->connect('event/generalsetting/*', ['controller' => 'event', 'action' => 'generalsetting']);
    $routes->connect('event/committee/*', ['controller' => 'event', 'action' => 'committee']);
    $routes->connect('event/getusersname/*', ['controller' => 'event', 'action' => 'getusersname']);
    $routes->connect('event/geteventcommittee/*', ['controller' => 'event', 'action' => 'geteventcommittee']);
    $routes->connect('event/importcommittee/*', ['controller' => 'event', 'action' => 'importcommittee']);
    $routes->connect('event/committeoptions/*', ['controller' => 'event', 'action' => 'committeoptions']);
    $routes->connect('event/committeegroups/*', ['controller' => 'event', 'action' => 'committeegroups']);
    $routes->connect('event/addgroupmember/*', ['controller' => 'event', 'action' => 'addgroupmember']);
    $routes->connect('event/deletemember/*', ['controller' => 'event', 'action' => 'deletemember']);
    $routes->connect('event/committeetickets/*', ['controller' => 'event', 'action' => 'committeetickets']);
    $routes->connect('event/assigncommtickets/*', ['controller' => 'event', 'action' => 'assigncommtickets']);
    $routes->connect('event/deletevent/*', ['controller' => 'event', 'action' => 'deletevent']);
    $routes->connect('event/saleaddons/*', ['controller' => 'event', 'action' => 'saleaddons']);
    $routes->connect('event/sales/*', ['controller' => 'event', 'action' => 'sales']);
    $routes->connect('event/lists/*', ['controller' => 'event', 'action' => 'lists']);
    $routes->connect('event/payments/*', ['controller' => 'event', 'action' => 'payments']);
    $routes->connect('event/paymentdetail/*', ['controller' => 'event', 'action' => 'paymentdetail']);
    $routes->connect('event/analytics/*', ['controller' => 'event', 'action' => 'analytics']);
    $routes->connect('event/payouts/*', ['controller' => 'event', 'action' => 'payouts']);
    $routes->connect('event/requests/*', ['controller' => 'event', 'action' => 'requests']);
    $routes->connect('event/boxoffice/*', ['controller' => 'event', 'action' => 'boxoffice']);
    $routes->connect('event/eventstatus/*', ['controller' => 'event', 'action' => 'eventstatus']);
    $routes->connect('event/exporttickets/*', ['controller' => 'event', 'action' => 'exporttickets']);
    $routes->connect('event/exportticketcsv/*', ['controller' => 'event', 'action' => 'exportticketcsv']);
    $routes->connect('event/exportticketsdata/*', ['controller' => 'event', 'action' => 'exportticketsdata']);
    $routes->connect('event/activationevent/*', ['controller' => 'event', 'action' => 'activationevent']);
    $routes->connect('event/exportexcel/*', ['controller' => 'event', 'action' => 'exportexcel']);
    $routes->connect('event/importattendees/*', ['controller' => 'event', 'action' => 'importattendees']);
    $routes->connect('event/downloadattendees/*', ['controller' => 'event', 'action' => 'downloadattendees']);
    $routes->connect('event/attendees/*', ['controller' => 'event', 'action' => 'attendees']);
    $routes->connect('event/importprattendees/*', ['controller' => 'event', 'action' => 'importprattendees']);
    $routes->connect('event/attendeessearch/*', ['controller' => 'event', 'action' => 'attendeessearch']);
    $routes->connect('event/selfregistration/*', ['controller' => 'event', 'action' => 'selfregistration']);
         // $routes->connect('event/usersmanager/*', ['controller' => 'event', 'action' => 'usersmanager']);
    // $routes->connect('event/roles/*', ['controller' => 'event', 'action' => 'roles']);

    // $routes->connect('categories/:slug/*', ['controller' => 'Subcategory', 'action' => 'index'], ['pass' => ['slug']]);

    $routes->connect('/admin', ['controller' => 'logins', 'action' => 'login', 'admin' => true]);
    $routes->connect('/signup', ['controller' => 'logins', 'action' => 'signup']);
    $routes->connect('/login', ['controller' => 'logins', 'action' => 'frontlogin']);
    $routes->connect('/frontlogout', ['controller' => 'logins', 'action' => 'frontlogout']);
    $routes->connect('/dashboardmyevent', ['controller' => 'homes', 'action' => 'dashboard_my_event']);
    $routes->connect('/pastevent', ['controller' => 'homes', 'action' => 'pastevent']);
    $routes->connect('/checkticket', ['controller' => 'homes', 'action' => 'checkticket']);
    $routes->connect('/upcomingevent', ['controller' => 'homes', 'action' => 'upcomingevent']);
    $routes->connect('/home', ['controller' => 'homes', 'action' => 'index']);
    $routes->connect('/privacy', ['controller' => 'homes', 'action' => 'privacy']);
    $routes->connect('/contactus', ['controller' => 'homes', 'action' => 'contactus']);
    $routes->connect('/contact', ['controller' => 'homes', 'action' => 'contact']);
    
    Router::prefix('admin', function ($routes) {
        $routes->fallbacks('InflectedRoute');
    });


    // $routes->connect('/', ['controller' => 'Homes', 'action' => 'index']);
    // $routes->connect('/admin', ['controller' => 'Logins', 'action' => 'index', 'admin'=>true]); 
    // $routes->connect('admin/logins', ['controller' => 'Logins', 'action' => 'index', 'admin'=>true]); 
    // $routes->connect('/home', ['controller' => 'Homes', 'action' => 'index']);
    // $routes->connect('/aboutus', ['controller' => 'pages', 'action' => 'aboutus']);
    // $routes->connect('/companydetail', ['controller' => 'pages', 'action' => 'companydetail']);
    // $routes->connect('/contactus', ['controller' => 'pages', 'action' => 'contactus']);  
    // $routes->connect('/subscribeplan', ['controller' => 'pages', 'action' => 'subscribeplan']);

    // $routes->connect('/termconditions', ['controller' => 'pages', 'action' => 'termconditions']);
    // $routes->connect('/paymentdetails', ['controller' => 'pages', 'action' => 'paymentdetails']);
    // $routes->connect('/login', ['controller' => 'logins', 'action' => 'frontlogin']);
    // $routes->connect('/signup', ['controller' => 'users', 'action' => 'signup']);
    // $routes->connect('/dashboard', ['controller' => 'homes', 'action' => 'dashboard']);
    // $routes->connect('/company/*', ['controller' => 'homes', 'action' => 'company']);
    // $routes->connect('/report/*', ['controller' => 'homes', 'action' => 'report']);
    // $routes->connect('/privacypolicy', ['controller' => 'pages', 'action' => 'privacypolicy']);

    // $routes->connect('/contactus', ['controller' => 'pages', 'action' => 'contactus']);


    //      * Connect catchall routes for all controllers.
    //      *
    //      * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
    //      *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
    //      *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
    //      *
    //      * Any route class can be used with this method, such as:
    //      * - DashedRoute
    //      * - InflectedRoute
    //      * - Route
    //      * - Or your own route class
    //      *
    //      * You can remove these routes once you've connected the
    //      * routes you want in your application.

    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
