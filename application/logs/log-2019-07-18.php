<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-07-18 12:04:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:04:59 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:11:16 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:15:42 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:19:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:30:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:30:15 --> Query error: Unknown column 'UDISE_STAFFREG.emis_usertype' in 'on clause' - Invalid query: SELECT `EMISUSER_TEACHER`.`emis_user_id`, `EMISUSER_TEACHER`.`emis_username`, `EMISUSER_TEACHER`.`emis_usertype`, `USER_CATEGORY`.`user_type`, `UDISE_STAFFREG`.`udise_code`, `UDISE_STAFFREG`.`teacher_type`, `TEACHER_TYPE`.`type_teacher`, `UDISE_STAFFREG`.`teacher_name`, `UDISE_STAFFREG`.`teacher_type`, `STUDENTS_SCHOOL_CHILD_COUNT`.`block_id`, `STUDENTS_SCHOOL_CHILD_COUNT`.`school_id`, `STUDENTS_SCHOOL_CHILD_COUNT`.`district_id`
FROM `emisuser_teacher` as `EMISUSER_TEACHER`
LEFT JOIN `udise_staffreg` as `UDISE_STAFFREG` ON `UDISE_STAFFREG`.`aadhar_no` LIKE '%21735888'
LEFT JOIN `students_school_child_count` as `STUDENTS_SCHOOL_CHILD_COUNT` ON `UDISE_STAFFREG`.`udise_code` = `STUDENTS_SCHOOL_CHILD_COUNT`.`udise_code`
LEFT JOIN `user_category` as `USER_CATEGORY` ON `UDISE_STAFFREG`.`emis_usertype` = `USER_CATEGORY`.`id`
LEFT JOIN `teacher_type` as `TEACHER_TYPE` ON `UDISE_STAFFREG`.`teacher_type` = `TEACHER_TYPE`.`id`
WHERE `EMISUSER_TEACHER`.`emis_username` = '21735888'
AND `EMISUSER_TEACHER`.`emis_password` = 'cc2c9934c9c5bff7da0c93fc761a8bc0'
AND `EMISUSER_TEACHER`.`STATUS` = 'Active'
ERROR - 2019-07-18 12:31:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:55:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 12:56:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:00:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:03:35 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:19:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:22:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:22:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:23:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:26:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:27:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:28:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:30:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:40:08 --> Language file contains no data: language/english/message_lang.php
ERROR - 2019-07-18 13:41:07 --> Language file contains no data: language/english/message_lang.php
