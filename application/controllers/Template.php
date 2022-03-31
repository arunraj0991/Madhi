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

class Template extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

     function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Template_model');
       
       
    }



    public function getTemplates_get()
    {
        $result_data = $this->Template_model->getAllTemplates();
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
                $data['msg'] = 'Templates Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }

    public function saveObservation_post()
    {
       
        $records = $this->post('records');
        //print_r(($records['form_values'][1]['classroom_type']));die();
       $created_by_user_name = $records['emis_username'];
       $observation_start_timestamp = $records['observation_start_timestamp'];
       $observation_start_timestamp = date_format(date_create_from_format("d/m/Y, h:i:s a",$observation_start_timestamp),"Y-m-d H:i:s");
       $school_id = '';//$records['form_values'][5]['classroom_data'][1]['school_id'];
       $district_id = '';//$records['form_values'][5]['classroom_data'][1]['district_id'];
       $block_id = '';//$records['form_values'][5]['classroom_data'][1]['block_id'];
       $class = '';//$records['form_values'][1]['classroom_type']['class'];
       $section = '';//$records['form_values'][1]['classroom_type']['section'];
       $medium = '';// $records['form_values'][1]['classroom_type']['medium_info'];
       $final_remarks = ''; //$records['form_values'][9]['final_remarks_form']['final_remarks'];
       $block_name = '';$school_name = '';$district_name = '';
       $teacher_name = '';$teacher_emisid = '';
       $teachers_sanctioned = '';$teachers_alloted = '';
       $staff_attendance = '';$class_type = '';$tot_students = '';$students_seen = '';

       
       //Get Master Details from form JSON
        foreach ($records['form_values'] as $section_key => $section_value) 
        {
            $array_key = (array_keys($section_value)[0]);
            if(!strcasecmp($array_key,'classroom_data'))
            {
                $school_id = $section_value[ $array_key ][1]['school_id'];
                $district_id = $section_value[ $array_key ][1]['district_id'];
                $block_id = $section_value[ $array_key ][1]['block_id'];
                $block_name = $section_value[ $array_key ][1]['block_name'];
                $school_name = $section_value[ $array_key ][1]['school_name'];
                $district_name = $section_value[ $array_key ][1]['district_name'];
            }
            if(!strcasecmp($array_key,'classroom_type'))
            {
                $class = isset( $section_value[ $array_key ]['class'] ) ? $section_value[ $array_key ]['class']  :  $section_value[ $array_key ]['class_observed'];
                $section = $section_value[ $array_key ]['section'];
                $medium = $section_value[ $array_key ]['medium_info'];
                $teacher_name = $section_value[ $array_key ]['teacher_observed'];;
                $teacher_emisid = $section_value[ $array_key ]['teacher_emis_id'];
                $class_type =  $section_value[ $array_key ]['class_type'];
                $tot_students =  $section_value[ $array_key ]['tot_students'];
                $students_seen =  $section_value[ $array_key ]['students_seen'];
            }
             if(!strcasecmp($array_key,'final_remarks_form'))
            {
                $final_remarks = $section_value[ $array_key ]['final_remarks'];
              
            }

            if(!strcasecmp($array_key,'teacher_info'))
            {
               $teachers_sanctioned = $section_value[ $array_key ]['teachers_sanctioned'];
               $teachers_alloted = $section_value[ $array_key ]['teachers_alloted'];
               $staff_attendance = $section_value[ $array_key ]['staff_attendance'];
            }
        }


        $data_to_save = array('json' => json_encode($records),'createdby' =>  $created_by_user_name, 'school_id' => $school_id, 'district_id' => $district_id, 'block_id' => $block_id,'class' =>  $class, 'section' => $section,'medium' => $medium,'final_remarks' => $final_remarks,'block_name' => $block_name,'school_name' => $school_name,'district_name' => $district_name,'teacher_name' => $teacher_name ,'teacher_emisid' => $teacher_emisid,'teachers_sanctioned' => $teachers_sanctioned,'teachers_alloted' => $teachers_alloted,'staff_attendance' => $staff_attendance,'class_type' => $class_type,'tot_students' => $tot_students,'students_seen' => $students_seen);//
      // print_r($data_to_save);die();
       //Save Master details
       $observation_id = $this->Template_model->saveRecords( $data_to_save,SCHOOL_OBSERVATIONS);
 
       //GET single question and save
       if($observation_id)
       {
            foreach ($records['form_values'] as $section_key => $section_value) 
            {

                $array_key = (array_keys($section_value)[0]);
               if( $array_key  != 'classroom_type' && $array_key != 'classroom_data' && $array_key != 'teacher_info' && $array_key != 'final_remarks_form')
                {
                    
                    $temp_data = $section_value[$array_key];
                    if($array_key  != 'student_list')
                    {
                        foreach ($temp_data as $key => $value) 
                        {
                            $this->convertJsonToQuestion($value,$observation_id,$parent_ques_id = null);
                        }
                    }
                    else
                    {
                         
                        //Save Student Masters data 

                        foreach ($temp_data as $key => $value) 
                        {
                            
                             $data_to_insert = array();
                             $data_to_insert['student_emis_id'] = $value['student_emis_id'];
                             $data_to_insert['student_name'] = $value['student'];
                             $data_to_insert['medium'] = $value['medium'];
                             $data_to_insert['learning_outcome_updated'] = $value['learning_outcome_updated'];
                            // print_r($data_to_insert);
                             $learning_outcome_id = isset($value['learning_outcome_id']) ? $value['learning_outcome_id'] : null;
                             $student_id = $this->Template_model->saveRecords( $data_to_insert,SCHOOL_OBSERVATION_STUDENTS);
                             foreach ($value['questions'] as $student_key => $student_value) 
                             {
                                 
                                // save dynamic student specific questions
                                 if( !strcasecmp($value['learning_outcome_updated'],'yes') )
                                 {
                                        $this->convertJsonToQuestion($student_value,$observation_id,$parent_ques_id = null,$student_id,$learning_outcome_id);
                                 }
                                 else // save static student specific questions
                                 {
                                    //print_r($student_value);
                                        for($i = 1; $i <= 3; $i++)
                                        {
                                              
                                              $static_ques = array();  
                                              $static_ques['question'] = $student_value [ ('question_asked' . $i) ] ;
                                              $static_ques['school_observation_id'] = $observation_id;
                                              $static_ques['parent_ques_id'] = null;
                                              $static_ques['student_id'] = $student_id;
                                              $static_ques['answer'] = $student_value [ ('answered_correctly' . $i) ];
                                              // print_r($static_ques);
                                              $this->Template_model->saveRecords($static_ques,SCHOOL_OBSERVATION_QUS_ANSWERS);
                                        }
                                 }
                              }
                            
                        }
                        
                    } 
               }
                    
               
            }
       }
      /// die();
       if($observation_id)
       {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $this->response($data,REST_Controller::HTTP_OK);
       }
       else
       {
            $data['dataStatus'] = false;
            $data['status'] = REST_Controller::HTTP_NOT_FOUND;
            $data['msg'] = 'Try later';
            $this->response($data,REST_Controller::HTTP_OK);
       }
    }

    public function getLeaningOutcomeQuestions_get()
    {
        $result_data = $this->Template_model->getAllLeaningOutcomeQuestions();
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
                $data['msg'] = 'Templates Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        }
    }

    function convertJsonToQuestion($ques_array,$observation_id,$parent_ques_id = null,$student_id = null,$learning_outcome_id = null)
    {

        //Get single Question
                        $data_to_insert['question'] = $ques_array['ques'];
                        if(is_array($ques_array['ques']) && $student_id != null)
                        {
                             $data_to_insert['question'] = $ques_array['ques'][0]['qn'];
                        }
                        $data_to_insert['school_observation_id'] = $observation_id;
                        $data_to_insert['parent_ques_id'] = $parent_ques_id;
                        $data_to_insert['student_id'] = $student_id;
                        $data_to_insert['learning_outcome_id'] = $learning_outcome_id;

                     
                        switch($ques_array['type'])
                        {
                            case 1: //free text
                                     $data_to_insert['answer'] = $ques_array['ans'];
                            break;

                            case 2://radio button
                                     
                                     if(is_array($ques_array['ans'])) 
                                      { 
                                        $data_to_insert['answer'] = ($ques_array['ans']['ans']);
                                        $data_to_insert['answer_id'] = ($ques_array['ans']['answer_id']);
                                      }
                                      else
                                      {
                                        $data_to_insert['answer'] = $ques_array['ans'];
                                      }
                            break;

                            case 3: //single dropdown
                                    $temp_ans = isset($ques_array['ans']['ans']) ? $ques_array['ans']['ans'] : null;
                                    $data_to_insert['answer'] = $temp_ans;
                            break;  

                            case 4://multiple dropdown
                                      $temp_ans = '';
                                          foreach ($ques_array['ans'] as $a_key => $a_value) 
                                          {
                                              
                                            try {
                                                  $temp_ans .= isset($a_value['ans']) ? $a_value['ans'].' ,' : $a_value.' ,';
                                                 
                                                 } catch (Exception $e) {
                                                  
                                                  $custom_info_msg = '###DEV_TRY_CATCH'.$e->getMessage();
                                                  log_message('ERROR',$custom_info_msg);
                                              }  
                                           
                                          }    
                                          $temp_ans  = substr_replace($temp_ans,'',-1,1);
                                           $data_to_insert['answer'] = $temp_ans;

                            break;

                            case 5:
                                         if(isset($ques_array['ans'][0]) && is_array($ques_array['ans'][0]))
                                         {
                                             $temp_ans = '';
                                              foreach ($ques_array['ans'] as $a_key => $a_value) 
                                              {
                                                  
                                                try {
                                                      $temp_ans .= isset($a_value['ans']) ? $a_value['ans'].' ,' : $a_value.' ,';
                                                     
                                                     } catch (Exception $e) {
                                                      
                                                      $custom_info_msg = '###DEV_TRY_CATCH'.$e->getMessage();
                                                      log_message('ERROR',$custom_info_msg);
                                                  }  
                                               
                                              }    
                                                  $temp_ans  = substr_replace($temp_ans,'',-1,1);
                                                  $data_to_insert['answer'] = $temp_ans;
                                         }
                                         else
                                         {
                                             $temp_ans  = implode(',',$ques_array['ans']);
                                             $data_to_insert['answer'] = $temp_ans;
                                         }
                            break;

                            default:
                        }
                       
                  
                         $parent_ques_id = $this->Template_model->saveRecords($data_to_insert,SCHOOL_OBSERVATION_QUS_ANSWERS);
                      
                        if(isset($ques_array['sub_field_array']) && count($ques_array['sub_field_array']))
                        {
                            
                            foreach ($ques_array['sub_field_array'] as $sub_key => $sub_value) 
                            {
                                $this->convertJsonToQuestion($sub_value,$observation_id,$parent_ques_id);
                            }
                             
                        }
                        
    }



     public function getObservationList_post()
    {

      $post_data = $this->post();
      //print_r($post_data);die();
      $getallheaders = getallheaders();
      $user_name = JWT::getTokenPayloadInfo($getallheaders['Token']);
      $result_data = $this->Template_model->getObservationList($post_data,$user_name->emis_username);
        if(count($result_data))
        {
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result_data;
                $data['count'] = count($result_data);
                $this->response($data,REST_Controller::HTTP_OK);
        }   
        else
        {
                $data['dataStatus'] = false;
                $data['status'] = REST_Controller::HTTP_NOT_FOUND;
                $data['msg'] = 'Data Not Found!';
                $this->response($data,REST_Controller::HTTP_OK);
        } 
    }
    

}