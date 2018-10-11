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
|	example.com/class/method/id/
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
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
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

$route['default_controller']   		= 'Dashboard/index';
$route['404_override']     			= '';
$route['translate_uri_dashes']   	= FALSE;

$route['/']      					= 'Dashboard/index';
$route['signup']      				= 'Authentication/signup';
$route['login']      				= 'Authentication/login';
$route['logout']      				= 'Authentication/logout';

$route['dashboard']    				= 'Dashboard/dashboard';


$route['profile/edit'] 				= 'Profile/edit';
$route['profile/update'] 			= 'Profile/update';
$route['profile/password_change'] 	= 'Profile/password_change';
$route['profile/pw_update'] 		= 'Profile/pw_update';


$route['customer/list'] 			= 'Customer/index';
$route['customer/dataTables'] 		= 'Customer/dataTables';
$route['customer/add'] 				= 'Customer/add';
$route['customer/save'] 			= 'Customer/save';
$route['customer/edit/([^/]+)'] 	= 'Customer/edit/$1';
$route['customer/update'] 			= 'Customer/update';
$route['customer/delete/([^/]+)'] 	= 'Customer/delete/$1';

$route['customer/duplicate_mobileno'] = 'customer/duplicate_mobileno';


$route['receipt/list'] 				= 'Receipt/index';
$route['receipt/dataTables'] 		= 'Receipt/dataTables';
$route['receipt/add'] 				= 'Receipt/add';
$route['receipt/save'] 				= 'Receipt/save';
$route['receipt/edit/([^/]+)'] 		= 'Receipt/edit/$1';
$route['receipt/update'] 			= 'Receipt/update';
$route['receipt/delete/([^/]+)'] 	= 'Receipt/delete/$1';

$route['expenses/list'] 			= 'Expenses/index';
$route['expenses/dataTables'] 		= 'Expenses/dataTables';
$route['expenses/add'] 				= 'Expenses/add';
$route['expenses/save'] 			= 'Expenses/save';
$route['expenses/edit/([^/]+)'] 	= 'Expenses/edit/$1';
$route['expenses/update'] 			= 'Expenses/update';
$route['expenses/delete/([^/]+)'] 	= 'Expenses/delete/$1';

$route['profit'] 					= 'Profit/index';
$route['profit/cash_on_hand'] 			= 'Profit/cash_on_hand';
$route['profit/openingBalance/([^/]+)'] = 'Profit/openingBalance/$1';
$route['profit/dataTables/([^/]+)/([^/]+)'] = 'Profit/dataTables/$1/$2';

$route['profit/gross_income'] 			= 'Profit/gross_income';
$route['profit/grossincome_Balance/([^/]+)'] = 'Profit/grossincome_Balance/$1';
$route['profit/grossincome_dataTables/([^/]+)/([^/]+)'] = 'Profit/grossincome_dataTables/$1/$2';

$route['customer/outstanding_list'] = 'Customer/outstanding_list';
$route['customer/outstanding_dataTables/(:num)'] = 'Customer/outstanding_dataTables/$1';

$route['customer/ledger/([^/]+)'] 	= 'Customer/ledger/$1';

$route['cash/list'] 				= 'Cash/index';
$route['cash/dataTables'] 			= 'Cash/dataTables';
$route['cash/add'] 					= 'Cash/add';
$route['cash/save'] 				= 'Cash/save';
$route['cash/edit/([^/]+)'] 		= 'Cash/edit/$1';
$route['cash/update'] 				= 'Cash/update';
$route['cash/delete/([^/]+)'] 		= 'Cash/delete/$1';





