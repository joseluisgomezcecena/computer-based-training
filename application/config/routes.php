<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//admins
$route['courses/create'] = 'courses/create';
$route['courses/(:any)'] = 'courses/view/$1';
$route['courses/update/(:any)'] = 'courses/update/$1';
$route['courses/delete/(:any)'] = 'courses/delete/$1';
$route['courses'] = 'courses/index';

$route['content/(:any)'] = 'content/view/$1';
$route['content/create/(:any)'] = 'content/create/$1';
$route['content/update/(:any)'] = 'content/update/$1';
$route['content/delete/(:any)'] = 'content/delete/$1';



//users
$route['playlists/(:any)'] = 'playlists/index/$1';



$route['users/login'] = 'users/login';



$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


