<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	admin.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'admin';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above admin, the "admin" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['login'] = 'site/login';
$route['postLogin'] = 'admin/login/postLogin';
$route['forgotPassword'] = 'site/login/forgotPassword';
$route['reset_password/(:any)'] = 'site/login/reset_password/$1';
$route['signUp'] = 'site/login/signUp';
$route['cms/(:any)'] = 'site/cms/index/$1';
$route['contact'] = 'site/contact';
$route['account'] = 'site/account';
$route['account/edit/(:any)'] = 'site/account/edit/$1';
$route['address'] = 'site/address';
$route['address/add'] = 'site/address/add';
$route['address/edit/(:any)'] = 'site/address/edit/$1';
$route['password'] = 'site/password';
$route['order_list'] = 'site/checkout/order';
$route['order_view/(:any)'] = 'site/checkout/order_view/$1';
$route['track'] = 'site/checkout/track';
$route['product_detail/(:any)'] = 'site/home/product_detail/$1';
$route['category_product/(:any)'] = 'site/home/sub_category/$1';
$route['wishlist'] = 'site/sale/wishcart';
$route['checkout'] = 'site/checkout';
$route['cart'] = 'site/sale/cart';
$route['authenticate'] = 'site/authenticate';
//$route['home'] = 'site/home';

$route['default_controller'] = 'site/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
