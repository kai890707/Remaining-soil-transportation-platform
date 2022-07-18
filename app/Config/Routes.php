<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


//view

$routes->get('/','Home::index');



//測試
$routes->get('lobby', 'Home::lobby', ["filter" => "login"]);
$routes->get('personal', 'Home::personal');
$routes->get('projectList', 'Home::projectList');
$routes->get('documentUse', 'Home::documentUse');
$routes->get('documentList', 'Home::documentList');
$routes->get('qrscan', 'Home::qrscan');
$routes->get('sign', 'Home::sign');
$routes->get('signRecords', 'Home::signRecords');
$routes->get('project', 'Home::project');
$routes->get('accountLobby', 'Home::accountLobby');


$routes->get('pwa','Home::pwa');
$routes->get('qrcode', 'QrcodeRender::index');
$routes->get('pd', 'QrcodeRender::pdf');
$routes->get('pdf', 'PdfController::index');
$routes->get('htmlToPDF', 'PdfController::htmlToPDF');

$routes->get('404', 'Home::errorPage');
// Register Route
//     // $routes->get('/(:num)', 'RegisterController::viewVaild/$1'); //清運司機註冊頁面
//     // $routes->get('clearingCompany', 'RegisterController::clearingCompanyRegister'); //清運公司註冊頁面
//     // $routes->get('containmentcompany', 'RegisterController::containmentcompanyRegister'); //收容公司註冊頁面
//     // $routes->get('contractingcompany', 'RegisterController::contractingcompanyRegister'); //承造公司註冊頁面
$routes->post('login', 'LoginController::LoginCheck'); //登入
$routes->get('logout', 'LoginController::logout');
$routes->get('drverRegister', 'Home::register'); //公開清運司機註冊頁面
$routes->post('clearingDriver', 'RegisterController::clearingDriverRegister'); //公開清運司機註冊
$routes->group(
    'register',
    [
        'namespace' => 'App\Controllers',
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('/', 'RegisterController::index');
        $routes->get('(:num)', 'RegisterController::viewVaild/$1');
        $routes->post('clearingDriver', 'RegisterController::clearingDriverRegister'); //清運司機註冊
        $routes->post('clearingCompany', 'RegisterController::clearingCompanyRegister'); //清運公司註冊
        $routes->post('containmentcompany', 'RegisterController::containmentcompanyRegister'); //收容公司註冊
        $routes->post('contractingcompany', 'RegisterController::contractingcompanyRegister'); //承造公司註冊
    }
);





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
