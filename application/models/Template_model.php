<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Custom_Model.php';
class Template_model extends Custom_Model {

		public function __construct() 
		{
        	parent::__construct();
        }

        public function getAllTemplates()
        {
        		$templates = $this->db->SELECT('template_id,template_name,template_desc')->FROM(INSPECTION_TEMPLATES)->GET()->result_array();
        		if(count($templates))
        		{
        			foreach ($templates as $key => $template) 
        			{
        				$template_questions = $this->db->SELECT('ques_ans_json,section')->FROM(INSPECTION_QUESTIONS)->WHERE('fk_template_id',$template['template_id'])->GET()->result_array();
        				$templates[$key]['questions'] = $template_questions;
        			}
        		}

        		return $templates;
        }


        public function getAllLeaningOutcomeQuestions()
        {

            $term = $this->db->SELECT('term')->FROM(INSPECTION_LEARNING_OUTCOME_TERM)->WHERE('isactive',1)->GET()->result_array();
            //print_r($term);die();

            $learning_outcome = $this->db->SELECT('learning_outcome_id, grade, subject, unit, learning_outcome,term,meduim')->FROM(LEARNING_OUTCOME_QUESTIONS)->WHERE('term',$term[0]['term'])->GET()->result_array();
                        if(count($learning_outcome))
                        {
                                foreach ($learning_outcome as $key => $outcome) 
                                {
                                        $learning_outcome_questions = $this->db->SELECT('ques_ans_json,section')->FROM(INSPECTION_QUESTIONS)->WHERE('fk_learning_outcome_id',$outcome['learning_outcome_id'])->GET()->result_array();
                                        $learning_outcome[$key]['questions'] = $learning_outcome_questions;
                                }
                        }

                        return $learning_outcome;
        }
		
		
        

        function getObservationList($params,$user_name = null)
        {
                    $this->db->SELECT("school_observation_id,createdon,date_format( CONVERT_TZ(createdon,'+00:00','+05:30'),'%d-%m-%Y %h:%i:%s %p') as createdon,createdby, school_id, district_id, block_id, class, section, medium, final_remarks, block_name, school_name, district_name,observation_time");
                    $this->db->FROM(SCHOOL_OBSERVATIONS);
                  //  echo date_format(date_sub(date_create(), date_interval_create_from_date_string("3 months")),'Y-m-d');die();
                    if(count($params) && isset($params['start_date']) && isset($params['end_date']))
                    {
                        $this->db->WHERE(' date(createdon) >=', $params['start_date']);
                        $this->db->WHERE(' date(createdon) <=',$params['end_date']);
                    }
                    else
                    {
                        $date = date_format(date_sub(date_create(), date_interval_create_from_date_string("3 months")),'Y-m-d');
                         $this->db->WHERE('  date(createdon) >=',$date);
                    }
                    if($user_name != null)
                    {
                      $this->db->WHERE('createdby',$user_name);
                    }
                    $this->db->ORDER_BY('school_observation_id','desc');
                    //$this->db->LIMIT(1,0);
             return $this->db->GET()->result_array();
             print_r($this->db->last_query());die();

        }        
}