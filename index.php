<?php
// index.php

// Enable error reporting for debugging (remove or adjust in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the Autoloader and register it
require_once __DIR__ . '/classes/Autoloader.php';
Autoloader::register();

// Initialize Router
$router = new Router();

// Define Routes
$router->add('/', 'HomeController', 'index');
$router->add('/about', 'PageController', 'about');
$router->add('/episoden', 'EpisodeController', 'index');
$router->add('/episode/(\d+)/([^/]+)', 'EpisodeController', 'show');
$router->add('/presse', 'PageController', 'presse');
$router->add('/datenschutz', 'PageController', 'datenschutz');
$router->add('/impressum', 'PageController', 'impressum');
$router->add('/kontakt', 'PageController', 'kontakt');
$router->add('/sitemap.xml', 'SitemapController', 'generate');

// Add RSS Feed route
$router->add('/rss', 'RssFeedController', 'index');

// Dispatch Request
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($requestUri);