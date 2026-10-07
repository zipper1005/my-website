<?php


use CodeIgniter\Router\RouteCollection;


/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('landing', 'Home::landing');
$routes->get('/akun1', 'Akun1::index');
$routes->get('akun1/new', 'Akun1::new');
$routes->post('/akun1', 'Akun1::store');
$routes->get('akun1/edit/(:any)', 'Akun1::edit/$1');
$routes->put('akun1/(:any)', 'Akun1::update/$1');
$routes->delete('akun1/(:any)', 'Akun1::destroy/$1');

$routes->resource('akun2');
$routes->resource('akun3');

$routes->get('transaksi/akun3', 'Transaksi::akun3');
$routes->get('transaksi/status', 'Transaksi::status');
$routes->resource('transaksi');

$routes->get('penyesuaian/akun3', 'Penyesuaian::akun3');
$routes->get('penyesuaian/status', 'Penyesuaian::status');
$routes->resource('penyesuaian');

$routes->match(['GET', 'POST'], 'jurnalumum', 'JurnalUmum::index');
$routes->match(['GET', 'POST'], 'jurnalumum/cetakjurnalpdf', 'JurnalUmum::cetakjurnalpdf');

$routes->match(['GET', 'POST'], 'posting', 'Posting::index');
$routes->match(['GET', 'POST'], 'posting/cetakpostingpdf', 'Posting::cetakpostingpdf');

$routes->match(['GET', 'POST'], 'jurnalpenyesuaian', 'JurnalPenyesuaian::index');
$routes->match(['GET', 'POST'], 'jurnalpenyesuaian/cetakjurnalpdf', 'JurnalPenyesuaian::cetakjurnalpdf');

$routes->match(['GET', 'POST'], 'neracasaldo', 'NeracaSaldo::index');
$routes->match(['GET', 'POST'], 'neracasaldo/cetakneracasaldopdf', 'NeracaSaldo::cetakneracasaldopdf');

$routes->match(['GET', 'POST'], 'neracalajur', 'NeracaLajur::index');
$routes->match(['GET', 'POST'], 'neracalajur/cetaklajurpdf', 'NeracaLajur::cetaklajurpdf');

$routes->match(['GET', 'POST'], 'labarugi', 'LabaRugi::index');
$routes->match(['GET', 'POST'], 'labarugi/cetaklabarugipdf', 'LabaRugi::cetaklabarugipdf');

$routes->match(['GET', 'POST'], 'perubahanmodal', 'PerubahanModal::index');
$routes->match(['GET', 'POST'], 'perubahanmodal/cetakperubahanmodalpdf', 'PerubahanModal::cetakperubahanmodalpdf');

$routes->match(['GET', 'POST'], 'neraca', 'Neraca::index');
$routes->match(['GET', 'POST'], 'neraca/cetakneracapdf', 'Neraca::cetakneracapdf');

$routes->match(['GET', 'POST'], 'aruskas', 'ArusKas::index');
$routes->match(['GET', 'POST'], 'aruskas/cetakaruskaspdf', 'ArusKas::cetakaruskaspdf');

$routes->group('users', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->get('toggle/(:num)', 'Users::toggle/$1');
    $routes->post('delete/(:num)', 'Users::delete/$1');
});
$routes->addRedirect('user', 'users');
$routes->addRedirect('user/(:any)', 'users/$1');

