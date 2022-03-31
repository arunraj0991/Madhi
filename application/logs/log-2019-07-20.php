<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-07-20 11:28:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:29:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:29:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:31:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:32:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:38:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:42:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:44:59 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:45:58 --> Severity: error --> Exception: syntax error, unexpected 'GET' (T_STRING) C:\xampp\htdocs\TNTEMP\CI\api\application\models\Master_model.php 21
ERROR - 2019-07-20 11:46:08 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 11:46:08 --> Severity: Notice --> Undefined variable: master_data C:\xampp\htdocs\TNTEMP\CI\api\application\models\Master_model.php 22
ERROR - 2019-07-20 11:46:08 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\TNTEMP\CI\api\application\controllers\Masters.php 63
ERROR - 2019-07-20 11:46:21 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:26:16 --> 404 Page Not Found: GetTeachersListBySchoolId/index
ERROR - 2019-07-20 12:26:30 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:26:30 --> Query error: Table 'tnschools_working.udise_staffregas' doesn't exist - Invalid query: SELECT `UDISE_STAFFREG`.`u_id`, `UDISE_STAFFREG`.`udise_code`, `UDISE_STAFFREG`.`teacher_code`, `UDISE_STAFFREG`.`teacher_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_STAFFREG`.`teacher_name`
FROM `udise_staffregas` `UDISE_STAFFREG`
LEFT JOIN `teacher_type` as `TEACHER_TYPE` ON `UDISE_STAFFREG`.`teacher_type` = `TEACHER_TYPE`.`id`
WHERE `block_id` = '170'
ERROR - 2019-07-20 12:26:40 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:26:40 --> Query error: Table 'tnschools_working.udise_staffregas' doesn't exist - Invalid query: SELECT `UDISE_STAFFREG`.`u_id`, `UDISE_STAFFREG`.`udise_code`, `UDISE_STAFFREG`.`teacher_code`, `UDISE_STAFFREG`.`teacher_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_STAFFREG`.`teacher_name`
FROM `udise_staffregas` `UDISE_STAFFREG`
LEFT JOIN `teacher_type` as `TEACHER_TYPE` ON `UDISE_STAFFREG`.`teacher_type` = `TEACHER_TYPE`.`id`
WHERE `block_id` = '170'
ERROR - 2019-07-20 12:27:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:27:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:28:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:29:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:35:32 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:36:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:36:01 --> Query error: Unknown column 'class_studying_id' in 'field list' - Invalid query: SELECT `class_studying_id`, `class_section`
FROM `students_school_child_count`
WHERE `school_id` = '5814'
GROUP BY `class_studying_id`, `class_section`
ERROR - 2019-07-20 12:36:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:36:57 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\TNTEMP\CI\api\application\controllers\Masters.php 106
ERROR - 2019-07-20 12:37:35 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 12:37:35 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\TNTEMP\CI\api\application\controllers\Masters.php 106
ERROR - 2019-07-20 12:37:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\TNTEMP\CI\api\system\core\Exceptions.php:271) C:\xampp\htdocs\TNTEMP\CI\api\system\core\Common.php 570
ERROR - 2019-07-20 12:48:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 16:07:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 16:10:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 16:22:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 16:39:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 16:39:28 --> Query error: Unknown column 'TRUE' in 'field list' - Invalid query: SELECT `class_studying_id`, `class_section`, count( if(gender = 1, `TRUE`, NULL)) as male, count( if(gender = 2, `TRUE`, NULL)) as female
FROM `students_child_detail`
WHERE `school_id` = '5814'
GROUP BY `class_studying_id`, `class_section`
ERROR - 2019-07-20 16:42:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 17:18:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 19:40:27 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 19:41:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-20 21:05:31 --> Language file contains no data: language/english/message_lang.php
