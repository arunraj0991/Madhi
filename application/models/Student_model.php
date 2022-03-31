<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Custom_Model.php';
class Student_model extends Custom_Model {

		public function __construct() 
		{
        	parent::__construct();
        }

        public function getTeachingMethodology(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('sec_id,sec_name,sec_header_color,sec_color,priority,lang');
			$this->db2->FROM('sections');
			$this->db2->order_by('priority','ASC');
			$this->db2->WHERE('is_active',1);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		/* public function getTeachingQuestions(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.parent_id,observation_question.action_id,action_items.action_name,action_items.param_id,action_items.priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->WHERE('observation_question.is_active',1);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} */
		
		public function getTeachingQuestions($class_id,$classtype){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.score,observation_question.score_id,observation_question.parent_id,observation_question.action_id,observation_question.lang,observation_question.ref_id,action_items.action_name,action_items.param_id,action_items.priority as action_priority,dashboard_parameters.priority as param_priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->JOIN('dashboard_parameters','action_items.param_id = dashboard_parameters.param_id');
			$this->db2->WHERE('observation_question.parent_id','-1');
			$this->db2->WHERE('observation_question.classtype IN (3,'.$classtype.')');
			$this->db2->where("find_in_set('$class_id', observation_question.class)");
			$this->db2->WHERE('observation_question.is_active','1');
			$query = $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			  if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}  
		}
		
		public function getChildQuestions($child_id){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.score,observation_question.score_id,observation_question.parent_id,observation_question.action_id,observation_question.lang,observation_question.ref_id,action_items.action_name,action_items.param_id,action_items.priority as action_priority,dashboard_parameters.priority as param_priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->JOIN('dashboard_parameters','action_items.param_id = dashboard_parameters.param_id');
			$this->db2->WHERE("ob_qus_id IN (".$child_id.")",NULL, false);
			$this->db2->WHERE('observation_question.is_active','1');
			$query = $this->db2->GET();
			/* $sql = $this->db2->last_query();
			return $sql; */
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getChaptersList($class,$term,$medium,$subject){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('chapter_id,chapter_name,chapter_no');
			$this->db2->FROM('chapter');
			$this->db2->WHERE("class IN (".$class.")",NULL, false);
			$this->db2->WHERE('term',$term);
			//$this->db2->WHERE('medium_id',$medium);
			$this->db2->WHERE("medium_id IN (".$medium.")",NULL, false);
			$this->db2->WHERE('subject_id',$subject);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAssesmentReasons(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('reason_id,reason,language_id');
			$this->db2->FROM('ob_reasons_data');
			$this->db2->JOIN('medium','ob_reasons_data.language_id = medium.medium_id');
			$this->db2->WHERE('reason_type_id',3);
			$this->db2->WHERE('isactive',1);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getMismatchReasons(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('reason_id,reason,language_id');
			$this->db2->FROM('ob_reasons_data');
			$this->db2->JOIN('medium','ob_reasons_data.language_id = medium.medium_id');
			$this->db2->WHERE('reason_type_id',4);
			$this->db2->WHERE('isactive',1);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getTerm(){
			$this->db->SELECT('id,term'); 
			$this->db->FROM('inspection_learning_outcome_term');
			$this->db->WHERE('isactive',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function UserDetais($emis_username){
        	$this->db->SELECT('EMISUSER_TEACHER.emis_user_id,EMISUSER_TEACHER.emis_username,EMISUSER_TEACHER.emis_usertype,USER_CATEGORY.user_type,UDISE_STAFFREG.udise_code,UDISE_STAFFREG.teacher_type,TEACHER_TYPE.type_teacher,UDISE_STAFFREG.teacher_name,UDISE_STAFFREG.teacher_type,UDISE_OFFREG.district_id');
            $this->db->FROM(EMISUSER_TEACHER.' as EMISUSER_TEACHER');
            $this->db->JOIN(UDISE_STAFFREG.' as UDISE_STAFFREG',"UDISE_STAFFREG.u_id = EMISUSER_TEACHER.emis_user_id",'LEFT');
            $this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_STAFFREG.school_key_id = UDISE_OFFREG.off_key_id','LEFT');
            $this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMISUSER_TEACHER.emis_usertype = USER_CATEGORY.id','LEFT');
            $this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
            $this->db->WHERE('EMISUSER_TEACHER.emis_username',$emis_username);
            $this->db->WHERE('EMISUSER_TEACHER.STATUS','Active');
            $user_data = $this->db->GET()->row();

            if(!$user_data){
                $this->db->SELECT('EMIS_USERLOGIN.emis_user_id,EMIS_USERLOGIN.emis_usertype1,EMIS_USERLOGIN.emis_username,EMIS_USERLOGIN.emis_usertype,USER_CATEGORY.user_type,UDISE_OFFREG.district_id,SCHOOLNEW_BLOCK.district_id as district_id_from_block');
                 $this->db->FROM(EMIS_USERLOGIN.' as EMIS_USERLOGIN');
                $this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_OFFREG.office_user = EMIS_USERLOGIN.emis_username','LEFT');
                $this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMIS_USERLOGIN.emis_usertype = USER_CATEGORY.id','LEFT');
                $this->db->JOIN(SCHOOLNEW_BLOCK.' as SCHOOLNEW_BLOCK','EMIS_USERLOGIN.emis_user_id = SCHOOLNEW_BLOCK.id','LEFT');
                $this->db->WHERE('EMIS_USERLOGIN.emis_username',$emis_username);
                $this->db->WHERE('EMIS_USERLOGIN.STATUS','Active');
                $user_data = $this->db->GET()->row();
            }
			
			if($user_data){
				return $user_data;
			}else{
				return false;
			}
        	
        }
		
        public function getSchoolListByBlockId($blockid)
        {
        	$school_data = $this->db->SELECT('*')->FROM(STUDENTS_SCHOOL_CHILD_COUNT)->WHERE('block_id',$blockid)->GET()->result_array();
        	return $school_data;
        }


		//Get School Mapping
		public function getSchoolMapping($user_info)
        {
			//print_r $user_info; die();
			$interval_time = "now() - interval 5 month";
			
			if($user_info->user_type =='TEACHER' && $user_info->emis_usertype == 14){ //BRTE
				$this->db->SELECT('school_id,school_name');
				$this->db->FROM('brte_school_map');
				$this->db->JOIN('emisuser_teacher','brte_school_map.brte_id = emisuser_teacher.emis_user_id');
				$this->db->WHERE('emisuser_teacher.emis_username',$user_info->emis_username);
				$this->db->WHERE('brte_school_map.isactive','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				} 
				
				$query2 = $this->db->query("SELECT school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				} 

				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
				
			}else if($user_info->user_type =='school' && $user_info->emis_usertype == 1){ //ZHM
				$this->db->SELECT('school_id,school_name');
				$this->db->FROM('brte_school_map');
				$this->db->JOIN('emis_userlogin','brte_school_map.hss_udise_code = emis_userlogin.emis_username');
				$this->db->WHERE('emis_userlogin.emis_username',$user_info->emis_username);
				$this->db->WHERE('brte_school_map.isactive','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
				
				$query2 = $this->db->query("SELECT school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				} 

				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
				
			}else if($user_info->user_type =='BEO' && $user_info->emis_usertype == 6){ //BEO
				$this->db->SELECT('schoolnew_basicinfo.school_id,schoolnew_basicinfo.school_name');
				$this->db->FROM('schoolnew_basicinfo');
				$this->db->JOIN('emis_userlogin','schoolnew_basicinfo.block_id = emis_userlogin.emis_user_id');
				$this->db->WHERE('emis_userlogin.emis_username',$user_info->emis_username);
				$this->db->WHERE('schoolnew_basicinfo.beo_map',$user_info->emis_usertype1);
				$this->db->WHERE('schoolnew_basicinfo.curr_stat','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
				
				$query2 = $this->db->query("select school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen from school_observations_new where createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				}

				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
				
			}else if($user_info->user_type =='DEO' && $user_info->emis_usertype == 10){ //DEO
				$this->db->SELECT('school_id,school_name');
				$this->db->FROM('schoolnew_basicinfo');
				$this->db->JOIN('emis_userlogin','schoolnew_basicinfo.edu_dist_id = emis_userlogin.emis_user_id');
				$this->db->WHERE('emis_userlogin.emis_username',$user_info->emis_username);
				$this->db->WHERE('schoolnew_basicinfo.curr_stat','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
				
				$query2 = $this->db->query("select school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen from school_observations_new where createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				}
				
				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
				
				
			}else if($user_info->user_type =='CEO' && $user_info->emis_usertype == 9){ //CEO
				$this->db->SELECT('school_id,school_name');
				$this->db->FROM('schoolnew_basicinfo');
				$this->db->JOIN('emis_userlogin','schoolnew_basicinfo.district_id = emis_userlogin.emis_user_id');
				$this->db->WHERE('emis_userlogin.emis_username',$user_info->emis_username);
				$this->db->WHERE('schoolnew_basicinfo.curr_stat','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}			
				
				$query2 = $this->db->query("select school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen from school_observations_new where createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				}
				
				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
			}else if($user_info->user_type =='state' && $user_info->emis_usertype == 5){ //STATE
				$this->db->SELECT('school_id,school_name');
				$this->db->FROM('schoolnew_basicinfo');
				$this->db->WHERE('schoolnew_basicinfo.curr_stat','1');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
				
				$query2 = $this->db->query("select school_id,class,section,medium,teacher_name,teacher_emisid,school_name,teachers_alloted,staff_attendance,class_type,tot_students,students_seen from school_observations_new where createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				if($query2->num_rows() > 0){
					$result2 = $query2->result();
				}else{
					$result2 = false;
				}
				
				$query3 = $this->db->query("SELECT COUNT(DISTINCT(school_id)) AS schools_visited, COUNT(DISTINCT(teacher_emisid)) AS teachers_observed FROM school_observations_new WHERE createdBy = '".$user_info->emis_username."'  AND createdon >= ".$interval_time." ;");
				$result3 = $query3->result(); 
				
				return array('All' => $result, 'recentlyVisited' => $result2, 'observed' => $result3);
			}
		}
		
		public function getQuotes($date_month){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('quotes');
			$this->db2->FROM('ob_quotes_data');
			$this->db2->WHERE('isactive','1');
			$this->db2->ORDER_BY("rand(".$date_month.")");
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}

		//Targets
		public function getTargetsData($user_info){   
        	$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('target_id,target_value');
			$this->db2->FROM('ob_target_data');
			$this->db2->WHERE('officer_type_id',$user_info->emis_usertype);
			$this->db2->WHERE('target_type_id','1'); // 1 For Schools Observed Target
			$this->db2->WHERE('isactive','1');
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				$school_target = $query->row();
			}else{
				$school_target = false;
			}
			
			$this->db2->SELECT('target_id,target_value');
			$this->db2->FROM('ob_target_data');
			$this->db2->WHERE('officer_type_id',$user_info->emis_usertype);
			$this->db2->WHERE('target_type_id','2'); // 2 For Teachers Observed Target
			$this->db2->WHERE('isactive','1');
			$query2 = $this->db2->GET();
			if($query2->num_rows() > 0){
				$teacher_target = $query2->row();
			}else{
				$teacher_target = false;
			}

			return array('schoolTarget' => $school_target, 'teacherTarget' => $teacher_target);
		}
		
		public function getSchoolResons(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('reason_id,reason,language_id');
			$this->db2->FROM('ob_reasons_data');
			$this->db2->JOIN('medium','ob_reasons_data.language_id = medium.medium_id');
			$this->db2->WHERE('reason_type_id','1');
			$this->db2->WHERE('isactive','1');
		//	$reason_data = $this->db2->GET()->result_array();
		//	return $reason_data;
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		
		function getAllbrachesbyschool($school_id){
			$this->db->SELECT('students_school_child_count.district_id,students_school_child_count.edu_dist_id,students_school_child_count.block_id,students_school_child_count.block_name,students_school_child_count.edu_dist_name,students_school_child_count.district_name,students_school_child_count.total,students_school_child_count.catty_id,students_school_child_count.cate_type,students_school_child_count.teach_tot,students_school_child_count.nonteach_tot,students_school_child_count.totstaff,students_school_child_count.total as total_students,schoolnew_basicinfo.school_name,schoolnew_basicinfo.school_id,schoolnew_basicinfo.udise_code,Prkg_b,Prkg_g,Prkg_t, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, lkg_b,lkg_g,lkg_t, sum(lkg_b+lkg_g+lkg_t) as LKG_Total,ukg_b,ukg_g,ukg_t,sum(ukg_b+ukg_g+ukg_t) as UKG_Total, c1_b,c1_g,c1_t,sum(c1_b+c1_g+c1_t) as class_1_Total,c2_b,c2_g,c2_t ,sum(c2_b+c2_g+c2_t) as class_2_Total,c3_b,c3_g,c3_t,sum(c3_b+c3_g+c3_t) as class_3_Total,c4_b,c4_g,c4_t,sum(c4_b+c4_g+c4_t) as class_4_Total,c5_b,c5_g,c5_t,sum(c5_b+c5_g+c5_t) as class_5_Total,c6_b,c6_g,c6_t,sum(c6_b+c6_g+c6_t) as class_6_Total,c7_b,c7_g,c7_t,sum(c7_b+c7_g+c7_t) as class_7_Total,c8_b,c8_g,c8_t,sum(c8_b+c8_g+c8_t) as class_8_Total,c9_b,c9_g,c9_t,sum(c9_b+c9_g+c9_t) as class_9_Total,c10_b,c10_g,c10_t,sum(c10_b+c10_g+c10_t) as class_10_Total,c11_b,c11_g,c11_t,sum(c11_b+c11_g+c11_t) as class_11_Total,c12_b,c12_g,c12_t,sum(c12_b+c12_g+c12_t) as class_12_Total,brte_school_map.hss_school_id,brte_school_map.hss_school_name') 
			->FROM('students_school_child_count')
			->JOIN('brte_school_map', 'students_school_child_count.school_id = brte_school_map.school_id')
			->JOIN('schoolnew_basicinfo','students_school_child_count.school_id=schoolnew_basicinfo.school_id')	
			//->WHERE('schoolnew_block.id',$block_id)
			->WHERE('schoolnew_basicinfo.school_id',$school_id)
			->WHERE('schoolnew_basicinfo.curr_stat','1')
			->group_by('schoolnew_basicinfo.school_name')
			->group_by('schoolnew_basicinfo.school_id')
			->group_by('schoolnew_basicinfo.udise_code');
			$query =  $this->db->get();
			//print_r($this->db->last_query());
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		/* function getTeacherDetails($school_id){
			$this->db->SELECT('teacher_id,teacher_name');
			$this->db->FROM(UDISE_STAFFREG);
			$this->db->WHERE('school_key_id',$school_id); 
			$this->db->WHERE('status','1');
			$this->db->WHERE('archive','1');
			$query =  $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} */
		
		function getObservedTeacherDetails($school_id){
			$this->db2 = $this->load->database('database2', TRUE);
			$interval_time = "now() - interval 2 month";
			
			$query = $this->db2->query("select teacher_name,teacher_emisid from school_observations_new where school_id =  ".$school_id." AND createdon >=  ".$interval_time." ;");
			
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			} 
		}
		
		function getTeacherDetails($school_id){
			$this->db->SELECT('teacher_id,teacher_name');
			$this->db->FROM(UDISE_STAFFREG);
			$this->db->WHERE('school_key_id',$school_id);
			$this->db->WHERE('status','1');
			$this->db->WHERE('archive','1');
			$query =  $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getOtherTeachers($school_id,$teacher_id){
			$this->db->SELECT('teacher_id,teacher_name');
			$this->db->FROM(UDISE_STAFFREG);
			$this->db->WHERE('school_key_id',$school_id); 
			$this->db->WHERE_NOT_IN('teacher_id',$teacher_id); 
			$this->db->WHERE('status','1');
			$this->db->WHERE('archive','1');
			$query =  $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getTeacherObsInfo($teacher_id){   //Con
			//$this->db2 = $this->load->database('database2', TRUE);
			$this->db->SELECT('teacher_emisid,teacher_name,createdon,final_remarks,strength,improvement');
			$this->db->FROM('school_observations_new');
			$this->db->WHERE('teacher_emisid',$teacher_id);
			$query =  $this->db->GET();
			
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}

		public function getTeacherResons(){	
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('reason_id,reason,language_id');
			$this->db2->FROM('ob_reasons_data');
			$this->db2->JOIN('medium','ob_reasons_data.language_id = medium.medium_id');
			$this->db2->WHERE('reason_type_id','2');
			$this->db2->WHERE('isactive','1');
			$query =  $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getallstudentsbyid($schoolid,$classid,$section){
			if($section != null){
				$this->db->SELECT('id,name,class_studying_id,class_section')
				->FROM('students_child_detail')
				->WHERE('school_id', $schoolid)  
				->WHERE('transfer_flag',0)
				->WHERE("class_studying_id IN (".$classid.")",NULL, false)
				->WHERE('class_section', $section);
				$query =  $this->db->get();
				// $sql = $this->db->last_query();
				// return $sql;
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}else{
				$this->db->SELECT('id,name,class_studying_id,class_section')
				->FROM('students_child_detail')
				->WHERE('school_id', $schoolid)  
				->WHERE('transfer_flag',0)
				->WHERE("class_studying_id IN (".$classid.")",NULL, false);
				$query =  $this->db->get();
				// $sql = $this->db->last_query();
				// return $sql;
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}
		}

		function getAttendanceData($schoolid,$classid,$section){
			//$date =date('Y-m-d');
			$date = '2020-02-17';

			if($section != null){
				$this->db->SELECT('session1_allP as tot_present, session1_allA as tot_absent, session1_all as total_students, session1_students as absent_students,st_section,st_class')
				->FROM('students_attend_daily')
				->WHERE('school_id', $schoolid)
				->WHERE("st_class IN (".$classid.")",NULL, false)
				->WHERE('st_section', $section)
				->WHERE('date', $date);
				$query =  $this->db->get();
				//$sql = $this->db->last_query();
				//return $sql;
				if($query->num_rows() > 0){
					return $query->result_array();
				}else{
					return false;
				}
			}else{
				$this->db->SELECT('session1_allP as tot_present, session1_allA as tot_absent, session1_all as total_students, session1_students as absent_students,st_section,st_class')
				->FROM('students_attend_daily')
				->WHERE('school_id', $schoolid)
				->WHERE("st_class IN (".$classid.")",NULL, false)
				->WHERE('date', $date);
				$query =  $this->db->get();
				//$sql = $this->db->last_query();
				//return $sql;
				if($query->num_rows() > 0){
					return $query->result_array();
				}else{
					return false;
				}
			}
		}

		function getAbsentData($school_id,$class_id,$section,$abs_student_list){
			if($section != null){
				if($abs_student_list){
					$this->db->SELECT('id,name,class_studying_id,class_section')
					->FROM('students_child_detail')
					->WHERE('school_id', $school_id)
				//	->WHERE("class_studying_id IN (".$class_id.")",NULL, false)
				//	->WHERE('class_section', $section)
					->WHERE("id IN (".$abs_student_list.")",NULL, false);
					//->WHERE_IN('id', $abs_student_list);
					$query =  $this->db->get();
					//$sql = $this->db->last_query();
					//return $sql;
					if($query->num_rows() > 0){
						return $query->result();
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				if($abs_student_list){
					$this->db->SELECT('id,name,class_studying_id,class_section')
					->FROM('students_child_detail')
					->WHERE('school_id', $school_id)
					//->WHERE("class_studying_id IN (".$class_id.")",NULL, false)
					->WHERE("id IN (".$abs_student_list.")",NULL, false);
					//->WHERE_IN('id', $abs_student_list);
					$query =  $this->db->get();
					//$sql = $this->db->last_query();
					//return $sql;
					if($query->num_rows() > 0){
						return $query->result();
					}else{
						return false;
					}
				}else{
					return false;
				}
			}	
		}

		public function	get_mediumInfo($medium_id){			
			//EMIS Staging
			// $this->db->SELECT('MEDINSTR_ID AS medium_id, MEDINSTR_DESC as medium_desc');
			// $this->db->FROM('schoolnew_mediumofinstruction');
			// $this->db->WHERE_IN('MEDINSTR_ID', $medium_id);
			// $query =  $this->db->get();
			// if($query->num_rows() > 0){
			// 	return $query->result();
			// }else{
			// 	return false;
			// }
					
			//Try Staging
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('medium_id,medium as medium_desc');
			$this->db2->FROM('medium');
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->get();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		public function	getSchoolClassInfo($school_id){
		  $this->db->SELECT('group_concat(distinct(section)) as section ,class_id,students');
		  $this->db->FROM('schoolnew_section_group');
		  $this->db->WHERE('schoolnew_section_group.school_key_id',$school_id);
		  $this->db->group_by('schoolnew_section_group.class_id');
		  $query =  $this->db->get();
		  if($query->num_rows() > 0){
			  return $query->result();
		  }else{
			  return false;
		  }
		}
		
		public function	getSubjectsdata(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('subject_id,subject');
			$this->db2->FROM('subject');
			//$this->db->JOIN('medium','subject.medium_id = medium.medium_id');
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
	
		public function	getSubjects($class,$medium){
			$this->db2 = $this->load->database('database2', TRUE);
			$sql="select subject_id,subject from subject where subject_id in (select distinct(subject_id) from chapter where class in ('".$class."') and medium_id in  ($medium))";
			$query =  $this->db2->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getLearningOutcome($chapter){	
			$this->db2 = $this->load->database('database2', TRUE);
			$sql="select lo.lo_name,lo.lo_id,lo.option_1,lo.option_2,lo.option_3,lo.option_4,lo.grade_option_1,lo.grade_option_2,lo.grade_option_3,lo.grade_option_4,c.chapter_no
			FROM chapter c,medium m,subject s,sub_topic t,skills sk,learning_objective lo 
			WHERE m.medium_id = c.medium_id 
			AND s.subject_id=c.subject_id 
			AND lo.skill_id = sk.skill_id 
			AND sk.topic_id = t.topic_id 
			AND t.chapter_id = c.chapter_id 
			AND c.chapter_id in ('".$chapter."') order by RAND() limit 1;";
			$query =  $this->db2->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getQuestions($learning_outcome_id){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('id,question,ans');
			$this->db2->FROM('question_ans');
			$this->db2->WHERE('lo_id',$learning_outcome_id);
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
     
		public function getTeachersListBySchoolId($schoolid){
        	
        	$this->db->SELECT('UDISE_STAFFREG.u_id,UDISE_STAFFREG.udise_code,UDISE_STAFFREG.teacher_code,UDISE_STAFFREG.teacher_type,TEACHER_TYPE.type_teacher,UDISE_STAFFREG.teacher_name,');
        	$this->db->FROM(UDISE_STAFFREG.' as UDISE_STAFFREG');
        	$this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
        	$teachers_data = $this->db->WHERE('UDISE_STAFFREG.school_key_id',$schoolid)->GET()->result_array();
        	return $teachers_data;
        }
	
		function getObsInfo_new(){		
				$this->db->SELECT('id,edn_dist_name,district_id'); 
				$this->db->FROM('schoolnew_edn_dist_mas');
				$query =  $this->db->GET();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
			
				$this->db->SELECT('id,block_name,district_id,edu_dist_id'); 
				$this->db->FROM('schoolnew_block');
				$query2 =  $this->db->GET();
				if($query2->num_rows() > 0){
					$result2 =  $query2->result();
				}else{
					$result2 = false;
				}
			
				$this->db->SELECT('distinct(hss_school_id),hss_school_name,district_id,block_id,edu_dist_id'); 
				$this->db->FROM('brte_school_map'); 
				$query3 =  $this->db->GET();
				if($query3->num_rows() > 0){
					$result3 =  $query3->result();
				}else{
					$result3 = false;
				}
				
				return array('edu_dist' => $result, 'blocks' => $result2, 'nodals' => $result3);
		   
		}
		
		public function getObsInformation($json){ //Con
			//$this->db2 = $this->load->database('database2', TRUE);
			$this->db->insert('school_observations_new', $json);
			if($this->db->affected_rows()){
				return $idOfInsertedData = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		
		public function getAllDist(){
			$this->db->SELECT('id,district_name');
			$this->db->FROM('schoolnew_district');
			$district = $this->db->GET()->result();
			return $district;
		}
		
		// Offline API
		
		function getAllbrachesbyschool_new($school_id){
			$this->db->SELECT('students_school_child_count.district_id,students_school_child_count.edu_dist_id,students_school_child_count.block_id,students_school_child_count.block_name,students_school_child_count.edu_dist_name,students_school_child_count.district_name,students_school_child_count.total,students_school_child_count.catty_id,students_school_child_count.cate_type,students_school_child_count.teach_tot,students_school_child_count.nonteach_tot,students_school_child_count.totstaff,students_school_child_count.total as total_students,schoolnew_basicinfo.school_name,schoolnew_basicinfo.school_id,schoolnew_basicinfo.udise_code,Prkg_b,Prkg_g,Prkg_t, sum(Prkg_b+Prkg_g+Prkg_t) as Prkg_Total, lkg_b,lkg_g,lkg_t, sum(lkg_b+lkg_g+lkg_t) as LKG_Total,ukg_b,ukg_g,ukg_t,sum(ukg_b+ukg_g+ukg_t) as UKG_Total, c1_b,c1_g,c1_t,sum(c1_b+c1_g+c1_t) as class_1_Total,c2_b,c2_g,c2_t ,sum(c2_b+c2_g+c2_t) as class_2_Total,c3_b,c3_g,c3_t,sum(c3_b+c3_g+c3_t) as class_3_Total,c4_b,c4_g,c4_t,sum(c4_b+c4_g+c4_t) as class_4_Total,c5_b,c5_g,c5_t,sum(c5_b+c5_g+c5_t) as class_5_Total,c6_b,c6_g,c6_t,sum(c6_b+c6_g+c6_t) as class_6_Total,c7_b,c7_g,c7_t,sum(c7_b+c7_g+c7_t) as class_7_Total,c8_b,c8_g,c8_t,sum(c8_b+c8_g+c8_t) as class_8_Total,c9_b,c9_g,c9_t,sum(c9_b+c9_g+c9_t) as class_9_Total,c10_b,c10_g,c10_t,sum(c10_b+c10_g+c10_t) as class_10_Total,c11_b,c11_g,c11_t,sum(c11_b+c11_g+c11_t) as class_11_Total,c12_b,c12_g,c12_t,sum(c12_b+c12_g+c12_t) as class_12_Total,brte_school_map.hss_school_id,brte_school_map.hss_school_name') 
			->FROM('students_school_child_count')
			->JOIN('brte_school_map', 'students_school_child_count.school_id = brte_school_map.school_id')
			->JOIN('schoolnew_basicinfo','students_school_child_count.school_id=schoolnew_basicinfo.school_id')	
			//->WHERE('schoolnew_block.id',$block_id)
			->WHERE("schoolnew_basicinfo.school_id IN (".$school_id.")",NULL, false)
			//->WHERE('schoolnew_basicinfo.school_id',$school_id)
			->WHERE('schoolnew_basicinfo.curr_stat','1')
			->group_by('schoolnew_basicinfo.school_name')
			->group_by('schoolnew_basicinfo.school_id')
			->group_by('schoolnew_basicinfo.udise_code');
			$query =  $this->db->get();
			//print_r($this->db->last_query());
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		
		public function getTeachingQuestions_new(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.score,observation_question.score_id,observation_question.parent_id,observation_question.action_id,observation_question.lang,observation_question.ref_id,action_items.action_name,action_items.param_id,action_items.priority as action_priority,dashboard_parameters.priority as param_priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->JOIN('dashboard_parameters','action_items.param_id = dashboard_parameters.param_id');
			$this->db2->WHERE('observation_question.parent_id','-1');
			//$this->db2->WHERE('observation_question.classtype IN (3,'.$classtype.')');
			//$this->db2->WHERE("find_in_set('$class_id', observation_question.class)");
			$this->db2->WHERE('observation_question.is_active','1');
			$query = $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			  if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}  
		}
		
		public function getChaptersList_new(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('chapter_id,class,term,medium_id,subject_id,chapter_name,chapter_no');
			$this->db2->FROM('chapter');
			//$this->db2->WHERE("class IN (".$class.")",NULL, false);
			//$this->db2->WHERE('term',$term);
			//$this->db2->WHERE('medium_id',$medium);
			//$this->db2->WHERE('subject_id',$subject);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getAllStudentsBySchoolId_new($schoolid){
			$this->db->SELECT('id,name,class_studying_id,class_section')
			->FROM('students_child_detail')
			->WHERE('school_id', $schoolid)  
			->WHERE('transfer_flag',0);
			//->WHERE("class_studying_id IN (".$classid.")",NULL, false)
			//->WHERE('class_section', $section);
			$query =  $this->db->get();
			// $sql = $this->db->last_query();
			// return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getAttendanceData_new($schoolid){
			//$date =date('Y-m-d');
			$date = '2020-02-17';

			$this->db->SELECT('session1_allP as tot_present, session1_allA as tot_absent, session1_all as total_students, session1_students as absent_students,st_section,st_class')
			->FROM('students_attend_daily')
			->WHERE('school_id', $schoolid)
			//->WHERE("st_class IN (".$classid.")",NULL, false)
			//->WHERE('st_section', $section)
			->WHERE('date', $date);
			$query =  $this->db->get();
			//$sql = $this->db->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		
		function getAbsentData_new($school_id,$abs_student_list){
			if($abs_student_list){
				$this->db->SELECT('id,name,class_studying_id,class_section')
				->FROM('students_child_detail')
				->WHERE('school_id', $school_id)
				->WHERE("id IN (".$abs_student_list.")",NULL, false);
				$query =  $this->db->get();
				//$sql = $this->db->last_query();
				//return $sql;
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}else{
				return false;
			}	
		}
		
		
		public function getLearningOutcome_new($chapterslist){	
			$this->db2 = $this->load->database('database2', TRUE);
			$sql="select lo.lo_name,lo.no_of_random_qus,lo.lo_id,lo.option_1,lo.option_2,lo.option_3,lo.option_4,lo.grade_option_1,lo.grade_option_2,lo.grade_option_3,lo.grade_option_4,c.chapter_no,c.chapter_id 
			FROM chapter c,medium m,subject s,sub_topic t,skills sk,learning_objective lo 
			WHERE m.medium_id = c.medium_id 
			AND s.subject_id=c.subject_id 
			AND lo.skill_id = sk.skill_id 
			AND sk.topic_id = t.topic_id 
			AND t.chapter_id = c.chapter_id 
			AND c.chapter_id in ($chapterslist);";
			$query =  $this->db2->query($sql);
			//$sqls = $this->db2->last_query();
			//return $sqls;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		
		/* public function getLearningOutcome_new(){	
			$this->db2 = $this->load->database('database2', TRUE);
			$sql="select lo.lo_name,lo.lo_id,lo.option_1,lo.option_2,lo.option_3,lo.option_4,lo.grade_option_1,lo.grade_option_2,lo.grade_option_3,lo.grade_option_4,c.chapter_no
			FROM chapter c,medium m,subject s,sub_topic t,skills sk,learning_objective lo 
			WHERE m.medium_id = c.medium_id 
			AND s.subject_id=c.subject_id 
			AND lo.skill_id = sk.skill_id 
			AND sk.topic_id = t.topic_id 
			AND t.chapter_id = c.chapter_id order by RAND() limit 1;";
			$query =  $this->db2->query($sql);
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        } */
		
		/* function getObsInfo_new(){		
				$this->db->SELECT('id,edn_dist_name'); 
				$this->db->FROM('schoolnew_edn_dist_mas');
				$query =  $this->db->GET();
				if($query->num_rows() > 0){
					$result = $query->result();
				}else{
					$result = false;
				}
			
				$this->db->SELECT('id,block_name'); 
				$this->db->FROM('schoolnew_block');
				$query2 =  $this->db->GET();
				if($query2->num_rows() > 0){
					$result2 =  $query2->result();
				}else{
					$result2 = false;
				}
			
				$this->db->SELECT('distinct(hss_school_id),hss_school_name'); 
				$this->db->FROM('brte_school_map'); 
				$query3 =  $this->db->GET();
				if($query3->num_rows() > 0){
					$result3 =  $query3->result();
				}else{
					$result3 = false;
				}
				
				return array('edu_dist' => $result, 'blocks' => $result2, 'nodals' => $result3);
		   
		} */
		
		public function	getSubjectsById($class,$medium){
			$this->db2 = $this->load->database('database2', TRUE);
			$sql="select subject_id,subject from subject where subject_id in (select distinct(subject_id) from chapter where class in ('".$class."') and medium_id in  ($medium))";
			$query =  $this->db2->query($sql);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		
		public function	getMedium_new($class){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('chapter.medium_id,medium.medium');
			$this->db2->FROM('chapter');
			$this->db2->JOIN('medium','chapter.medium_id = medium.medium_id'); 
			$this->db2->WHERE('class',$class);
			$this->db2->group_by('chapter.medium_id'); 
			$query =  $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function	getsub_new($class,$medium){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('chapter.subject_id,subject.subject');
			$this->db2->FROM('chapter');
			$this->db2->JOIN('subject','chapter.subject_id = subject.subject_id');
			$this->db2->WHERE('class',$class);
			$this->db2->WHERE('medium_id',$medium);
			$this->db2->group_by('chapter.subject_id'); 
			$query =  $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getQuestions_new($lo_list){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('id,lo_id,question,ans');
			$this->db2->FROM('question_ans');
			//$this->db2->WHERE_IN('lo_id',$lo_list);
			$this->db2->WHERE("lo_id IN (".$lo_list.")",NULL, false);
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
			//Language
		
		public function	getLang(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('distinct(lang)');
			$this->db2->FROM('sections');
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSectionLang($lang){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('sec_id,sec_name,sec_header_color,sec_color,priority,lang');
			$this->db2->FROM('sections');
			$this->db2->order_by('priority','ASC');
			$this->db2->WHERE('lang',$lang);
			$this->db2->WHERE('is_active',1);
			$query = $this->db2->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function	getObsQuestLang(){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('distinct(lang)');
			$this->db2->FROM('observation_question');
			$this->db2->WHERE('is_active','1');
			$query =  $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getTeachingQuestions_new_lang($lang){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.score,observation_question.score_id,observation_question.parent_id,observation_question.action_id,observation_question.lang,observation_question.ref_id,action_items.action_name,action_items.param_id,action_items.priority as action_priority,dashboard_parameters.priority as param_priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->JOIN('dashboard_parameters','action_items.param_id = dashboard_parameters.param_id');
			$this->db2->WHERE('observation_question.parent_id','-1');
			$this->db2->WHERE('observation_question.lang',$lang);
			//$this->db2->WHERE('observation_question.classtype IN (3,'.$classtype.')');
			//$this->db2->WHERE("find_in_set('$class_id', observation_question.class)");
			$this->db2->WHERE('observation_question.is_active','1');
			$query = $this->db2->GET();
			//$sql = $this->db2->last_query();
			//return $sql;
			  if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}  
		}
		
		public function getChildQuestions_lang($child_id,$lang){
			$this->db2 = $this->load->database('database2', TRUE);
			$this->db2->SELECT('observation_question.ob_qus_id,observation_question.ob_qus_name,observation_question.class,observation_question.sec_id,observation_question.type_of_ans,observation_question.ans,observation_question.classtype,observation_question.score,observation_question.score_id,observation_question.parent_id,observation_question.action_id,observation_question.lang,observation_question.ref_id,action_items.action_name,action_items.param_id,action_items.priority as action_priority,dashboard_parameters.priority as param_priority');
			$this->db2->FROM('observation_question');
			$this->db2->JOIN('action_items','action_items.action_id = observation_question.action_id');
			$this->db2->JOIN('dashboard_parameters','action_items.param_id = dashboard_parameters.param_id');
			$this->db2->WHERE("ob_qus_id IN (".$child_id.")",NULL, false);
			$this->db2->WHERE('observation_question.lang',$lang);
			$this->db2->WHERE('observation_question.is_active','1');
			$query = $this->db2->GET();
/* 			$sql = $this->db2->last_query();
			return $sql; */
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
			
		function getObsStreanthWeakness(){
			$this->db2 = $this->load->database('database2', TRUE);
			$interval_time = "now() - interval 2 month";
			
			$query = $this->db2->query("select teacher_emisid,teacher_name,createdon,final_remarks,strength,improvement,school_id from school_observations_new where  createdon >=  ".$interval_time." ;");
			
		
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		
		
		public function staffs_check($school_id){
			$this->db->SELECT('school_key_id');
			$this->db->FROM('udise_staffreg');
			$this->db->WHERE('school_key_id',$school_id);
			$this->db->WHERE('status','1');
			$this->db->WHERE('archive','1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function students_check($school_id){
			$this->db->SELECT('school_id');
			$this->db->FROM('students_school_child_count');
			$this->db->WHERE('school_id',$school_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getschools($school_ids){
			$this->db->SELECT('school_id,school_name');
			$this->db->FROM('students_school_child_count');
			$this->db->WHERE("school_id IN (".$school_ids.")",NULL, false);
			$query = $this->db->GET();

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		
}



