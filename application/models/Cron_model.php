<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Custom_Model.php';
class Cron_model extends Custom_Model {

		public function __construct() 
		{
        	parent::__construct(); 
        }

		public function getAllDist(){
			$this->db->SELECT('id,district_name');
			$this->db->FROM('schoolnew_district');
			$district = $this->db->GET()->result();
			return $district;
		}
		
		public function getAllBlocks(){
			$this->db->SELECT('id,block_name,district_id');
			$this->db->FROM('schoolnew_block');
			$blocks = $this->db->GET()->result();
			return $blocks;
		}
		
		public function getAllZones(){
			$this->db->SELECT('district_id,district_name,block_id,block_name,hss_school_id as zone_id,hss_school_name as zone_name');
			$this->db->FROM('brte_school_map');
			$this->db->where('isactive',1);
			$this->db->group_by('hss_school_id');
			$zones = $this->db->GET()->result();
			return $zones;
		}
		
		public function getZonesById($district_id,$block_id,$school_id){
			$this->db->SELECT('hss_school_id as zone_id,hss_school_name as zone_name');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('school_id',$school_id);
			$this->db->where('isactive',1);
			$this->db->group_by('hss_school_id');
			$zones = $this->db->GET()->result();
			return $zones;
		}
		
		public function getAllSchools(){
			$this->db->SELECT('distinct(school_id),school_name,district_id,block_id');
			$this->db->FROM('schoolnew_basicinfo');
			$this->db->WHERE('curr_stat',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getblocksByDist($district_id){
			$this->db->SELECT('count(id) as blocks');
			$this->db->FROM('schoolnew_block');
			$this->db->WHERE('district_id',$district_id); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getblocksCount(){
			$this->db->SELECT('count(id) as blocks');
			$this->db->FROM('schoolnew_block');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBrtesByDist($district_id){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id); 
			$this->db->where('isactive',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        } 
		
		public function getBrtesCount(){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->where('isactive',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        } 
		public function getBrtesByDistBlock($district_id,$block_id){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id); 
			$this->db->WHERE('block_id',$block_id); 
			$this->db->where('isactive',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        } 
		
		public function getBrtesByDistBlockZone($district_id,$block_id,$zone_id){
			$this->db->SELECT('count(distinct(brte_id)) as brtes');
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id); 
			$this->db->WHERE('block_id',$block_id); 
			$this->db->WHERE('hss_school_id',$zone_id); 
			$this->db->where('isactive',1);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        } 
		
		public function getSchoolsByDist($district_id){
			$this->db->SELECT('count(distinct(school_id)) as schools');
			$this->db->FROM('schoolnew_basicinfo');
			$this->db->WHERE('curr_stat','1');
			$this->db->WHERE('district_id',$district_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getSchoolsCount(){
			$this->db->SELECT('count(distinct(school_id)) as schools');
			$this->db->FROM('schoolnew_basicinfo');
			$this->db->WHERE('curr_stat','1');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getSchoolsByDistBlock($district_id,$block_id){
			$this->db->SELECT('count(distinct(school_id)) as schools');
			$this->db->FROM('schoolnew_basicinfo');
			$this->db->WHERE('curr_stat','1');
			$this->db->WHERE('district_id',$district_id);
			$this->db->WHERE('block_id',$block_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
	
	
		
		public function getblocksDist($district_id){
			$this->db->SELECT('district_name');
			$this->db->FROM('schoolnew_district');
			$this->db->WHERE('id',$district_id); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonesByDistBlock($district_id,$block_id){
			$this->db->SELECT('count(distinct(hss_school_id)) as zone_name'); 
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id); 
			$this->db->WHERE('block_id',$block_id); 
			$this->db->where('isactive',1);
			$query =  $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getSchoolsByDistBlockZone($district_id,$block_id,$zone_id){
			$this->db->SELECT('count(distinct(school_id)) as school_name'); 
			$this->db->FROM('brte_school_map');
			$this->db->WHERE('district_id',$district_id); 
			$this->db->WHERE('block_id',$block_id); 
			$this->db->WHERE('hss_school_id',$zone_id); 
			$this->db->where('isactive',1);
			$query =  $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getblocksName($block_id){
			$this->db->SELECT('block_name');
			$this->db->FROM('schoolnew_block');
			$this->db->WHERE('id',$block_id); 
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getAllPendingRows(){
			$this->db->SELECT('school_observation_id,json,createdon,createdby,school_id,district_id,block_id,class,section,medium,final_remarks,block_name,school_name,district_name,teacher_name,teacher_emisid,teachers_sanctioned,teachers_alloted,staff_attendance,class_type,tot_students,students_seen,observation_time,strength,improvement');
			$this->db->FROM('school_observations_new');
			$this->db->order_by("school_observation_id", "desc");
			$this->db->WHERE('process_status','0');

			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function setProcessingStatus($data,$schoolObsId){
			$this->db->where('school_observation_id', $schoolObsId); 
			$this->db->update('school_observations_new', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function setFinishedStatus($data,$schoolObsId){
			$this->db->where('school_observation_id', $schoolObsId); 
			$this->db->update('school_observations_new', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function setPendingStatus($data,$schoolObsId){
			$this->db->where('school_observation_id', $schoolObsId); 
			$this->db->update('school_observations_new', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function getAllDistTargets($dist_id){
			$this->db->SELECT('id,district_name,target_value');
			$this->db->FROM('dg_graph_target');
			$this->db->WHERE('id',$dist_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getScoreDetails($score_id){
			$this->db->SELECT('score_id,score_name,weightage');
			$this->db->FROM('scores_section');
			$this->db->WHERE('score_id',$score_id);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		public function getDistTeacherPercentageBottom5($month,$year){
			$state = array(-1);
			$this->db->SELECT('district_id');
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
		
		public function getBlockTeacherPercentageBottom5($districtId,$month,$year){
			$this->db->SELECT('district_id,block_id');
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
		
		public function getZoneTeacherPercentageBottom5($districtId,$blockId,$month,$year){
			$this->db->SELECT('district_id,block_id,zone_id');
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
		
		public function getSchoolTeacherPercentageBottom5($districtId,$blockId,$zoneId,$month,$year){
			$this->db->SELECT('district_id,block_id,zone_id,school_id');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $districtId); 
			$this->db->where('block_id', $blockId);  
			$this->db->where('school_id', $schoolId); 
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
		
		public function getOldDistFreqData($dist_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $dist_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getOldBlockFreqData($dist_id,$block_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getOldZoneFreqData($dist_id,$block_id,$zone_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('zone_id', $zone_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function getOldSchoolFreqData($dist_id,$block_id,$zone_id,$schoolId,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('zone_id', $zone_id);
			$this->db->where('school_id', $schoolId);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		public function updateFreqDistValue($data,$dist_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->update('graph_districts', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateFreqBlockValue($data,$dist_id,$block_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->update('graph_blocks', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateFreqZoneValue($data,$dist_id,$block_id,$zone_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->where('zone_id', $zone_id); 
			$this->db->update('graph_zones', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateFreqSchoolValue($data,$dist_id,$block_id,$zone_id,$school_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->where('zone_id', $zone_id); 
			$this->db->where('school_id', $school_id); 
			$this->db->update('graph_schools', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function getCurrentMonthData($month,$year){
			$this->db->SELECT('createdon');
			$this->db->FROM('graph_districts');
			$this->db->WHERE('district_id', -1);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getStateData($month,$year){
			$this->db->SELECT('district_id,district_name,no_of_blocks,user_type,createdon,no_of_observers,no_of_schools,no_of_teachers_observed,no_of_students_assessed,teachers_vacancy_percentage,teachers_alloted_percentage,total_teachers_percentage,deputation_from_this,deputation_from_others,teachers_long_leave,tamil,english,evs,science,social,maths,tn_qul_index,no_of_observation_percentage,lesson_plan,lesson_plan_info,lesson_execution,lesson_execution_info,stu_interaction,stu_interaction_info,class_management,class_mgmt_info,stu_learning,stu_learning_info,pro_dev,pro_dev_info,diksha,diksha_info,learning_outcome,wtd_avg');
			$this->db->FROM('graph_districts');
			$this->db->WHERE('district_id', -1);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getDistrictData($dist_id,$month,$year){
			$this->db->SELECT('district_id,district_name,no_of_blocks,user_type,createdon,no_of_observers,no_of_schools,no_of_teachers_observed,no_of_students_assessed,teachers_vacancy_percentage,teachers_alloted_percentage,total_teachers_percentage,deputation_from_this,deputation_from_others,teachers_long_leave,tamil,english,evs,science,social,maths,tn_qul_index,no_of_observation_percentage,lesson_plan,lesson_plan_info,lesson_execution,lesson_execution_info,stu_interaction,stu_interaction_info,class_management,class_mgmt_info,stu_learning,stu_learning_info,pro_dev,pro_dev_info,diksha,diksha_info,learning_outcome,wtd_avg');
			$this->db->FROM('graph_districts');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getBlockData($dist_id,$block_id,$month,$year){
			$this->db->SELECT('district_id,district_name,block_id,block_name,no_of_zones,user_type,createdon,no_of_observers,no_of_schools,no_of_teachers_observed,no_of_students_assessed,teachers_vacancy_percentage,teachers_alloted_percentage,total_teachers_percentage,deputation_from_this,deputation_from_others,teachers_long_leave,tamil,english,evs,science,social,maths,tn_qul_index,no_of_observation_percentage,lesson_plan,lesson_plan_info,lesson_execution,lesson_execution_info,stu_interaction,stu_interaction_info,class_management,class_mgmt_info,stu_learning,stu_learning_info,pro_dev,pro_dev_info,diksha,diksha_info,learning_outcome,wtd_avg');
			$this->db->FROM('graph_blocks');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			
			/* $sql = $this->db->last_query();
			return $sql; */
			
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function getZonesData($dist_id,$block_id,$zone_id,$month,$year){
			$this->db->SELECT('district_id,district_name,block_id,block_name,zone_id,zone_name,no_of_schools,user_type,createdon,no_of_observers,no_of_teachers_observed,no_of_students_assessed,teachers_vacancy_percentage,teachers_alloted_percentage,total_teachers_percentage,deputation_from_this,deputation_from_others,teachers_long_leave,tamil,english,evs,science,social,maths,tn_qul_index,no_of_observation_percentage,lesson_plan,lesson_plan_info,lesson_execution,lesson_execution_info,stu_interaction,stu_interaction_info,class_management,class_mgmt_info,stu_learning,stu_learning_info,pro_dev,pro_dev_info,diksha,diksha_info,learning_outcome,wtd_avg');
			$this->db->FROM('graph_zones');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('zone_id',$zone_id);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			
			/* $sql = $this->db->last_query();
			return $sql; */
			
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		 
		public function getSchoolData($dist_id,$block_id,$zone_id,$school_id,$month,$year){
			$this->db->SELECT('district_id,district_name,block_id,block_name,zone_id,zone_name,school_id,school_name,no_of_schools,user_type,createdon,no_of_observers,no_of_teachers_observed,no_of_students_assessed,teachers_vacancy_percentage,teachers_alloted_percentage,total_teachers_percentage,deputation_from_this,deputation_from_others,teachers_long_leave,tamil,english,evs,science,social,maths,tn_qul_index,no_of_observation_percentage,lesson_plan,lesson_plan_info,lesson_execution,lesson_execution_info,stu_interaction,stu_interaction_info,class_management,class_mgmt_info,stu_learning,stu_learning_info,pro_dev,pro_dev_info,diksha,diksha_info,learning_outcome,wtd_avg');
			$this->db->FROM('graph_schools');
			$this->db->WHERE('district_id',$dist_id);
			$this->db->WHERE('block_id',$block_id);
			$this->db->WHERE('zone_id',$zone_id);
			$this->db->WHERE('school_id',$school_id);
			$this->db->WHERE('MONTH(createdon)', $month); 
			$this->db->WHERE('YEAR(createdon)', $year);
			$query = $this->db->GET();
			
			/* $sql = $this->db->last_query();
			return $sql; */
			
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		
		public function getPrevFreqDistData($dist_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_districts');
			$this->db->where('district_id', $dist_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}	
		
		public function getPrevFreqBlockData($dist_id,$block_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_blocks');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}	
		
		public function getPrevFreqZoneData($dist_id,$block_id,$zone_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_zones');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('zone_id', $zone_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}	
		
		public function getPrevFreqSchool($dist_id,$block_id,$zone_id,$school_id,$month,$year){
			$this->db->SELECT('frequency');
			$this->db->FROM('graph_schools');
			$this->db->where('district_id', $dist_id);
			$this->db->where('block_id', $block_id);
			$this->db->where('zone_id', $zone_id);
			$this->db->where('school_id', $school_id);
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}
		
		
		public function updateDistData($data){
			$this->db->insert('graph_districts', $data);
			if($this->db->affected_rows()){
				return $idOfInsertedData = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		public function updateBlocksData($data){
			$this->db->insert('graph_blocks', $data);
			if($this->db->affected_rows()){
				return $idOfInsertedData = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		public function updateZonesData($data){
			$this->db->insert('graph_zones', $data);
			if($this->db->affected_rows()){
				return $idOfInsertedData = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		public function updateSchoolsData($data){
			$this->db->insert('graph_schools', $data);
			if($this->db->affected_rows()){
				return $idOfInsertedData = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		public function updateDistrict($data,$dist_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->update('graph_districts', $data);
			
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateBlock($data,$dist_id,$block_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->update('graph_blocks', $data);
			
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateZone($data,$dist_id,$block_id,$zone_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->where('zone_id', $zone_id); 
			$this->db->update('graph_zones', $data);
			
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateSchool($data,$dist_id,$block_id,$zone_id,$school_id,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', $dist_id); 
			$this->db->where('block_id', $block_id); 
			$this->db->where('zone_id', $zone_id); 
			$this->db->where('school_id', $school_id); 
			$this->db->update('graph_schools', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		public function updateState($data,$month,$year){
			$this->db->where('MONTH(createdon)', $month); 
			$this->db->where('YEAR(createdon)', $year);
			$this->db->where('district_id', -1); 
			$this->db->update('graph_districts', $data);
			if($this->db->affected_rows()){
				return $idOfUpdatedData = $this->db->affected_rows();
			}else{
				return false;
			}
		}
		
		
		public function getAllObservations(){
			$this->db->SELECT('school_observation_id');
			$this->db->FROM('school_observations_new');
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
        }
		
		
		public function getLessonPlanQuestionsIds($lessonPlanId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $lessonPlanId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getLessonExecutionQuestionsIds($lessonExecutionId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $lessonExecutionId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getstudentInteractionQuestionsIds($studentInteractionId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $studentInteractionId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getclassManagementQuestionsIds($classManagementId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $classManagementId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getstudentLearingQuestionsIds($studentLearingId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $studentLearingId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getTeacherProDevQuestionsIds($TeacherProDevId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $TeacherProDevId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
		public function getdikshaQuestionsIds($dikshaId){
			$this->db->SELECT('questions');
			$this->db->FROM('scores_section');
			$this->db->where('score_id', $dikshaId);
			$query = $this->db->GET();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
        }
		
}


?>
