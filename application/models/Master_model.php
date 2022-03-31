<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Custom_Model.php';
class Master_model extends Custom_Model {

		public function __construct() 
		{
        	parent::__construct();
        }

        public function getMasterData($param1)
        {
        		$master_data = $this->db->SELECT('*')->FROM(constant($param1))->GET()->result_array();
        		return $master_data;
        }

        public function getSchoolListByBlockId($blockid)
        {
        	$school_data = $this->db->SELECT('*')->FROM(STUDENTS_SCHOOL_CHILD_COUNT)->WHERE('block_id',$blockid)->GET()->result_array();
        	return $school_data;
        }

        public function getTeachersListBySchoolId($schoolid)
        {
        	
        	$this->db->SELECT('UDISE_STAFFREG.u_id,UDISE_STAFFREG.udise_code,UDISE_STAFFREG.teacher_code,UDISE_STAFFREG.teacher_type,TEACHER_TYPE.type_teacher,UDISE_STAFFREG.teacher_name,');
        	$this->db->FROM(UDISE_STAFFREG.' as UDISE_STAFFREG');
        	$this->db->JOIN(TEACHER_TYPE.' as TEACHER_TYPE','UDISE_STAFFREG.teacher_type = TEACHER_TYPE.id','LEFT');
        	$teachers_data = $this->db->WHERE('UDISE_STAFFREG.school_key_id',$schoolid)->GET()->result_array();
        	return $teachers_data;
        }

        public function getStudentsListBySchoolId($schoolid)
        {
        	$class_section_data = $this->db->SELECT('class_studying_id,class_section')->SELECT('count( if(gender = 1,TRUE,NULL)) as male,count( if(gender = 2,TRUE,NULL)) as female',FALSE)->FROM(STUDENTS_CHILD_DETAIL)->WHERE('school_id',$schoolid)->GROUP_BY('class_studying_id,class_section')->GET()->result_array();

        	if(count($class_section_data))
        	{
        		foreach ($class_section_data as $class_key => $class_value) 
        		{
        			$this->db->SELECT('id,name,name_tamil,name_id_card,name_tamil_id_card');
        			$this->db->FROM(STUDENTS_CHILD_DETAIL);
        			$this->db->WHERE('school_id',$schoolid);
        			$this->db->WHERE('class_studying_id',$class_value['class_studying_id']);
        			$this->db->WHERE('class_section',$class_value['class_section']);
        			$student_data = $this->db->GET()->result_array();
        			$class_section_data[$class_key]['student_data'] = $student_data;
        		}
        	}


        	return $class_section_data;
        }

        function getSchoolListByDistrictId($districtid)
        {
               $school_data = $this->db->SELECT('*')->FROM(STUDENTS_SCHOOL_CHILD_COUNT)->WHERE('district_id',$districtid)->GET()->result_array();
                return $school_data; 
        }

        function getAppVersionInfo()
        {
                    $this->db->SELECT('version_id, version, release_notes');
                    $this->db->FROM(SCHOOLD_APP_VERSION_INFO);
                    $this->db->ORDER_BY('version_id','desc');
                    $this->db->LIMIT(1,0);
                    $versions = $this->db->GET()->result_array();
                    return $versions;
        }
        


}