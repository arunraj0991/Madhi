<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
error_reporting(0);

class Webapp extends REST_Controller{
   
    function __construct(){ // Construct the parent class
        parent::__construct();
        $this->load->model('Webapp_model');
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, authorization_key");
		//header("Access-Control-Allow-Headers: *");
		header("Access-Control-Request-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, authorization_key");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
	}
	
	
	
	public function getSubjectData_post(){

		$emis_username = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
		$class = ($this->post('class') && $this->post('class') != '') ? $this->post('class') : null;
		$date = ($this->post('date') && $this->post('date') != '') ? $this->post('date') : null;
		$subject = ($this->post('subject') && $this->post('subject') != '') ? $this->post('subject') : null;
		$user_type = ($this->post('usertype') && $this->post('usertype') != '') ? $this->post('usertype') : null;
		$districtId = ($this->post('district_id') && $this->post('district_id') != '') ? $this->post('district_id') : null;
		$blockId = ($this->post('block_id') && $this->post('block_id') != '') ? $this->post('block_id') : null;
		$zoneId = ($this->post('zone_id') && $this->post('zone_id') != '') ? $this->post('zone_id') : null;
		
		$result_data = array();
		if($user_type != null && $emis_username != null && $date != null){
			$user_info = $this->Webapp_model->UserDetais($emis_username);
			$date_format = strtotime($date);
			$month = date('m', $date_format);
			$year = date('Y', $date_format);
			
			if($user_info){
				if($user_type == 'state' && $user_info->emis_username =='state' && $user_info->emis_usertype == 5){ //STATE or JD = District Data
					
					$stateSectionsInfo = $this->Webapp_model->stateSectionsInfo($month,$year);
					$result_data['basic_info']['sectionsInfo'] =$stateSectionsInfo;
					
					//$blocks = $this->Webapp_model->getBlocks();
					//$result_data['basic_info']['no_of_blocks'] =$blocks->blocks;
					
					//$students_count = $this->Webapp_model->getStudentcounts();
					//$result_data['basic_info']['students_count'] = $students_count->total;
					
					$allDistricts = $this->Webapp_model->getAllDist();
					$dist_count = count($allDistricts);
					
					//$result_data['basic_info']['districts_count'] = $dist_count;  					
					//Fixed number of districts to 32.
					$result_data['basic_info']['districts_count'] = 32;

					$brtes = $this->Webapp_model->getBrtes();
					$result_data['basic_info']['no_of_brtes'] = $brtes->brtes;
					
					$school_count = $this->Webapp_model->getSchoolCount();
					$result_data['basic_info']['school_count'] = $school_count->school_count;
					
					$schools = $this->Webapp_model->getSchoolsVisited($month,$year);
					$result_data['basic_info']['schools_visited'] = $schools->schools_visited;
					
					$teachers = $this->Webapp_model->getTeachersObserved($month,$year);
					$result_data['basic_info']['teachers_observed'] = $teachers->teachers_observed;
					
					$students = $this->Webapp_model->getStudentsAssessed($month,$year);
					$result_data['basic_info']['students_assessed'] = $students->students_assessed;

					$getStateStudentGrades =  $this->Webapp_model->getStateStudentGrades($month,$year);
					
					if($getStateStudentGrades){
						$count = count($getStateStudentGrades);
						for($i=0;$i<$count;$i++){
							$tamil = json_decode($getStateStudentGrades[$i]->tamil);
							$english = json_decode($getStateStudentGrades[$i]->english);
							$maths = json_decode($getStateStudentGrades[$i]->maths);
							$science = json_decode($getStateStudentGrades[$i]->science);
							$evs = json_decode($getStateStudentGrades[$i]->evs);
							$social = json_decode($getStateStudentGrades[$i]->social);
						}
						
						//Tamil
						foreach($tamil as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryTamilAgrade[] = $key->no_a;
								$primaryTamilBgrade[] = $key->no_b;
								$primaryTamilCgrade[] = $key->no_c;
								$primaryTamilDgrade[] = $key->no_d;
								$primaryTamilStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryTamilAgrade[] = $key->no_a;
								$UprimaryTamilBgrade[] = $key->no_b;
								$UprimaryTamilCgrade[] = $key->no_c;
								$UprimaryTamilDgrade[] = $key->no_d;
								$UprimaryTamilStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['tamil']['a'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilAgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['b'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilBgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['c'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilCgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['d'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilDgrade) / array_sum($primaryTamilStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['tamil']['a'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilAgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['b'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilBgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['c'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilCgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['d'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilDgrade) / array_sum($UprimaryTamilStudents) * 100);
				 
						//English
						foreach($english as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEnglishAgrade[] = $key->no_a;
								$primaryEnglishBgrade[] = $key->no_b;
								$primaryEnglishCgrade[] = $key->no_c;
								$primaryEnglishDgrade[] = $key->no_d;
								$primaryEnglishStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryEnglishAgrade[] = $key->no_a;
								$UprimaryEnglishBgrade[] = $key->no_b;
								$UprimaryEnglishCgrade[] = $key->no_c;
								$UprimaryEnglishDgrade[] = $key->no_d;
								$UprimaryEnglishStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['english']['a'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishAgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['b'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishBgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['c'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishCgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['d'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishDgrade) / array_sum($primaryEnglishStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['english']['a'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishAgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['b'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishBgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['c'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishCgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['d'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishDgrade) / array_sum($UprimaryEnglishStudents) * 100);
						
						//Maths
						foreach($maths as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryMathsAgrade[] = $key->no_a;
								$primaryMathsBgrade[] = $key->no_b;
								$primaryMathsCgrade[] = $key->no_c;
								$primaryMathsDgrade[] = $key->no_d;
								$primaryMathsStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryMathsAgrade[] = $key->no_a;
								$UprimaryMathsBgrade[] = $key->no_b;
								$UprimaryMathsCgrade[] = $key->no_c;
								$UprimaryMathsDgrade[] = $key->no_d;
								$UprimaryMathsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['maths']['a'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsAgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['b'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsBgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['c'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsCgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['d'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsDgrade) / array_sum($primaryMathsStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['maths']['a'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsAgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['b'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsBgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['c'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsCgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['d'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsDgrade) / array_sum($UprimaryMathsStudents) * 100);
						
						
						//Science
						foreach($science as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryScienceAgrade[] = $key->no_a;
								$primaryScienceBgrade[] = $key->no_b;
								$primaryScienceCgrade[] = $key->no_c;
								$primaryScienceDgrade[] = $key->no_d;
								$primaryScienceStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryScienceAgrade[] = $key->no_a;
								$UprimaryScienceBgrade[] = $key->no_b;
								$UprimaryScienceCgrade[] = $key->no_c;
								$UprimaryScienceDgrade[] = $key->no_d;
								$UprimaryScienceStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['science']['a'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceAgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['b'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceBgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['c'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceCgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['d'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceDgrade) / array_sum($primaryScienceStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['science']['a'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceAgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['b'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceBgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['c'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceCgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['d'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceDgrade) / array_sum($UprimaryScienceStudents) * 100);
						
						//Evs
						foreach($evs as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEvsAgrade[] = $key->no_a;
								$primaryEvsBgrade[] = $key->no_b;
								$primaryEvsCgrade[] = $key->no_c;
								$primaryEvsDgrade[] = $key->no_d;
								$primaryEvsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['evs']['a'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsAgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['b'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsBgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['c'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsCgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['d'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsDgrade) / array_sum($primaryEvsStudents) * 100);
					
						//Social Science
						foreach($social as $key){
							$class =  $key->class;
							if($class <= 5){
								$primarySocialAgrade[] = $key->no_a;
								$primarySocialBgrade[] = $key->no_b;
								$primarySocialCgrade[] = $key->no_c;
								$primarySocialDgrade[] = $key->no_d;
								$primarySocialStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimarySocialAgrade[] = $key->no_a;
								$UprimarySocialBgrade[] = $key->no_b;
								$UprimarySocialCgrade[] = $key->no_c;
								$UprimarySocialDgrade[] = $key->no_d;
								$UprimarySocialStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['socialscience']['a'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialAgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['b'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialBgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['c'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialCgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['d'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialDgrade) / array_sum($primarySocialStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['socialscience']['a'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialAgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['b'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialBgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['c'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialCgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['d'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialDgrade) / array_sum($UprimarySocialStudents) * 100);
						
					}else{
						$result_data['studentGrades'] = false;
					}
					$allDistrictsIndex = $this->Webapp_model->getAllDistWithTnqul($month,$year);
					//$allDistrictsIndexTop5 =  $this->Webapp_model->getAllDistWithTnqulTop5($month,$year);
					//$allDistrictsIndexBottom5 =  $this->Webapp_model->getAllDistWithTnqulBottom5($month,$year);
					//$allDistrictsIndexMiddle5 =  $this->Webapp_model->getAllDistWithTnqulMiddle5($month,$year);
					
					$allDistrictsIndexTop3 =  $this->Webapp_model->getAllDistWithTnqulTop3($month,$year);
					$allDistrictsIndexUpper3 =  $this->Webapp_model->getAllDistWithTnqulUpper3($month,$year);
					$allDistrictsIndexMiddle3 =  $this->Webapp_model->getAllDistWithTnqulMiddle3($month,$year);
					$allDistrictsIndexBottom3 =  $this->Webapp_model->getAllDistWithTnqulBottom3($month,$year); 
					
					/* $result_data['districts_tn_qul_index']['topFive'] = $allDistrictsIndexTop5;
					$result_data['districts_tn_qul_index']['middleFive'] = $allDistrictsIndexMiddle5;
					$result_data['districts_tn_qul_index']['bottomFive'] = $allDistrictsIndexBottom5;*/
					$stateTnIndex = $this->Webapp_model->getStateTnqul($month,$year);
					
					$result_data['districts_tn_qul_index']['stateIndex'] = $stateTnIndex[0]->tn_qul_index;
					$result_data['districts_tn_qul_index']['allData'] = $allDistrictsIndex;
					$result_data['districts_tn_qul_index']['top'] = $allDistrictsIndexTop3;
					$result_data['districts_tn_qul_index']['upperMiddle'] = $allDistrictsIndexUpper3;
					$result_data['districts_tn_qul_index']['middle'] = $allDistrictsIndexMiddle3;
					$result_data['districts_tn_qul_index']['bottom'] = $allDistrictsIndexBottom3; 
					
					
					$PercentageTop5 =  $this->Webapp_model->getDistPercentageVisitsTop5($month,$year);
					$PercentageBottom5 =  $this->Webapp_model->getDistPercentageVisitsBottom5($month,$year);
					$PercentageAll =  $this->Webapp_model->getDistPercentageVisits($month,$year);
					
					$distTarget =  $this->Webapp_model->getDistTarget();
					$TargetValue = $distTarget[0]->value;
					if($PercentageTop5){
						for($i=0;$i<count($PercentageTop5);$i++){
							$Top5Percentage[$i]['DistName'] = $PercentageTop5[$i]->DistName;
							$values = $PercentageTop5[$i]->value;
							$Top5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageTop5 = false;
					}
					
					if($PercentageBottom5){
						for($i=0;$i<count($PercentageBottom5);$i++){
							$Bottom5Percentage[$i]['DistName'] = $PercentageBottom5[$i]->DistName;
							$values = $PercentageBottom5[$i]->value;
							$Bottom5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageBottom5 = false;
					}
					
					
					if($PercentageAll){
						for($i=0;$i<count($PercentageAll);$i++){
							$AllPercentage[$i]['DistName'] = $PercentageAll[$i]->DistName;
							$values = $PercentageAll[$i]->value;
							$AllPercentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
						
						if($AllPercentage){
							for($i=0;$i<count($AllPercentage);$i++){
								$averageData[] = $AllPercentage[$i]['value'];
							}
							$PercentageAvg = count($AllPercentage);
							$AvgValue = round(array_sum($averageData) / $PercentageAvg); 
						}
						
					}else{
						$PercentageAll = false;
					}
					
					
					$result_data['percentageOfVisits']['topFive'] = $Top5Percentage;
					$result_data['percentageOfVisits']['bottomFive'] = $Bottom5Percentage;
					$result_data['percentageOfVisits']['allData'] = $AllPercentage;
					$result_data['percentageOfVisits']['average'] = $AvgValue;
					
					$teachersPercentageTop5 =  $this->Webapp_model->getDistTeacherPercentageTop5($month,$year);
					$teachersPercentageBottom5 =  $this->Webapp_model->getDistTeacherPercentageBottom5($month,$year);
					$teachersPercentageAll =  $this->Webapp_model->getDistTeacherPercentage($month,$year);
					
					$result_data['percentageOfTeachers']['top5'] = $teachersPercentageTop5;
					$result_data['percentageOfTeachers']['bottom5'] = $teachersPercentageBottom5;
					$result_data['percentageOfTeachers']['allData'] = $teachersPercentageAll;
									
					$result_data['ViewForTest'] = 'State View';
				
				}else if($user_type == 'district' && $districtId != null && $user_info->emis_username =='state' || $user_type == 'district' && $districtId != null && $user_info->user_type =='DEO' || $user_type == 'district' && $districtId != null && $user_info->user_type =='CEO'){ //DEO & CEO = District Data
					
					//state 5
					//DEO 10
					//CEO 9
					
					$result_data['basic_info']['districtId'] =$districtId;
					
					$distSectionsInfo = $this->Webapp_model->getDistSectionsInfo($districtId,$month,$year);
					$result_data['basic_info']['sectionsInfo'] =$distSectionsInfo;
					
					$allDistricts = $this->Webapp_model->getAllDist();
					$dist_count = count($allDistricts);
					//$result_data['basic_info']['districts_count'] = $dist_count;
					$result_data['basic_info']['districts_count'] = 32;
					
					$blocks = $this->Webapp_model->getBlocksinDist($districtId);
					$result_data['basic_info']['no_of_blocks'] =count($blocks);
					
					$brtes = $this->Webapp_model->getBrtesByDist($districtId);
					$result_data['basic_info']['no_of_brtes'] = $brtes->brtes;
					
					$schools = $this->Webapp_model->getSchoolsVisitedByDist($districtId,$month,$year);
					$result_data['basic_info']['schools_visited'] = $schools->schools_visited;
					
					$teachers = $this->Webapp_model->getTeachersObservedByDist($districtId,$month,$year);
					$result_data['basic_info']['teachers_observed'] = $teachers->teachers_observed;
					
					$students = $this->Webapp_model->getStudentsAssessedByDist($districtId,$month,$year);
					$result_data['basic_info']['students_assessed'] = $students->students_assessed;
					
					$getDistTnQulIndex = $this->Webapp_model->getDistTnQulIndex($districtId,$month,$year);
					$result_data['basic_info']['distTnQulIndex'] = $getDistTnQulIndex[0]->tn_qul_index;
					
					$getDistrictStudentGrades =  $this->Webapp_model->getDistrictStudentGrades($districtId,$month,$year);
					if($getDistrictStudentGrades){
						$count = count($getDistrictStudentGrades);
						for($i=0;$i<$count;$i++){
							$tamil = json_decode($getDistrictStudentGrades[$i]->tamil);
							$english = json_decode($getDistrictStudentGrades[$i]->english);
							$maths = json_decode($getDistrictStudentGrades[$i]->maths);
							$science = json_decode($getDistrictStudentGrades[$i]->science);
							$evs = json_decode($getDistrictStudentGrades[$i]->evs);
							$social = json_decode($getDistrictStudentGrades[$i]->social);
						}
						
						//Tamil
						foreach($tamil as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryTamilAgrade[] = $key->no_a;
								$primaryTamilBgrade[] = $key->no_b;
								$primaryTamilCgrade[] = $key->no_c;
								$primaryTamilDgrade[] = $key->no_d;
								$primaryTamilStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryTamilAgrade[] = $key->no_a;
								$UprimaryTamilBgrade[] = $key->no_b;
								$UprimaryTamilCgrade[] = $key->no_c;
								$UprimaryTamilDgrade[] = $key->no_d;
								$UprimaryTamilStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['tamil']['a'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilAgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['b'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilBgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['c'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilCgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['d'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilDgrade) / array_sum($primaryTamilStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['tamil']['a'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilAgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['b'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilBgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['c'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilCgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['d'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilDgrade) / array_sum($UprimaryTamilStudents) * 100);
				 
						//English
						foreach($english as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEnglishAgrade[] = $key->no_a;
								$primaryEnglishBgrade[] = $key->no_b;
								$primaryEnglishCgrade[] = $key->no_c;
								$primaryEnglishDgrade[] = $key->no_d;
								$primaryEnglishStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryEnglishAgrade[] = $key->no_a;
								$UprimaryEnglishBgrade[] = $key->no_b;
								$UprimaryEnglishCgrade[] = $key->no_c;
								$UprimaryEnglishDgrade[] = $key->no_d;
								$UprimaryEnglishStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['english']['a'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishAgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['b'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishBgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['c'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishCgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['d'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishDgrade) / array_sum($primaryEnglishStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['english']['a'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishAgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['b'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishBgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['c'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishCgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['d'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishDgrade) / array_sum($UprimaryEnglishStudents) * 100);
						
						//Maths
						foreach($maths as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryMathsAgrade[] = $key->no_a;
								$primaryMathsBgrade[] = $key->no_b;
								$primaryMathsCgrade[] = $key->no_c;
								$primaryMathsDgrade[] = $key->no_d;
								$primaryMathsStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryMathsAgrade[] = $key->no_a;
								$UprimaryMathsBgrade[] = $key->no_b;
								$UprimaryMathsCgrade[] = $key->no_c;
								$UprimaryMathsDgrade[] = $key->no_d;
								$UprimaryMathsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['maths']['a'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsAgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['b'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsBgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['c'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsCgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['d'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsDgrade) / array_sum($primaryMathsStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['maths']['a'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsAgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['b'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsBgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['c'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsCgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['d'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsDgrade) / array_sum($UprimaryMathsStudents) * 100);
						
						
						//Science
						foreach($science as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryScienceAgrade[] = $key->no_a;
								$primaryScienceBgrade[] = $key->no_b;
								$primaryScienceCgrade[] = $key->no_c;
								$primaryScienceDgrade[] = $key->no_d;
								$primaryScienceStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryScienceAgrade[] = $key->no_a;
								$UprimaryScienceBgrade[] = $key->no_b;
								$UprimaryScienceCgrade[] = $key->no_c;
								$UprimaryScienceDgrade[] = $key->no_d;
								$UprimaryScienceStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['science']['a'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceAgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['b'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceBgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['c'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceCgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['d'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceDgrade) / array_sum($primaryScienceStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['science']['a'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceAgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['b'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceBgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['c'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceCgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['d'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceDgrade) / array_sum($UprimaryScienceStudents) * 100);
						
						//Evs
						foreach($evs as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEvsAgrade[] = $key->no_a;
								$primaryEvsBgrade[] = $key->no_b;
								$primaryEvsCgrade[] = $key->no_c;
								$primaryEvsDgrade[] = $key->no_d;
								$primaryEvsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['evs']['a'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsAgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['b'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsBgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['c'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsCgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['d'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsDgrade) / array_sum($primaryEvsStudents) * 100);
					
						//Social Science
						foreach($social as $key){
							$class =  $key->class;
							if($class <= 5){
								$primarySocialAgrade[] = $key->no_a;
								$primarySocialBgrade[] = $key->no_b;
								$primarySocialCgrade[] = $key->no_c;
								$primarySocialDgrade[] = $key->no_d;
								$primarySocialStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimarySocialAgrade[] = $key->no_a;
								$UprimarySocialBgrade[] = $key->no_b;
								$UprimarySocialCgrade[] = $key->no_c;
								$UprimarySocialDgrade[] = $key->no_d;
								$UprimarySocialStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['socialscience']['a'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialAgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['b'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialBgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['c'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialCgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['d'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialDgrade) / array_sum($primarySocialStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['socialscience']['a'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialAgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['b'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialBgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['c'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialCgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['d'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialDgrade) / array_sum($UprimarySocialStudents) * 100);
						
					}else{
						$result_data['studentGrades'] = false;
					}
					
					$allBlocks = $this->Webapp_model->getAllBlockWithTnqul($districtId,$month,$year);
					$allBlocksTop5 = $this->Webapp_model->getAllBlockWithTnqulTop5($districtId,$month,$year);
					$allBlocksMiddle5 = $this->Webapp_model->getAllBlockWithTnqulMiddle5($districtId,$month,$year);
					$allBlocksBottom5 = $this->Webapp_model->getAllBlockWithTnqulBottom5($districtId,$month,$year);
					
					$allBlocksTop3 = $this->Webapp_model->getAllBlockWithTnqulTop3($districtId,$month,$year);
					$allBlocksUpper3 = $this->Webapp_model->getAllBlockWithTnqulUpper3($districtId,$month,$year);
					$allBlocksMiddle3 = $this->Webapp_model->getAllBlockWithTnqulMiddle3($districtId,$month,$year);
					$allBlocksBottom3 = $this->Webapp_model->getAllBlockWithTnqulBottom3($districtId,$month,$year);
					$stateTnIndex = $this->Webapp_model->getStateTnqul($month,$year);
					$districtTnIndex = $this->Webapp_model->getDistrictTnIndex($districtId,$month,$year);
					
					$result_data['blocks_tn_qul_index']['stateIndex'] = $stateTnIndex[0]->tn_qul_index;
					$result_data['blocks_tn_qul_index']['distIndex'] = $districtTnIndex[0]->tn_qul_index;
					
					$result_data['blocks_tn_qul_index']['allData'] = $allBlocks;
					$result_data['blocks_tn_qul_index']['topFive'] = $allBlocksTop5;
					$result_data['blocks_tn_qul_index']['middleFive'] = $allBlocksMiddle5;
					$result_data['blocks_tn_qul_index']['bottomFive'] = $allBlocksBottom5;
					
					$result_data['blocks_tn_qul_index']['top'] = $allBlocksTop3;
					$result_data['blocks_tn_qul_index']['upperMiddle'] = $allBlocksUpper3;
					$result_data['blocks_tn_qul_index']['middle'] = $allBlocksMiddle3;
					$result_data['blocks_tn_qul_index']['bottom'] = $allBlocksBottom3;
					
					
					$PercentageTop5 =  $this->Webapp_model->getBlockPercentageVisitsTop5($districtId,$month,$year);
					$PercentageBottom5 =  $this->Webapp_model->getBlockPercentageVisitsBottom5($districtId,$month,$year);
					$PercentageAll =  $this->Webapp_model->getBlockPercentageVisits($districtId,$month,$year);
					//$PercentageTargets =  $this->Webapp_model->getBlockPercentageVisitsTargets($districtId,$month,$year);
					
					
					$blockTarget =  $this->Webapp_model->getBlockTarget();
					$TargetValue = $blockTarget[0]->value;
					if($PercentageTop5){
						for($i=0;$i<count($PercentageTop5);$i++){
							$Top5Percentage[$i]['BlockName'] = $PercentageTop5[$i]->BlockName;
							$values = $PercentageTop5[$i]->value;
							$Top5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageTop5 = false;
					}
					
					if($PercentageBottom5){ 
						for($i=0;$i<count($PercentageBottom5);$i++){
							$Bottom5Percentage[$i]['BlockName'] = $PercentageBottom5[$i]->BlockName;
							$values = $PercentageBottom5[$i]->value;
							$Bottom5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageBottom5 = false;
					}
					
					
					if($PercentageAll){
						for($i=0;$i<count($PercentageAll);$i++){
							$AllPercentage[$i]['BlockName'] = $PercentageAll[$i]->BlockName;
							$values = $PercentageAll[$i]->value;
							$AllPercentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
						
						
						if($AllPercentage){
							for($i=0;$i<count($AllPercentage);$i++){
								$averageData[] = $AllPercentage[$i]['value'];
							}
							$PercentageAvg = count($AllPercentage);
							$AvgValue = round(array_sum($averageData) / $PercentageAvg); 
						}
						
					}else{
						$PercentageAll = false;
					}
					
					
					$DistPercentageAll =  $this->Webapp_model->getDistPercentageVisits($month,$year);
					$distTarget =  $this->Webapp_model->getDistTarget();
					$DistTargetValue = $distTarget[0]->value;
					
					if($DistPercentageAll){
						for($i=0;$i<count($DistPercentageAll);$i++){
							$values = $DistPercentageAll[$i]->value;
							$DistAllPercentage[$i]['value'] = round(($values/$DistTargetValue) * 100);
						}
						
					}else{
						$DistPercentageAll = false;
					}
					
					if($DistAllPercentage){
						for($i=0;$i<count($DistAllPercentage);$i++){
							$TnaverageData[] = $DistAllPercentage[$i]['value'];
						}
						$TNPercentageAvg = count($DistAllPercentage);
						$TnAvgValue = round(array_sum($TnaverageData) / $TNPercentageAvg); 
					}
					
					
					
					$result_data['percentageOfVisits']['topFive'] = $Top5Percentage;
					$result_data['percentageOfVisits']['bottomFive'] = $Bottom5Percentage;
					$result_data['percentageOfVisits']['allData'] = $AllPercentage;
					$result_data['percentageOfVisits']['average'] = $AvgValue;
					$result_data['percentageOfVisits']['TnAverage'] = $TnAvgValue;
					
					$teachersPercentageTop5 =  $this->Webapp_model->getBlockTeacherPercentageTop5($districtId,$month,$year);
					$teachersPercentageBottom5 =  $this->Webapp_model->getBlockTeacherPercentageBottom5($districtId,$month,$year);
					$teachersPercentageAll =  $this->Webapp_model->getBlockTeacherPercentage($districtId,$month,$year);
					
					$result_data['percentageOfTeachers']['top5'] = $teachersPercentageTop5;
					$result_data['percentageOfTeachers']['bottom5'] = $teachersPercentageBottom5;
					$result_data['percentageOfTeachers']['allData'] = $teachersPercentageAll;
					
					
				}else if($user_type == 'block' && $districtId != null && $blockId != null && $user_info->emis_username =='state' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='DEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='CEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='BEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='TEACHER'){ //State & DEO & CEO & BEO & BRTE
					
					//state 5
					//DEO 10
					//CEO 9
					//BEO 6
					//BRTE(TEACHER) 14
					
					$result_data['user_type'] = $user_type; 
					$result_data['districtId'] = $districtId; 
					$result_data['blockId'] = $blockId; 
					
					$blockSectionsInfo = $this->Webapp_model->getBlockSectionsInfo($districtId,$blockId,$month,$year);
					$result_data['basic_info']['sectionsInfo'] =$blockSectionsInfo;
				
					$blocks = $this->Webapp_model->getZonesinDist($districtId,$blockId);
					$result_data['basic_info']['no_of_zones'] = count($blocks);
					
					$brtes = $this->Webapp_model->getBrtesByDistBlock($districtId,$blockId);
					$result_data['basic_info']['no_of_brtes'] = $brtes->brtes;
					
					$schools = $this->Webapp_model->getSchoolsVisitedByDistBlock($districtId,$blockId,$month,$year);
					$result_data['basic_info']['schools_visited'] = $schools->schools_visited;
					
					$teachers = $this->Webapp_model->getTeachersObservedByDistBlock($districtId,$blockId,$month,$year);
					$result_data['basic_info']['teachers_observed'] = $teachers->teachers_observed;
					
					$students = $this->Webapp_model->getStudentsAssessedByDistBlock($districtId,$blockId,$month,$year);
					$result_data['basic_info']['students_assessed'] = $students->students_assessed;
					
					$getDistTnQulIndex = $this->Webapp_model->getDistTnQulIndex($districtId,$month,$year);
					$result_data['basic_info']['distTnQulIndex'] = $getDistTnQulIndex[0]->tn_qul_index;
					
					$getDistTnQulIndexDistBlock = $this->Webapp_model->getDistTnQulIndexDistBlock($districtId,$blockId,$month,$year);
					$result_data['basic_info']['BlockTnQulIndex'] = $getDistTnQulIndexDistBlock[0]->tn_qul_index;
									
					$getBlockStudentGrades =  $this->Webapp_model->getBlockStudentGrades($districtId,$blockId,$month,$year);
					if($getBlockStudentGrades){
						$count = count($getBlockStudentGrades);
						for($i=0;$i<$count;$i++){
							$tamil = json_decode($getBlockStudentGrades[$i]->tamil);
							$english = json_decode($getBlockStudentGrades[$i]->english);
							$maths = json_decode($getBlockStudentGrades[$i]->maths);
							$science = json_decode($getBlockStudentGrades[$i]->science);
							$evs = json_decode($getBlockStudentGrades[$i]->evs);
							$social = json_decode($getBlockStudentGrades[$i]->social);
						}
						
						//Tamil
						foreach($tamil as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryTamilAgrade[] = $key->no_a;
								$primaryTamilBgrade[] = $key->no_b;
								$primaryTamilCgrade[] = $key->no_c;
								$primaryTamilDgrade[] = $key->no_d;
								$primaryTamilStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryTamilAgrade[] = $key->no_a;
								$UprimaryTamilBgrade[] = $key->no_b;
								$UprimaryTamilCgrade[] = $key->no_c;
								$UprimaryTamilDgrade[] = $key->no_d;
								$UprimaryTamilStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['tamil']['a'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilAgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['b'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilBgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['c'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilCgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['d'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilDgrade) / array_sum($primaryTamilStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['tamil']['a'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilAgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['b'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilBgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['c'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilCgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['d'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilDgrade) / array_sum($UprimaryTamilStudents) * 100);
				 
						//English
						foreach($english as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEnglishAgrade[] = $key->no_a;
								$primaryEnglishBgrade[] = $key->no_b;
								$primaryEnglishCgrade[] = $key->no_c;
								$primaryEnglishDgrade[] = $key->no_d;
								$primaryEnglishStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryEnglishAgrade[] = $key->no_a;
								$UprimaryEnglishBgrade[] = $key->no_b;
								$UprimaryEnglishCgrade[] = $key->no_c;
								$UprimaryEnglishDgrade[] = $key->no_d;
								$UprimaryEnglishStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['english']['a'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishAgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['b'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishBgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['c'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishCgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['d'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishDgrade) / array_sum($primaryEnglishStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['english']['a'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishAgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['b'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishBgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['c'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishCgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['d'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishDgrade) / array_sum($UprimaryEnglishStudents) * 100);
						
						//Maths
						foreach($maths as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryMathsAgrade[] = $key->no_a;
								$primaryMathsBgrade[] = $key->no_b;
								$primaryMathsCgrade[] = $key->no_c;
								$primaryMathsDgrade[] = $key->no_d;
								$primaryMathsStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryMathsAgrade[] = $key->no_a;
								$UprimaryMathsBgrade[] = $key->no_b;
								$UprimaryMathsCgrade[] = $key->no_c;
								$UprimaryMathsDgrade[] = $key->no_d;
								$UprimaryMathsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['maths']['a'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsAgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['b'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsBgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['c'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsCgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['d'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsDgrade) / array_sum($primaryMathsStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['maths']['a'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsAgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['b'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsBgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['c'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsCgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['d'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsDgrade) / array_sum($UprimaryMathsStudents) * 100);
						
						
						//Science
						foreach($science as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryScienceAgrade[] = $key->no_a;
								$primaryScienceBgrade[] = $key->no_b;
								$primaryScienceCgrade[] = $key->no_c;
								$primaryScienceDgrade[] = $key->no_d;
								$primaryScienceStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryScienceAgrade[] = $key->no_a;
								$UprimaryScienceBgrade[] = $key->no_b;
								$UprimaryScienceCgrade[] = $key->no_c;
								$UprimaryScienceDgrade[] = $key->no_d;
								$UprimaryScienceStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['science']['a'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceAgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['b'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceBgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['c'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceCgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['d'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceDgrade) / array_sum($primaryScienceStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['science']['a'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceAgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['b'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceBgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['c'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceCgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['d'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceDgrade) / array_sum($UprimaryScienceStudents) * 100);
						
						//Evs
						foreach($evs as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEvsAgrade[] = $key->no_a;
								$primaryEvsBgrade[] = $key->no_b;
								$primaryEvsCgrade[] = $key->no_c;
								$primaryEvsDgrade[] = $key->no_d;
								$primaryEvsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['evs']['a'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsAgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['b'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsBgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['c'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsCgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['d'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsDgrade) / array_sum($primaryEvsStudents) * 100);
					
						//Social Science
						foreach($social as $key){
							$class =  $key->class;
							if($class <= 5){
								$primarySocialAgrade[] = $key->no_a;
								$primarySocialBgrade[] = $key->no_b;
								$primarySocialCgrade[] = $key->no_c;
								$primarySocialDgrade[] = $key->no_d;
								$primarySocialStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimarySocialAgrade[] = $key->no_a;
								$UprimarySocialBgrade[] = $key->no_b;
								$UprimarySocialCgrade[] = $key->no_c;
								$UprimarySocialDgrade[] = $key->no_d;
								$UprimarySocialStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['socialscience']['a'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialAgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['b'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialBgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['c'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialCgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['d'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialDgrade) / array_sum($primarySocialStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['socialscience']['a'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialAgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['b'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialBgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['c'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialCgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['d'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialDgrade) / array_sum($UprimarySocialStudents) * 100);
						
						
					}else{
						$result_data['studentGrades'] = false;
					}
					
					
					$allZones = $this->Webapp_model->getAllZonesWithTnqul($districtId,$blockId,$month,$year);
					$allZonesTop5 = $this->Webapp_model->getAllZonesWithTnqulTop5($districtId,$blockId,$month,$year);
					$allZonesMiddle5 = $this->Webapp_model->getAllZonesWithTnqulMiddle5($districtId,$blockId,$month,$year);
					$allZonesBottom5 = $this->Webapp_model->getAllZonesWithTnqulBottom5($districtId,$blockId,$month,$year);
					
					$allZonesTop3 = $this->Webapp_model->getAllZonesWithTnqulTop3($districtId,$blockId,$month,$year);
					$allZonesUpper3 = $this->Webapp_model->getAllZonesWithTnqulUpper3($districtId,$blockId,$month,$year);
					$allZonesMiddle3 = $this->Webapp_model->getAllZonesWithTnqulMiddle3($districtId,$blockId,$month,$year);
					$allZonesBottom3 = $this->Webapp_model->getAllZonesWithTnqulBottom3($districtId,$blockId,$month,$year);
					$stateTnIndex = $this->Webapp_model->getStateTnqul($month,$year);
					$districtTnIndex = $this->Webapp_model->getDistrictTnIndex($districtId,$month,$year);
					$BlockTnIndex = $this->Webapp_model->getBlockTnIndex($districtId,$blockId,$month,$year);
					
					$result_data['zones_tn_qul_index']['stateIndex'] = $stateTnIndex[0]->tn_qul_index;
					$result_data['zones_tn_qul_index']['distIndex'] = $districtTnIndex[0]->tn_qul_index;
					$result_data['zones_tn_qul_index']['blockIndex'] = $BlockTnIndex[0]->tn_qul_index;
					$result_data['zones_tn_qul_index']['allData'] = $allZones;
					$result_data['zones_tn_qul_index']['topFive'] = $allZonesTop5;
					$result_data['zones_tn_qul_index']['middleFive'] = $allZonesMiddle5;
					$result_data['zones_tn_qul_index']['bottomFive'] = $allZonesBottom5;
					
					$result_data['zones_tn_qul_index']['top'] = $allZonesTop3;
					$result_data['zones_tn_qul_index']['upperMiddle'] = $allZonesUpper3;
					$result_data['zones_tn_qul_index']['middle'] = $allZonesMiddle3;
					$result_data['zones_tn_qul_index']['bottom'] = $allZonesBottom3;
					
					
					$PercentageTop5 =  $this->Webapp_model->getZonePercentageVisitsTop5($districtId,$blockId,$month,$year);
					$PercentageBottom5 =  $this->Webapp_model->getZonePercentageVisitsBottom5($districtId,$blockId,$month,$year);
					$PercentageAll =  $this->Webapp_model->getZonePercentageVisits($districtId,$blockId,$month,$year);
					//$PercentageAllTargets =  $this->Webapp_model->getZonePercentageVisitsTargets($districtId,$blockId,$month,$year);
					
					$zoneTarget =  $this->Webapp_model->getZoneTarget();
					$TargetValue = $zoneTarget[0]->value;
					if($PercentageTop5){
						for($i=0;$i<count($PercentageTop5);$i++){
							$Top5Percentage[$i]['ZoneName'] = $PercentageTop5[$i]->ZoneName;
							$values = $PercentageTop5[$i]->value;
							$Top5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageTop5 = false;
					}
					
					if($PercentageBottom5){ 
						for($i=0;$i<count($PercentageBottom5);$i++){
							$Bottom5Percentage[$i]['ZoneName'] = $PercentageBottom5[$i]->ZoneName;
							$values = $PercentageBottom5[$i]->value;
							$Bottom5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageBottom5 = false;
					}
					
					
					if($PercentageAll){
						for($i=0;$i<count($PercentageAll);$i++){
							$AllPercentage[$i]['ZoneName'] = $PercentageAll[$i]->ZoneName;
							$values = $PercentageAll[$i]->value;
							$AllPercentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
						
						if($AllPercentage){
							for($i=0;$i<count($AllPercentage);$i++){
								$averageData[] = $AllPercentage[$i]['value'];
							}
							$PercentageAvg = count($AllPercentage);
							$AvgValue = round(array_sum($averageData) / $PercentageAvg); 
						}
						
					}else{
						$PercentageAll = false;
					}
					
					
					$DistPercentageAll =  $this->Webapp_model->getDistPercentageVisits($month,$year);
					$distTarget =  $this->Webapp_model->getDistTarget();
					$DistTargetValue = $distTarget[0]->value;
					
					if($DistPercentageAll){
						for($i=0;$i<count($DistPercentageAll);$i++){
							$values = $DistPercentageAll[$i]->value;
							$DistAllPercentage[$i]['value'] = round(($values/$DistTargetValue) * 100);
						}
						
					}else{
						$DistPercentageAll = false;
					}
					
					if($DistAllPercentage){
						for($i=0;$i<count($DistAllPercentage);$i++){
							$TnaverageData[] = $DistAllPercentage[$i]['value'];
						}
						$TNPercentageAvg = count($DistAllPercentage);
						$TnAvgValue = round(array_sum($TnaverageData) / $TNPercentageAvg); 
					}
					
					
					
					$result_data['percentageOfVisits']['topFive'] = $Top5Percentage;
					$result_data['percentageOfVisits']['bottomFive'] = $Bottom5Percentage;
					$result_data['percentageOfVisits']['allData'] = $AllPercentage;
					$result_data['percentageOfVisits']['average'] = $AvgValue;
					$result_data['percentageOfVisits']['TnAverage'] = $TnAvgValue;
					
					$teachersPercentageTop5 =  $this->Webapp_model->getZoneTeacherPercentageTop5($districtId,$blockId,$month,$year);
					$teachersPercentageBottom5 =  $this->Webapp_model->getZoneTeacherPercentageBottom5($districtId,$blockId,$month,$year);
					$teachersPercentageAll =  $this->Webapp_model->getZoneTeacherPercentage($districtId,$blockId,$month,$year);
					
					$result_data['percentageOfTeachers']['top5'] = $teachersPercentageTop5;
					$result_data['percentageOfTeachers']['bottom5'] = $teachersPercentageBottom5;
					$result_data['percentageOfTeachers']['allData'] = $teachersPercentageAll;
				
				}else if($user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->emis_username =='state' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='DEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='CEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='BEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='TEACHER'){ //State & DEO & CEO & BEO & BRTE
					
					//state 5
					//DEO 10
					//CEO 9
					//BEO 6
					//BRTE(TEACHER) 14
					
					$result_data['user_type'] = $user_type; 
					$result_data['districtId'] = $districtId; 
					$result_data['blockId'] = $blockId; 
					$result_data['zoneId'] = $zoneId; 
					
					$zoneSectionsInfo = $this->Webapp_model->getZoneSectionsInfo($districtId,$blockId,$zoneId,$month,$year);
					$result_data['basic_info']['sectionsInfo'] =$zoneSectionsInfo;
					
					$schoolsCount = $this->Webapp_model->getSchoolsinDist($districtId,$blockId,$zoneId);
					$result_data['basic_info']['no_of_schools'] = count($schoolsCount);
					
					$brtes = $this->Webapp_model->getBrtesByDistBlockZone($districtId,$blockId,$zoneId);
					$result_data['basic_info']['no_of_brtes'] = $brtes->brtes;
					
					$schools = $this->Webapp_model->getSchoolsVisitedByDistBlockZone($districtId,$blockId,$zoneId,$month,$year);
					$result_data['basic_info']['schools_visited'] = $schools->schools_visited;
					
					$teachers = $this->Webapp_model->getTeachersObservedByDistBlockZone($districtId,$blockId,$zoneId,$month,$year);
					$result_data['basic_info']['teachers_observed'] = $teachers->teachers_observed;
					
					$students = $this->Webapp_model->getStudentsAssessedByDistBlockZone($districtId,$blockId,$zoneId,$month,$year);
					$result_data['basic_info']['students_assessed'] = $students->students_assessed;
					
					$getDistTnQulIndex = $this->Webapp_model->getDistTnQulIndex($districtId,$month,$year);
					$result_data['basic_info']['distTnQulIndex'] = $getDistTnQulIndex[0]->tn_qul_index;
					
					$getDistTnQulIndexDistBlock = $this->Webapp_model->getDistTnQulIndexDistBlock($districtId,$blockId,$month,$year);
					$result_data['basic_info']['BlockTnQulIndex'] = $getDistTnQulIndexDistBlock[0]->tn_qul_index;
					
					$getDistTnQulIndexDistBlockZone = $this->Webapp_model->getDistTnQulIndexDistBlockZone($districtId,$blockId,$zoneId,$month,$year);
					$result_data['basic_info']['ZoneTnQulIndex'] = $getDistTnQulIndexDistBlockZone[0]->tn_qul_index;
					
					$getZoneStudentGrades =  $this->Webapp_model->getZoneStudentGrades($districtId,$blockId,$zoneId,$month,$year);
					if($getZoneStudentGrades){
						$count = count($getZoneStudentGrades);
						for($i=0;$i<$count;$i++){
							$tamil = json_decode($getZoneStudentGrades[$i]->tamil);
							$english = json_decode($getZoneStudentGrades[$i]->english);
							$maths = json_decode($getZoneStudentGrades[$i]->maths);
							$science = json_decode($getZoneStudentGrades[$i]->science);
							$evs = json_decode($getZoneStudentGrades[$i]->evs);
							$social = json_decode($getZoneStudentGrades[$i]->social);
						}
						
						//Tamil
						foreach($tamil as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryTamilAgrade[] = $key->no_a;
								$primaryTamilBgrade[] = $key->no_b;
								$primaryTamilCgrade[] = $key->no_c;
								$primaryTamilDgrade[] = $key->no_d;
								$primaryTamilStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryTamilAgrade[] = $key->no_a;
								$UprimaryTamilBgrade[] = $key->no_b;
								$UprimaryTamilCgrade[] = $key->no_c;
								$UprimaryTamilDgrade[] = $key->no_d;
								$UprimaryTamilStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['tamil']['a'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilAgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['b'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilBgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['c'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilCgrade) / array_sum($primaryTamilStudents) * 100);
						$result_data['studentGrades']['primary']['tamil']['d'] = (array_sum($primaryTamilStudents) == 0) ? 0 : round(array_sum($primaryTamilDgrade) / array_sum($primaryTamilStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['tamil']['a'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilAgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['b'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilBgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['c'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilCgrade) / array_sum($UprimaryTamilStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['tamil']['d'] = (array_sum($UprimaryTamilStudents) == 0) ? 0 : round(array_sum($UprimaryTamilDgrade) / array_sum($UprimaryTamilStudents) * 100);
				 
						//English
						foreach($english as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEnglishAgrade[] = $key->no_a;
								$primaryEnglishBgrade[] = $key->no_b;
								$primaryEnglishCgrade[] = $key->no_c;
								$primaryEnglishDgrade[] = $key->no_d;
								$primaryEnglishStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryEnglishAgrade[] = $key->no_a;
								$UprimaryEnglishBgrade[] = $key->no_b;
								$UprimaryEnglishCgrade[] = $key->no_c;
								$UprimaryEnglishDgrade[] = $key->no_d;
								$UprimaryEnglishStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['english']['a'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishAgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['b'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishBgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['c'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishCgrade) / array_sum($primaryEnglishStudents) * 100);
						$result_data['studentGrades']['primary']['english']['d'] = (array_sum($primaryEnglishStudents) == 0) ? 0 : round(array_sum($primaryEnglishDgrade) / array_sum($primaryEnglishStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['english']['a'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishAgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['b'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishBgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['c'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishCgrade) / array_sum($UprimaryEnglishStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['english']['d'] = (array_sum($UprimaryEnglishStudents) == 0) ? 0 : round(array_sum($UprimaryEnglishDgrade) / array_sum($UprimaryEnglishStudents) * 100);
						
						//Maths
						foreach($maths as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryMathsAgrade[] = $key->no_a;
								$primaryMathsBgrade[] = $key->no_b;
								$primaryMathsCgrade[] = $key->no_c;
								$primaryMathsDgrade[] = $key->no_d;
								$primaryMathsStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryMathsAgrade[] = $key->no_a;
								$UprimaryMathsBgrade[] = $key->no_b;
								$UprimaryMathsCgrade[] = $key->no_c;
								$UprimaryMathsDgrade[] = $key->no_d;
								$UprimaryMathsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['maths']['a'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsAgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['b'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsBgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['c'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsCgrade) / array_sum($primaryMathsStudents) * 100);
						$result_data['studentGrades']['primary']['maths']['d'] = (array_sum($primaryMathsStudents) == 0) ? 0 : round(array_sum($primaryMathsDgrade) / array_sum($primaryMathsStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['maths']['a'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsAgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['b'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsBgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['c'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsCgrade) / array_sum($UprimaryMathsStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['maths']['d'] = (array_sum($UprimaryMathsStudents) == 0) ? 0 : round(array_sum($UprimaryMathsDgrade) / array_sum($UprimaryMathsStudents) * 100);
						
						
						//Science
						foreach($science as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryScienceAgrade[] = $key->no_a;
								$primaryScienceBgrade[] = $key->no_b;
								$primaryScienceCgrade[] = $key->no_c;
								$primaryScienceDgrade[] = $key->no_d;
								$primaryScienceStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimaryScienceAgrade[] = $key->no_a;
								$UprimaryScienceBgrade[] = $key->no_b;
								$UprimaryScienceCgrade[] = $key->no_c;
								$UprimaryScienceDgrade[] = $key->no_d;
								$UprimaryScienceStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['science']['a'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceAgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['b'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceBgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['c'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceCgrade) / array_sum($primaryScienceStudents) * 100);
						$result_data['studentGrades']['primary']['science']['d'] = (array_sum($primaryScienceStudents) == 0) ? 0 : round(array_sum($primaryScienceDgrade) / array_sum($primaryScienceStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['science']['a'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceAgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['b'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceBgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['c'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceCgrade) / array_sum($UprimaryScienceStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['science']['d'] = (array_sum($UprimaryScienceStudents) == 0) ? 0 : round(array_sum($UprimaryScienceDgrade) / array_sum($UprimaryScienceStudents) * 100);
						
						//Evs
						foreach($evs as $key){
							$class =  $key->class;
							if($class <= 5){
								$primaryEvsAgrade[] = $key->no_a;
								$primaryEvsBgrade[] = $key->no_b;
								$primaryEvsCgrade[] = $key->no_c;
								$primaryEvsDgrade[] = $key->no_d;
								$primaryEvsStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['evs']['a'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsAgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['b'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsBgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['c'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsCgrade) / array_sum($primaryEvsStudents) * 100);
						$result_data['studentGrades']['primary']['evs']['d'] = (array_sum($primaryEvsStudents) == 0) ? 0 : round(array_sum($primaryEvsDgrade) / array_sum($primaryEvsStudents) * 100);
					
						//Social Science
						foreach($social as $key){
							$class =  $key->class;
							if($class <= 5){
								$primarySocialAgrade[] = $key->no_a;
								$primarySocialBgrade[] = $key->no_b;
								$primarySocialCgrade[] = $key->no_c;
								$primarySocialDgrade[] = $key->no_d;
								$primarySocialStudents[] = $key->total_students;
							}
							if($class > 5){
								$UprimarySocialAgrade[] = $key->no_a;
								$UprimarySocialBgrade[] = $key->no_b;
								$UprimarySocialCgrade[] = $key->no_c;
								$UprimarySocialDgrade[] = $key->no_d;
								$UprimarySocialStudents[] = $key->total_students;
							}
						}
						
						$result_data['studentGrades']['primary']['socialscience']['a'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialAgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['b'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialBgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['c'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialCgrade) / array_sum($primarySocialStudents) * 100);
						$result_data['studentGrades']['primary']['socialscience']['d'] = (array_sum($primarySocialStudents) == 0) ? 0 : round(array_sum($primarySocialDgrade) / array_sum($primarySocialStudents) * 100);
						
						$result_data['studentGrades']['upperPrimary']['socialscience']['a'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialAgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['b'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialBgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['c'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialCgrade) / array_sum($UprimarySocialStudents) * 100);
						$result_data['studentGrades']['upperPrimary']['socialscience']['d'] = (array_sum($UprimarySocialStudents) == 0) ? 0 : round(array_sum($UprimarySocialDgrade) / array_sum($UprimarySocialStudents) * 100);
						
						
					}else{
						$result_data['studentGrades'] = false;
					}
					
					$allSchools = $this->Webapp_model->getAllSchoolsWithTnqul($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsTop5 = $this->Webapp_model->getAllSchoolsWithTnqulTop5($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsMiddle5 = $this->Webapp_model->getAllSchoolsWithTnqulMiddle5($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsBottom5 = $this->Webapp_model->getAllSchoolsWithTnqulBottom5($districtId,$blockId,$zoneId,$month,$year);
					
					$allSchoolsTop3 = $this->Webapp_model->getAllSchoolsWithTnqulTop3($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsUpper3 = $this->Webapp_model->getAllSchoolsWithTnqulUpper3($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsMiddle3 = $this->Webapp_model->getAllSchoolsWithTnqulMiddle3($districtId,$blockId,$zoneId,$month,$year);
					$allSchoolsBottom3 = $this->Webapp_model->getAllSchoolsWithTnqulBottom3($districtId,$blockId,$zoneId,$month,$year);
					$stateTnIndex = $this->Webapp_model->getStateTnqul($month,$year);
					$districtTnIndex = $this->Webapp_model->getDistrictTnIndex($districtId,$month,$year);
					$BlockTnIndex = $this->Webapp_model->getBlockTnIndex($districtId,$blockId,$month,$year);
					$ZoneTnIndex = $this->Webapp_model->getZoneTnIndex($districtId,$blockId,$zoneId,$month,$year);
					
					$result_data['schools_tn_qul_index']['stateIndex'] = $stateTnIndex[0]->tn_qul_index;
					$result_data['schools_tn_qul_index']['distIndex'] = $districtTnIndex[0]->tn_qul_index;
					$result_data['schools_tn_qul_index']['blockIndex'] = $BlockTnIndex[0]->tn_qul_index;
					$result_data['schools_tn_qul_index']['zoneIndex'] = $ZoneTnIndex[0]->tn_qul_index;
					$result_data['schools_tn_qul_index']['allData'] = $allSchools;
					$result_data['schools_tn_qul_index']['topFive'] = $allSchoolsTop5;
					$result_data['schools_tn_qul_index']['middleFive'] = $allSchoolsMiddle5;
					$result_data['schools_tn_qul_index']['bottomFive'] = $allSchoolsBottom5; 
					
					$result_data['schools_tn_qul_index']['top'] = $allSchoolsTop3;
					$result_data['schools_tn_qul_index']['upperMiddle'] = $allSchoolsUpper3;
					$result_data['schools_tn_qul_index']['middle'] = $allSchoolsMiddle3; 
					$result_data['schools_tn_qul_index']['bottom'] = $allSchoolsBottom3; 
					
					$PercentageTop5 =  $this->Webapp_model->getSchoolPercentageVisitsTop5($districtId,$blockId,$zoneId,$month,$year);
					$PercentageBottom5 =  $this->Webapp_model->getSchoolPercentageVisitsBottom5($districtId,$blockId,$zoneId,$month,$year);
					$PercentageAll =  $this->Webapp_model->getSchoolPercentageVisits($districtId,$blockId,$zoneId,$month,$year);
					//$PercentageAllTargets =  $this->Webapp_model->getSchoolPercentageVisitsTargets($districtId,$blockId,$zoneId,$month,$year);
					
					$SchoolTarget =  $this->Webapp_model->getSchoolTarget();
					$TargetValue = $SchoolTarget[0]->value;
					if($PercentageTop5){
						for($i=0;$i<count($PercentageTop5);$i++){
							$Top5Percentage[$i]['SchoolName'] = $PercentageTop5[$i]->SchoolName;
							$values = $PercentageTop5[$i]->value;
							$Top5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageTop5 = false;
					}
					
					if($PercentageBottom5){ 
						for($i=0;$i<count($PercentageBottom5);$i++){
							$Bottom5Percentage[$i]['SchoolName'] = $PercentageBottom5[$i]->SchoolName;
							$values = $PercentageBottom5[$i]->value;
							$Bottom5Percentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
					}else{
						$PercentageBottom5 = false;
					}
					
					
					if($PercentageAll){
						for($i=0;$i<count($PercentageAll);$i++){
							$AllPercentage[$i]['SchoolName'] = $PercentageAll[$i]->SchoolName;
							$values = $PercentageAll[$i]->value;
							$AllPercentage[$i]['value'] = round(($values/$TargetValue) * 100);
						}
						
						if($AllPercentage){
							for($i=0;$i<count($AllPercentage);$i++){
								$averageData[] = $AllPercentage[$i]['value'];
							}
							$PercentageAvg = count($AllPercentage);
							$AvgValue = round(array_sum($averageData) / $PercentageAvg); 
						}
						
					}else{
						$PercentageAll = false;
					}
					
					
					
					$DistPercentageAll =  $this->Webapp_model->getDistPercentageVisits($month,$year);
					$distTarget =  $this->Webapp_model->getDistTarget();
					$DistTargetValue = $distTarget[0]->value;
					
					if($DistPercentageAll){
						for($i=0;$i<count($DistPercentageAll);$i++){
							$values = $DistPercentageAll[$i]->value;
							$DistAllPercentage[$i]['value'] = round(($values/$DistTargetValue) * 100);
						}
						
					}else{
						$DistPercentageAll = false;
					}
					
					if($DistAllPercentage){
						for($i=0;$i<count($DistAllPercentage);$i++){
							$TnaverageData[] = $DistAllPercentage[$i]['value'];
						}
						$TNPercentageAvg = count($DistAllPercentage);
						$TnAvgValue = round(array_sum($TnaverageData) / $TNPercentageAvg); 
					}
					
					
					$result_data['percentageOfVisits']['topFive'] = $Top5Percentage;
					$result_data['percentageOfVisits']['bottomFive'] = $Bottom5Percentage;
					$result_data['percentageOfVisits']['allData'] = $AllPercentage;
					$result_data['percentageOfVisits']['average'] = $AvgValue;
					$result_data['percentageOfVisits']['TnAverage'] = $TnAvgValue;
					
					$teachersPercentageTop5 =  $this->Webapp_model->getSchoolTeacherPercentageTop5($districtId,$blockId,$zoneId,$month,$year);
					$teachersPercentageBottom5 =  $this->Webapp_model->getSchoolTeacherPercentageBottom5($districtId,$blockId,$zoneId,$month,$year);
					$teachersPercentageAll =  $this->Webapp_model->getSchoolTeacherPercentage($districtId,$blockId,$zoneId,$month,$year);
					
					
					$result_data['percentageOfTeachers']['top5'] = $teachersPercentageTop5;
					$result_data['percentageOfTeachers']['bottom5'] = $teachersPercentageBottom5;
					$result_data['percentageOfTeachers']['allData'] = $teachersPercentageAll;
					$result_data['user_info'] = $user_info;
					
				}
				
				if($result_data){
						$data['dataStatus'] = true;
						$data['status'] = REST_Controller::HTTP_OK;
						$data['records'] = $result_data;
						$this->response($data,REST_Controller::HTTP_OK);
				}else{
					 $data['dataStatus'] = false;
					 $data['status'] = REST_Controller::HTTP_NOT_FOUND;
					 $data['msg'] = 'Subject Data Not Found!';
					 $this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'User Data Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			 $data['dataStatus'] = false;
			 $data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			 $data['msg'] = 'Invalid Request!';
			 $this->response($data,REST_Controller::HTTP_OK);
		}
		
	}
	
	public function getSubjectDataById_post(){

		$emis_username = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
		$class = ($this->post('class') && $this->post('class') != '') ? $this->post('class') : null;
		$date = ($this->post('date') && $this->post('date') != '') ? $this->post('date') : null;
		$getSubject = ($this->post('subject') && $this->post('subject') != '') ? $this->post('subject') : null;
		$user_type = ($this->post('usertype') && $this->post('usertype') != '') ? $this->post('usertype') : null;
		$districtId = ($this->post('district_id') && $this->post('district_id') != '') ? $this->post('district_id') : null;
		$blockId = ($this->post('block_id') && $this->post('block_id') != '') ? $this->post('block_id') : null;
		$zoneId = ($this->post('zone_id') && $this->post('zone_id') != '') ? $this->post('zone_id') : null;
		
		if(strlen($getSubject) != mb_strlen($getSubject, 'utf-8')){ 
			if($getSubject == 'தமிழ்'){
				$subject = 'tamil';
			}elseif($getSubject == 'ஆங்கிலம்'){
				$subject = 'english';
			}elseif($getSubject == 'கணிதம்'){
				$subject = 'maths';
			}elseif($getSubject == 'அறிவியல்'){
				$subject = 'science';
			}elseif($getSubject == 'சூழ்நிலையியல்'){
				$subject = 'evs';
			}else{
				$subject = 'social';
			}
		}else{
			$subject = $getSubject;
		}
		
		if($user_type != null && $emis_username != null && $date != null && $class != null && $subject != null ){
			$user_info = $this->Webapp_model->UserDetais($emis_username);
			$date_format = strtotime($date);
			$month = date('m', $date_format);
			$year = date('Y', $date_format);
			if($user_info){
				
				if($user_type == 'state' && $user_info->emis_username =='state' && $user_info->emis_usertype == 5){ //STATE or JD = District Data
					
					$getStateGradeData =  $this->Webapp_model->getStateGradeData($month,$year);
					if($getStateGradeData){
						$value = ''; 
						$subjectName = strtolower($subject);
						$count = count($getStateGradeData);
						for($i=0;$i<$count;$i++){
							$gradeData = json_decode($getStateGradeData[$i]->$subjectName);
							foreach($gradeData as $key){
								$classValue =  $key->class;
								if($classValue == $class){
									$value[$i]['DistName'] = $getStateGradeData[$i]->district_name;
									$value[$i]['DistId'] = $getStateGradeData[$i]->district_id;
									$value[$i]['a'] = $key->A;
									$value[$i]['b'] = $key->B;
									$value[$i]['c'] = $key->C;
									$value[$i]['d'] = $key->D;
								}
							}
						}
						
						$result_data['gradeData'] = $value;
					}else{
						$result_data['gradeData'] = false;
					}
					$result_data['view'] = 'StateView';

				}else if($user_type == 'district' && $districtId != null && $user_info->emis_username =='state' || $user_type == 'district' && $districtId != null && $user_info->user_type =='DEO' || $user_type == 'district' && $districtId != null && $user_info->user_type =='CEO'){ //DEO & CEO = District Data
					
					//state 5
					//DEO 10
					//CEO 9
					
					$getDistGradeData =  $this->Webapp_model->getDistGradeData($districtId,$month,$year);
					if($getDistGradeData){
						$value = array(); 
						$subjectName = strtolower($subject);
						$count = count($getDistGradeData);
						for($i=0;$i<$count;$i++){
							$gradeData = json_decode($getDistGradeData[$i]->$subjectName);
							foreach($gradeData as $key){
								$classValue =  $key->class;
								if($classValue == $class){
									$value[$i]['BlockName'] = $getDistGradeData[$i]->block_name;
									$value[$i]['BlockId'] = $getDistGradeData[$i]->block_id;
									$value[$i]['a'] = $key->A;
									$value[$i]['b'] = $key->B;
									$value[$i]['c'] = $key->C;
									$value[$i]['d'] = $key->D;
								}
							}
						}
						
						$result_data['gradeData'] = $value;
					}else{
						$result_data['gradeData'] = false;
					}
				
					$result_data['view'] = 'DistView';
			
			}else if($user_type == 'block' && $districtId != null && $blockId != null && $user_info->emis_username =='state' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='DEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='CEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='BEO' || $user_type == 'block' && $districtId != null && $blockId != null && $user_info->user_type =='TEACHER'){ //State & DEO & CEO & BEO & BRTE
					
					$getBlockGradeData =  $this->Webapp_model->getBlockGradeData($districtId,$blockId,$month,$year);
					if($getBlockGradeData){
						$value = array(); 
						$subjectName = strtolower($subject);
						$count = count($getBlockGradeData);
						for($i=0;$i<$count;$i++){
							$gradeData = json_decode($getBlockGradeData[$i]->$subjectName);
							foreach($gradeData as $key){
								$classValue =  $key->class;
								if($classValue == $class){
									$value[$i]['ZoneName'] = $getBlockGradeData[$i]->zone_name;
									$value[$i]['ZoneId'] = $getBlockGradeData[$i]->zone_id;
									$value[$i]['a'] = $key->A;
									$value[$i]['b'] = $key->B;
									$value[$i]['c'] = $key->C;
									$value[$i]['d'] = $key->D;
								}
							}
						}
						
						$result_data['gradeData'] = $value;
					}else{
						$result_data['gradeData'] = false;
					}
					
					$result_data['view'] = 'BlockView';
					
				}else if($user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->emis_username =='state' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='DEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='CEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='BEO' || $user_type == 'zone' && $districtId != null && $blockId != null && $zoneId != null && $user_info->user_type =='TEACHER'){ //State & DEO & CEO & BEO & BRTE
					
					//state 5
					//DEO 10
					//CEO 9
					//BEO 6
					//BRTE(TEACHER) 14
					
					$getZoneGradeData =  $this->Webapp_model->getZoneGradeData($districtId,$blockId,$zoneId,$month,$year);
					if($getZoneGradeData){
						$value = array(); 
						$subjectName = strtolower($subject);
						$count = count($getZoneGradeData);
						for($i=0;$i<$count;$i++){
							$gradeData = json_decode($getZoneGradeData[$i]->$subjectName);
							foreach($gradeData as $key){
								$classValue =  $key->class;
								if($classValue == $class){
									$value[$i]['SchoolName'] = $getZoneGradeData[$i]->school_name;
									$value[$i]['SchoolId'] = $getZoneGradeData[$i]->school_id;
									$value[$i]['a'] = $key->A;
									$value[$i]['b'] = $key->B;
									$value[$i]['c'] = $key->C;
									$value[$i]['d'] = $key->D;
								}
							}
						}
						
						$result_data['gradeData'] = $value;
					}else{
						$result_data['gradeData'] = false;
					}
					
					$result_data['view'] = 'ZoneView';
				}
				
				if($result_data){
						$data['dataStatus'] = true;
						$data['status'] = REST_Controller::HTTP_OK;
						$data['records'] = $result_data;
						$this->response($data,REST_Controller::HTTP_OK);
				}else{
					 $data['dataStatus'] = false;
					 $data['status'] = REST_Controller::HTTP_NOT_FOUND;
					 $data['msg'] = 'Subject Data Not Found!';
					 $this->response($data,REST_Controller::HTTP_OK);
				}
			}else{
				$data['dataStatus'] = false;
				$data['status'] = REST_Controller::HTTP_NOT_FOUND;
				$data['msg'] = 'User Data Not Found!';
				$this->response($data,REST_Controller::HTTP_OK);
			}
		}else{
			 $data['dataStatus'] = false;
			 $data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			 $data['msg'] = 'Invalid Request!';
			 $this->response($data,REST_Controller::HTTP_OK);
		}
		
	}
	
	public function getSearchResults_post(){
		$value = ($this->post('value') && $this->post('value') != '') ? $this->post('value') : null;
		$emis_usertype = ($this->post('usertype') && $this->post('usertype') != '') ? $this->post('usertype') : null;
		$emis_username = ($this->post('username') && $this->post('username') != '') ? $this->post('username') : null;
		
		$dist = array();
		$blocks = array();
		$nodals = array();
		$record = array();
		
		if($value != null && $emis_usertype != null && $emis_username != null){
			if($emis_usertype == 5){ //STATE
			
				$dist = $this->Webapp_model->getAllDistricts($value);
				$blocks = $this->Webapp_model->getAllBlocks($value);
				$nodals = $this->Webapp_model->getAllNodals($value);
				$record = array_merge($dist,$blocks,$nodals); 
				
			}else if($emis_usertype == 9 || $emis_usertype == 10){ //DEO & CEO District Data
				$user_info = $this->Webapp_model->UserInfoByDist($emis_username);
				if($user_info){
					$districtId = $user_info->district_id;
					$blocks = $this->Webapp_model->getAllBlocksByDist($districtId,$value);
					$nodals = $this->Webapp_model->getAllNodalsByDist($districtId,$value);
					$record = array_merge($blocks,$nodals); 
				}else{
					$record = 'Invalid Request';
				}
			}else if($emis_usertype == 6){ //BEO Block Data
				
				$user_info = $this->Webapp_model->UserInfoByDist($emis_username);
				if($user_info){
					$blockId = $user_info->block_id_from_dist;
					$nodals = $this->Webapp_model->getAllNodalsByBlock($blockId,$value);
					$record = array_merge($nodals); 
				}else{
					$record = 'Invalid Request';
				}
			}else if($emis_usertype == 14){ //BRTE Zone Data
				
			}
				
			
			if($record){
					$data['dataStatus'] = true;
					$data['status'] = REST_Controller::HTTP_OK;
					$data['records'] = $record;
					$this->response($data,REST_Controller::HTTP_OK);
			}else{
				 $data['dataStatus'] = false;
				 $data['status'] = REST_Controller::HTTP_NOT_FOUND;
				 $data['msg'] = 'Search Results Not Found!';
				 $this->response($data,REST_Controller::HTTP_OK);
			}		
		}else{
			$data['dataStatus'] = false;
			$data['status'] = REST_Controller::HTTP_BAD_REQUEST;
			$data['msg'] = 'Invalid Request!';
			$this->response($data,REST_Controller::HTTP_OK);
		}
		
	}
	

}