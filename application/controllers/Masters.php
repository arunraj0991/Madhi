<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

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

class Masters extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

     function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Master_model');
       
       
    }



    public function getMaster_get()
    {
       $table_param = $this->get('param1');
        $result_data = $this->Master_model->getMasterData($table_param);
        if(count($result_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'Masters Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }


    public function getSchoolListByBlockId_post()
    {
        $blockid = $this->post('blockid');
        $school_data = $this->Master_model->getSchoolListByBlockId($blockid);
        if(count($school_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $school_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'School Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }

    }


    public function getTeachersListBySchoolId_post()
    {
        $schoolid = $this->post('schoolid');
        $teachers_data = $this->Master_model->getTeachersListBySchoolId($schoolid);
        if(count($teachers_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $teachers_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'Teachers Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }


    public function getStudentsListBySchoolId_post()
    {
        $schoolid = $this->post('schoolid');
        $teachers_data = $this->Master_model->getStudentsListBySchoolId($schoolid);
        if(count($teachers_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $teachers_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'Teachers Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }

    public function getSchoolListByDistrictId_post()
    {
         $districtid = $this->post('districtid');
        $school_data = $this->Master_model->getSchoolListByDistrictId($districtid);
        if(count($school_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $school_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'School Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }

    public function getAppVersionInfo_get()
    {
        $version_data = $this->Master_model->getAppVersionInfo();
        if(count($version_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $version_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'School Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }
    

}