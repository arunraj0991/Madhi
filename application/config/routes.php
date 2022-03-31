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
$route['default_controller'] = 'welcome';
$route['autenticadors'] = 'autenticador/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth'] = 'Auth/token'; 
$route['checkapi'] = 'Auth/checkapi'; 
$route['getAllTemplates'] = 'Template/getTemplates'; 
$route['getMaster'] = 'Masters/getMaster'; 
$route['getSchoolListByBlockId'] = 'Masters/getSchoolListByBlockId';
$route['getSchoolListByDistrictId'] = 'Masters/getSchoolListByDistrictId'; 
$route['getStudentsListBySchoolId'] = 'Masters/getStudentsListBySchoolId'; 
$route['getTeachersListBySchoolId'] = 'Masters/getTeachersListBySchoolId'; 
$route['getAppVersionInfo'] = 'Masters/getAppVersionInfo'; 
$route['saveObservation'] = 'Template/saveObservation'; 
$route['getLeaningOutcomeQuestions'] = 'Template/getLeaningOutcomeQuestions'; 
$route['getObservationList'] = 'Template/getObservationList'; 

$route['getObservationInfo'] = 'Student/getObservationInfo';
$route['getTeachingMethodology'] = 'Student/getTeachingMethodology';
$route['getChapterSection'] = 'Student/getChapterSection';
$route['getAssesmentReasons'] = 'Student/getAssesmentReasons';
$route['getMismatchReasons'] = 'Student/getMismatchReasons';
$route['getTermList'] = 'Student/getTermList';

$route['getSchoolMapping'] = 'Student/getSchoolMapping';
$route['getSubjects'] = 'Student/getSubjects';
$route['getQuestions'] = 'Student/getQuestions';
$route['getSchoolDetails/(:num)'] = 'Student/getSchoolDetails/';
$route['getBlocknames/(:num)'] = 'Student/getBlocknames/';
$route['getTeacherDetails/(:num)'] = 'Student/getTeacherDetails/';
$route['getSchoolClassInfo/(:num)'] = 'Student/getSchoolClassInfo/';


$route['getStudentDetails'] = 'Student/getStudentDetails/';
$route['saveObservationJson'] = 'Student/saveObservationJson/';

$route['getAllData'] = 'Student/getAllData/';
$route['getSchoolData/(:num)'] = 'Student/getSchoolData/';

$route['getSchoolByDist'] = 'Student/getSchoolByDist';
//$route['getTeachingQuestions/(:num)'] = 'Student/getTeachingQuestions/';
$route['getBlocksBySchool/(:num)'] = 'Student/getBlocksBySchool/';


//Webapp Dashboard API's
$route['dashboardData'] = 'Webapp/getDasboardData';
$route['getBlockDetails'] = 'Webapp/getBlockDetails';
$route['getZoneDetails'] = 'Webapp/getZoneDetails';
$route['getSchoolInfo'] = 'Webapp/getSchoolInfo';

$route['getSubjectData'] = 'Webapp/getSubjectData';
$route['getSubjectDataById'] = 'Webapp/getSubjectDataById';
$route['getTestData'] = 'Webapp/getTestData';
$route['getSearchResults'] = 'Webapp/getSearchResults';

//CRON
$route['UpdateColumns'] = 'Cron/updateAllColumns';


?>
