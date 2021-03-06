<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AdminUserController::index');

$routes->get('/preview/(:segment)', 'PreviewController::index/$1');
$routes->get('/get-preview/(:segment)', 'PreviewController::getPointData/$1/$2');
$routes->get('/preview-attraction-count/(:segment)', 'AttractionController::countAttractionView/$1');

//news
$routes->get('/preview-news/(:segment)', 'NewsController::previewNewsView/$1');
$routes->get('/get-preview-news-public/(:segment)', 'NewsController::getNewsByDateTimeStartEndValid/$1');
$routes->get('/preview-news-video/(:segment)', 'NewsController::previewVideoView/$1');
$routes->get('/preview-news-details/(:segment)', 'NewsController::previewNewsDetailsView/$1');
$routes->get('/get-select-news/(:segment)', 'NewsController::getNewsDetailsByIdPublic/$1');
$routes->get('/get-preview-video/(:segment)', 'VideoController::getVideoNotLogin/$1');
//set type vr view
$routes->get('/set-type-vr-view/(:segment)', 'TypeVRController::setCountTypeView/$1');

$routes->group("admin", function($routes){
    $routes->get('/', 'AdminUserController::index');
    $routes->get('login', 'AdminUserController::login');
    $routes->post('login-post', 'AdminUserController::loginPost');
    $routes->get('logout', 'AdminUserController::logout');
    $routes->get('register', 'AdminUserController::register');
    $routes->post('register', 'AdminUserController::registerPost');
    $routes->get('dashboard', 'DashboardController::dashboard');
    $routes->get('preview', 'PreviewController::index');
    $routes->get('get-preview/(:segment1)/(:segment2)', 'PreviewController::getPointData/$1/$2');
    //route type vr
    $routes->get('add-type-vr', 'TypeVRController::setTypeVr');
    $routes->post('add-type-vr-post', 'TypeVRController::setTypeVrPost');
    $routes->get('edit-type-vr', 'TypeVRController::updateTypeVr');
    $routes->post('edit-type-vr-post', 'TypeVRController::updateTypeVrPost');
    $routes->get('delete-type-vr/(:segment)', 'TypeVRController::deleteTypeVr/$1');
    $routes->get('get-all-type-vr', 'TypeVRController::listAllTypeVr');
    //route type vr count
    $routes->get('get-type-vr-count/(:segment)', 'TypeVRController::getCountTypeView/$1');
    //route attraction
    $routes->get('add-attraction', 'AttractionController::setAttraction');
    $routes->post('add-attraction-post', 'AttractionController::setAttractionPost');
    $routes->get('edit-attraction', 'AttractionController::updateAttraction');
    $routes->post('edit-attraction-post', 'AttractionController::updateAttractionPost');
    $routes->get('delete-attraction/(:segment)', 'AttractionController::deleteAttraction/$1');
    $routes->get('check-attr-name/(:segment)', 'AttractionController::checkAttrName/$1');
    $routes->get('get-all-attraction', 'AttractionController::listAllAttraction');
    $routes->get('get-all-attraction-by-type/(:segment)', 'AttractionController::getAttractionByType/$1');
    $routes->get('get-select-attraction/(:segment)', 'AttractionController::getSelectAttraction/$1');
    $routes->get('get-count-attraction-and-point', 'AttractionController::getCountAttractionAndPont');
    $routes->get('get-count-attraction-and-point-by-type/(:segment)', 'AttractionController::getCountAttractionAndPontWithType/$1');
    $routes->get('get-attraction-view-all/(:segment)', 'AttractionController::getAttractionViewCountAll/$1');
    //route point vr
    $routes->get('add-point-vr', 'AttractionPointController::setAttractionPoint');
    $routes->post('add-point-vr-post', 'AttractionPointController::setAttractionPointPost');
    $routes->get('edit-point-vr', 'AttractionPointController::updateAttractionPoint');
    $routes->post('edit-point-vr-post', 'AttractionPointController::updateAttractionPointPost');
    $routes->get('delete-point-vr/(:segment)', 'AttractionPointController::deleteAttractionPoint/$1');
    $routes->get('get-all-point-vr-by-att-id/(:segment)', 'AttractionPointController::getAllAttractionPointByAttrId/$1');
    $routes->get('get-select-point-vr-by-id/(:segment)', 'AttractionPointController::getSelectAttractionPointById/$1');
    //route news
    $routes->get('add-news', 'NewsController::addNewsView');
    $routes->post('add-news-post', 'NewsController::addNewsPost');
    $routes->get('get-all-news/(:segment)', 'NewsController::getAllNews/$1');
    $routes->get('get-select-news/(:segment)', 'NewsController::getNewsById/$1');
    $routes->get('view-news/(:segment)', 'NewsController::viewNewsView/$1');
    $routes->get('edit-news', 'NewsController::editNewsView');
    $routes->post('edit-news-post', 'NewsController::editNewsPost');
    $routes->get('delete-news/(:segment)', 'NewsController::deleteNews/$1');
    $routes->get('get-video/(:segment)', 'VideoController::getVideo/$1');
    $routes->post('add-edit-video', 'VideoController::addEditVideo');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
