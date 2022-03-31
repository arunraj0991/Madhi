<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Custom_Model.php';

class Webapp_model extends Custom_Model { 

		public function __construct() 
		{
        	parent::__construct();
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
		
		public function getStateStudentGrades($month,$year){
			$this->db->SELECT('tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', '-1'); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistrictStudentGrades($districtId,$month,$year){
			$state = array(-1);
			$this->db->SELECT('tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockStudentGrades($districtId,$blockId,$month,$year){
			$this->db->SELECT('tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZoneStudentGrades($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function stateSectionsInfo($month,$year){
			$this->db->SELECT('lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', -1);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		public function getDistSectionsInfo($distId,$month,$year){
			$this->db->SELECT('lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $distId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getBlockSectionsInfo($distId,$blockId,$month,$year){
			$this->db->SELECT('lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getZoneSectionsInfo($distId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getStateTnqul($month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', -1);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistrictTnIndex($distId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $distId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockTnIndex($distId,$blockId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZoneTnIndex($distId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistPercentageVisitsTop5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName,no_of_teachers_observed AS value');
			$this->db->FROM('graph_districts');
			$this->db->order_by("no_of_teachers_observed", "desc");
			$this->db->limit(5);
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistPercentageVisitsBottom5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_districts');
			$this->db->order_by("no_of_teachers_observed", "asc");
			$this->db->limit(5);
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistPercentageVisits($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistTarget(){
			$this->db->SELECT('value');
			$this->db->FROM('graph_targets');
			$this->db->where('target_id', 1); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockTarget(){
			$this->db->SELECT('value');
			$this->db->FROM('graph_targets');
			$this->db->where('target_id', 2); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZoneTarget(){
			$this->db->SELECT('value');
			$this->db->FROM('graph_targets');
			$this->db->where('target_id', 3); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolTarget(){
			$this->db->SELECT('value');
			$this->db->FROM('graph_targets');
			$this->db->where('target_id', 4); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockPercentageVisitsTop5($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName,no_of_teachers_observed AS value');
			$this->db->FROM('graph_blocks');
			$this->db->order_by("no_of_teachers_observed", "desc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockPercentageVisitsBottom5($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_blocks');
			$this->db->order_by("no_of_teachers_observed", "asc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockPercentageVisits($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockPercentageVisitsTargets($districtId,$month,$year){
			$this->db->SELECT('targets');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonePercentageVisitsTop5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_zones');
			$this->db->order_by("no_of_teachers_observed", "desc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonePercentageVisitsBottom5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("no_of_teachers_observed", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonePercentageVisits($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);  
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonePercentageVisitsTargets($districtId,$blockId,$month,$year){
			$this->db->SELECT('no_of_zones as targets');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolPercentageVisitsTop5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->order_by("no_of_teachers_observed", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolPercentageVisitsBottom5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->order_by("no_of_teachers_observed", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolPercentageVisits($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, no_of_teachers_observed AS value');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolPercentageVisitsTargets($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('no_of_observers AS targets');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		
		public function getDistTeacherPercentageTop5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_districts');
			$this->db->order_by("unavailable_percentage", "desc");
			$this->db->limit(5);
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistTeacherPercentageBottom5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_districts');
			$this->db->order_by("unavailable_percentage", "asc");
			$this->db->limit(5);
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		

		public function getDistTeacherPercentage($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_name as DistName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockTeacherPercentageTop5($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_blocks');
			$this->db->order_by("unavailable_percentage", "desc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockTeacherPercentageBottom5($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_blocks');
			$this->db->order_by("unavailable_percentage", "asc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		

		public function getBlockTeacherPercentage($districtId,$month,$year){
			$this->db->SELECT('block_name as BlockName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZoneTeacherPercentageTop5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_zones');
			$this->db->order_by("unavailable_percentage", "desc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}	
		
		public function getZoneTeacherPercentageBottom5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_zones');
			$this->db->order_by("unavailable_percentage", "asc");
			$this->db->limit(5);
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}	

		public function getZoneTeacherPercentage($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_name as ZoneName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolTeacherPercentageTop5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("unavailable_percentage", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getSchoolTeacherPercentageBottom5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("unavailable_percentage", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		

		public function getSchoolTeacherPercentage($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_name as SchoolName, available_percentage as available, unavailable_percentage as unavailable, teachers_alloted_percentage as teachersAvailable,teachers_vacancy_percentage as teachersUnavailable,frequency');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getStateTnqulIndex($month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', -1);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqul($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->where_not_in('district_id', $state);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		public function getAllDistWithTnqulTop5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 61 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulTop3($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 75 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulUpper3($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 50 AND 74");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulMiddle3($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 25 AND 49");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulBottom3($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN '0' AND 24");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc"); 
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulBottom5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 1 AND 30");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllDistWithTnqulMiddle5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where("tn_qul_index BETWEEN 31 AND 60");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->order_by("tn_qul_index", "desc");			
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistTnQulIndex($districtId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $districtId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistTnQulIndexDistBlock($districtId,$blockId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistTnQulIndexDistBlockZone($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('tn_qul_index');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllBlockWithTnqul($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllBlockWithTnqulTop3($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 75 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
		
		public function getAllBlockWithTnqulUpper3($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 50 AND 74");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
		
		public function getAllBlockWithTnqulMiddle3($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 25 AND 49");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
		
		public function getAllBlockWithTnqulBottom3($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN '0' AND 24");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
		
		public function getAllBlockWithTnqulTop5($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 61 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} 
		
		public function getAllBlockWithTnqulBottom5($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 1 AND 30");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllBlockWithTnqulMiddle5($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId); 
			$this->db->where("tn_qul_index BETWEEN 31 AND 60");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqul($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulTop3($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 75 AND 100");
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulUpper3($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 50 AND 74");
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulMiddle3($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 25 AND 49");
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		public function getAllZonesWithTnqulBottom3($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN '0' AND 24");
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulTop5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 61 AND 100");
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulBottom5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 1 AND 30");
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllZonesWithTnqulMiddle5($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where("tn_qul_index BETWEEN 31 AND 60");
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqul($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulTop3($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 75 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulUpper3($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 50 AND 74");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulMiddle3($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 25 AND 49");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulBottom3($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN '0' AND 24");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(3);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		 
		public function getAllSchoolsWithTnqulTop5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 61 AND 100");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulMiddle5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 31 AND 60");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "desc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllSchoolsWithTnqulBottom5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tn_qul_index,lesson_plan,lesson_execution,stu_interaction,class_management,stu_learning,pro_dev,diksha,learning_outcome');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId); 
			$this->db->where('zone_id', $zoneId); 
			$this->db->where("tn_qul_index BETWEEN 1 AND 30");
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$this->db->order_by("tn_qul_index", "asc");
			$this->db->limit(5);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		//GetSubjectById
		
		public function getStateGradeData($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id,district_name,tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_districts');
			$this->db->where_not_in('district_id', $state);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistGradeData($districtId,$month,$year){
			$this->db->SELECT('block_id,block_name,tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockGradeData($districtId,$blockId,$month,$year){
			$this->db->SELECT('zone_id,zone_name,tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZoneGradeData($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('school_id,school_name,tamil,english,evs,science,social,maths');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		public function getBlocksinDist($dist_id){
			$this->db->SELECT('schoolnew_block.id,schoolnew_block.block_name');
			$this->db->FROM('schoolnew_block');
			$this->db->JOIN('schoolnew_district','schoolnew_block.district_id=schoolnew_district.id');
			$this->db->WHERE('schoolnew_block.district_id',$dist_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getZonesinDist($dist_id,$block_id){
			$this->db->SELECT('hss_school_id');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getSchoolsinDist($dist_id,$block_id,$zone_id){
			$this->db->SELECT('school_id');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('hss_school_id',$zone_id);
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getSchoolsVisited($month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as schools_visited');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', '-1'); 
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getSchoolsVisitedByDist($districtId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as schools_visited');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getSchoolsVisitedByDistBlock($districtId,$blockId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as schools_visited');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getSchoolsVisitedByDistBlockZone($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as schools_visited');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getTeachersObserved($month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as teachers_observed');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', '-1');
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getTeachersObservedByDist($districtId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as teachers_observed');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $districtId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getTeachersObservedByDistBlock($districtId,$blockId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as teachers_observed');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getTeachersObservedByDistBlockZone($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('sum(no_of_teachers_observed) as teachers_observed');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $districtId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getStudentsAssessed($month,$year){
			$this->db->SELECT('sum(no_of_students_assessed) as students_assessed');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', '-1');
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getStudentsAssessedByDist($distId,$month,$year){
			$this->db->SELECT('sum(no_of_students_assessed) as students_assessed');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $distId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getStudentsAssessedByDistBlock($distId,$blockId,$month,$year){
			$this->db->SELECT('sum(no_of_students_assessed) as students_assessed');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getStudentsAssessedByDistBlockZone($distId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('sum(no_of_students_assessed) as students_assessed');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $distId);
			$this->db->where('block_id', $blockId);
			$this->db->where('zone_id', $zoneId);
			$this->db->where('MONTH(createdon)', $month);
			$this->db->where('YEAR(createdon)',$year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return 0;
			}
        }
		
		public function getObservers(){
			$this->db->SELECT('sum(no_of_observers) as no_of_observers');
			$this->db->FROM('graph_districts');
			$this->db->where('MONTH(createdon)', date('m')); //For current month
			$this->db->where('YEAR(createdon)', date('Y')); // For current year
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getBlocks(){
			$this->db->SELECT('count(distinct(block_code)) as blocks');
			$this->db->FROM('schoolnew_block');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getBrtes(){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getBrtesByDist($dist_id){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id', $dist_id);
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getBrtesByDistBlock($districtId,$blockId){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id', $districtId);
			$this->db->WHERE('block_id', $blockId);
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getBrtesByDistBlockZone($districtId,$blockId,$zoneId){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id', $districtId);
			$this->db->WHERE('block_id', $blockId);
			$this->db->WHERE('hss_school_id', $zoneId);
			$this->db->WHERE('isactive', '1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getSchoolCount(){
			$this->db->SELECT('count(distinct(school_id)) as school_count');
			$this->db->FROM('schoolnew_basicinfo');
			$this->db->WHERE('curr_stat','1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		function getStudentcountsByDistrict(){   // Not in Use
		   $this->db->SELECT('schoolnew_district.district_name,schoolnew_district.id,sum(total_b+total_g+total_t) as total')
		   ->FROM('students_school_child_count')
		   ->JOIN('schoolnew_basicinfo','students_school_child_count.school_id=schoolnew_basicinfo.school_id')
		   ->JOIN('schoolnew_district ','schoolnew_basicinfo.district_id=schoolnew_district.id')
		   ->WHERE('schoolnew_basicinfo.curr_stat',1)
		   ->group_by('schoolnew_district.district_name');
		   $query =  $this->db->get();
		   if($query->num_rows() > 0){
				return $query->result();
		   }else{
				return false;
		   }
		}
		
		function getStudentcounts(){
		   $this->db->SELECT('sum(total_b+total_g+total_t) as total')
		   ->FROM('students_school_child_count')
		   ->JOIN('schoolnew_basicinfo','students_school_child_count.school_id=schoolnew_basicinfo.school_id')
		   ->WHERE('schoolnew_basicinfo.curr_stat',1);
		   $query =  $this->db->get();
		   if($query->num_rows() > 0){
				return $query->row();
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
		
		public function getDistNameById($dist_id){
			$this->db->SELECT('district_name');
			$this->db->FROM('schoolnew_district');
			$this->db->like('id', $dist_id);
			$district = $this->db->GET()->result();
			return $district;
		}
	
		
		
		public function UserInfoByDist($user_name){
        	
			$this->db->SELECT('EMIS_USERLOGIN.emis_user_id,EMIS_USERLOGIN.emis_username,EMIS_USERLOGIN.emis_usertype,USER_CATEGORY.user_type,UDISE_OFFREG.district_id,UDISE_OFFREG.district_name,SCHOOLNEW_BLOCK.district_id as district_id_from_block,SCHOOLNEW_DISTRICT.district_name as district_name_from_block,EMIS_USERLOGIN.emis_user_id as block_id_from_dist, SCHOOLNEW_BLOCK.block_name as block_name_from_dist');
			$this->db->FROM(EMIS_USERLOGIN.' as EMIS_USERLOGIN');
			$this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_OFFREG.office_user = EMIS_USERLOGIN.emis_username','LEFT');
			$this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMIS_USERLOGIN.emis_usertype = USER_CATEGORY.id','LEFT');
			$this->db->JOIN(SCHOOLNEW_BLOCK.' as SCHOOLNEW_BLOCK','EMIS_USERLOGIN.emis_user_id = SCHOOLNEW_BLOCK.id','LEFT');
			$this->db->JOIN(SCHOOLNEW_DISTRICT.' as SCHOOLNEW_DISTRICT','SCHOOLNEW_BLOCK.district_id = SCHOOLNEW_DISTRICT.id','LEFT');
			$this->db->WHERE('EMIS_USERLOGIN.emis_username',$user_name);
			$this->db->WHERE('EMIS_USERLOGIN.STATUS','Active');
			$user_data = $this->db->GET()->row();
			
			if($user_data){
				return $user_data;
			}else{
				return false;
			}
        }
		
		public function UserInfoByBlock($user_name){
			$this->db->SELECT('EMISUSER_TEACHER.emis_user_id,EMISUSER_TEACHER.emis_username,EMISUSER_TEACHER.emis_usertype,USER_CATEGORY.user_type,UDISE_STAFFREG.udise_code,UDISE_STAFFREG.teacher_type,TEACHER_TYPE.type_teacher,UDISE_STAFFREG.teacher_name,UDISE_STAFFREG.teacher_type,UDISE_OFFREG.district_id,UDISE_OFFREG.district_name,SCHOOLNEW_BLOCK.id as block_id_from_dist,SCHOOLNEW_BLOCK.block_name as block_name_from_dist');
            $this->db->FROM(EMISUSER_TEACHER.' as EMISUSER_TEACHER');
            $this->db->JOIN(UDISE_STAFFREG.' as UDISE_STAFFREG',"UDISE_STAFFREG.u_id = EMISUSER_TEACHER.emis_user_id",'LEFT');
            $this->db->JOIN(UDISE_OFFREG.' as UDISE_OFFREG','UDISE_STAFFREG.school_key_id = UDISE_OFFREG.off_key_id','LEFT');
            $this->db->JOIN(USER_CATEGORY.' as USER_CATEGORY','EMISUSER_TEACHER.emis_usertype = USER_CATEGORY.id','LEFT');
            $this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
			$this->db->JOIN(SCHOOLNEW_BLOCK.' as SCHOOLNEW_BLOCK','UDISE_OFFREG.district_id = SCHOOLNEW_BLOCK.district_id','LEFT');
            $this->db->WHERE('EMISUSER_TEACHER.emis_username',$user_name);
            $this->db->WHERE('EMISUSER_TEACHER.STATUS','Active');
            $user_data = $this->db->GET()->row();
			
			if($user_data){
				return $user_data;
			}else{
				return false;
			}
        }
		
		public function getAllBlocksByDist($dist_id,$keyword){
			$this->db->SELECT('schoolnew_block.id, CONCAT(block_name, " (Block)") AS display_name,district_id,schoolnew_district.district_name, "Block" as type_name');
			$this->db->FROM('schoolnew_block');
			$this->db->JOIN('schoolnew_district','schoolnew_district.id = schoolnew_block.district_id');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->like('block_name', $keyword);
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllNodalsByDist($dist_id,$keyword){
			$this->db->SELECT('hss_school_id as id, CONCAT(hss_school_name, " (Zone)") AS display_name,district_id,district_name,block_id,block_name, "Zone" as type_name');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id', $dist_id);
			$this->db->WHERE('isactive', '1');
			$this->db->like('hss_school_name', $keyword);
			$this->db->group_by('hss_school_id');
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllNodalsByBlock($blockId,$keyword){
			$this->db->SELECT('hss_school_id as id, CONCAT(hss_school_name, " (Zone)") AS display_name,district_id,district_name,block_id,block_name, "Zone" as type_name');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('block_id', $blockId);
			$this->db->WHERE('isactive', '1');
			$this->db->like('hss_school_name', $keyword);
			$this->db->group_by('hss_school_id');
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllDistricts($keyword){
			$this->db->SELECT('id, CONCAT(district_name, " (District)") AS display_name, "District" as type_name');
			$this->db->FROM('schoolnew_district');
			$this->db->like('district_name', $keyword);
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllBlocks($keyword){
			$this->db->SELECT('schoolnew_block.id, CONCAT(block_name, " (Block)") AS display_name,district_id,schoolnew_district.district_name, "Block" as type_name');
			$this->db->FROM('schoolnew_block');
			$this->db->JOIN('schoolnew_district','schoolnew_district.id = schoolnew_block.district_id');
			$this->db->like('block_name', $keyword);
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllNodals($keyword){
			$this->db->SELECT('hss_school_id as id, CONCAT(hss_school_name, " (Zone)") AS display_name,district_id,district_name,block_id,block_name, "Zone" as type_name');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('isactive', '1');
			$this->db->like('hss_school_name', $keyword);
			$this->db->group_by('hss_school_id');
			$district = $this->db->GET()->result();
			return $district;
		}
		
		
		public function distTargetsList(){
			$this->db->SELECT('*');
			$this->db->FROM('dg_graph_target');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
}



