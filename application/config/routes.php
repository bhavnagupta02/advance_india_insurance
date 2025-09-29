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
// $route['default_controller'] = 'welcome';

$route['default_controller'] = 'home';
// $route['(:any)'] = "home/$1";

// Back-end Re-writte URL
$route['admin'] = 'admin/admin/index';
$route['admin/login'] = 'admin/admin/index';
$route['admin/dashboard'] = 'admin/admin/dashboard';
$route['admin/view-users'] = 'admin/admin/view_users';
$route['admin/edit-user/(:any)'] = 'admin/admin/edit_user/$1';
$route['admin/add-model'] = 'admin/admin/add_twowheeler_car_model';
$route['admin/view-twowheeler-models'] = 'admin/admin/view_twowheeler_models';
$route['admin/view-car-models'] = 'admin/admin/view_car_models';
$route['admin/edit-vehicle-model/(:any)'] = 'admin/admin/edit_vehicle_model/$1';
$route['admin/add-variant'] = 'admin/admin/add_twowheeler_car_variants';
$route['admin/view-twowheeler-variants'] = 'admin/admin/view_twowheeler_variants';
$route['admin/view-car-variants'] = 'admin/admin/view_car_variants';
$route['admin/edit-vehicle-variant/(:any)'] = 'admin/admin/edit_vehicle_variant/$1';
$route['admin/add-rto-city'] = 'admin/admin/add_vehicle_rto_city_num';
$route['admin/view-rto-cities'] = 'admin/admin/view_vehicle_rto_cities';
$route['admin/edit-vehicle-rto-city/(:any)'] = 'admin/admin/edit_vehicle_rto_city/$1';
$route['admin/view-car-insurance'] = 'admin/admin/view_car_insurance_policies';
$route['admin/view-twowheeler-insurance'] = 'admin/admin/view_twowheeler_insurance_policies';
$route['admin/export-insurance-policies'] = 'admin/admin/export_excel_insurance_policies';

// Front-end Re-writte URL
$route['become-pos'] = 'home/become_pos';
$route['user-dashboard'] = 'home/user_dashboard';
$route['my-profile'] = 'home/user_profile';
$route['bike-info'] = 'home/bike_insurance';
$route['quotes/(:any)/(:any)'] = 'home/quotes/$1/$2';
/*$route['quotes/(.+)'] = 'home/quotes/$1'; // here (.+) means we can pass more than 1 request URI segment but when we have 2 segment and we will put 1 only then also it will display page*/
$route['owner-details/(:any)/(:any)'] = 'home/owner_details/$1/$2';
$route['personal-details/(:any)/(:any)'] = 'home/personal_details/$1/$2';
$route['vehicle-details/(:any)/(:any)'] = 'home/vehicle_details/$1/$2';
$route['documents'] = 'home/insurance_documents';
$route['payment-summary/(:any)/(:any)'] = 'home/payment_summary/$1/$2';

$route['success/(:any)/(:any)'] = 'home/payment_success/$1/$2';
$route['thankyou/(:any)/(:any)'] = 'home/payment_thankyou/$1/$2';
$route['contact-us'] = 'home/contact_us_form';
$route['transactions'] = 'home/insurance_transactions';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
