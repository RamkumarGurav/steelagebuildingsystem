<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user';
$route['secureRegions'] = 'secureRegions/login';
$route['404_override'] = 'User/pageNotFound';
$route['translate_uri_dashes'] = TRUE;



$route['ongoing-projects'] = 'user/ongoing_projects';
$route['ongoing-projects/(:any)'] = 'user/ongoing_projects_details/$1';
$route['completed-projects'] = 'user/completed_projects';
$route['completed-projects/(:any)'] = 'user/completed_projects_details/$1';
$route['contact-us'] = 'user/contact_us';
$route['about-us'] = 'user/about_us';
$route['services'] = 'user/services';
$route['careers'] = 'user/careers';
$route['clients'] = 'user/clients';
$route['infrastructure'] = 'user/infrastructure';
$route['mission-values'] = 'user/mission_values';
$route['company-policy'] = 'user/company_policy';
$route['thank-you'] = 'user/thank_you';
$route['error'] = 'user/error';
// $route['test1'] = 'user/test1';
$route['generate_sitemap'] = 'user/generate_sitemap';
// $route['test2'] = 'user/test2';
// $route['test3'] = 'user/test3';
$route['do_enquiry'] = 'user/do_enquiry';
// $route['ajax_insert_enquiry'] = 'user/ajax_insert_enquiry';
// $route['ajax_insert_career_enquiry'] = 'user/ajax_insert_career_enquiry';





$route['profile'] = "user/profile";

$route['404found'] = "user/found404";



$route['getState'] = 'Ajax/getState';
$route['getCity'] = 'Ajax/getCity';





