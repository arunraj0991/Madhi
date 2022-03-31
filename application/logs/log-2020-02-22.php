<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-22 13:07:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 13:07:22 --> Severity: Notice --> Undefined property: Student::$Master_model E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-22 13:07:22 --> Severity: Error --> Call to a member function get_all_block_name() on null E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-22 13:07:45 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 13:07:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 13:08:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 13:08:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:07:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:33:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:34:21 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:34:44 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:35:35 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:35:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:37:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:37:03 --> Severity: Notice --> Undefined variable: district_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 303
ERROR - 2020-02-22 16:37:33 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:37:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:38:21 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:38:39 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:39:25 --> Severity: Parsing Error --> syntax error, unexpected ')' E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 298
ERROR - 2020-02-22 16:40:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:40:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:40:43 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:56:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:27 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:52 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:55 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:56 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:57:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:58:00 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:58:47 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:58:47 --> Query error: Column 'block_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `block_id`, `edu_dist_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 16:59:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:59:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 16:59:29 --> Query error: Column 'district_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`block_name`, `district_id`, `block_id`, `edu_dist_id`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:00:14 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:00:14 --> Query error: Column 'block_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `block_id`, `edu_dist_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:00:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:00:24 --> Query error: Column 'edu_dist_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `edu_dist_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:00:32 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:00:32 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `schoolnew_block` ON `schoolnew_basicinfo`.`block_id`=`schoolnew_block`.`id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:00:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:12:42 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:12:42 --> Query error: Column 'district_id' in field list is ambiguous - Invalid query: SELECT `district_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:12:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:13:12 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:13:12 --> Query error: Unknown column 'dist_id' in 'field list' - Invalid query: SELECT `dist_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:13:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:13:22 --> Query error: Column 'district_id' in field list is ambiguous - Invalid query: SELECT `district_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:14:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:14:49 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:14:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:14:53 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:15:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:15:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:21 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:23 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:17:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:18:02 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:18:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:19:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:19:26 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:20:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:20:22 --> Query error: Column 'edu_dist_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `edu_dist_id`, `block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:20:55 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:20:55 --> Query error: Column 'block_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:27:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:27:20 --> Query error: Column 'block_id' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '67'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-22 17:27:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:54:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:54:28 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:54:28 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:54:28 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:55:03 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:03 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:03 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:55:15 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:15 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 17:55:25 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 17:55:25 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 522
ERROR - 2020-02-22 18:00:17 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:00:57 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:01:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:02:31 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:02:31 --> Severity: Notice --> Undefined variable: district E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:02:31 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:02:31 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:03:21 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:03:21 --> Severity: Notice --> Undefined variable: district E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:03:21 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:03:21 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:04:04 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:04:04 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:04:04 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:05:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:05:01 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:05:01 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:05:42 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:05:42 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:05:42 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:08:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:09:55 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:09:55 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:09:55 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 517
ERROR - 2020-02-22 18:11:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:11:06 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:11:06 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:11:36 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:11:36 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:11:36 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:12:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:12:41 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:12:42 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:12:42 --> Severity: Notice --> Undefined variable: sql E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:13:35 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:13:35 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:13:35 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:13:35 --> Severity: Notice --> Undefined variable: sql E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:14:35 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:14:35 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:14:35 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:14:35 --> Severity: Notice --> Undefined variable: sql E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 518
ERROR - 2020-02-22 18:15:14 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:15:14 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:15:14 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:15:30 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:15:30 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:15:30 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:17:16 --> Severity: Parsing Error --> syntax error, unexpected '{' E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 512
ERROR - 2020-02-22 18:17:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:17:29 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:17:29 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:18:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:18:11 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:18:11 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:18:41 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:18:41 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:18:41 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:19:04 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:19:04 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:19:04 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:19:16 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:19:16 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:19:16 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:27:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:27:07 --> Severity: Notice --> Undefined variable: district_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 310
ERROR - 2020-02-22 18:27:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:27:28 --> Severity: Notice --> Undefined variable: district_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 310
ERROR - 2020-02-22 18:27:48 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:28:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:28:15 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:28:15 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:31:51 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:31:51 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:31:51 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:32:11 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:32:12 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:32:12 --> Severity: Notice --> Undefined variable: nodal_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:32:31 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-22 18:32:31 --> Severity: Notice --> Undefined variable: edu_dist_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
ERROR - 2020-02-22 18:32:31 --> Severity: Notice --> Undefined variable: block_data E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 520
