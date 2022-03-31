<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
error_reporting(0);
/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */ 

class Auth extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function token_post()
    {
        
       //echo(isset($this->post('username')));die();
        $user_name = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
        $pwd = $this->post('password') && $this->post('password') != '' ? $this->post('password') : null;
        $api_client = ($this->post('client')) && $this->post('client') != '' ? $this->post('client') : null; 

        if($user_name != null && $pwd != null && $api_client != '')
        {    
            $this->db->SELECT('EMISUSER_TEACHER.emis_user_id,EMISUSER_TEACHER.emis_username,EMISUSER_TEACHER.emis_usertype,USER_CATEGORY.user_type,UDISE_STAFFREG.udise_code,UDISE_STAFFREG.teacher_type,TEACHER_TYPE.type_teacher,UDISE_STAFFREG.teacher_name,UDISE_STAFFREG.teacher_type,UDISE_OFFREG.district_id,UDISE_OFFREG.district_name,SCHOOLNEW_BLOCK.id as block_id_from_dist,SCHOOLNEW_BLOCK.block_name as block_name_from_dist');
            $this->db->FROM(EMISUSER_TEACHER.' as EMISUSER_TEACHER');
            $this->db->JOIN(UDISE_STAFFREG.' as UDISE_STAFFREG',"UDISE_STAFFREG.u_id = EMISUSER_TEACHER.emis_user_id",'LEFT');
            $this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_STAFFREG.school_key_id = UDISE_OFFREG.off_key_id','LEFT');
            $this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMISUSER_TEACHER.emis_usertype = USER_CATEGORY.id','LEFT');
            $this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
			$this->db->JOIN(SCHOOLNEW_BLOCK.' as SCHOOLNEW_BLOCK','UDISE_OFFREG.district_id = SCHOOLNEW_BLOCK.district_id','LEFT');
            $this->db->WHERE('EMISUSER_TEACHER.emis_username',$user_name);
            $this->db->WHERE('EMISUSER_TEACHER.emis_password',md5($pwd));
            $this->db->WHERE('EMISUSER_TEACHER.STATUS','Active');
            $login_data = $this->db->GET()->row();

            if(!$login_data)
            {
                $this->db->SELECT('EMIS_USERLOGIN.emis_user_id,EMIS_USERLOGIN.emis_username,EMIS_USERLOGIN.emis_usertype,USER_CATEGORY.user_type,UDISE_OFFREG.district_id,UDISE_OFFREG.district_name,SCHOOLNEW_BLOCK.district_id as district_id_from_block,SCHOOLNEW_DISTRICT.district_name as district_name_from_block,EMIS_USERLOGIN.emis_user_id as block_id_from_dist, SCHOOLNEW_BLOCK.block_name as block_name_from_dist');
                 $this->db->FROM(EMIS_USERLOGIN.' as EMIS_USERLOGIN');
                $this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_OFFREG.office_user = EMIS_USERLOGIN.emis_username','LEFT');
                $this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMIS_USERLOGIN.emis_usertype = USER_CATEGORY.id','LEFT');
                $this->db->JOIN(SCHOOLNEW_BLOCK.' as SCHOOLNEW_BLOCK','EMIS_USERLOGIN.emis_user_id = SCHOOLNEW_BLOCK.id','LEFT');
                $this->db->JOIN(SCHOOLNEW_DISTRICT.' as SCHOOLNEW_DISTRICT','SCHOOLNEW_BLOCK.district_id = SCHOOLNEW_DISTRICT.id','LEFT');
//$this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
                $this->db->WHERE('EMIS_USERLOGIN.emis_username',$user_name);
                $this->db->WHERE('EMIS_USERLOGIN.emis_password',md5($pwd));
                $this->db->WHERE('EMIS_USERLOGIN.STATUS','Active');
                $login_data = $this->db->GET()->row();
            }
           //print_r($this->db->last_query());
            //print_r($login_data);
            if(($login_data))
            {
                $iat = time();
                $one_month_time = (60 * 60 * 24 * 30);
                $exp = $iat + $one_month_time;
                $tokenData = array();
                $tokenData['emis_username'] = $login_data->emis_username; 
                $tokenData['iss'] = 'https://www.emis.com'; 
                $tokenData['iat'] = $iat; 
                $tokenData['exp'] = $exp; 
                $tokenData['sub'] = 'tn_school_app'; 
               // $tokenData['block_id'] = $login_data->block_id; 
               // $tokenData['school_id'] = $login_data->school_id; 
                $tokenData['district_id'] = isset($login_data->district_id) && $login_data->district_id != "" ? $login_data->district_id : $login_data->district_id_from_block; 
                $tokenData['district_name'] = $login_data->district_name ? $login_data->district_name : 'NOT AVAILABLE'; 
                $tokenData['emis_usertype'] = $login_data->emis_usertype ? $login_data->emis_usertype : 'NOT AVAILABLE'; 
                $tokenData['district_id_from_block'] = $login_data->district_id_from_block ? $login_data->district_id_from_block : 'NOT AVAILABLE'; 
                $tokenData['district_name_from_block'] = $login_data->district_name_from_block ? $login_data->district_name_from_block : 'NOT AVAILABLE'; 
                $tokenData['block_id_from_dist'] = $login_data->block_id_from_dist ? $login_data->block_id_from_dist : 'NOT AVAILABLE'; 
                $tokenData['block_name_from_dist'] = $login_data->block_name_from_dist ? $login_data->block_name_from_dist : 'NOT AVAILABLE'; 
                $tokenData['teacher_type'] = isset($login_data->teacher_type) ? $login_data->teacher_type : 'NOT AVAILABLE'; 
                $output['token'] = AUTHORIZATION::generateToken($tokenData);
                $output['userdata'] = array('username' => (isset($login_data->teacher_name) ? $login_data->teacher_name : 'NOT AVAILABLE'));
                $this->set_response($output, REST_Controller::HTTP_OK);
            }
            else
            {      
                log_message('error','User not Found!');   
                $this->set_response(array('msg' => 'User not Found!'), REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
			print_r('Client Id');
		}
    }


    public function checkapi_post()
    {
        print_r($this->post());
    }
}