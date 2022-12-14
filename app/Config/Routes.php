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






$routes->get('lobby', 'Home::lobby', ["filter" => "login"]);
$routes->get('qrscan', 'Home::qrscan', ["filter" => "login"]);
$routes->get('changePassword', 'Home::changePassword', ["filter" => "login"]);
$routes->post('changePassword', 'Home::updatePassword', ["filter" => "login"]);
$routes->get('documentUse', 'Home::documentUse',["filter" => "login"]);


//測試路由
$routes->get('personal', 'Home::personal');
// $routes->get('projectList', 'Home::projectList');

// $routes->get('documentList', 'Home::documentList');

$routes->get('sign', 'Home::sign');
$routes->get('signRecords', 'Home::signRecords');
$routes->get('project', 'Home::project');
$routes->get('pwa','Home::pwa');
$routes->get('qrcode', 'QrcodeRender::index');
$routes->get('baseTest', 'QrcodeRender::baseTest');
$routes->get('base', 'Home::qrtest'); //404頁面
$routes->get('htmlToPDF', 'PdfController::htmlToPDF');

$routes->get('pdfview', 'PdfController::index');
$routes->post('insertEngineeringData', 'PdfController::insertEngineeringData');

//公開路由
$routes->get('/','Home::index');
$routes->post('login', 'LoginController::LoginCheck'); //登入
$routes->get('logout', 'LoginController::logout'); //登出
$routes->get('drverRegister', 'Home::register'); //公開清運司機註冊頁面
$routes->post('clearingDriver', 'RegisterController::clearingDriverRegister'); //公開清運司機註冊
$routes->get('404', 'Home::errorPage'); //404頁面




/**
 * 註冊路由
 */
$routes->group(
    'register',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'root'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('/', 'RegisterController::index');
        $routes->get('(:num)', 'RegisterController::viewVaild/$1');
        $routes->post('clearingDriver', 'RegisterController::clearingDriverRegister'); //清運司機註冊
        $routes->post('clearingCompany', 'RegisterController::clearingCompanyRegister'); //清運公司註冊
        $routes->post('containmentcompany', 'RegisterController::containmentcompanyRegister'); //收容公司註冊
        $routes->post('contractingcompany', 'RegisterController::contractingcompanyRegister'); //承造公司註冊
        $routes->post('government', 'RegisterController::governmentRegister'); //政府單位註冊
    }
);


/**
 * Root 路由
 */
$routes->group(
    'root',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'root'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
       $routes->get('accountLobby', 'RootController::accountLobby');
       $routes->get('accountManage', 'RootController::accountManage');
       $routes->get('updateUser/(:num)', 'RootController::updateUser/$1');
       $routes->post('personalUpdate', 'RootController::personalUpdate');
       
    }
);
/**
 * 承造廠商路由
 */
$routes->group(
    'contract',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'contract'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('companyInfoView', 'ContractController::companyInfoView');
        $routes->get('personalView', 'ContractController::personalView');
        $routes->post('personalUpdate', 'ContractController::personalUpdate');
        //工程新增 view & post
        $routes->get('projectCreate', 'EngineeringController::projectCreateView');
        $routes->post('projectCreate', 'EngineeringController::projectCreate');
        //聯單新增 view & post
        $routes->get('documentCreate/(:num)', 'ContractController::documentCreateView/$1');
        $routes->post('insertEngineeringData', 'PdfController::insertEngineeringData');
        //工程結案區
        $routes->get('documentComplete/(:num)', 'DocumentController::documentComplete/$1');
        $routes->get('doneProjectView', 'EngineeringController::doneProjectView');
        

    }
);
/**
 * 清運公司路由
 */
$routes->group(
    'clearingCompany',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'company'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('companyInfoView', 'ClearingCompanyController::companyInfoView');
        $routes->get('personalView', 'ClearingCompanyController::personalView');
        $routes->post('personalUpdate', 'ClearingCompanyController::personalUpdate');
        $routes->get('carMembership', 'ClearingCompanyController::getDriverData');
        $routes->get('getDriverInfo/(:num)', 'ClearingCompanyController::getDriverInfo/$1');
        
    }
);
/**
 * 清運司機路由
 */
$routes->group(
    'clearingDriver',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'driver'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('companyInfoView', 'DriverController::companyInfoView');
        $routes->get('personalView', 'DriverController::personalView');
        $routes->post('personalUpdate', 'DriverController::personalUpdate');

        $routes->get('execution', 'DriverController::execution');
        
    }
);

/**
 * 收容場所路由
 */
$routes->group(
    'containment',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'shelter'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('companyInfoView', 'ContainmentController::companyInfoView');
        $routes->get('personalView', 'ContainmentController::personalView');
        $routes->post('personalUpdate', 'ContainmentController::personalUpdate');
    }
);


/**
 * 政府單位路由
 */
$routes->group(
    'government',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'government'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('governmentInfoView', 'GovernmentController::governmentInfoView');
        $routes->post('governmentInfoUpdate', 'GovernmentController::governmentInfoUpdate');
        $routes->get('personalView', 'GovernmentController::personalView');
    }
);



/**
 * 工程路由
 */
$routes->group(
    'project',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'login'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
       $routes->get('projectList', 'EngineeringController::index',["filter" => "login"]); //工程列表view
    }
);

/**
 * 聯單路由
 */
$routes->group(
    'document',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'login'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->get('(:num)', 'DocumentController::index/$1'); //工程流向編號清單列表 參數:工程ID
        $routes->get('(:num)/(:num)', 'DocumentController::useStatus/$1/$2'); //工程流向編號清單使用狀態 參數:工程ID、PDF狀態
        $routes->get('showDocumentQrcode/(:num)', 'DocumentController::showDocumentQrcode/$1'); //qrcode頁面
        $routes->get('documentTable/(:num)', 'DocumentController::documentTable/$1'); //聯單table
        
        
    }
);

/**
 * 聯單路由
 */
$routes->get('pdf/validSign/(:num)', 'PdfController::validSign/$1'); //pdf頁面 參數:pdf id
$routes->group(
    'pdf',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'login'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {
        $routes->post('uploadSign', 'PdfController::uploadSign'); //post 簽名
        // $routes->post('uploadContainmentSign', 'PdfController::uploadContainmentSign'); //收容 post 簽名
        $routes->get('showPdf/(:num)', 'PdfController::showPdf/$1'); //pdf頁面 參數:pdf id
        $routes->post('selectDocument', 'PdfController::selectDocument'); //pdf頁面 參數:pdf id
        
    }
);

/**
 * 簽名路由
 */
$routes->group(
    'sign',
    [
        'namespace' => 'App\Controllers',
        'filter' => 'login'
    ],
    function (\CodeIgniter\Router\RouteCollection $routes) {


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
