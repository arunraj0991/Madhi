<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-29 18:06:40 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:06:40 --> Severity: Notice --> Undefined property: stdClass::$block_id C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 59
ERROR - 2019-08-29 18:06:40 --> Severity: Notice --> Undefined property: stdClass::$school_id C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 60
ERROR - 2019-08-29 18:06:59 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:07:05 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:07:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:08:00 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:08:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:26:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:26:54 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:26:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 18:27:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:28:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:30:09 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:30:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:31:02 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:54:16 --> Token Experied
ERROR - 2019-08-29 19:54:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:55:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 19:55:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 20:30:30 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 20:30:49 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:11:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:12:17 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:26:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:31:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:40:46 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:40:46 --> Query error: Unknown column 'UDISE_STAFFREG.udise_code' in 'field list' - Invalid query: SELECT `EMIS_USERLOGIN`.`emis_user_id`, `EMIS_USERLOGIN`.`emis_username`, `EMIS_USERLOGIN`.`emis_usertype`, `USER_CATEGORY`.`user_type`, `UDISE_STAFFREG`.`udise_code`, `UDISE_STAFFREG`.`teacher_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_OFFREG`.`district_id`
FROM `emis_userlogin` as `EMIS_USERLOGIN`
LEFT JOIN `udise_offreg` as `UDISE_OFFREG` ON `UDISE_OFFREG`.`office_user` = `EMIS_USERLOGIN`.`emis_username`
LEFT JOIN `user_category` as `USER_CATEGORY` ON `EMIS_USERLOGIN`.`emis_usertype` = `USER_CATEGORY`.`id`
LEFT JOIN `teacher_type` as `TEACHER_TYPE` ON `UDISE_STAFFREG`.`teacher_type` = `TEACHER_TYPE`.`id`
WHERE `EMIS_USERLOGIN`.`emis_username` = 'ceo.tntut'
AND `EMIS_USERLOGIN`.`emis_password` = '5f4dcc3b5aa765d61d8327deb882cf99'
AND `EMIS_USERLOGIN`.`STATUS` = 'Active'
ERROR - 2019-08-29 21:41:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:41:07 --> Query error: Unknown column 'UDISE_STAFFREG.teacher_type' in 'on clause' - Invalid query: SELECT `EMIS_USERLOGIN`.`emis_user_id`, `EMIS_USERLOGIN`.`emis_username`, `EMIS_USERLOGIN`.`emis_usertype`, `USER_CATEGORY`.`user_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_OFFREG`.`district_id`
FROM `emis_userlogin` as `EMIS_USERLOGIN`
LEFT JOIN `udise_offreg` as `UDISE_OFFREG` ON `UDISE_OFFREG`.`office_user` = `EMIS_USERLOGIN`.`emis_username`
LEFT JOIN `user_category` as `USER_CATEGORY` ON `EMIS_USERLOGIN`.`emis_usertype` = `USER_CATEGORY`.`id`
LEFT JOIN `teacher_type` as `TEACHER_TYPE` ON `UDISE_STAFFREG`.`teacher_type` = `TEACHER_TYPE`.`id`
WHERE `EMIS_USERLOGIN`.`emis_username` = 'ceo.tntut'
AND `EMIS_USERLOGIN`.`emis_password` = '5f4dcc3b5aa765d61d8327deb882cf99'
AND `EMIS_USERLOGIN`.`STATUS` = 'Active'
ERROR - 2019-08-29 21:42:08 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:42:08 --> Query error: Unknown column 'TEACHER_TYPE.type_teacher' in 'field list' - Invalid query: SELECT `EMIS_USERLOGIN`.`emis_user_id`, `EMIS_USERLOGIN`.`emis_username`, `EMIS_USERLOGIN`.`emis_usertype`, `USER_CATEGORY`.`user_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_OFFREG`.`district_id`
FROM `emis_userlogin` as `EMIS_USERLOGIN`
LEFT JOIN `udise_offreg` as `UDISE_OFFREG` ON `UDISE_OFFREG`.`office_user` = `EMIS_USERLOGIN`.`emis_username`
LEFT JOIN `user_category` as `USER_CATEGORY` ON `EMIS_USERLOGIN`.`emis_usertype` = `USER_CATEGORY`.`id`
WHERE `EMIS_USERLOGIN`.`emis_username` = 'ceo.tntut'
AND `EMIS_USERLOGIN`.`emis_password` = '5f4dcc3b5aa765d61d8327deb882cf99'
AND `EMIS_USERLOGIN`.`STATUS` = 'Active'
ERROR - 2019-08-29 21:42:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:43:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:43:06 --> Severity: Notice --> Undefined property: stdClass::$teacher_type C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 76
ERROR - 2019-08-29 21:43:06 --> Severity: Notice --> Undefined property: stdClass::$teacher_name C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 78
ERROR - 2019-08-29 21:43:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:43:24 --> Severity: Notice --> Undefined property: stdClass::$teacher_type C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 76
ERROR - 2019-08-29 21:43:24 --> Severity: Notice --> Undefined property: stdClass::$teacher_name C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 78
ERROR - 2019-08-29 21:43:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:43:43 --> Severity: Notice --> Undefined property: stdClass::$teacher_name C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 78
ERROR - 2019-08-29 21:44:24 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' C:\xampp\htdocs\TNTEMP\CI\tnapp_backend\api\application\controllers\Auth.php 78
ERROR - 2019-08-29 21:44:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:44:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-08-29 21:46:34 --> Language file contains no data: language/english/message_lang.php
