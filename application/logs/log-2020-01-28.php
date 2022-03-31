<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-28 12:29:10 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-28 13:13:29 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-28 13:14:27 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-28 13:15:25 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-28 13:15:25 --> Severity: Warning --> constant(): Couldn't find constant  E:\xampp\htdocs\madhi_backend\api\application\models\Master_model.php 15
ERROR - 2020-01-28 13:15:25 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2020-01-28 15:22:52 --> Severity: Parsing Error --> syntax error, unexpected '}' E:\xampp\htdocs\madhi_backend\api\application\models\Student_model.php 166
ERROR - 2020-01-28 15:23:13 --> Language file contains no data: language/english/message_lang.php
ERROR - 2020-01-28 15:23:13 --> Query error: This version of MySQL doesn't yet support 'LIMIT & IN/ALL/ANY/SOME subquery' - Invalid query: select * from schoolnew_basicinfo where block_id = 105 and beo_map=2 and school_id not in (select * from schoolnew_basicinfo where block_id = 105 and beo_map = 2 and school_id not in (select school_id from school_observations where createdBy = 'beo2tvm0608') order by RAND() limit 3);
