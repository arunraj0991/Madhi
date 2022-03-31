<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-27 11:46:04 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 11:47:26 --> 404 Page Not Found: GetSchoolDetails/index
ERROR - 2020-02-27 11:47:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:05:27 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:05:27 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `brte_school_map`.`hss_school_name`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `brte_school_map` ON `brte_school_map`.`school_id` = `students_school_child_count`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:06:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:06:19 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total, `brte_school_map`.`hss_school_name`
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `brte_school_map` ON `brte_school_map`.`school_id` = `students_school_child_count`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:09:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:09:01 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `brte_school_map` ON `brte_school_map`.`school_id` = `students_school_child_count`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:09:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:09:13 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `brte_school_map` ON `brte_school_map`.`school_id` = `students_school_child_count`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:09:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:09:22 --> Severity: Notice --> Undefined property: stdClass::$hss_school_name E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 170
ERROR - 2020-02-27 12:09:59 --> Severity: Parsing Error --> syntax error, unexpected '=' E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 445
ERROR - 2020-02-27 12:10:17 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:10:17 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
JOIN `brte_school_map` ON `students_school_child_count`.`school_id` = `brte_school_map`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:10:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:10:34 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `brte_school_map` ON `students_school_child_count`.`school_id` = `brte_school_map`.`school_id`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:21:49 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:21:49 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `brte_school_map` ON `students_school_child_count`.`school_id` = `brte_school_map`.`school_key_id`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:22:39 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:22:39 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `brte_school_map` ON `students_school_child_count`.`school_id` = `brte_school_map`.`school_id`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '46864'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:22:45 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:22:45 --> Query error: Column 'block_name' in field list is ambiguous - Invalid query: SELECT `students_school_child_count`.`district_id`, `students_school_child_count`.`edu_dist_id`, `students_school_child_count`.`block_id`, `block_name`, `edu_dist_name`, `district_name`, `total`, `catty_id`, `cate_type`, `teach_tot`, `nonteach_tot`, `totstaff`, `total` as `total_students`, `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`, `Prkg_b`, `Prkg_g`, `Prkg_t`, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, `lkg_b`, `lkg_g`, `lkg_t`, sum(lkg_b+lkg_g+lkg_t) as LKG_Total, `ukg_b`, `ukg_g`, `ukg_t`, sum(ukg_b+ukg_g+ukg_t) as UKG_Total, `c1_b`, `c1_g`, `c1_t`, sum(c1_b+c1_g+c1_t) as class_1_Total, `c2_b`, `c2_g`, `c2_t`, sum(c2_b+c2_g+c2_t) as class_2_Total, `c3_b`, `c3_g`, `c3_t`, sum(c3_b+c3_g+c3_t) as class_3_Total, `c4_b`, `c4_g`, `c4_t`, sum(c4_b+c4_g+c4_t) as class_4_Total, `c5_b`, `c5_g`, `c5_t`, sum(c5_b+c5_g+c5_t) as class_5_Total, `c6_b`, `c6_g`, `c6_t`, sum(c6_b+c6_g+c6_t) as class_6_Total, `c7_b`, `c7_g`, `c7_t`, sum(c7_b+c7_g+c7_t) as class_7_Total, `c8_b`, `c8_g`, `c8_t`, sum(c8_b+c8_g+c8_t) as class_8_Total, `c9_b`, `c9_g`, `c9_t`, sum(c9_b+c9_g+c9_t) as class_9_Total, `c10_b`, `c10_g`, `c10_t`, sum(c10_b+c10_g+c10_t) as class_10_Total, `c11_b`, `c11_g`, `c11_t`, sum(c11_b+c11_g+c11_t) as class_11_Total, `c12_b`, `c12_g`, `c12_t`, sum(c12_b+c12_g+c12_t) as class_12_Total
FROM `students_school_child_count`
JOIN `brte_school_map` ON `students_school_child_count`.`school_id` = `brte_school_map`.`school_id`
JOIN `schoolnew_basicinfo` ON `students_school_child_count`.`school_id`=`schoolnew_basicinfo`.`school_id`
WHERE `schoolnew_basicinfo`.`school_id` = '4054'
AND `schoolnew_basicinfo`.`curr_stat` = 1
GROUP BY `schoolnew_basicinfo`.`school_name`, `schoolnew_basicinfo`.`school_id`, `schoolnew_basicinfo`.`udise_code`
ERROR - 2020-02-27 12:24:03 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:24:03 --> Severity: Notice --> Undefined property: stdClass::$hss_school_name E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 170
ERROR - 2020-02-27 12:25:14 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:25:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:31:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:32:33 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:35:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:37:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:37:28 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:37:38 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:37:39 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:37:59 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:37:59 --> Severity: Notice --> Undefined index: lo_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:38:28 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:38:28 --> Severity: Error --> Cannot use object of type stdClass as array E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:39:23 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:39:23 --> Severity: Notice --> Undefined variable: school_info E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:39:23 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:39:47 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:39:47 --> Severity: Notice --> Undefined variable: school_info E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:39:47 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 320
ERROR - 2020-02-27 12:39:59 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:40:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:52:07 --> Severity: Parsing Error --> syntax error, unexpected '=' E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 321
ERROR - 2020-02-27 12:52:21 --> Severity: Parsing Error --> syntax error, unexpected '=' E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 321
ERROR - 2020-02-27 12:53:20 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:54:17 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:55:42 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:56:01 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 12:56:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:07 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:07 --> Severity: Notice --> Undefined variable: dist_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 317
ERROR - 2020-02-27 13:22:15 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:15 --> Severity: Notice --> Undefined variable: dist_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 317
ERROR - 2020-02-27 13:22:22 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:22 --> Severity: Notice --> Undefined variable: dist_id E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 317
ERROR - 2020-02-27 13:22:49 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:58 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:22:59 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:22:59 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:23:19 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:23:34 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:23:34 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:23:34 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:24:13 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:13 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:18 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:24:18 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:18 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:24 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 13:24:24 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 13:24:24 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 17:27:06 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-02-27 17:27:07 --> Severity: Notice --> Undefined offset: 0 E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
ERROR - 2020-02-27 17:27:07 --> Severity: Notice --> Trying to get property of non-object E:\xampp\htdocs\madhi_backend\api\application\controllers\Student.php 319
