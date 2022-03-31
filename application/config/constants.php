<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('ROUTE_LOGIN')        OR define('ROUTE_LOGIN', 'auth'); // login api 

defined('EMISLOGIN_TEACHER') OR define('EMISLOGIN_TEACHER','emislogin_teacher');
defined('EMISUSER_TEACHER') OR define('EMISUSER_TEACHER','emisuser_teacher');
defined('USER_CATEGORY') OR define('USER_CATEGORY','user_category');
defined('TEACHER_TYPE') OR define('TEACHER_TYPE','teacher_type');
defined('INSPECTION_TEMPLATES') OR define('INSPECTION_TEMPLATES','inspection_templates');
defined('INSPECTION_QUESTIONS') OR define('INSPECTION_QUESTIONS','inspection_questions');
defined('SCHOOLNEW_BLOCK') OR define('SCHOOLNEW_BLOCK','schoolnew_block');
defined('SCHOOLNEW_DISTRICT') OR define('SCHOOLNEW_DISTRICT','schoolnew_district');
defined('SCHOOLNEW_EDN_DIST_MAS') OR define('SCHOOLNEW_EDN_DIST_MAS','schoolnew_edn_dist_mas');
defined('SCHOOLNEW_SCHOOL_DEPARTMENT') OR define('SCHOOLNEW_SCHOOL_DEPARTMENT','schoolnew_school_department');
defined('SCHOOLNEW_MANAGE_CATE') OR define('SCHOOLNEW_MANAGE_CATE','schoolnew_manage_cate');
defined('EMIS_SCHOOLS_TEACHERS') OR define('EMIS_SCHOOLS_TEACHERS','emis_schools_teachers');
defined('UDISE_STAFFREG') OR define('UDISE_STAFFREG','udise_staffreg');
defined('STUDENTS_SCHOOL_CHILD_COUNT') OR define('STUDENTS_SCHOOL_CHILD_COUNT','students_school_child_count');
defined('STUDENTS_CHILD_DETAIL') OR define('STUDENTS_CHILD_DETAIL','students_child_detail');
defined('SCHOOL_OBSERVATIONS') OR define('SCHOOL_OBSERVATIONS','school_observations');
defined('UDISE_OFFREG') OR define('UDISE_OFFREG','udise_offreg');
defined('LEARNING_OUTCOME_QUESTIONS') OR define('LEARNING_OUTCOME_QUESTIONS','inspection_learning_outcome_questions');
defined('EMIS_USERLOGIN') OR define('EMIS_USERLOGIN','emis_userlogin');
defined('SCHOOL_OBSERVATION_QUS_ANSWERS') OR define('SCHOOL_OBSERVATION_QUS_ANSWERS','school_observation_qus_answers');
defined('SCHOOL_OBSERVATION_STUDENTS') OR define('SCHOOL_OBSERVATION_STUDENTS','school_observation_students');
defined('SCHOOLD_APP_VERSION_INFO') OR define('SCHOOLD_APP_VERSION_INFO','school_app_version_info');
defined('SCHOOLNEW_BLOCK') OR define('SCHOOLNEW_BLOCK','schoolnew_block');
defined('INSPECTION_LEARNING_OUTCOME_TERM') OR define('INSPECTION_LEARNING_OUTCOME_TERM','inspection_learning_outcome_term');

defined('BRTE_SCHOOL_MAP') OR define('BRTE_SCHOOL_MAP','brte_school_map');



//Webapp
defined('DG_GRAPH_TARGET') OR define('DG_GRAPH_TARGET','dg_graph_target');
?>



