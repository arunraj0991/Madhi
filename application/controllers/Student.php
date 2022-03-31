<?php

error_reporting(0);
ini_set('display_erros',0);

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

class Student extends REST_Controller{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

    function __construct(){ // Construct the parent class
        parent::__construct();
        $this->load->model('Student_model');
	}

/* 	public function getTeachingMethodology_post(){
		
		$result_data['methodology'] = $this->Student_model->getTeachingMethodology();
		$result_data['methodology_questions'] = $this->Student_model->getTeachingQuestions();
		
		if(count($result_data)){
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }else{
             $data['dataStatus'] = false;
             $data['status'] = REST_Controller::HTTP_NOT_FOUND;
             $data['msg'] = 'Data Not Found!';
             $this->response($data,REST_Controller::HTTP_OK);
        }
	} */
	
	public function getTeachingMethodology_post(){
		
		$class_id = ($this->post('class_id') && $this->post('class_id') != '') ? $this->post('class_id') : null;
		$classtype = ($this->post('classtype') && $this->post('classtype') != '') ? $this->post('classtype') : null;
		
		if($class_id != null && $classtype != null){
			$result_data['methodology'] = $this->Student_model->getTeachingMethodology();
			$questions = $this->Student_model->getTeachingQuestions($class_id,$classtype);			
			
			if($questions){
				$array_data = array();
				$count = [];
				$ans_data = [];
					
				foreach($questions as $key => $val){
					$array_data[]=$val->ans;
				}
				for($i=0;$i<count($array_data);$i++){
					$count2[] = json_decode($array_data[$i]);
				}
				
				foreach($count2 as $key2 => $val2){
					$ans_data=$val2->ans;
					for($j=0;$j<count($ans_data);$j++){
						$child_qus = $ans_data[$j]->child_qus;
						if(count($child_qus)>0){
							for($k=0;$k<count($child_qus);$k++){
								$final_data[] = $child_qus[$k];
							}																			
						}
					}
				}
				
				if($final_data){
					$array = array_unique($final_data);
					$child_id = implode(",",$array);
					$child_questions = $this->Student_model->getChildQuestions($child_id);
					$result_data['methodology_questions'] = array_merge($questions,$child_questions);
				}else{
					$result_data['methodology_questions'] = $questions;
				}
				
				
				if($ans_data){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] =$result_data;
					$this->response($data,REST_Controller::HTTP_OK);
				}else{
					 $data['dataStatus'] = false;
					 $data['status'] = REST_Controller::HTTP_NOT_FOUND;
					 $data['msg'] = 'Data Not Found!';
					 $this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Questions Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
	}
	
	public function getChapterSection_post(){

		$class = ($this->post('class_id') && $this->post('class_id') != '') ? $this->post('class_id') : null;
		$term = ($this->post('term_id') && $this->post('term_id') != '') ? $this->post('term_id') : null;
		$medium = ($this->post('medium_id') && $this->post('medium_id') != '') ? $this->post('medium_id') : null;
		$subject = ($this->post('subject_id') && $this->post('subject_id') != '') ? $this->post('subject_id') : null;
		
		if($class != null && $term != null && $medium != null && $subject != null ){
			$medium_id = implode(",", $medium);
			$result_data['chapters'] = $this->Student_model->getChaptersList($class,$term,$medium_id,$subject);		
			if(count($result_data)){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $result_data;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Data Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
	}
	
	public function getAssesmentReasons_get(){
		$result_data['student_reasons'] = $this->Student_model->getAssesmentReasons();		
		if($result_data['student_reasons']){
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }else{
             $data['dataStatus'] = false;
             $data['status'] = REST_Controller::HTTP_NOT_FOUND;
             $data['msg'] = 'Assesment Reasons Not Found!';
             $this->response($data,REST_Controller::HTTP_OK);
        }
	}
	
	public function getMismatchReasons_get(){
		$result_data['mismatch_reasons'] = $this->Student_model->getMismatchReasons();
		if($result_data['mismatch_reasons']){
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result_data;
                $this->response($data,REST_Controller::HTTP_OK);
        }else{
             $data['dataStatus'] = false;
             $data['status'] = REST_Controller::HTTP_NOT_FOUND;
             $data['msg'] = 'Attendance Mismatch Not Found!';
             $this->response($data,REST_Controller::HTTP_OK);
        }
	}
	
	public function getTermList_get(){
		$result['term'] = $this->Student_model->getTerm();
		if($result['term']){
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $result;
                $this->response($data,REST_Controller::HTTP_OK);
        }else{
             $data['dataStatus'] = false;
             $data['status'] = REST_Controller::HTTP_NOT_FOUND;
             $data['msg'] = 'Term Not Found!';
             $this->response($data,REST_Controller::HTTP_OK);
        }
	}
	
	public function getSchoolMapping_post(){
		$emis_username = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
		if($emis_username != null){
			$get_userinfo = $this->Student_model->UserDetais($emis_username);
			if($get_userinfo){
				date_default_timezone_set('Asia/Calcutta');
				$date=date('d-M-Y');
				$date_month=date('dm');
				$dashboard_data['school_info'] = $this->Student_model->getSchoolMapping($get_userinfo);
				$dashboard_data['current_date'] = $date;
				$dashboard_data['today_quotes'] = $this->Student_model->getQuotes($date_month);
				$dashboard_data['targets'] = $this->Student_model->getTargetsData($get_userinfo);
				$dashboard_data['school_reasons'] = $this->Student_model->getSchoolResons();
				$dashboard_data['user_info'] = $get_userinfo;
				if(count($dashboard_data)){
						$data['dataStatus'] = true;
						$data['status'] = REST_Controller::HTTP_OK;
						$data['records'] = $dashboard_data;
						$this->response($data,REST_Controller::HTTP_OK);
				}else{
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_NOT_FOUND;
					$data['msg'] = 'Dashboard Data Not Found!';
					$this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Invalid Username!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or Username!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	public function getSchoolDetails_get(){
		$school_id = $this->uri->segment(2);
		if($school_id != '' && $school_id != null){
			$school_info = $this->Student_model->getAllbrachesbyschool($school_id);		
			$districts = $this->Student_model->getAllDist();		
			if($school_info){
				$schoolDetails['nodal_name'] = $school_info[0]->hss_school_name;
				$schoolDetails['nodal_id'] = $school_info[0]->hss_school_id;				
				$schoolDetails['dist_id'] = $school_info[0]->district_id;				
				$schoolDetails['edu_dist_id'] = $school_info[0]->edu_dist_id;				
				$schoolDetails['block_id'] = $school_info[0]->block_id;				
				$schoolDetails['block_name'] = $school_info[0]->block_name;				
				$schoolDetails['edu_dist_name'] = $school_info[0]->edu_dist_name;				
				$schoolDetails['district_name'] = $school_info[0]->district_name;				
				$schoolDetails['total'] = $school_info[0]->total;				
				$schoolDetails['catty_id'] = $school_info[0]->catty_id;				
				$schoolDetails['cate_type'] = $school_info[0]->cate_type;				
				$schoolDetails['teach_tot'] = $school_info[0]->teach_tot;
				$schoolDetails['nonteach_tot'] = $school_info[0]->nonteach_tot;				
				$schoolDetails['totstaff'] = $school_info[0]->totstaff;
				$schoolDetails['total_students'] = $school_info[0]->total_students;
				$schoolDetails['school_name'] = $school_info[0]->school_name;		
				$schoolDetails['school_id'] = $school_info[0]->school_id;
				$schoolDetails['udise_code'] = $school_info[0]->udise_code;
				
				
				$classDetails = [];				
				$preKgDetails['class'] = 'prkg'; 
				$preKgDetails['boys'] =$school_info[0]->Prkg_b;
				$preKgDetails['girls'] = $school_info[0]->Prkg_g;
				$preKgDetails['trans'] = $school_info[0]->Prkg_t;
				$preKgDetails['total'] = $school_info[0]->Prkg_b + $school_info[0]->Prkg_g + $school_info[0]->Prkg_t;				
				
				$lKgDetails['class'] = 'lkg'; 
				$lKgDetails['boys'] = $school_info[0]->lkg_b;
				$lKgDetails['girls'] = $school_info[0]->lkg_g;
				$lKgDetails['trans'] = $school_info[0]->lkg_t;
				$lKgDetails['total'] = $school_info[0]->lkg_b + $school_info[0]->lkg_g + $school_info[0]->lkg_t;				
				
				$uKgDetails['class'] = 'ukg';
				$uKgDetails['boys'] = $school_info[0]->ukg_b;
				$uKgDetails['girls'] = $school_info[0]->ukg_g;
				$uKgDetails['trans'] = $school_info[0]->ukg_t;
				$uKgDetails['total'] = $school_info[0]->ukg_t + $school_info[0]->ukg_g + $school_info[0]->ukg_b;
				array_push($classDetails,$uKgDetails,$lKgDetails,$preKgDetails);
				
				for($i=1;$i<=12;$i++){
					$classData['class'] = $i;
					$classData['boys'] = $school_info[0]->{'c'.$i.'_b'};
					$classData['girls'] = $school_info[0]->{'c'.$i.'_g'};
					$classData['trans'] = $school_info[0]->{'c'.$i.'_t'};
					$classData['total'] = $school_info[0]->{'class_'.$i.'_Total'};
					array_push($classDetails,$classData);
				}	

				$schoolDetails['class_info'] = $classDetails;
				$schoolDetails['districts'] = $districts;				
				$data['dataStatus'] = true;
				$data['status'] = REST_Controller::HTTP_OK;
				$data['records'] = $schoolDetails;
				$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'School Id Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or School ID';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	/* public function getTeacherDetails_get(){
		$school_id = $this->uri->segment(2);
		if($school_id != '' && $school_id != null){
			$teacher_info['teachers'] = $this->Student_model->getTeacherDetails($school_id);
			$teacher_info['teacher_reasons'] = $this->Student_model->getTeacherResons();
			if(count($teacher_info)){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $teacher_info;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Teacher Data Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or School ID';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    } */
	
	public function getTeacherDetails_get(){
		$school_id = $this->uri->segment(2);
		if($school_id != '' && $school_id != null){
			
			$observed_teachers = $this->Student_model->getObservedTeacherDetails($school_id); // Recently Observed Teachers
			$teachers_info = $this->Student_model->getTeacherDetails($school_id); // All Teachers Info of The School
			$teacher_info['reasons'] = $this->Student_model->getTeacherResons();
			
			if($observed_teachers){
				foreach($observed_teachers as $val){
					$teacher_emisid[] = $val->teacher_emisid;
				}
				$teacher_id = implode(",", $teacher_emisid);
				$other_teachers = $this->Student_model->getOtherTeachers($school_id,$teacher_id); //Recently Not Observed Teachers
				if($other_teachers){
					$random_id = $other_teachers[array_rand($other_teachers)];							// Random ID From Recently Not Observed Teachers
					$teacher_obsinfo = $this->Student_model->getTeacherObsInfo($random_id->teacher_id);  //Last Observed Data of the Teacher
					if($teacher_obsinfo === false){
						//$teacher_data = $teachers_info[array_rand($teachers_info)];
						$teacher_info['teacher']['teacher_emisid'] = $random_id->teacher_id;
						$teacher_info['teacher']['teacher_name'] = $random_id->teacher_name;
						$teacher_info['teacher']['final_remarks'] = 'null';
						$teacher_info['teacher']['strength'] = 'null';
						$teacher_info['teacher']['createdon'] = 'null';
						$teacher_info['teacher']['improvement'] = 'null';
					}else{
						$teacher_info['teacher'] =$teacher_obsinfo;
					}
				}else{
					$teacher_data = $teachers_info[array_rand($teachers_info)];  							// Random ID From School Teachers
					$teacherobsinfo = $this->Student_model->getTeacherObsInfo($teacher_data->teacher_id);	 //Last Observed Data of the Teacher
					if($teacherobsinfo === false){
						//$teacher_data = $teachers_info[array_rand($teachers_info)];
						$teacher_info['teacher']['teacher_emisid'] = $teacher_data->teacher_id;
						$teacher_info['teacher']['teacher_name'] = $teacher_data->teacher_name;
						$teacher_info['teacher']['final_remarks'] = 'null';
						$teacher_info['teacher']['strength'] = 'null';
						$teacher_info['teacher']['createdon'] = 'null';
						$teacher_info['teacher']['improvement'] = 'null';
					}else{
						$teacher_info['teacher'] = $teacherobsinfo;
					}
				}
			}else{
				$teacher_data = $teachers_info[array_rand($teachers_info)];									//Recently Not Observed Teachers For Long Time
				$teacher_obsinfms = $this->Student_model->getTeacherObsInfo($teacher_data->teacher_id);		 //Last Observed Data of the Teacher
				if($teacher_obsinfms === false){
					//$teacher_data = $teachers_info[array_rand($teachers_info)];
					$teacher_info['teacher']['teacher_emisid'] = $teacher_data->teacher_id;
					$teacher_info['teacher']['teacher_name'] = $teacher_data->teacher_name;
					$teacher_info['teacher']['final_remarks'] = 'null';
					$teacher_info['teacher']['strength'] = 'null';
					$teacher_info['teacher']['createdon'] = 'null';
					$teacher_info['teacher']['improvement'] = 'null';
				}else{
					$teacher_info['teacher'] = $teacher_obsinfms;
				}
			}
			
			/* $teacher_info['reasons']['0']['reason_id'] = '2';
			$teacher_info['reasons']['0']['reason'] = 'Teacher is obsent';
			$teacher_info['reasons']['1']['reason_id'] = '6';
			$teacher_info['reasons']['1']['reason'] = 'Free Period';
			$teacher_info['teachers']['teacher_emisid'] = '20085942';
			$teacher_info['teachers']['teacher_name'] = 'Sangeetha';
			$teacher_info['teachers']['createdon'] = '2020-01-29 10:05:26';
			$teacher_info['teachers']['final_remarks'] = 'Good';
			$teacher_info['teachers']['strength'] = 'You are clearly aware about the learning outcomes. Good job!,You have updated the Achievement Chart. Well done!,You are using the template for the achivement chart. Well done!,You maintain a lesson plan for the topic. Well done!,You give clear instructions to students for all activities. Well done!,You appreciate children to encourage participation. Well done!,You explore TNTP for resources. Good job! Look for more teacher courses on TNTP.,No action item mapped,You practice reading with students using word wall. Good job!';
			$teacher_info['teachers']['improvement'] = 'Please try to use the template provided for lesson plans,Focus on engaging students in classroom activities,Make an effort to explore resources from DIKSHA platform,You check notebooks regularly. Keep it up!'; */
			
			$data['dataStatus'] = true;
			$data['status'] = REST_Controller::HTTP_OK;
			$data['records'] = $teacher_info;
			$this->response($data,REST_Controller::HTTP_OK);	
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or School ID';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	public function getStudentDetails_post(){
		$school_id = ($this->post('school_id') && $this->post('school_id') != '') ? $this->post('school_id') : null;
		$class_id = ($this->post('class_id') && $this->post('class_id') != '') ? $this->post('class_id') : null;
		$section = ($this->post('section') && $this->post('section') != '') ? $this->post('section') : null;
		if($school_id != null && $class_id != null){
			$student_data['all'] = $this->Student_model->getallstudentsbyid($school_id,$class_id,$section);
			$student_data['absent_data'] = $this->Student_model->getAttendanceData($school_id,$class_id,$section);
			$absent_list = [];
			foreach($student_data['absent_data'] as $key){
				if($key['absent_students'] != ""){
					array_push($absent_list, $key['absent_students']);
				}
			}
			$lists_of_absents = implode(",", $absent_list);
			
			$student_data['absent_info'] = $this->Student_model->getAbsentData($school_id,$class_id,$section,$lists_of_absents);
			if(count($student_data)){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $student_data;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Students Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	public function getSchoolClassInfo_get(){
		$school_id = $this->uri->segment(2);
		if($school_id != '' && $school_id != null){
			$medium_id = [16,19,17,18,5]; //
			$classInfo['medium_info'] = $this->Student_model->get_mediumInfo($medium_id);
			$classInfo['class_info'] = $this->Student_model->getSchoolClassInfo($school_id);
			$classInfo['subjects'] = $this->Student_model->getSubjectsdata();

			if(count($classInfo)){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $classInfo;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Data Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or School ID';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	public function getSubjects_post(){
		$class = ($this->post('class_id') && $this->post('class_id') != '') ? $this->post('class_id') : null;
		$medium = ($this->post('medium_id') && $this->post('medium_id') != '') ? $this->post('medium_id') : null;
		if($class != null && $medium != null){
			$medium_id = implode(",",$medium);
			$subject_data['subjects'] = $this->Student_model->getSubjects($class,$medium_id);
			if($subject_data){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $subject_data;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Students Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	/*  public function getQuestions_post(){	
		$chapter = ($this->post('chapter_id') && $this->post('chapter_id') != '') ? $this->post('chapter_id') : null;
		if($chapter != null){
			$learning_outcome = $this->Student_model->getLearningOutcome($chapter);
			$learning_outcome_id = $learning_outcome[0]->lo_id;
			if($learning_outcome_id){
				$questions_data = $this->Student_model->getQuestions($learning_outcome_id);
				$questions['options'][0]['id'] = 1;
				$questions['options'][0]['option'] = $learning_outcome[0]->option_1;
				$questions['options'][1]['id'] = 2;
				$questions['options'][1]['option'] = $learning_outcome[0]->option_2;
				$questions['options'][2]['id'] = 3;
				$questions['options'][2]['option'] = $learning_outcome[0]->option_3;
				$questions['options'][3]['id'] = 4;
				$questions['options'][3]['option'] = $learning_outcome[0]->option_4;
				$questions['questions'] = $questions_data;
				$questions['learning_outcome'] = $learning_outcome[0]->lo_name;
				$questions['learning_outcome_id'] = $learning_outcome_id;
				if(count($questions)){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $questions;
					$this->response($data,REST_Controller::HTTP_OK);
				}   
				else{
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_NOT_FOUND;
					$data['msg'] = 'Questions Not Found!';
					$this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Learning Outcome Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
			
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request Or Chapter ID!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }  */
	
	public function getQuestions_post(){
		$chapter = ($this->post('chapter_id') && $this->post('chapter_id') != '') ? $this->post('chapter_id') : null;
		if($chapter != null){
			$learning_outcome = $this->Student_model->getLearningOutcome($chapter);
			$learning_outcome_id = $learning_outcome->lo_id;
			if($learning_outcome_id){
				$questions_data = $this->Student_model->getQuestions($learning_outcome_id);
				if($questions_data){
					$questions['options'][0]['id'] = 1;
					$questions['options'][0]['option'] = $learning_outcome->option_1;
					$questions['options'][0]['grade'] = $learning_outcome->grade_option_1;
					$questions['options'][1]['id'] = 2;
					$questions['options'][1]['option'] = $learning_outcome->option_2;
					$questions['options'][1]['grade'] = $learning_outcome->grade_option_2;
					$questions['options'][2]['id'] = 3;
					$questions['options'][2]['option'] = $learning_outcome->option_3;
					$questions['options'][2]['grade'] = $learning_outcome->grade_option_3;
					$questions['options'][3]['id'] = 4;
					$questions['options'][3]['option'] = $learning_outcome->option_4;
					$questions['options'][3]['grade'] = $learning_outcome->grade_option_4;
					$questions['questions'] = $questions_data;
					$questions['learning_outcome'] = $learning_outcome->lo_name;
					$questions['learning_outcome_id'] = $learning_outcome_id;
					$questions['chapter_no'] = $learning_outcome->chapter_no;
					
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['msg1'] = $learning_outcome_id;
					$data['msg'] = $questions;
					$this->response($data,REST_Controller::HTTP_OK);
				}else{
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_NOT_FOUND;
					$data['msg'] = 'There Is No Questions Available. Please Choose Any Other Chapter';
					$this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Learning Outcome Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
  
	public function getObservationInfo_post(){
		
		$dist_id = ($this->post('district_id') && $this->post('district_id') != '') ? $this->post('district_id') : null;
		$edu_dist_id = ($this->post('edu_dist_id') && $this->post('edu_dist_id') != '') ? $this->post('edu_dist_id') : null;
		$block_id = ($this->post('block_id') && $this->post('block_id') != '') ? $this->post('block_id') : null;

		if($dist_id != null || $edu_dist_id != null || $block_id != null){
			$observation_data = $this->Student_model->getObsInfo($dist_id,$edu_dist_id,$block_id);
			if(count($observation_data)){
                $data['dataStatus'] = true;
                $data['status'] = REST_Controller::HTTP_OK;
                $data['records'] = $observation_data;
                $this->response($data,REST_Controller::HTTP_OK);
			}else{
				 $data['dataStatus'] = false;
				 $data['status'] = REST_Controller::HTTP_NOT_FOUND;
				 $data['msg'] = 'Data Not Found!';
				 $this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
		

    }
	
	
	public function saveObservationJson_post(){
		
		$json_data = $this->post('json');
		$value[] = json_decode($json_data,true);
 		if ($value){
			foreach($value as $key){
				if($key['observation_report']){
					if($key['observation_report']['strength'] && $key['observation_report']['improvement']){
						$strength_data = $key['observation_report']['strength'];
						foreach($strength_data as $val){
							$strength_array[] = $val['action_item_description'];
						}
						
						$improvement_data = $key['observation_report']['improvement'];
						foreach($improvement_data as $val){
							$improvement_array[] = $val['action_item_description'];
						}
						
						$strength = implode("|", $strength_array);
						$improvement = implode("|", $improvement_array);
					}else{
						$strength = '';
						$improvement = '';
					}
				}else{
					$strength = '';
					$improvement = '';
				}
				$str = array("json"=>json_encode($value),"createdby"=>$key['basic_info']['created_by'],"school_id"=>$key['basic_info']['school_id'],"district_id"=>$key['basic_info']['district_id'],"block_id"=>$key['basic_info']['block_id'],"zone_id"=>$key['basic_info']['nodal_id'],"zone_name"=>$key['basic_info']['nodal_name'],"class"=>$key['basic_info']['class'],"section"=>$key['basic_info']['section'],"final_remarks"=>$key['final_remarks'],"block_name"=>$key['basic_info']['block_name'],"school_name"=>$key['basic_info']['school_name'],"district_name"=>$key['basic_info']['district_name'],"teacher_name"=>$key['basic_info']['teacher_name'],"teacher_emisid"=>$key['basic_info']['teacher_emisid'],"class_type"=>$key['basic_info']['class_type'],"strength"=>$strength,"improvement"=>$improvement,"process_status"=>'0');
			}
			if($str){
				$inserted_id = $this->Student_model->getObsInformation($str);
				if($str){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $inserted_id;
					$this->response($data,REST_Controller::HTTP_OK);
				}else{
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_NOT_FOUND;
					$data['msg'] = 'Id Not Found!';
					$this->response($data,REST_Controller::HTTP_OK);
				}
			}
			
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = "Invalid Request";
			$this->response($data,REST_Controller::HTTP_OK);
		} 
    }
	
	
	
	public function getAllData_post(){
		$result_data['student_reasons'] = $this->Student_model->getAssesmentReasons();
		$result_data['mismatch_reasons'] = $this->Student_model->getMismatchReasons();
		$result_data['methodology'] = $this->Student_model->getTeachingMethodology();
		$result_data['reasons'] = $this->Student_model->getTeacherResons();
		$result_data['term'] = $this->Student_model->getTerm();
		$result_data['subjects'] = $this->Student_model->getSubjectsdata();
		
		$emis_username = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
		if($emis_username != null){
			$get_userinfo = $this->Student_model->UserDetais($emis_username);
			if($get_userinfo){
				date_default_timezone_set('Asia/Calcutta');
				$date=date('d-M-Y');
				$date_month=date('dm');
				$result_data['current_date'] = $date;
				$result_data['today_quotes'] = $this->Student_model->getQuotes($date_month);
				$result_data['targets'] = $this->Student_model->getTargetsData($get_userinfo);
				$result_data['school_reasons'] = $this->Student_model->getSchoolResons();
				$result_data['user_info'] = $get_userinfo;
				//$result_data['school_info'] = $this->Student_model->getSchoolMapping($get_userinfo); lack of data resolved
				
				//start

				$school_info = $this->Student_model->getSchoolMapping($get_userinfo);
				$result_data['schools'] = $school_info;
				
				$list = $school_info['All'];
				
				foreach($list as $val){
					$school_id[] = $val->school_id; 
				}
				
				for($i=0;$i<count($school_id);$i++){
					$value = $list[$i]->school_id;
					$staff_check = $this->Student_model->staffs_check($value);
					if($staff_check != false){
						$student_check = $this->Student_model->students_check($value);
						if($student_check != false){
							$available_schools[] = $value;
						}else{
							$available_schools = false;
						}
					}else{
						$available_schools = false;
					}
				}
				if($available_schools != false){
					$id_list = implode(",", $available_schools);
					$result_data['schools']['All'] = $this->Student_model->getschools($id_list);
				}else{
					$result_data['schools']['All'] = false;
				}
				
				//end
				
				if(count($result_data)){
						$data['dataStatus'] = true;
						$data['status'] = REST_Controller::HTTP_OK;
						$data['records'] = $result_data;
						$this->response($data,REST_Controller::HTTP_OK);
				}else{
					$data['dataStatus'] = false;
					$data['status'] = REST_Controller::HTTP_NOT_FOUND;
					$data['msg'] = 'Dashboard Data Not Found!';
					$this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'Invalid Username!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or Username!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
		
	}
	
	public function getSchoolData_get(){
		$school_id = $this->uri->segment(2);
		if($school_id != '' && $school_id != null){
			$school_info = $this->Student_model->getAllbrachesbyschool($school_id);		
			$districts = $this->Student_model->getAllDist();		
			if($school_info){
				$schoolDetails['nodal_name'] = $school_info[0]->hss_school_name;
				$schoolDetails['nodal_id'] = $school_info[0]->hss_school_id;				
				$schoolDetails['dist_id'] = $school_info[0]->district_id;				
				$schoolDetails['edu_dist_id'] = $school_info[0]->edu_dist_id;				
				$schoolDetails['block_id'] = $school_info[0]->block_id;				
				$schoolDetails['block_name'] = $school_info[0]->block_name;				
				$schoolDetails['edu_dist_name'] = $school_info[0]->edu_dist_name;				
				$schoolDetails['district_name'] = $school_info[0]->district_name;				
				$schoolDetails['total'] = $school_info[0]->total;				
				$schoolDetails['catty_id'] = $school_info[0]->catty_id;				
				$schoolDetails['cate_type'] = $school_info[0]->cate_type;				
				$schoolDetails['teach_tot'] = $school_info[0]->teach_tot;
				$schoolDetails['nonteach_tot'] = $school_info[0]->nonteach_tot;				
				$schoolDetails['totstaff'] = $school_info[0]->totstaff;
				$schoolDetails['total_students'] = $school_info[0]->total_students;
				$schoolDetails['school_name'] = $school_info[0]->school_name;		
				$schoolDetails['school_id'] = $school_info[0]->school_id;
				$schoolDetails['udise_code'] = $school_info[0]->udise_code;
				
				
				$classDetails = [];				
				$preKgDetails['class'] = 'prkg'; 
				$preKgDetails['boys'] =$school_info[0]->Prkg_b;
				$preKgDetails['girls'] = $school_info[0]->Prkg_g;
				$preKgDetails['trans'] = $school_info[0]->Prkg_t;
				$preKgDetails['total'] = $school_info[0]->Prkg_b + $school_info[0]->Prkg_g + $school_info[0]->Prkg_t;				
				
				$lKgDetails['class'] = 'lkg'; 
				$lKgDetails['boys'] = $school_info[0]->lkg_b;
				$lKgDetails['girls'] = $school_info[0]->lkg_g;
				$lKgDetails['trans'] = $school_info[0]->lkg_t;
				$lKgDetails['total'] = $school_info[0]->lkg_b + $school_info[0]->lkg_g + $school_info[0]->lkg_t;				
				
				$uKgDetails['class'] = 'ukg';
				$uKgDetails['boys'] = $school_info[0]->ukg_b;
				$uKgDetails['girls'] = $school_info[0]->ukg_g;
				$uKgDetails['trans'] = $school_info[0]->ukg_t;
				$uKgDetails['total'] = $school_info[0]->ukg_t + $school_info[0]->ukg_g + $school_info[0]->ukg_b;
				array_push($classDetails,$uKgDetails,$lKgDetails,$preKgDetails);
				
				for($i=1;$i<=12;$i++){
					$classData['class'] = $i;
					$classData['boys'] = $school_info[0]->{'c'.$i.'_b'};
					$classData['girls'] = $school_info[0]->{'c'.$i.'_g'};
					$classData['trans'] = $school_info[0]->{'c'.$i.'_t'};
					$classData['total'] = $school_info[0]->{'class_'.$i.'_Total'};
					array_push($classDetails,$classData);
				}	
	
	$schoolDetails['class_info'] = $classDetails;
	$schoolDetails['school_class_info'] = $this->Student_model->getSchoolClassInfo($school_id);
	$schoolDetails['districts'] = $districts;		
				
				
				$medium_id = [16,19,17,18,5]; //
	$schoolDetails['medium_info'] = $this->Student_model->get_mediumInfo($medium_id);
	
				
				
				$observed_teachers = $this->Student_model->getObservedTeacherDetails($school_id); // Recently Observed Teachers
				$teachers_info = $this->Student_model->getTeacherDetails($school_id); // All Teachers Info of The School
				$teacher_info['reasons'] = $this->Student_model->getTeacherResons();
				if($observed_teachers){
					foreach($observed_teachers as $val){
						$teacher_emisid[] = $val->teacher_emisid;
					}
					$teacher_id = implode(",", $teacher_emisid);
					$other_teachers = $this->Student_model->getOtherTeachers($school_id,$teacher_id); //Recently Not Observed Teachers
					if($other_teachers){
						$random_id = $other_teachers[array_rand($other_teachers)];							// Random ID From Recently Not Observed Teachers
						$teacher_obsinfo = $this->Student_model->getTeacherObsInfo($random_id->teacher_id);  //Last Observed Data of the Teacher
						if($teacher_obsinfo === false){
							//$teacher_data = $teachers_info[array_rand($teachers_info)];
							$teacher_info['teacher']['teacher_emisid'] = $random_id->teacher_id;
							$teacher_info['teacher']['teacher_name'] = $random_id->teacher_name;
							$teacher_info['teacher']['final_remarks'] = 'null';
							$teacher_info['teacher']['strength'] = 'null';
							$teacher_info['teacher']['createdon'] = 'null';
							$teacher_info['teacher']['improvement'] = 'null';
						}else{
							$teacher_info['teacher'] =$teacher_obsinfo;
						}
					}else{
						$teacher_data = $teachers_info[array_rand($teachers_info)];  							// Random ID From School Teachers
						$teacherobsinfo = $this->Student_model->getTeacherObsInfo($teacher_data->teacher_id);	 //Last Observed Data of the Teacher
						if($teacherobsinfo === false){
							//$teacher_data = $teachers_info[array_rand($teachers_info)];
							$teacher_info['teacher']['teacher_emisid'] = $teacher_data->teacher_id;
							$teacher_info['teacher']['teacher_name'] = $teacher_data->teacher_name;
							$teacher_info['teacher']['final_remarks'] = 'null';
							$teacher_info['teacher']['strength'] = 'null';
							$teacher_info['teacher']['createdon'] = 'null';
							$teacher_info['teacher']['improvement'] = 'null';
						}else{
							$teacher_info['teacher'] = $teacherobsinfo;
						}
					}
				}else{
					$teacher_data = $teachers_info[array_rand($teachers_info)];									//Recently Not Observed Teachers For Long Time
					$teacher_obsinfms = $this->Student_model->getTeacherObsInfo($teacher_data->teacher_id);		 //Last Observed Data of the Teacher
					if($teacher_obsinfms === false){
						//$teacher_data = $teachers_info[array_rand($teachers_info)];
						$teacher_info['teacher']['teacher_emisid'] = $teacher_data->teacher_id;
						$teacher_info['teacher']['teacher_name'] = $teacher_data->teacher_name;
						$teacher_info['teacher']['final_remarks'] = 'null';
						$teacher_info['teacher']['strength'] = 'null';
						$teacher_info['teacher']['createdon'] = 'null';
						$teacher_info['teacher']['improvement'] = 'null';
					}else{
						$teacher_info['teacher'] = $teacher_obsinfms;
					}
				}
	$schoolDetails['teachers_details'] = $teacher_info['teacher'];
				
				
				// Start TeachingMethodology
 $schoolDetails['methodology'] = $this->Student_model->getTeachingMethodology();
				$questions = $this->Student_model->getTeachingQuestions_new();			
				
				if($questions){
					$array_data = array();
					$count = [];
					$ans_data = [];
						
					foreach($questions as $key => $val){
						$array_data[]=$val->ans;
					}
					for($i=0;$i<count($array_data);$i++){
						$count2[] = json_decode($array_data[$i]);
					}
					
					foreach($count2 as $key3 => $val3){
						$ans_data=$val3->ans;
						for($j=0;$j<count($ans_data);$j++){
							$child_qus = $ans_data[$j]->child_qus;
							if(count($child_qus)>0){
								for($k=0;$k<count($child_qus);$k++){
									$final_data[] = $child_qus[$k];
								}																			
							}
						}
					}
					
					if($final_data){
						$array = array_unique($final_data);
						$child_id = implode(",",$array);
						$child_questions = $this->Student_model->getChildQuestions($child_id);
	$schoolDetails['methodology_questions'] = array_merge($questions,$child_questions);
					}else{
	$schoolDetails['methodology_questions'] = $questions;
					}
				}else{
					$schoolDetails['methodology_questions'] = false;
				} 
				// END TeachingMethodology Questions
				

				
				
		
				//START Students Data
				$student_data['all'] = $this->Student_model->getAllStudentsBySchoolId_new($school_id);
				$student_data['absent_data'] = $this->Student_model->getAttendanceData_new($school_id);
				$absent_list = [];
				foreach($student_data['absent_data'] as $key){
					if($key['absent_students'] != ""){
						array_push($absent_list, $key['absent_students']);
					}
				}
				$lists_of_absents = implode(",", $absent_list);
				
				$student_data['absent_info'] = $this->Student_model->getAbsentData_new($school_id,$lists_of_absents);
				if(count($student_data)){
	$schoolDetails['StudentsData'] = $student_data;
	$schoolDetails['StudentsData_ForTesting1'] = $student_data; //For Testing purpose to check storage size
	$schoolDetails['StudentsData_ForTesting2'] = $student_data; //For Testing purpose to check storage size
	$schoolDetails['StudentsData_ForTesting3'] = $student_data; //For Testing purpose to check storage size
	$schoolDetails['StudentsData_ForTesting4'] = $student_data; //For Testing purpose to check storage size
	$schoolDetails['StudentsData_ForTesting5'] = $student_data; //For Testing purpose to check storage size
	$schoolDetails['StudentsData_ForTesting6'] = $student_data; //For Testing purpose to check storage size
				}else{
					$schoolDetails['StudentsData'] = false;
				}
				// END Students Data
				
							
					
				//START Get ChapterSection POST
				$getChapters_list= $this->Student_model->getChaptersList_new();
$schoolDetails['chapters'] = $getChapters_list;
				//END Get ChapterSection POST
				
				if($getChapters_list){
					foreach($getChapters_list as $key){
						$chapters_data[]=$key->chapter_id;
					}
					$chapterslist = implode(',',$chapters_data);
				}else{
					$getChapters_list = false;
				}
				
				$learning_outcome = $this->Student_model->getLearningOutcome_new($chapterslist);
				if($learning_outcome){
					foreach($learning_outcome as $value){
						$lo_id[]=$value->lo_id;
					}
					$lo_id_list = implode(',',$lo_id);
				}else{
					$getChapters_list = false;
				}

				$questions_data = $this->Student_model->getQuestions_new($lo_id_list);
				
$schoolDetails['QuestionData']['learning_outcome'] = $learning_outcome;
$schoolDetails['QuestionData']['questions_ans'] = $questions_data;


				// END Assesment Questions New
				
				
				// START Assesment Questions old
				/* $learning_outcome = $this->Student_model->getLearningOutcome_new();
				$learning_outcome_id = $learning_outcome->lo_id;
				if($learning_outcome_id){
					$questions_data = $this->Student_model->getQuestions($learning_outcome_id);
					if($questions_data){
						$option_questions['options'][0]['id'] = 1;
						$option_questions['options'][0]['option'] = $learning_outcome->option_1;
						$option_questions['options'][0]['grade'] = $learning_outcome->grade_option_1;
						$option_questions['options'][1]['id'] = 2;
						$option_questions['options'][1]['option'] = $learning_outcome->option_2;
						$option_questions['options'][1]['grade'] = $learning_outcome->grade_option_2;
						$option_questions['options'][2]['id'] = 3;
						$option_questions['options'][2]['option'] = $learning_outcome->option_3;
						$option_questions['options'][2]['grade'] = $learning_outcome->grade_option_3;
						$option_questions['options'][3]['id'] = 4;
						$option_questions['options'][3]['option'] = $learning_outcome->option_4;
						$option_questions['options'][3]['grade'] = $learning_outcome->grade_option_4;
						$option_questions['questions'] = $questions_data;
						$option_questions['learning_outcome'] = $learning_outcome->lo_name;
						$option_questions['learning_outcome_id'] = $learning_outcome_id;
						$option_questions['chapter_no'] = $learning_outcome->chapter_no;
						$schoolDetails['QuestionData'] = $option_questions;
					}else{
						$schoolDetails['QuestionData'] = false;
					}
				}else{
					$schoolDetails['QuestionData'] = false;
				} */
				// END Assesment Questions old
				
				// START  Edu_dist, Blocks, Nodals Info
				$observation_data = $this->Student_model->getObsInfo_new();
				if($observation_data){
	$schoolDetails['obs_info'] = $observation_data;
				}else{
					$schoolDetails['obs_info'] = false;
				}
				// END  Edu_dist, Blocks, Nodals Info
				
				// START  Subjects Info
				/* for($i=1;$i<13;$i++){
					$getMediumId = $this->Student_model->getMedium_new($i);
					$val_data[] = $getMediumId;
					
					if(is_array($getMediumId)){
						foreach($getMediumId as $row){
							$medium_data[] = $row->medium_id;
						}
					
						$medium_value = implode(',',$medium_data);
						$subject_datas[$i] = $this->Student_model->getSubjectsById($i,$medium_value);
					}else{
						$subject_datas[$i] = false;
					}
					
				}
				$schoolDetails['subject_datas'] = $subject_datas; */
				// END  Subjects Info
				
				
				// START  Subjects Info New
				for($i=1;$i<13;$i++){
					$getMediumId = $this->Student_model->getMedium_new($i); 
	$schoolDetails['subject_datas']['medium_info'][$i] = $getMediumId;
					if(is_array($getMediumId)){
						foreach($getMediumId as $row){
							$medium_id = $row->medium_id;
							$subjlist = $this->Student_model->getsub_new($i,$medium_id);
	$schoolDetails['subject_datas']['subjects'][$i][$row->medium_id] = $subjlist;
						}
					} 
					
				}
				// END  Subjects Info New
				
				
				
				// Start Reasons
	$schoolDetails['student_reasons'] = $this->Student_model->getAssesmentReasons();
	$schoolDetails['mismatch_reasons'] = $this->Student_model->getMismatchReasons();
	$schoolDetails['methodology'] = $this->Student_model->getTeachingMethodology();
	$schoolDetails['teacher_reasons'] = $this->Student_model->getTeacherResons();
	$schoolDetails['term'] = $this->Student_model->getTerm();
				// End Reasons
				
				
				
				
												//Start Languages
				//Start Methodology Lang
				$get_languages = $this->Student_model->getLang();
				foreach($get_languages as $keys => $vals){
					$lang_id[] = $vals->lang;
					$sectoins_lang[$vals->lang] = $this->Student_model->getSectionLang($vals->lang);
				}
	
	$schoolDetails['Observations']['methodologys'] = $sectoins_lang;
				// End Methodology Lang
				
				
								//Start Observation Questions Lang
				$get_quest_lang = $this->Student_model->getObsQuestLang();
				foreach($get_quest_lang as $keys4 => $vals4){
					$questlang_id = $vals4->lang;
					$questions_lang[$vals4->lang] = $this->Student_model->getTeachingQuestions_new_lang($questlang_id);
				
					if($questions_lang){
						$array_data = array();
						$langans_data = [];
							
						foreach($questions_lang[$vals4->lang] as $key5 => $val5){
							$langarray_data[]=$val5->ans;
						}
						for($i=0;$i<count($langarray_data);$i++){
							$count3[] = json_decode($langarray_data[$i]);
						}
						
						foreach($count3 as $key6 => $val6){
							$langans_data=$val6->ans;
							for($j=0;$j<count($langans_data);$j++){
								$langchild_qus = $langans_data[$j]->child_qus;
								if(count($langchild_qus)>0){
									for($l=0;$l<count($langchild_qus);$l++){
										$langfinal_data[] = $langchild_qus[$l];
									}																			
								}
							}
						}
						
						if($langfinal_data){
							$langarray = array_unique($final_data);
							$langchild_id = implode(",",$langarray);
							
							
							$langchild_questions['child'][$vals4->lang] = $this->Student_model->getChildQuestions_lang($langchild_id,$vals4->lang);
							
							
							
			$schoolDetails['methodology_questions_lang'] = array_merge($questions_lang,$langchild_questions);
						}else{
			$schoolDetails['methodology_questions_lang'][$vals4->lang] = $questions_lang[$vals4->lang];
						}
					}else{
						$schoolDetails['methodology_questions_lang'] = false;
					} 
				}
				//End Observation Questions Lang
				
			
				
				
				
				
				$data['dataStatus'] = true;
				$data['status'] = REST_Controller::HTTP_OK;
				$data['records'] = $schoolDetails;
				$this->response($data,REST_Controller::HTTP_OK);
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'School Id Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request or School ID';
			$this->response($data,REST_Controller::HTTP_OK);
		}
    }
	
	

}