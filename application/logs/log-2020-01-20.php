<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-20 12:05:16 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:08:48 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:08:50 --> Severity: Notice --> Undefined property: stdClass::$district_id_from_block E:\xampp\htdocs\madhi_backend\api\application\controllers\Auth.php 75
ERROR - 2020-01-20 12:10:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:10:25 --> Severity: Notice --> Undefined property: stdClass::$district_id_from_block E:\xampp\htdocs\madhi_backend\api\application\controllers\Auth.php 75
ERROR - 2020-01-20 12:11:02 --> Access denied!
ERROR - 2020-01-20 12:11:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:15:23 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:16:09 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:17:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 12:31:41 --> Access denied!
ERROR - 2020-01-20 12:32:35 --> Access denied!
ERROR - 2020-01-20 12:32:53 --> Access denied!
ERROR - 2020-01-20 12:34:07 --> Access denie!
ERROR - 2020-01-20 12:34:10 --> Access denie!
ERROR - 2020-01-20 12:34:11 --> Access denie!
ERROR - 2020-01-20 12:34:12 --> Access denie!
ERROR - 2020-01-20 12:34:12 --> Access denie!
ERROR - 2020-01-20 12:34:13 --> Access denie!
ERROR - 2020-01-20 12:34:19 --> Access denie!
ERROR - 2020-01-20 12:41:26 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 13:16:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 13:16:47 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 13:16:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 14:47:09 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 14:47:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 14:47:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 14:47:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 15:11:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 15:12:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 15:17:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 15:17:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(Prkg_b+Prkg_g+Prkg_t) as PREKG, sum(lkg_b+lkg_g+lkg_t) as LKG, sum(ukg_b+ukg' at line 1 - Invalid query: SELECT `schoolnew_basicinfo`.`school_id` as `school_id`, `schoolnew_basicinfo`.`school_name` as `school_name`, `block_name`, edu_dist_name sum(Prkg_b+Prkg_g+Prkg_t) as PREKG, sum(lkg_b+lkg_g+lkg_t) as LKG, sum(ukg_b+ukg_g+ukg_t) as UKG, sum(c1_b+c1_g+c1_t) as class1, sum(c2_b+c2_g+c2_t) as class2, sum(c3_b+c3_g+c3_t) as class3, sum(c4_b+c4_g+c4_t) as class4, sum(c5_b+c5_g+c5_t) as class5, sum(c6_b+c6_g+c6_t) as class6, sum(c7_b+c7_g+c7_t) as class7, sum(c8_b+c8_g+c8_t) as class8, sum(c9_b+c9_g+c9_t) as class9, sum(c10_b+c10_g+c10_t) as class10, sum(c11_b+c11_g+c11_t) as class11, sum(c12_b+c12_g+c12_t) as class12
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`curr_stat` = 1
AND `schoolnew_basicinfo`.`school_id` = '46864'
ERROR - 2020-01-20 15:18:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 15:37:16 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 16:49:04 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:25:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:29:52 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:29:52 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `block_name`, `edu_dist_name`, `total`, sum(Prkg_b+Prkg_g+Prkg_t) as PREKG, sum(lkg_b+lkg_g+lkg_t) as LKG, sum(ukg_b+ukg_g+ukg_t) as UKG, sum(c1_b+c1_g+c1_t) as class_1, sum(c2_b+c2_g+c2_t) as class_2, sum(c3_b+c3_g+c3_t) as class_3, sum(c4_b+c4_g+c4_t) as class_4, sum(c5_b+c5_g+c5_t) as class_5, sum(c6_b+c6_g+c6_t) as class_6, sum(c7_b+c7_g+c7_t) as class_7, sum(c8_b+c8_g+c8_t) as class_8, sum(c9_b+c9_g+c9_t) as class_9, sum(c10_b+c10_g+c10_t) as class_10, sum(c11_b+c11_g+c11_t) as class_11, sum(c12_b+c12_g+c12_t) as class_12, sum(total_b+total_g+total_t) as total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_block`.`id` = '19'
AND `schoolnew_basicinfo`.`sch_management_id` = 13
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-20 17:30:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:30:19 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `block_name`, `edu_dist_name`, `total`, sum(Prkg_b+Prkg_g+Prkg_t) as PREKG, sum(lkg_b+lkg_g+lkg_t) as LKG, sum(ukg_b+ukg_g+ukg_t) as UKG, sum(c1_b+c1_g+c1_t) as class_1, sum(c2_b+c2_g+c2_t) as class_2, sum(c3_b+c3_g+c3_t) as class_3, sum(c4_b+c4_g+c4_t) as class_4, sum(c5_b+c5_g+c5_t) as class_5, sum(c6_b+c6_g+c6_t) as class_6, sum(c7_b+c7_g+c7_t) as class_7, sum(c8_b+c8_g+c8_t) as class_8, sum(c9_b+c9_g+c9_t) as class_9, sum(c10_b+c10_g+c10_t) as class_10, sum(c11_b+c11_g+c11_t) as class_11, sum(c12_b+c12_g+c12_t) as class_12, sum(total_b+total_g+total_t) as total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_block`.`id` = '19'
AND `schoolnew_basicinfo`.`sch_management_id` = 13
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-20 17:31:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:31:53 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `block_name`, `edu_dist_name`, `total`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, sum(Prkg_b+Prkg_g+Prkg_t) as PREKG, sum(lkg_b+lkg_g+lkg_t) as LKG, sum(ukg_b+ukg_g+ukg_t) as UKG, sum(c1_b+c1_g+c1_t) as class_1, sum(c2_b+c2_g+c2_t) as class_2, sum(c3_b+c3_g+c3_t) as class_3, sum(c4_b+c4_g+c4_t) as class_4, sum(c5_b+c5_g+c5_t) as class_5, sum(c6_b+c6_g+c6_t) as class_6, sum(c7_b+c7_g+c7_t) as class_7, sum(c8_b+c8_g+c8_t) as class_8, sum(c9_b+c9_g+c9_t) as class_9, sum(c10_b+c10_g+c10_t) as class_10, sum(c11_b+c11_g+c11_t) as class_11, sum(c12_b+c12_g+c12_t) as class_12, sum(total_b+total_g+total_t) as total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_block`.`id` = '19'
AND `schoolnew_basicinfo`.`sch_management_id` = 13
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-20 17:32:17 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:32:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 17:59:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 18:46:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 18:47:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 18:47:48 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-20 18:50:34 --> Language file contains no data: language/english/message_lang.php
