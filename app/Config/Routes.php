<?php

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
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// ================================================>>WEBSITE <<================================================ //
// ===>>Halaman Awal<<===
$routes->get('/writable/(:any)', 'Pages::showFile');
$routes->get('/', 'Pages::index');
$routes->get('/pages/(:any)', 'Pages::pages/$1');
// ===>>Dosen<<===
$routes->get('/pages-dosen', 'Pages::dosen');
$routes->get('/dosen-detail/(:any)', 'Pages::dosen_detail/$1');
// ===>>Tendik<<===
$routes->get('/pages-tendik', 'Pages::tendik');
// ===>>Berita<<===
$routes->get('/informasi', 'Pages::informasi');
$routes->get('/informasi-lengkap', 'Pages::informasi_lengkap');
$routes->get('/informasi-detail/(:any)', 'Pages::informasi_detail/$1');
$routes->get('/informasi-kategori/(:any)', 'Pages::informasi_kategori/$1');
// ===>>mitra<<===
$routes->get('/mitra-detail/(:any)', 'Pages::mitra_detail/$1');
// ===>>SK<<===
$routes->get('/pages-sk', 'Sk_view::index');

// ================================================>>BACKEND <<================================================

// ===>>Login<<===
$routes->get('/login', 'Pages::login');
// ===>>Beranda<<===
$routes->get('/beranda', 'Pages::beranda');
// ===>>Main Menu<<===
// ===>>Sub Menu<<===
$routes->get('/submenu-edit/(:any)', 'Submenu::editform/$1');
$routes->get('/submenu-edit/(:any)', 'Submenu::editform/$1');
// ===>>Berita<<===
$routes->get('/berita-edit/(:any)', 'Berita::editform/$1');
