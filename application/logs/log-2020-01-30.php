<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-30 11:42:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 11:54:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 11:55:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 11:55:52 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 11:56:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 11:59:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:17:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:19:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:00 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:04 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:05 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:09 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:33:46 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:34:45 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 12:34:45 --> Severity: Notice --> Undefined variable: login_data E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 38
ERROR - 2020-01-30 13:20:32 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:22:08 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:24:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:25:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:25:12 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:25:42 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:32:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 13:33:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:40:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:40:13 --> Severity: Notice --> Undefined variable: login_data E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 38
ERROR - 2020-01-30 16:56:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:56:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:56:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:57:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:58:02 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 16:58:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:03:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:04:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:12:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:19:05 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:21:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:21:19 --> Query error: Unknown column 'tot_staff' in 'field list' - Invalid query: SELECT `students_school_child_count`.`block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `tot_staff`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, sum(c1_b+c1_g+c1_t) as class_1, sum(c2_b+c2_g+c2_t) as class_2, sum(c3_b+c3_g+c3_t) as class_3, sum(c4_b+c4_g+c4_t) as class_4, sum(c5_b+c5_g+c5_t) as class_5, sum(c6_b+c6_g+c6_t) as class_6, sum(c7_b+c7_g+c7_t) as class_7, sum(c8_b+c8_g+c8_t) as class_8, sum(c9_b+c9_g+c9_t) as class_9, sum(c10_b+c10_g+c10_t) as class_10, sum(c11_b+c11_g+c11_t) as class_11, sum(c12_b+c12_g+c12_t) as class_12, sum(total_b+total_g+total_t) as total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-30 17:22:00 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:23:54 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:24:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:26:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:36:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 17:37:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:20:40 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:20:40 --> Query error: Column 'district_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`block_name`, `district_id`, `edu_dist_id`, `block_id`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-30 18:22:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:22:37 --> Query error: Column 'edu_dist_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `edu_dist_id`, `block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-30 18:22:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:22:53 --> Query error: Column 'edu_dist_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `edu_dist_id`, `block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-30 18:25:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:25:11 --> Query error: Column 'block_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `block_id`, `edu_dist_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-01-30 18:25:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:32:50 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:34:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:35:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:35:30 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:36:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:36:39 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:37:50 --> 404 Page Not Found: GetTeacherDetails/index
ERROR - 2020-01-30 18:38:33 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:38:52 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:38:52 --> Query error: Unknown column 'curr_stat' in 'where clause' - Invalid query: SELECT `teacher_code`, `teacher_name`
FROM `udise_staffreg`
WHERE `curr_stat` = 1
AND `school_key_id` = '67'
ERROR - 2020-01-30 18:39:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:40:16 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:40:48 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:41:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:41:37 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 18:41:37 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-30 18:43:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 19:02:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 19:02:01 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-30 19:02:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-30 19:02:22 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-30 19:06:47 --> Language file contains no data: language/english/message_lang.php
