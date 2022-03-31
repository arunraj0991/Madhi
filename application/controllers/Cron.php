<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
ini_set('MAX_EXECUTION_TIME', '-1');
error_reporting(0);

class Cron extends REST_Controller{
  
    function __construct(){ // Construct the parent class
        parent::__construct();
        $this->load->model('Cron_model');
    }
	
	public function updateAllColumns_get(){

		$month = date('m');
		$year = date('Y');
		
		$currentMonth = $this->Cron_model->getCurrentMonthData($month,$year);
		
		if(!$currentMonth){ //Current month rows not available so insert new rows
		
			$subjectArray = [["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "1","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "2","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "3","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "4","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "5","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "6","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "7","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"],["A" => 0,"B" => 0,"C" => 0,"D" => 0,"class" => "8","total_students" => "0","no_a" => "0","no_b" => "0","no_c" => "0","no_d" => "0"]];
			
			$lessonPlanId = 1;
			$lessonPlanQuests = $this->Cron_model->getLessonPlanQuestionsIds($lessonPlanId);
			$lessonPlanInfo = $lessonPlanQuests->questions;
			
			$lessonExecutionId = 2;
			$lessonExecutionQuests = $this->Cron_model->getLessonExecutionQuestionsIds($lessonExecutionId);
			$lessonExecutionInfo = $lessonExecutionQuests->questions;
			
			$studentInteractionId = 3;
			$studentInteractionQuests = $this->Cron_model->getstudentInteractionQuestionsIds($studentInteractionId);
			$studentInteraction = $studentInteractionQuests->questions;
			
			$classManagementId = 4;
			$classManagementQuests = $this->Cron_model->getclassManagementQuestionsIds($classManagementId);
			$classManagement = $classManagementQuests->questions;
			
			$studentLearingId = 5;
			$studentLearingQuests = $this->Cron_model->getstudentLearingQuestionsIds($studentLearingId);
			$studentLearing = $studentLearingQuests->questions;
			
			$TeacherProDevId = 6;
			$TeacherProDevQuests = $this->Cron_model->getTeacherProDevQuestionsIds($TeacherProDevId);
			$TeacherProDev = $TeacherProDevQuests->questions;
			
			$dikshaId = 7;
			$dikshaQuests = $this->Cron_model->getdikshaQuestionsIds($dikshaId);
			$diksha = $dikshaQuests->questions;
			
			$getPrevMonth = date('Y-m', strtotime(date('Y-m')." -1 month"));
			$prevMonth =  date("m",strtotime($getPrevMonth));
			$monthOfYear =  date("Y",strtotime($getPrevMonth));
		
			//Districts
			$getDist = $this->Cron_model->getAllDist();
			$Distcount = count($getDist);
			
			for($i=0;$i<$Distcount;$i++){
				
				$PreviousFreqData = $this->Cron_model->getPrevFreqDistData($getDist[$i]->id,$prevMonth,$monthOfYear);
				$Oldfrequency = ($PreviousFreqData->frequency == null && $PreviousFreqData->frequency == '') ? 0 : $PreviousFreqData->frequency;
				
				$dist_data = array(
						'district_id' => $getDist[$i]->id,
						'district_name' =>  $getDist[$i]->district_name,
						'no_of_blocks' => 0,
						'user_type' =>  0,
						'no_of_observers' => 0,
						'no_of_schools' => 0,
						'no_of_teachers_observed' =>0,
						'no_of_students_assessed' =>0,
						'teachers_vacancy_percentage' => 0,
						'teachers_alloted_percentage' => 0,
						'total_teachers_percentage' => 0,
						'deputation_from_this' =>  0,
						'deputation_from_others' =>  0,
						'teachers_long_leave' =>  0,
						'available_percentage' =>  0,
						'unavailable_percentage' =>  0,
						'frequency' => $Oldfrequency,
						'tamil' =>  json_encode($subjectArray),
						'english' =>  json_encode($subjectArray),
						'evs' =>  json_encode($subjectArray),
						'science' =>  json_encode($subjectArray),
						'social' =>  json_encode($subjectArray),
						'maths' =>  json_encode($subjectArray),
						'tn_qul_index' =>0,
						'no_of_observation_percentage' =>0,
						'lesson_plan' =>0,
						'lesson_plan_info' => $lessonPlanInfo,
						'lesson_execution' =>0,
						'lesson_execution_info' => $lessonExecutionInfo,
						'stu_interaction' =>0,
						'stu_interaction_info' => $studentInteraction,
						'class_management' =>0,
						'class_mgmt_info' => $classManagement,
						'stu_learning' =>0,
						'stu_learning_info' => $studentLearing,
						'pro_dev' =>0,
						'pro_dev_info' => $TeacherProDev,
						'diksha' =>0,
						'diksha_info' => $diksha,
						'learning_outcome' =>0, 
						'wtd_avg' =>0
					);
					
				$dist_afected_rows[] = $this->Cron_model->updateDistData($dist_data);
			}
			
			//STATE
			$state_data = array(
						'district_id' => -1,
						'district_name' =>  'STATE',
						'no_of_blocks' => 0,
						'user_type' =>  0,
						'no_of_observers' => 0,
						'no_of_schools' => 0,
						'no_of_teachers_observed' =>0,
						'no_of_students_assessed' =>0,
						'teachers_vacancy_percentage' => 0,
						'teachers_alloted_percentage' => 0,
						'total_teachers_percentage' => 0,
						'deputation_from_this' =>  0,
						'deputation_from_others' =>  0,
						'teachers_long_leave' =>  0,
						'available_percentage' =>  0,
						'unavailable_percentage' =>  0,
						'frequency' => 0,
						'tamil' =>  json_encode($subjectArray),
						'english' =>  json_encode($subjectArray),
						'evs' =>  json_encode($subjectArray),
						'science' =>  json_encode($subjectArray),
						'social' =>  json_encode($subjectArray),
						'maths' =>  json_encode($subjectArray),
						'tn_qul_index' =>0,
						'no_of_observation_percentage' =>0,
						'lesson_plan' =>0,
						'lesson_plan_info' => $lessonPlanInfo,
						'lesson_execution' =>0,
						'lesson_execution_info' => $lessonExecutionInfo,
						'stu_interaction' =>0,
						'stu_interaction_info' => $studentInteraction,
						'class_management' =>0,
						'class_mgmt_info' => $classManagement,
						'stu_learning' =>0,
						'stu_learning_info' => $studentLearing,
						'pro_dev' =>0,
						'pro_dev_info' => $TeacherProDev,
						'diksha' =>0,
						'diksha_info' => $diksha,
						'learning_outcome' =>0, 
						'wtd_avg' =>0
					);
			$dist_afected_rows[] = $this->Cron_model->updateDistData($state_data);
		
			//Blocks
			$getBlocks = $this->Cron_model->getAllBlocks();
			$blocks_count = count($getBlocks);
			
			for($i=0;$i<$blocks_count;$i++){
				
				$PrevBlockFreqData = $this->Cron_model->getPrevFreqBlockData($getBlocks[$i]->district_id,$getBlocks[$i]->id,$prevMonth,$monthOfYear);
				$oldBlockfrequency = ($PrevBlockFreqData->frequency == null && $PrevBlockFreqData->frequency == '') ? 0 : $PrevBlockFreqData->frequency;
				
				$setDist = $this->Cron_model->getblocksDist($getBlocks[$i]->district_id);
				$blocks_data = array(
						'district_id' => $getBlocks[$i]->district_id,
						'district_name' =>  $setDist[0]->district_name,
						'block_id' => $getBlocks[$i]->id,
						'block_name' =>  $getBlocks[$i]->block_name,
						'no_of_zones' => 0,
						'user_type' =>  0,
						'no_of_observers' => 0,
						'no_of_schools' => 0,
						'no_of_teachers_observed' =>0,
						'no_of_students_assessed' =>0,
						'teachers_vacancy_percentage' => 0,
						'teachers_alloted_percentage' => 0,
						'total_teachers_percentage' => 0,
						'deputation_from_this' =>  0,
						'deputation_from_others' =>  0,
						'teachers_long_leave' =>  0,
						'available_percentage' =>  0,
						'unavailable_percentage' =>  0,
						'frequency' => $oldBlockfrequency,
						'tamil' =>  json_encode($subjectArray),
						'english' =>  json_encode($subjectArray),
						'evs' =>  json_encode($subjectArray),
						'science' =>  json_encode($subjectArray),
						'social' =>  json_encode($subjectArray),
						'maths' =>  json_encode($subjectArray),
						'tn_qul_index' =>0,
						'no_of_observation_percentage' =>0,
						'lesson_plan' =>0,
						'lesson_plan_info' => $lessonPlanInfo,
						'lesson_execution' =>0,
						'lesson_execution_info' => $lessonExecutionInfo,
						'stu_interaction' =>0,
						'stu_interaction_info' => $studentInteraction,
						'class_management' =>0,
						'class_mgmt_info' => $classManagement,
						'stu_learning' =>0,
						'stu_learning_info' => $studentLearing,
						'pro_dev' =>0,
						'pro_dev_info' => $TeacherProDev,
						'diksha' =>0,
						'diksha_info' => $diksha,
						'learning_outcome' =>0, 
						'wtd_avg' =>0
					);
					
				$blocks_afected_rows[] = $this->Cron_model->updateBlocksData($blocks_data);
			}
		
			//Zones
			$getZones = $this->Cron_model->getAllZones();
			$zones_count = count($getZones);
			
			for($i=0;$i<$zones_count;$i++){
				
				$PrevFreqZoneData = $this->Cron_model->getPrevFreqZoneData($getZones[$i]->district_id,$getZones[$i]->block_id,$getZones[$i]->zone_id,$prevMonth,$monthOfYear);
				$oldZonefrequency = ($PrevFreqZoneData->frequency == null && $PrevFreqZoneData->frequency == '') ? 0 : $PrevFreqZoneData->frequency;
				
				$zones_data = array(
						'district_id' => $getZones[$i]->district_id,
						'district_name' =>  $getZones[$i]->district_name,
						'block_id' => $getZones[$i]->block_id,
						'block_name' =>  $getZones[$i]->block_name,
						'zone_id' => $getZones[$i]->zone_id,
						'zone_name' =>  $getZones[$i]->zone_name,
						'user_type' =>  'state',
						'no_of_observers' => 0,
						'no_of_schools' => 0,
						'no_of_teachers_observed' =>0,
						'no_of_students_assessed' =>0,
						'teachers_vacancy_percentage' => 0,
						'teachers_alloted_percentage' => 0,
						'total_teachers_percentage' => 0,
						'deputation_from_this' =>  0,
						'deputation_from_others' =>  0,
						'teachers_long_leave' =>  0,
						'available_percentage' =>  0,
						'unavailable_percentage' =>  0,
						'frequency' => $oldZonefrequency,
						'tamil' =>  json_encode($subjectArray),
						'english' =>  json_encode($subjectArray),
						'evs' =>  json_encode($subjectArray),
						'science' =>  json_encode($subjectArray),
						'social' =>  json_encode($subjectArray),
						'maths' =>  json_encode($subjectArray),
						'tn_qul_index' =>0,
						'no_of_observation_percentage' =>0,
						'lesson_plan' =>0,
						'lesson_plan_info' => $lessonPlanInfo,
						'lesson_execution' =>0,
						'lesson_execution_info' => $lessonExecutionInfo,
						'stu_interaction' =>0,
						'stu_interaction_info' => $studentInteraction,
						'class_management' =>0,
						'class_mgmt_info' => $classManagement,
						'stu_learning' =>0,
						'stu_learning_info' => $studentLearing,
						'pro_dev' =>0,
						'pro_dev_info' => $TeacherProDev,
						'diksha' =>0,
						'diksha_info' => $diksha,
						'learning_outcome' =>0, 
						'wtd_avg' =>0
					);
					
				$zones_afected_rows[] = $this->Cron_model->updateZonesData($zones_data);
			}
		
			//Schools
			$getSchools = $this->Cron_model->getAllSchools();
			$school_count = count($getSchools);
			
			for($i=0;$i<$school_count;$i++){
				$setDist = $this->Cron_model->getblocksDist($getSchools[$i]->district_id);
				$setBlockName = $this->Cron_model->getblocksName($getSchools[$i]->block_id);
				$getZonesById =  $this->Cron_model->getZonesById($getSchools[$i]->district_id,$getSchools[$i]->block_id,$getSchools[$i]->school_id);
				
				$PrevFreqSklData = $this->Cron_model->getPrevFreqSchool($getSchools[$i]->district_id,$getSchools[$i]->block_id,$getZonesById[0]->zone_id,$getSchools[$i]->school_id,$prevMonth,$monthOfYear);
				$OldfreqSchool = ($PrevFreqSklData->frequency == null && $PrevFreqSklData->frequency == '') ? 0 : $PrevFreqSklData->frequency;
				
				$school_data = array(
						'district_id' => $getSchools[$i]->district_id,
						'district_name' =>  $setDist[0]->district_name,
						'block_id' => $getSchools[$i]->block_id,
						'block_name' =>  $setBlockName[0]->block_name,
						'zone_id' => $getZonesById[0]->zone_id,
						'zone_name' =>  $getZonesById[0]->zone_name,
						'school_id' => $getSchools[$i]->school_id,
						'school_name' =>  $getSchools[$i]->school_name,
						'user_type' =>  'state',
						'no_of_schools' => 0,
						'no_of_observers' => 0,
						'no_of_teachers_observed' =>0,
						'no_of_schools' => 0,
						'no_of_students_assessed' =>0,
						'teachers_vacancy_percentage' => 0,
						'teachers_alloted_percentage' => 0,
						'total_teachers_percentage' => 0,
						'deputation_from_this' =>  0,
						'deputation_from_others' =>  0,
						'teachers_long_leave' =>  0,
						'available_percentage' =>  0,
						'unavailable_percentage' =>  0,
						'frequency' => $OldfreqSchool,
						'tamil' =>  json_encode($subjectArray),
						'english' =>  json_encode($subjectArray),
						'evs' =>  json_encode($subjectArray),
						'science' =>  json_encode($subjectArray),
						'social' =>  json_encode($subjectArray),
						'maths' =>  json_encode($subjectArray),
						'tn_qul_index' =>0,
						'no_of_observation_percentage' =>0,
						'lesson_plan' =>0,
						'lesson_plan_info' => $lessonPlanInfo,
						'lesson_execution' =>0,
						'lesson_execution_info' => $lessonExecutionInfo,
						'stu_interaction' =>0,
						'stu_interaction_info' => $studentInteraction,
						'class_management' =>0,
						'class_mgmt_info' => $classManagement,
						'stu_learning' =>0,
						'stu_learning_info' => $studentLearing,
						'pro_dev' =>0,
						'pro_dev_info' => $TeacherProDev,
						'diksha' =>0,
						'diksha_info' => $diksha,
						'learning_outcome' =>0, 
						'wtd_avg' =>0
					);
					
				$schools_afected_rows[] = $this->Cron_model->updateSchoolsData($school_data);
			}
		}
		
		$getRows = $this->Cron_model->getAllPendingRows();
		if($getRows){
			//District
			$rows_count = count($getRows);
			for($i=0;$i<$rows_count;$i++){
				$schoolObsId	= $getRows[$i]->school_observation_id;
				$processStatus = array('process_status' => 2); //2 enum=> 1 Processing
				$setProcess 	= $this->Cron_model->setProcessingStatus($processStatus,$schoolObsId);
				
				
				$createdon 		= $getRows[$i]->createdon;
				$createdby 		= $getRows[$i]->createdby;
				$school_id 		= $getRows[$i]->school_id;
				$school_name 	= $getRows[$i]->school_name;
				$block_id 		= $getRows[$i]->block_id;
				$block_name 	= $getRows[$i]->block_name;
				$class 			= $getRows[$i]->class;
				$district_id 	= $getRows[$i]->district_id;
				$district_name 	= $getRows[$i]->district_name;
				$teacher_emisid = $getRows[$i]->teacher_emisid;
				$teacher_name	= $getRows[$i]->teacher_name;
				$json 			= $getRows[$i]->json;
				$value = json_decode($json,true);
				
				foreach($value as $key){
					$zone_id = $key['basic_info']['nodal_id'];
					$zone_name = $key['basic_info']['nodal_name'];
					$teacherSanctioned = $key['basic_info']['teacherSanctioned'];
					$teachersAvailable = $key['basic_info']['teachersAvailable'];
					$deputationThis = $key['basic_info']['teachersDeputationSameSchool'];
					$deputationOthers = $key['basic_info']['teachersDeputationOtherSchool'];
					$teacherLongLeave = $key['basic_info']['teachersOnLongLeave'];
					$getSubject = $key['learning_outcome_data']['subject'];
					$question_data = $key['learning_outcome_data']['question_data'];
					$observation_data = $key['observation_data'];
					$StudentsObserved = count($key['learning_outcome_data']['question_data']);
					foreach($question_data as $datas){
						if($datas['grade'] == null){
							$grades = null;
						}else{
							$grades[] = $datas['grade'];
						}
					}
					if(is_array($grades)){
						$grade_count = implode($grades);
						$A_count = ($grades == 0 && $grades == null) ? 0 : substr_count($grade_count,"A");
						$B_count = ($grades == 0 && $grades == null) ? 0 : substr_count($grade_count,"B");
						$C_count = ($grades == 0 && $grades == null) ? 0 : substr_count($grade_count,"C");
						$D_count = ($grades == 0 && $grades == null) ? 0 : substr_count($grade_count,"D");
					}else{
						$A_count =  0;
						$B_count =  0;
						$C_count =  0;
						$D_count =  0;
					}
				}
				
				if($observation_data){
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
					
					if($getSubject == 'Social Science'){
						$subject = 'social';
					}
					
					$distTeachPercentageBottom5 =  $this->Cron_model->getDistTeacherPercentageBottom5($month,$year);
					$distTeachPercentageBottom5ss[] =  $this->Cron_model->getDistTeacherPercentageBottom5($month,$year);
					if($distTeachPercentageBottom5){
						for($k=0;$k<count($distTeachPercentageBottom5);$k++){
							$oldFrequencyDist =  $this->Cron_model->getOldDistFreqData($distTeachPercentageBottom5[$k]->district_id,$month,$year);
							$newFreqDist = $oldFrequencyDist->frequency + 1;
							$FreqDistData = array('frequency' => $newFreqDist);
							$updateDistFreq = $this->Cron_model->updateFreqDistValue($FreqDistData,$distTeachPercentageBottom5[$k]->district_id,$month,$year);
						}
					}
					
					$blockTeachBottom5 =  $this->Cron_model->getBlockTeacherPercentageBottom5($district_id,$month,$year);
					if($blockTeachBottom5){
						for($j=0;$j<count($blockTeachBottom5);$j++){
							$oldFrequencyBlock =  $this->Cron_model->getOldBlockFreqData($blockTeachBottom5[$j]->district_id,$blockTeachBottom5[$j]->block_id,$month,$year);
							$newFreqBlock = $oldFrequencyBlock->frequency + 1;
							$FreqBlockData = array('frequency' => $newFreqBlock);
							$updateBlockFreq = $this->Cron_model->updateFreqBlockValue($FreqBlockData,$blockTeachBottom5[$j]->district_id,$blockTeachBottom5[$j]->block_id,$month,$year);
						}
					}
					
					$zoneTeachBottom5 =  $this->Cron_model->getZoneTeacherPercentageBottom5($district_id,$block_id,$month,$year);
					if($zoneTeachBottom5){
						for($m=0;$m<count($zoneTeachBottom5);$m++){
							$oldFrequencyZone =  $this->Cron_model->getOldZoneFreqData($zoneTeachBottom5[$m]->district_id,$zoneTeachBottom5[$m]->block_id,$zoneTeachBottom5[$m]->zone_id,$month,$year);
							$newFreqZone = $oldFrequencyZone->frequency + 1;
							$FreqZoneData = array('frequency' => $newFreqZone);
							$updateZoneFreq = $this->Cron_model->updateFreqZoneValue($FreqZoneData,$zoneTeachBottom5[$m]->district_id,$zoneTeachBottom5[$m]->block_id,$zoneTeachBottom5[$m]->zone_id,$month,$year);
						}
					}
					
					$schoolTeachBottom5 =  $this->Cron_model->getSchoolTeacherPercentageBottom5($district_id,$block_id,$zone_id,$month,$year);
					if($schoolTeachBottom5){
						for($n=0;$n<count($schoolTeachBottom5);$n++){
							$oldFrequencySchool =  $this->Cron_model->getOldSchoolFreqData($schoolTeachBottom5[$n]->district_id,$schoolTeachBottom5[$n]->block_id,$schoolTeachBottom5[$n]->zone_id,$schoolTeachBottom5[$n]->school_id,$month,$year);
							$newFreqSchool = $oldFrequencySchool->frequency + 1;
							$FreqSchoolData = array('frequency' => $newFreqSchool);
							$updateSchoolFreq = $this->Cron_model->updateFreqSchoolValue($FreqSchoolData,$schoolTeachBottom5[$n]->district_id,$schoolTeachBottom5[$n]->block_id,$schoolTeachBottom5[$n]->zone_id,$schoolTeachBottom5[$n]->school_id,$month,$year);
						}
					}
					
					$distTargets = $this->Cron_model->getAllDistTargets($district_id); //Same target for dist, block and zone
					$target = $distTargets[0]->target_value;
					
					$Blocks = $this->Cron_model->getblocksByDist($district_id);
					$noOfBlocks = $Blocks[0]->blocks; 
					
					$observers = $this->Cron_model->getBrtesByDist($district_id);
					$noOfObservers = $observers->brtes; 

					$schools = $this->Cron_model->getSchoolsByDist($district_id);
					$noOfSchools = $schools->schools;
					
					//Get District Data
					$getDistRecords = $this->Cron_model->getDistrictData($district_id,$month,$year);
					if($getDistRecords){
						$noOfTeachersObserved = $getDistRecords[0]->no_of_teachers_observed;
						$StudentsAssessed = $getDistRecords[0]->no_of_students_assessed;
						$oldTeacherVacancy = $getDistRecords[0]->teachers_vacancy_percentage;
						$oldTeacherAlloted = $getDistRecords[0]->teachers_alloted_percentage;
						$oldTeacherTotal = $getDistRecords[0]->total_teachers_percentage;
						$oldTnQualIndex = $getDistRecords[0]->tn_qul_index;
						$oldDebutationThis = $getDistRecords[0]->deputation_from_this;
						$oldDebutationOthers = $getDistRecords[0]->deputation_from_others;
						$oldLongLeave = $getDistRecords[0]->teachers_long_leave;
						$oldFrequency = $getDistRecords[0]->frequency;
						
						$newTeacherVacancy = $oldTeacherVacancy + ($teacherSanctioned - $teachersAvailable);
						$newTeacherAlloted = $oldTeacherAlloted + $teacherSanctioned;
						$newTotalTeacher = $oldTeacherTotal + $teachersAvailable;
						
						$NewDebutationThis = $oldDebutationThis + $deputationThis;
						$NewDebutationOthers = $oldDebutationOthers + $deputationOthers;
						$NewLongLeave = $oldLongLeave + $teacherLongLeave;
						
						$ETS = ($newTotalTeacher - $NewDebutationThis) + ($NewDebutationOthers - $NewLongLeave);
						if($ETS == 0){
							$TeacherAvailable = 0;
						}else{
							$TeacherAvailable = round(($ETS / $newTeacherAlloted) * 100);
						}
						$TeacherUnAvailable = (100 - $TeacherAvailable);
						
						$strlower = strtolower($subject);
						$selectedSubjectData = $getDistRecords[0]->$strlower;
						$subjectData = json_decode($selectedSubjectData);
						
						foreach($subjectData as $keys){
							$gradesValue = $keys->class;
							if($gradesValue == $class){
								
								$noOfA = $keys->no_a + $A_count;
								$noOfB = $keys->no_b + $B_count;
								$noOfC = $keys->no_c + $C_count;
								$noOfD = $keys->no_d + $D_count;
								$totStudents =  $keys->total_students + $StudentsObserved;
								$AValue = round($noOfA / $totStudents * 100);
								$BValue = round($noOfB / $totStudents * 100);
								$CValue = round($noOfC / $totStudents * 100);
								$DValue = round($noOfD / $totStudents * 100);
								$subjectDataNew = array(
										'A'				=>  $AValue,
										'B'				=>  $BValue,
										'C'				=>  $CValue,
										'D'				=>  $DValue,
										'class'			=>  $keys->class,
										'total_students'=>  $totStudents,
										'no_a'			=>  $noOfA,
										'no_b'			=>  $noOfB,
										'no_c'			=>  $noOfC,
										'no_d'			=>  $noOfD,
								);
								$subjectData[$class - 1] = $subjectDataNew;
							}
						}
						
						$NewNoOfTeachersObserved = ($noOfTeachersObserved == 0 && $noOfTeachersObserved == '') ? 1 : $noOfTeachersObserved + 1;
						$NewStudentsAssessed = ($StudentsAssessed == 0 && $StudentsAssessed == '') ? $StudentsObserved : $StudentsAssessed + $StudentsObserved;
						
						$DistPreobservation =  $this->getpreObservation($observation_data,$getDistRecords);
						$DistLessonPlanPercentage =  $this->lessonPlanPercentage($DistPreobservation,$NewNoOfTeachersObserved,$getDistRecords[0]->lesson_plan);
						
						$DistLesson_execution =  $this->getLessonExecution($observation_data,$getDistRecords);
						$DistLessonExecutionPercentage =  $this->lessonExecutionPercentage($DistLesson_execution,$NewNoOfTeachersObserved,$getDistRecords[0]->lesson_execution,$observation_data);
						
						$DistStuInteraction =  $this->getStudentInteraction($observation_data,$getDistRecords);
						$DistStuInteractionPercentage =  $this->StuInteractionPercentage($DistStuInteraction,$NewNoOfTeachersObserved,$getDistRecords[0]->stu_interaction);

						$DistClassManagement =  $this->getClassManagement($observation_data,$getDistRecords);
						$DistClassMgmtPercentage =  $this->ClassMgmtPercentage($DistClassManagement,$NewNoOfTeachersObserved,$getDistRecords[0]->class_management);

						$DistStuLearning =  $this->getStudentLearning($observation_data,$getDistRecords);
						$DistStuLearningPercentage =  $this->stuLearningPercentage($DistStuLearning,$NewNoOfTeachersObserved,$getDistRecords[0]->stu_learning,$observation_data);

						$DistProDev =  $this->getProfessionalDevelopment($observation_data,$getDistRecords);
						$DistProDevPercentage =  $this->proDevPercentage($DistProDev,$NewNoOfTeachersObserved,$getDistRecords[0]->pro_dev);

						$DistDiksha =  $this->getDiksha($observation_data,$getDistRecords);
						$DistDikshaPercentage =  $this->DikshaPercentage($DistDiksha,$NewNoOfTeachersObserved,$getDistRecords[0]->diksha);
						
						$DistLearningOutcome = $this->getLearningOutcome($getDistRecords,$A_count,$B_count,$C_count,$D_count,$StudentsObserved); 
					
						$DistTnQulIndex = $this->getQualIndexValue($DistLessonPlanPercentage,$DistLessonExecutionPercentage,$DistStuInteractionPercentage,$DistClassMgmtPercentage,$DistStuLearningPercentage,$DistProDevPercentage,$DistDikshaPercentage,$DistLearningOutcome,$oldTnQualIndex);

						$districtData = array(  
							'no_of_blocks'	=> $noOfBlocks,
							'createdon' 	=> $createdon,
							'no_of_observers' 	=> $noOfObservers,
							'no_of_schools' 	=> $noOfSchools,
							'no_of_teachers_observed' =>  $NewNoOfTeachersObserved,
							'no_of_students_assessed' =>  $NewStudentsAssessed,
							'teachers_vacancy_percentage' =>  $newTeacherVacancy,
							'teachers_alloted_percentage' =>  $newTeacherAlloted,
							'total_teachers_percentage' =>  $newTotalTeacher,
							'deputation_from_this' =>  $NewDebutationThis,
							'deputation_from_others' =>  $NewDebutationOthers,
							'teachers_long_leave' =>  $NewLongLeave,
							'available_percentage' =>  $TeacherAvailable,
							'unavailable_percentage' =>  $TeacherUnAvailable,
							$strlower =>  json_encode($subjectData),
							'tn_qul_index' => $DistTnQulIndex,
							'lesson_plan' =>$DistLessonPlanPercentage,
							'lesson_plan_info' =>json_encode(array($DistPreobservation)),
							'lesson_execution' => $DistLessonExecutionPercentage,
							'lesson_execution_info' =>json_encode(array($DistLesson_execution)),
							'stu_interaction' => $DistStuInteractionPercentage,
							'stu_interaction_info' =>json_encode(array($DistStuInteraction)),
							'class_management' => $DistClassMgmtPercentage,
							'class_mgmt_info' =>json_encode(array($DistClassManagement)),
							'stu_learning' => $DistStuLearningPercentage,
							'stu_learning_info' =>json_encode(array($DistStuLearning)),
							'pro_dev' => $DistProDevPercentage,
							'pro_dev_info' =>json_encode(array($DistProDev)),
							'diksha' => $DistDikshaPercentage,
							'diksha_info' =>json_encode(array($DistDiksha)),
							'learning_outcome' => $DistLearningOutcome
							
						); 
						$finalDistData[] =  $districtData;
						$district_updates = $this->Cron_model->updateDistrict($districtData,$district_id,$month,$year);
					}
					
					//Block
					$Zones = $this->Cron_model->getZonesByDistBlock($district_id,$block_id);
					$noOfZones = $Zones->zone_name; 
					$Zoneobservers = $this->Cron_model->getBrtesByDistBlock($district_id,$block_id);
					$ZoneobserversCount = $Zoneobservers->brtes; 
					$Zoneschools = $this->Cron_model->getSchoolsByDistBlock($district_id,$block_id);
					$ZoneschoolsCount = $Zoneschools->schools;
					
					//Get Block Data
					$getBlockRecords = $this->Cron_model->getBlockData($district_id,$block_id,$month,$year);
					if($getBlockRecords){
						$noOfTeachersObservedBlocks = $getBlockRecords[0]->no_of_teachers_observed;
						$StudentsAssessedBlocks = $getBlockRecords[0]->no_of_students_assessed;
						
						$oldTeacherVacancyBlocks = $getBlockRecords[0]->teachers_vacancy_percentage;
						$oldTeacherAllotedBlocks = $getBlockRecords[0]->teachers_alloted_percentage;
						$oldTeacherTotalBlocks = $getBlockRecords[0]->total_teachers_percentage;
						$oldTnQualIndexBlocks = $getBlockRecords[0]->tn_qul_index;
						$oldDebutationThisBlocks = $getBlockRecords[0]->deputation_from_this;
						$oldDebutationOthersBlocks = $getBlockRecords[0]->deputation_from_others;
						$oldLongLeaveBlocks = $getBlockRecords[0]->teachers_long_leave;
						$oldFrequencyBlocks = $getBlockRecords[0]->frequency;
						
						$newTeacherVacancyBlocks = $oldTeacherVacancyBlocks + ($teacherSanctioned - $teachersAvailable);
						$newTeacherAllotedBlocks = $oldTeacherAllotedBlocks + $teacherSanctioned;
						$newTotalTeacherBlocks = $oldTeacherTotalBlocks + $teachersAvailable;
						
						$NewDebutationThisBlocks = $oldDebutationThisBlocks + $deputationThis;
						$NewDebutationOthersBlocks = $oldDebutationOthersBlocks + $deputationOthers;
						$NewLongLeaveBlocks = $oldLongLeaveBlocks + $teacherLongLeave;
						
						$ETSblocks = ($newTotalTeacherBlocks - $NewDebutationThisBlocks) + ($NewDebutationOthersBlocks - $NewLongLeaveBlocks);
						if($ETSblocks == 0){
							$TeacherAvailableBlocks = 0;
						}else{
							$TeacherAvailableBlocks = round(($ETSblocks / $newTeacherAllotedBlocks) * 100);
						}
						$TeacherUnAvailableBlocks = (100 - $TeacherAvailableBlocks);
						
						$strlowerBlock = strtolower($subject);
						$selectedSubjectDataBlock = $getBlockRecords[0]->$strlowerBlock;
						$subjectDataBlock = json_decode($selectedSubjectDataBlock);
						
						foreach($subjectDataBlock as $Blockkeys){
							$gradesValueBlock = $Blockkeys->class;
							if($gradesValueBlock == $class){
								
								$noOfBlockA = $Blockkeys->no_a + $A_count;
								$noOfBlockB = $Blockkeys->no_b + $B_count;
								$noOfBlockC = $Blockkeys->no_c + $C_count;
								$noOfBlockD = $Blockkeys->no_d + $D_count;
								$totBlockStudents =  $Blockkeys->total_students + $StudentsObserved;
								$BlockAValue = round($noOfBlockA / $totBlockStudents * 100);
								$BlockBValue = round($noOfBlockB / $totBlockStudents * 100);
								$BlockCValue = round($noOfBlockC / $totBlockStudents * 100);
								$BlockDValue = round($noOfBlockD / $totBlockStudents * 100);
								$subjectDataNewBlock = array(
										'A'				=>  $BlockAValue,
										'B'				=>  $BlockBValue,
										'C'				=>  $BlockCValue,
										'D'				=>  $BlockDValue,
										'class'			=>  $Blockkeys->class,
										'total_students'=>  $totBlockStudents,
										'no_a'			=>  $noOfBlockA,
										'no_b'			=>  $noOfBlockB,
										'no_c'			=>  $noOfBlockC,
										'no_d'			=>  $noOfBlockD,
								);
								$subjectDataBlock[$class - 1] = $subjectDataNewBlock;
							}
						}
						
						$NewNoOfTeachersObservedBlock = ($noOfTeachersObservedBlocks == 0 && $noOfTeachersObservedBlocks == '') ? 1 : $noOfTeachersObservedBlocks + 1;
						$NewStudentsAssessedBlock = ($StudentsAssessedBlocks == 0 && $StudentsAssessedBlocks == '') ? $StudentsObserved : $StudentsAssessedBlocks + $StudentsObserved;
						
						$BlockPreobservation =  $this->getpreObservation($observation_data,$getBlockRecords);
						$BlockLessonPlanPercentage =  $this->lessonPlanPercentage($BlockPreobservation,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->lesson_plan);
						
						$BlockLesson_execution =  $this->getLessonExecution($observation_data,$getBlockRecords);
						$BlockLessonExecutionPercentage =  $this->lessonExecutionPercentage($BlockLesson_execution,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->lesson_execution,$observation_data);
						
						$BlockStuInteraction =  $this->getStudentInteraction($observation_data,$getBlockRecords);
						$BlockStuInteractionPercentage =  $this->StuInteractionPercentage($BlockStuInteraction,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->stu_interaction);

						$BlockClassManagement =  $this->getClassManagement($observation_data,$getBlockRecords);
						$BlockClassMgmtPercentage =  $this->ClassMgmtPercentage($BlockClassManagement,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->class_management);

						$BlockStuLearning =  $this->getStudentLearning($observation_data,$getBlockRecords);
						$BlockStuLearningPercentage =  $this->stuLearningPercentage($BlockStuLearning,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->stu_learning,$observation_data);

						$BlockProDev =  $this->getProfessionalDevelopment($observation_data,$getBlockRecords);
						$BlockProDevPercentage =  $this->proDevPercentage($BlockProDev,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->pro_dev);

						$BlockDiksha =  $this->getDiksha($observation_data,$getBlockRecords);
						$BlockDikshaPercentage =  $this->DikshaPercentage($BlockDiksha,$NewNoOfTeachersObservedBlock,$getBlockRecords[0]->diksha);
						
						$BlockLearningOutcome = $this->getLearningOutcome($getBlockRecords,$A_count,$B_count,$C_count,$D_count,$StudentsObserved);
						
						$BlocktnQulIndex = $this->getQualIndexValue($BlockLessonPlanPercentage,$BlockLessonExecutionPercentage,$BlockStuInteractionPercentage,$BlockClassMgmtPercentage,$BlockStuLearningPercentage,$BlockProDevPercentage,$BlockDikshaPercentage,$BlockLearningOutcome,$oldTnQualIndexBlocks);

						$BlockData = array(
							'no_of_zones'	=> $noOfZones,
							'createdon' 	=> $createdon,
							'no_of_observers' 	=> $ZoneobserversCount,
							'no_of_schools' 	=> $ZoneschoolsCount,
							'no_of_teachers_observed' =>  $NewNoOfTeachersObservedBlock,
							'no_of_students_assessed' =>  $NewStudentsAssessedBlock,
							'teachers_vacancy_percentage' =>  $newTeacherVacancyBlocks,
							'teachers_alloted_percentage' =>  $newTeacherAllotedBlocks,
							'total_teachers_percentage' =>  $newTotalTeacherBlocks,
							'deputation_from_this' =>  $NewDebutationThisBlocks,
							'deputation_from_others' =>  $NewDebutationOthersBlocks,
							'teachers_long_leave' =>  $NewLongLeaveBlocks,
							'available_percentage' =>  $TeacherAvailableBlocks,
							'unavailable_percentage' =>  $TeacherUnAvailableBlocks,
							$strlowerBlock =>  json_encode($subjectDataBlock),
							'tn_qul_index' => $BlocktnQulIndex,
							'lesson_plan' =>$BlockLessonPlanPercentage,
							'lesson_plan_info' =>json_encode(array($BlockPreobservation)),
							'lesson_execution' => $BlockLessonExecutionPercentage,
							'lesson_execution_info' =>json_encode(array($BlockLesson_execution)),
							'stu_interaction' => $BlockStuInteractionPercentage,
							'stu_interaction_info' =>json_encode(array($BlockStuInteraction)),
							'class_management' => $BlockClassMgmtPercentage,
							'class_mgmt_info' =>json_encode(array($BlockClassManagement)),
							'stu_learning' => $BlockStuLearningPercentage,
							'stu_learning_info' =>json_encode(array($BlockStuLearning)),
							'pro_dev' => $BlockProDevPercentage,
							'pro_dev_info' =>json_encode(array($BlockProDev)),
							'diksha' => $BlockDikshaPercentage,
							'diksha_info' =>json_encode(array($BlockDiksha)),
							'learning_outcome' => $BlockLearningOutcome
						);
						
						$finalBlockData[] =  $BlockData;
						$block_updates = $this->Cron_model->updateBlock($BlockData,$district_id,$block_id,$month,$year);
					}
					
					
					//Zones
					$Schools = $this->Cron_model->getSchoolsByDistBlockZone($district_id,$block_id,$zone_id);
					$noOfSchoolsInZone = $Schools->school_name; 
					
					$Schoolobservers = $this->Cron_model->getBrtesByDistBlockZone($district_id,$block_id,$zone_id);
					$SchoolobserversCount = $Schoolobservers->brtes; 
					
					//Get Zone Data
					$getZoneRecords = $this->Cron_model->getZonesData($district_id,$block_id,$zone_id,$month,$year);
					if($getZoneRecords){
						$noOfTeachersObservedZones = $getZoneRecords[0]->no_of_teachers_observed;
						$StudentsAssessedZones = $getZoneRecords[0]->no_of_students_assessed;
						
						$oldTeacherVacancyZones = $getZoneRecords[0]->teachers_vacancy_percentage;
						$oldTeacherAllotedZones = $getZoneRecords[0]->teachers_alloted_percentage;
						$oldTeacherTotalZones = $getZoneRecords[0]->total_teachers_percentage;
						$oldTnQualIndexZones = $getZoneRecords[0]->tn_qul_index;
						$oldDebutationThisZones = $getZoneRecords[0]->deputation_from_this;
						$oldDebutationOthersZones = $getZoneRecords[0]->deputation_from_others;
						$oldLongLeaveZones = $getZoneRecords[0]->teachers_long_leave;
						
						$newTeacherVacancyZones = $oldTeacherVacancyZones + ($teacherSanctioned - $teachersAvailable);
						$newTeacherAllotedZones = $oldTeacherAllotedZones + $teacherSanctioned;
						$newTotalTeacherZones = $oldTeacherTotalZones + $teachersAvailable;
						
						$NewDebutationThisZones = $oldDebutationThisZones + $deputationThis;
						$NewDebutationOthersZones = $oldDebutationOthersZones + $deputationOthers;
						$NewLongLeaveZones = $oldLongLeaveZones + $teacherLongLeave;
						
						$ETSzones = ($newTotalTeacherZones - $NewDebutationThisZones) + ($NewDebutationOthersZones - $NewLongLeaveZones);
						if($ETSzones == 0){
							$TeacherAvailableZones = 0;
						}else{
							$TeacherAvailableZones = round(($ETSzones / $newTeacherAllotedZones) * 100);
						}
						$TeacherUnAvailableZones = (100 - $TeacherAvailableZones);
						
						$strlowerZone = strtolower($subject);
						$selectedSubjectDataZone = $getZoneRecords[0]->$strlowerZone;
						$subjectDataZone = json_decode($selectedSubjectDataZone);
						
						foreach($subjectDataZone as $Zonekeys){
							$gradesValueZone = $Zonekeys->class;
							if($gradesValueZone == $class){
								
								$noOfZoneA = $Zonekeys->no_a + $A_count;
								$noOfZoneB = $Zonekeys->no_b + $B_count;
								$noOfZoneC = $Zonekeys->no_c + $C_count;
								$noOfZoneD = $Zonekeys->no_d + $D_count;
								$totZoneStudents =  $Zonekeys->total_students + $StudentsObserved;
								$ZoneAValue = round($noOfZoneA / $totZoneStudents * 100);
								$ZoneBValue = round($noOfZoneB / $totZoneStudents * 100);
								$ZoneCValue = round($noOfZoneC / $totZoneStudents * 100);
								$ZoneDValue = round($noOfZoneD / $totZoneStudents * 100);
								$subjectDataNewZone = array(
										'A'				=>  $ZoneAValue,
										'B'				=>  $ZoneBValue,
										'C'				=>  $ZoneCValue,
										'D'				=>  $ZoneDValue,
										'class'			=>  $Zonekeys->class,
										'total_students'=>  $totZoneStudents,
										'no_a'			=>  $noOfZoneA,
										'no_b'			=>  $noOfZoneB,
										'no_c'			=>  $noOfZoneC,
										'no_d'			=>  $noOfZoneD,
								);
								$subjectDataZone[$class - 1] = $subjectDataNewZone;
							}
						}
						
						$NewNoOfTeachersObservedZones = ($noOfTeachersObservedZones == 0 && $noOfTeachersObservedZones == '') ? 1 : $noOfTeachersObservedZones + 1;
						$NewStudentsAssessedZones = ($StudentsAssessedZones == 0 && $StudentsAssessedZones == '') ? $StudentsObserved : $StudentsAssessedZones + $StudentsObserved;
						
						$ZonePreobservation =  $this->getpreObservation($observation_data,$getZoneRecords); 
						$ZoneLessonPlanPercentage =  $this->lessonPlanPercentage($ZonePreobservation,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->lesson_plan);
						
						$ZoneLesson_execution =  $this->getLessonExecution($observation_data,$getZoneRecords);
						$ZoneLessonExecutionPercentage =  $this->lessonExecutionPercentage($ZoneLesson_execution,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->lesson_execution,$observation_data);
						
						$ZoneStuInteraction =  $this->getStudentInteraction($observation_data,$getZoneRecords);
						$ZoneStuInteractionPercentage =  $this->StuInteractionPercentage($ZoneStuInteraction,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->stu_interaction);

						$ZoneClassManagement =  $this->getClassManagement($observation_data,$getZoneRecords);
						$ZoneClassMgmtPercentage =  $this->ClassMgmtPercentage($ZoneClassManagement,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->class_management);
						

						$ZoneStuLearning =  $this->getStudentLearning($observation_data,$getZoneRecords);
						$ZoneStuLearningPercentage =  $this->stuLearningPercentage($ZoneStuLearning,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->stu_learning,$observation_data);

						$ZoneProDev =  $this->getProfessionalDevelopment($observation_data,$getZoneRecords);
						$ZoneProDevPercentage =  $this->proDevPercentage($ZoneProDev,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->pro_dev);

						$ZoneDiksha =  $this->getDiksha($observation_data,$getZoneRecords);
						$ZoneDikshaPercentage =  $this->DikshaPercentage($ZoneDiksha,$NewNoOfTeachersObservedZones,$getZoneRecords[0]->diksha);
						
						$ZoneLearningOutcome = $this->getLearningOutcome($getZoneRecords,$A_count,$B_count,$C_count,$D_count,$StudentsObserved);
					
						$ZonetnQulIndex = $this->getQualIndexValue($ZoneLessonPlanPercentage,$ZoneLessonExecutionPercentage,$ZoneStuInteractionPercentage,$ZoneClassMgmtPercentage,$ZoneStuLearningPercentage,$ZoneProDevPercentage,$ZoneDikshaPercentage,$ZoneLearningOutcome,$oldTnQualIndexZones);

						$ZoneData = array(
							'no_of_schools'	=> $noOfSchoolsInZone,
							'createdon' 	=> $createdon,
							'no_of_observers' 	=> $SchoolobserversCount,
							'no_of_teachers_observed' =>  $NewNoOfTeachersObservedZones,
							'no_of_students_assessed' =>  $NewStudentsAssessedZones,
							'teachers_vacancy_percentage' =>  $newTeacherVacancyZones,
							'teachers_alloted_percentage' =>  $newTeacherAllotedZones,
							'total_teachers_percentage' =>  $newTotalTeacherZones,
							'deputation_from_this' =>  $NewDebutationThisZones,
							'deputation_from_others' =>  $NewDebutationOthersZones,
							'teachers_long_leave' =>  $NewLongLeaveZones,
							'available_percentage' =>  $TeacherAvailableZones,
							'unavailable_percentage' =>  $TeacherUnAvailableZones,
							$strlowerZone =>  json_encode($subjectDataZone),
							'tn_qul_index' => $ZonetnQulIndex,
							'lesson_plan' =>$ZoneLessonPlanPercentage,
							'lesson_plan_info' =>json_encode(array($ZonePreobservation)),
							'lesson_execution' => $ZoneLessonExecutionPercentage,
							'lesson_execution_info' =>json_encode(array($ZoneLesson_execution)),
							'stu_interaction' => $ZoneStuInteractionPercentage,
							'stu_interaction_info' =>json_encode(array($ZoneStuInteraction)),
							'class_management' => $ZoneClassMgmtPercentage,
							'class_mgmt_info' =>json_encode(array($ZoneClassManagement)),
							'stu_learning' => $ZoneStuLearningPercentage,
							'stu_learning_info' =>json_encode(array($ZoneStuLearning)),
							'pro_dev' => $ZoneProDevPercentage,
							'pro_dev_info' =>json_encode(array($ZoneProDev)),
							'diksha' => $ZoneDikshaPercentage,
							'diksha_info' =>json_encode(array($ZoneDiksha)),
							'learning_outcome' => $ZoneLearningOutcome
						);
						
						$finalZoneData[] =  $ZoneData;
						$Zone_updates = $this->Cron_model->updateZone($ZoneData,$district_id,$block_id,$zone_id,$month,$year);
					}

					//Schools
					$getSchoolRecords = $this->Cron_model->getSchoolData($district_id,$block_id,$zone_id,$school_id,$month,$year);
					if($getSchoolRecords){
						$noOfTeachersObservedSchool = $getSchoolRecords[0]->no_of_teachers_observed;
						$StudentsAssessedSchool = $getSchoolRecords[0]->no_of_students_assessed;
						
						$oldTeacherVacancySchool = $getSchoolRecords[0]->teachers_vacancy_percentage;
						$oldTeacherAllotedSchool = $getSchoolRecords[0]->teachers_alloted_percentage;
						$oldTeacherTotalSchool = $getSchoolRecords[0]->total_teachers_percentage;
						$oldTnQualIndexSchool = $getSchoolRecords[0]->tn_qul_index;
						$oldDebutationThisSchool = $getSchoolRecords[0]->deputation_from_this;
						$oldDebutationOthersSchool = $getSchoolRecords[0]->deputation_from_others;
						$oldLongLeaveSchool = $getSchoolRecords[0]->teachers_long_leave;
						
						$newTeacherVacancySchool = $oldTeacherVacancySchool + ($teacherSanctioned - $teachersAvailable);
						$newTeacherAllotedSchool = $oldTeacherAllotedSchool + $teacherSanctioned;
						$newTotalTeacherSchool = $oldTeacherTotalSchool + $teachersAvailable;
						
						$NewDebutationThisSchool = $oldDebutationThisSchool + $deputationThis;
						$NewDebutationOthersSchool = $oldDebutationOthersSchool + $deputationOthers;
						$NewLongLeaveSchool = $oldLongLeaveSchool + $teacherLongLeave;
						
						$ETSschool = ($newTotalTeacherSchool - $NewDebutationThisSchool) + ($NewDebutationOthersSchool - $NewLongLeaveSchool);
						if($ETSschool == 0){
							$TeacherAvailableSchool = 0;
						}else{
							$TeacherAvailableSchool = round(($ETSschool / $newTeacherAllotedSchool) * 100);
						}
						$TeacherUnAvailableSchool = (100 - $TeacherAvailableSchool);
						
						$strlowerSchool = strtolower($subject);
						$selectedSubjectDataSchool = $getSchoolRecords[0]->$strlowerSchool;
						$subjectDataSchool = json_decode($selectedSubjectDataSchool);
						
						foreach($subjectDataSchool as $Schoolkeys){
							$gradesValueSchool = $Schoolkeys->class;
							if($gradesValueSchool == $class){
								
								$noOfSchoolA = $Schoolkeys->no_a + $A_count;
								$noOfSchoolB = $Schoolkeys->no_b + $B_count;
								$noOfSchoolC = $Schoolkeys->no_c + $C_count;
								$noOfSchoolD = $Schoolkeys->no_d + $D_count;
								$totSchoolStudents =  $Schoolkeys->total_students + $StudentsObserved;
								$SchoolAValue = round($noOfSchoolA / $totSchoolStudents * 100);
								$SchoolBValue = round($noOfSchoolB / $totSchoolStudents * 100);
								$SchoolCValue = round($noOfSchoolC / $totSchoolStudents * 100);
								$SchoolDValue = round($noOfSchoolD / $totSchoolStudents * 100);
								$subjectDataNewSchool = array(
										'A'				=>  $SchoolAValue,
										'B'				=>  $SchoolBValue,
										'C'				=>  $SchoolCValue,
										'D'				=>  $SchoolDValue,
										'class'			=>  $Schoolkeys->class,
										'total_students'=>  $totSchoolStudents,
										'no_a'			=>  $noOfSchoolA,
										'no_b'			=>  $noOfSchoolB,
										'no_c'			=>  $noOfSchoolC,
										'no_d'			=>  $noOfSchoolD,
								);
								$subjectDataSchool[$class - 1] = $subjectDataNewSchool;
							}
						}
						
						$NewNoOfTeachersObservedSchool = ($noOfTeachersObservedSchool == 0 && $noOfTeachersObservedSchool == '') ? 1 : $noOfTeachersObservedSchool + 1;
						$NewStudentsAssessedSchool = ($StudentsAssessedSchool == 0 && $StudentsAssessedSchool == '') ? $StudentsObserved : $StudentsAssessedSchool + $StudentsObserved;
						
						$SchoolPreobservation =  $this->getpreObservation($observation_data,$getSchoolRecords);
						$SchoolLessonPlanPercentage =  $this->lessonPlanPercentage($SchoolPreobservation,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->lesson_plan);
						
						$SchoolLesson_execution =  $this->getLessonExecution($observation_data,$getSchoolRecords);
						$SchoolLessonExecutionPercentage =  $this->lessonExecutionPercentage($SchoolLesson_execution,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->lesson_execution,$observation_data);
						
						$SchoolStuInteraction =  $this->getStudentInteraction($observation_data,$getSchoolRecords);
						$SchoolStuInteractionPercentage =  $this->StuInteractionPercentage($SchoolStuInteraction,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->stu_interaction);

						$SchoolClassManagement =  $this->getClassManagement($observation_data,$getSchoolRecords);
						$SchoolClassMgmtPercentage =  $this->ClassMgmtPercentage($SchoolClassManagement,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->class_management);

						$SchoolStuLearning =  $this->getStudentLearning($observation_data,$getSchoolRecords);
						$SchoolStuLearningPercentage =  $this->stuLearningPercentage($SchoolStuLearning,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->stu_learning,$observation_data);

						$SchoolProDev =  $this->getProfessionalDevelopment($observation_data,$getSchoolRecords);
						$SchoolProDevPercentage =  $this->proDevPercentage($SchoolProDev,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->pro_dev);

						$SchoolDiksha =  $this->getDiksha($observation_data,$getSchoolRecords);
						$SchoolDikshaPercentage =  $this->DikshaPercentage($SchoolDiksha,$NewNoOfTeachersObservedSchool,$getSchoolRecords[0]->diksha);
						
						$SchoolLearningOutcome = $this->getLearningOutcome($getSchoolRecords,$A_count,$B_count,$C_count,$D_count,$StudentsObserved);
					
						$SchooltnQulIndex = $this->getQualIndexValue($SchoolLessonPlanPercentage,$SchoolLessonExecutionPercentage,$SchoolStuInteractionPercentage,$SchoolClassMgmtPercentage,$SchoolStuLearningPercentage,$SchoolProDevPercentage,$SchoolDikshaPercentage,$SchoolLearningOutcome,$oldTnQualIndexSchool);
	 
						$SchoolData = array(
							'no_of_schools'	=> 1,
							'createdon' 	=> $createdon,
							'no_of_observers' 	=> 1,
							'no_of_teachers_observed' =>  $NewNoOfTeachersObservedSchool,
							'no_of_students_assessed' =>  $NewStudentsAssessedSchool,
							'teachers_vacancy_percentage' =>  $newTeacherVacancySchool,
							'teachers_alloted_percentage' =>  $newTeacherAllotedSchool,
							'total_teachers_percentage' =>  $newTotalTeacherSchool,
							'deputation_from_this' =>  $NewDebutationThisSchool,
							'deputation_from_others' =>  $NewDebutationOthersSchool,
							'teachers_long_leave' =>  $NewLongLeaveSchool,
							'available_percentage' =>  $TeacherAvailableSchool,
							'unavailable_percentage' =>  $TeacherUnAvailableSchool,
							$strlowerSchool =>  json_encode($subjectDataSchool),
							'tn_qul_index' => $SchooltnQulIndex,
							'lesson_plan' =>$SchoolLessonPlanPercentage,
							'lesson_plan_info' =>json_encode(array($SchoolPreobservation)),
							'lesson_execution' => $SchoolLessonExecutionPercentage,
							'lesson_execution_info' =>json_encode(array($SchoolLesson_execution)),
							'stu_interaction' => $SchoolStuInteractionPercentage,
							'stu_interaction_info' =>json_encode(array($SchoolStuInteraction)),
							'class_management' => $SchoolClassMgmtPercentage,
							'class_mgmt_info' =>json_encode(array($SchoolClassManagement)),
							'stu_learning' => $SchoolStuLearningPercentage,
							'stu_learning_info' =>json_encode(array($SchoolStuLearning)),
							'pro_dev' => $SchoolProDevPercentage,
							'pro_dev_info' =>json_encode(array($SchoolProDev)),
							'diksha' => $SchoolDikshaPercentage,
							'diksha_info' =>json_encode(array($SchoolDiksha)),
							'learning_outcome' => $SchoolLearningOutcome
						);
						$finalSchoolData[] = $SchoolData ;
						$School_updates = $this->Cron_model->updateSchool($SchoolData,$district_id,$block_id,$zone_id,$school_id,$month,$year);
					}  
					
					//STATE
					$AllBlocksState = $this->Cron_model->getblocksCount();
					$noOfBlocksState = $AllBlocksState[0]->blocks; 
					
					$observersState = $this->Cron_model->getBrtesCount();
					$noOfObserversState = $observersState->brtes; 

					$schoolsState = $this->Cron_model->getSchoolsCount();
					$noOfSchoolsState = $schoolsState->schools;
					
					
					//Get State Records
					$getStateRecords = $this->Cron_model->getStateData($month,$year);
					if($getStateRecords){
						$noOfTeachersObservedState = $getStateRecords[0]->no_of_teachers_observed;
						$StudentsAssessedState = $getStateRecords[0]->no_of_students_assessed;
						
						$oldTeacherVacancyState = $getStateRecords[0]->teachers_vacancy_percentage;
						$oldTeacherAllotedState = $getStateRecords[0]->teachers_alloted_percentage;
						$oldTeacherTotalState = $getStateRecords[0]->total_teachers_percentage;
						$oldTnQualIndex = $getStateRecords[0]->tn_qul_index;
						$oldDebutationThisState = $getStateRecords[0]->deputation_from_this;
						$oldDebutationOthersState = $getStateRecords[0]->deputation_from_others;
						$oldLongLeaveState = $getStateRecords[0]->teachers_long_leave;
						
						$newTeacherVacancyState = $oldTeacherVacancyState + ($teacherSanctioned - $teachersAvailable);
						$newTeacherAllotedState = $oldTeacherAllotedState + $teacherSanctioned; //a
						$newTotalTeacherState = $oldTeacherTotalState + $teachersAvailable;		//b
						
						$NewDebutationThisState = $oldDebutationThisState + $deputationThis;	//c
						$NewDebutationOthersState = $oldDebutationOthersState + $deputationOthers; //d
						$NewLongLeaveState = $oldLongLeaveState + $teacherLongLeave;			//e
						
						$ETSstate = ($newTotalTeacherState - $NewDebutationThisState) + ($NewDebutationOthersState - $NewLongLeaveState);
						
						if($ETSstate == 0){
							$TeacherAvailableState = 0;
						}else{
							$TeacherAvailableState = round(($ETSstate / $newTeacherAllotedState) * 100);
						}
						$TeacherUnAvailableState = (100 - $TeacherAvailableState);
						
						$strlowerState = strtolower($subject);
						$selectedSubjectDataState = $getStateRecords[0]->$strlowerState;
						$subjectDataState = json_decode($selectedSubjectDataState);
						
						foreach($subjectDataState as $Statekeys){
							$gradesValueState = $Statekeys->class;
							if($gradesValueState == $class){
								
								$noOfStateA = $Statekeys->no_a + $A_count;
								$noOfStateB = $Statekeys->no_b + $B_count;
								$noOfStateC = $Statekeys->no_c + $C_count;
								$noOfStateD = $Statekeys->no_d + $D_count;
								$totStateStudents =  $Statekeys->total_students + $StudentsObserved;
								$StateAValue = round($noOfStateA / $totStateStudents * 100);
								$StateBValue = round($noOfStateB / $totStateStudents * 100);
								$StateCValue = round($noOfStateC / $totStateStudents * 100);
								$StateDValue = round($noOfStateD / $totStateStudents * 100);
								$subjectDataNewState = array(
										'A'				=>  $StateAValue,
										'B'				=>  $StateBValue,
										'C'				=>  $StateCValue,
										'D'				=>  $StateDValue,
										'class'			=>  $Statekeys->class,
										'total_students'=>  $totStateStudents,
										'no_a'			=>  $noOfStateA,
										'no_b'			=>  $noOfStateB,
										'no_c'			=>  $noOfStateC,
										'no_d'			=>  $noOfStateD,
								);
								$subjectDataState[$class - 1] = $subjectDataNewState;
							}
						}
						
						$NewNoOfTeachersObservedState = ($noOfTeachersObservedState == 0 && $noOfTeachersObservedState == '') ? 1 : $noOfTeachersObservedState + 1;
						$NewStudentsAssessedState = ($StudentsAssessedState == 0 && $StudentsAssessedState == '') ? $StudentsObserved : $StudentsAssessedState + $StudentsObserved;

						$preobservation =  $this->getpreObservation($observation_data,$getStateRecords);
						$lessonPlanPercentage =  $this->lessonPlanPercentage($preobservation,$NewNoOfTeachersObservedState,$getStateRecords[0]->lesson_plan);
						
						$lesson_execution =  $this->getLessonExecution($observation_data,$getStateRecords);
						$lessonExecutionPercentage =  $this->lessonExecutionPercentage($lesson_execution,$NewNoOfTeachersObservedState,$getStateRecords[0]->lesson_execution,$observation_data);
						
						$stu_interaction =  $this->getStudentInteraction($observation_data,$getStateRecords);
						$StuInteractionPercentage =  $this->StuInteractionPercentage($stu_interaction,$NewNoOfTeachersObservedState,$getStateRecords[0]->stu_interaction);

						$class_management =  $this->getClassManagement($observation_data,$getStateRecords);
						$ClassMgmtPercentage =  $this->ClassMgmtPercentage($class_management,$NewNoOfTeachersObservedState,$getStateRecords[0]->class_management);
						
						$stu_learning =  $this->getStudentLearning($observation_data,$getStateRecords);
						$stuLearningPercentage =  $this->stuLearningPercentage($stu_learning,$NewNoOfTeachersObservedState,$getStateRecords[0]->stu_learning,$observation_data);

						$pro_dev =  $this->getProfessionalDevelopment($observation_data,$getStateRecords);
						$proDevPercentage =  $this->proDevPercentage($pro_dev,$NewNoOfTeachersObservedState,$getStateRecords[0]->pro_dev);

						$diksha =  $this->getDiksha($observation_data,$getStateRecords);
						$DikshaPercentage =  $this->DikshaPercentage($diksha,$NewNoOfTeachersObservedState,$getStateRecords[0]->diksha);
						
						$learning_outcome = $this->getLearningOutcome($getStateRecords,$A_count,$B_count,$C_count,$D_count,$StudentsObserved);
						
						$tnQulIndex = $this->getQualIndexValue($lessonPlanPercentage,$lessonExecutionPercentage,$StuInteractionPercentage,$ClassMgmtPercentage,$stuLearningPercentage,$proDevPercentage,$DikshaPercentage,$learning_outcome,$oldTnQualIndex);
						

						$StateData = array(
							'no_of_blocks'	=> $noOfBlocksState,
							'createdon' 	=> $createdon,
							'no_of_observers' 	=> $noOfObserversState,
							'no_of_schools' 	=> $noOfSchoolsState,
							'no_of_teachers_observed' =>  $NewNoOfTeachersObservedState,
							'no_of_students_assessed' =>  $NewStudentsAssessedState,
							'teachers_vacancy_percentage' =>  $newTeacherVacancyState,
							'teachers_alloted_percentage' =>  $newTeacherAllotedState,
							'total_teachers_percentage' =>  $newTotalTeacherState,
							'deputation_from_this' =>  $NewDebutationThisState,
							'deputation_from_others' =>  $NewDebutationOthersState,
							'teachers_long_leave' =>  $NewLongLeaveState,
							'available_percentage' =>  $TeacherAvailableState,
							'unavailable_percentage' =>  $TeacherUnAvailableState,
							$strlowerState => json_encode($subjectDataState) , //Subject
							'tn_qul_index' => $tnQulIndex,
							'lesson_plan' =>$lessonPlanPercentage,
							'lesson_plan_info' =>json_encode(array($preobservation)),
							'lesson_execution' => $lessonExecutionPercentage,
							'lesson_execution_info' =>json_encode(array($lesson_execution)),
							'stu_interaction' => $StuInteractionPercentage,
							'stu_interaction_info' =>json_encode(array($stu_interaction)),
							'class_management' => $ClassMgmtPercentage,
							'class_mgmt_info' =>json_encode(array($class_management)),
							'stu_learning' => $stuLearningPercentage,
							'stu_learning_info' => json_encode(array($stu_learning)),
							'pro_dev' => $proDevPercentage,
							'pro_dev_info' =>json_encode(array($pro_dev)),
							'diksha' => $DikshaPercentage,
							'diksha_info' =>json_encode(array($diksha)),
							'learning_outcome' => $learning_outcome
						);
						$finalStateData[] =  $StateData; 
						$State_updates = $this->Cron_model->updateState($StateData,$month,$year);
					}
					$grades = array();
					
					//if($district_updates != false && $block_updates != false && $Zone_updates != false && $School_updates != false && $State_updates != false){ // commented due to new districts mismatch in the other tables
					
					if($district_updates != false && $block_updates != false && $State_updates != false){
						$finishStatus = array('process_status' => 3); //3 enum => 2 Finished
						$setFinish 	= $this->Cron_model->setFinishedStatus($finishStatus,$schoolObsId);
					}else{
						$pendingStatus = array('process_status' => 4); //4 enum => 3 Pending
						$setPending 	= $this->Cron_model->setPendingStatus($pendingStatus,$schoolObsId);
					}
				}else{
					$grades = array();
					$pendingStatus = array('process_status' => 4); //4 enum => 3 Pending
					$setPending 	= $this->Cron_model->setPendingStatus($pendingStatus,$schoolObsId);
				}
			}
		} 

		
		$data['dataStatus'] = true;
		$data['status'] = REST_Controller::HTTP_OK;
		$data['finalStateData'] = $finalStateData;
		$this->response($data,REST_Controller::HTTP_OK);
	}
	
	
	function getQualIndexValue($lessonPlanPercentage,$lessonExecutionPercentage,$StuInteractionPercentage,$ClassMgmtPercentage,$stuLearningPercentage,$proDevPercentage,$DikshaPercentage,$learning_outcome,$oldTnQualIndex){
		
		$LPscore_id = 1;
		$getLPScoreDetails = $this->Cron_model->getScoreDetails($LPscore_id);
		$IPWeightage = $getLPScoreDetails[0]->weightage;
		$LPPercentage = ($lessonPlanPercentage * $IPWeightage);
		
		$LEscore_id = 2;
		$getLEScoreDetails = $this->Cron_model->getScoreDetails($LEscore_id);
		$IEWeightage = $getLEScoreDetails[0]->weightage;
		$LEPercentage = ($lessonExecutionPercentage * $IEWeightage);
		
		$SIscore_id = 3;
		$getSIScoreDetails = $this->Cron_model->getScoreDetails($SIscore_id);
		$SIWeightage = $getSIScoreDetails[0]->weightage;
		$SIPercentage = ($StuInteractionPercentage * $SIWeightage);
		
		$CRMscore_id = 4;
		$getCRMScoreDetails = $this->Cron_model->getScoreDetails($CRMscore_id);
		$CRMWeightage = $getCRMScoreDetails[0]->weightage;
		$CRMpercentage = ($ClassMgmtPercentage * $CRMWeightage);
		
		$SLscore_id = 5;
		$getSLScoreDetails = $this->Cron_model->getScoreDetails($SLscore_id);
		$SLWeightage = $getSLScoreDetails[0]->weightage;
		$SLpercentage = ($stuLearningPercentage * $SLWeightage);
		
		$TPDscore_id = 6;
		$getTPDScoreDetails = $this->Cron_model->getScoreDetails($TPDscore_id);
		$TPDWeightage = $getTPDScoreDetails[0]->weightage;
		$TPDpercentage = ($proDevPercentage * $TPDWeightage);
		
		$Discore_id = 7;
		$getDiScoreDetails = $this->Cron_model->getScoreDetails($Discore_id);
		$DiWeightage = $getDiScoreDetails[0]->weightage;
		$Dipercentage = ($DikshaPercentage * $DiWeightage);
		
		$LOscore_id = 8;
		$getLOScoreDetails = $this->Cron_model->getScoreDetails($LOscore_id);
		$LOWeightage = $getLOScoreDetails[0]->weightage;
		$LOpercentage = ($DikshaPercentage * $LOWeightage);
		
		$TotalIndexValue = $LPPercentage + $LEPercentage + $SIPercentage + $CRMpercentage + $SLpercentage + $TPDpercentage + $Dipercentage + $LOpercentage;
		
		if($TotalIndexValue){
			return round($TotalIndexValue);
			//return array('LPPercentage' => $LPPercentage, 'LEPercentage' => $LEPercentage, 'SIPercentage' => $SIPercentage, 'CRMpercentage' => $CRMpercentage, 'SLpercentage' => $SLpercentage,  'TPDpercentage' => $TPDpercentage, 'Dipercentage' => $Dipercentage, 'LOpercentage' => $LOpercentage);
		}else{
			return $oldTnQualIndex;
		}
		
	}

	function getpreObservation($observation_data,$getStateRecords){
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->lesson_plan_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 1){ //Planning And Preparation
					$scoreData = json_decode($dataKey2['score']);
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount= array();
						$aodCount= array();
						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key2->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$aosCount[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						//$CheckQuestion = array();
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count = array();
						$aod_count = array();
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										$selectedScore[] = $dataKey4->score;
										if(in_array( $selectedAns ,$aos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore);
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function lessonPlanPercentage($ObservationsData,$NewNoObservations,$oldValue){
		$lessonPlan = $ObservationsData['quest_list'];
		if($lessonPlan){
			for($i=0;$i<count($lessonPlan);$i++){
				$TotalAOS[] = $lessonPlan[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($lessonPlan);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue, 'AllScoreData' => $AllScoreData);
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getLessonExecution($observation_data,$getStateRecords){
		
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->lesson_execution_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		
		for($j=0;$j<count($ScoreQuestions);$j++){
			if($ScoreQuestions[$j]->childQusCount > 1){
				foreach($ScoreQuestions[$j]->ques_id as $key){
					$MogMugQuest[] = $key;
				}
			}
		}
		
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 2){ //Lesson Execution
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount;
						$aodCount;
						
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							$childQuestions = $ScoreQuestions[$i]->childQusCount;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								if($dataKey2['type_of_ans'] == 1){					// Percentage Calculation Single Choice
									$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
									$ScoreAos = $dataKey2['ans']['aos'];
									$ScoreAod = $dataKey2['ans']['aod'];
									
									$ScoreAns = $scoreData->scores;
									foreach($ScoreAns as $Key1){
										$ScoreSelectedAnsId = $Key1->ansId;
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key1->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$ScoresAOS[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$ScoresAOD[] = $dataKey2['ob_qus_id'];
											}
										} 
									}
								}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
									$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
									$ScoreAns = $scoreData->scores;
									$ScoreAos = $dataKey2['ans']['aos'];
									$ScoreAod = $dataKey2['ans']['aod'];
									
									if(in_array( $scoreOBQuestId ,$MogMugQuest )){
										foreach($ScoreMultipleChoice as $Key3){
											$MongradeOption[] = $Key3['answer_id'];
										}
										if(in_array( 0 ,$MongradeOption )){
											$ScoresSelected[] = 0;
										}else{
											$ScoresSelected[] = 1;
										}
										foreach($ScoreAns as $Key2){
											$ScoreSelectedAnsId = $Key2->ansId;
											foreach($ScoreMultipleChoice as $Key3){
												$AnswerIdselected = $Key3['answer_id'];
												if($ScoreSelectedAnsId == $AnswerIdselected){
													if(in_array( $AnswerIdselected ,$ScoreAos )){
														$aosCount[] = $dataKey2['ob_qus_id'];
													}
													if(in_array( $AnswerIdselected ,$ScoreAod )){
														$aodCount[] = $dataKey2['ob_qus_id'];
													}
												}
											}
										}
										
									}else{
										foreach($ScoreAns as $Key2){
											$ScoreSelectedAnsId = $Key2->ansId;
											foreach($ScoreMultipleChoice as $Key3){
												$AnswerIdselected = $Key3['answer_id'];
												if($ScoreSelectedAnsId == $AnswerIdselected){
													$ScoresSelected[] = $Key2->score;
													if(in_array( $AnswerIdselected ,$ScoreAos )){
														$aosCount[] = $dataKey2['ob_qus_id'];
													}
													if(in_array( $AnswerIdselected ,$ScoreAod )){
														$aodCount[] = $dataKey2['ob_qus_id'];
													}
												}
											}
										}
									}
								}
								
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + round(array_sum($ScoresSelected) /  $childQuestions, 2);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->childQusCount = $childQuestions;
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aod_count;
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}


						for($k=0;$k<count($ScoreQuestions);$k++){
							$totalScore[] = $ScoreQuestions[$k]->aos_score;
							$final_AosCount[] = $ScoreQuestions[$k]->aos_count;
						}
						
						$final_questionsCount = count($questionsCount);
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? array_sum($totalScore) : array_sum($totalScore);
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? array_sum($final_AosCount) :  array_sum($final_AosCount);
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
						$totalScore = array();
						$final_AosCount = array();
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function lessonExecutionPercentage($ObservationsData,$NewNoObservations,$oldValue,$observation_data){
		$lessonExePercentage = $ObservationsData['quest_list'];
		if($lessonExePercentage){
			for($i=0;$i<count($lessonExePercentage);$i++){
				$TotalAOS[] = $lessonExePercentage[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($lessonExePercentage);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'totalAOSValue' => $totalAOSValue, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => round($PercentageValue), 'NewNoObservations' => $NewNoObservations,  'lessonExePercentage' => count($lessonExePercentage));
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getStudentInteraction($observation_data,$getStateRecords){
		
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->stu_interaction_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 3){ //Student Interaction
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount;
						$aodCount;
						
						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key2->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$aosCount[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count;
						$aod_count;
						
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										$selectedScore[] = $dataKey4->score;
										if(in_array( $selectedAns ,$aos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore);
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function StuInteractionPercentage($ObservationsData,$NewNoObservations,$oldValue){
		$studentInteraction = $ObservationsData['quest_list'];
		if($studentInteraction){
			for($i=0;$i<count($studentInteraction);$i++){
				$TotalAOS[] = $studentInteraction[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($studentInteraction);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue, 'NewNoObservations' => $NewNoObservations,  'studentInteraction' => count($studentInteraction));
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getClassManagement($observation_data,$getStateRecords){
		
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->class_mgmt_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 4){ //ClassRoom Management
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount = array();
						$aodCount = array();
						/* $ScoresAOS = '';
						$ScoresAOD = ''; */
						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key2->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$aosCount[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count = array();
						$aod_count = array();
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										$selectedScore[] = $dataKey4->score;
										if(in_array( $selectedAns ,$aos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore);
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function ClassMgmtPercentage($ObservationsData,$NewNoObservations,$oldValue){
		$classMgmt = $ObservationsData['quest_list'];
		if($classMgmt){
			for($i=0;$i<count($classMgmt);$i++){
				$TotalAOS[] = $classMgmt[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($classMgmt);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue,  'NewNoObservations' => $NewNoObservations,  'classMgmt' => $classMgmt);
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getStudentLearning($observation_data,$getStateRecords){
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->stu_learning_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 5){ //Student Learning
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount;
						$aodCount;
						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$Multiaos = $this->removeCharacters($dataKey2['ans']['aos']);
								$Multiaod = $dataKey2['ans']['aod'];
								
								foreach($ScoreMultipleChoice as $dataKey7){
									$selected_CCE[] = $dataKey7['answer_id'];
								}
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											if($AnswerIdselected == $Multiaos ){ 
												$aosCount[] = $dataKey2['ob_qus_id'];
												$ScoresSelected[] = $Key2->score;
											}
											if($selected_CCE == $Multiaos ){  // For CCE Records
												$aosCount[] = $dataKey2['ob_qus_id'];
												$ScoreCCE[] = $dataKey2['ob_qus_id'];  
											}
											if(in_array( $AnswerIdselected ,$Multiaod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected) +  count(array_count_values($ScoreCCE));
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								$ScoreCCE= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count;
						$aod_count;
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$Multaos = $this->removeCharacters($dataKey2['ans']['aos']);
							$Multaod = $dataKey2['ans']['aod'];
							
							foreach($multipleChoice as $dataKey6){
								$selectedCCE[] = $dataKey6['answer_id'];
							}
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								
								
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									$selectedAnss[] = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										
										if(in_array( $selectedAns ,$Multaos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										
										if($selectedCCE == $Multaos ){  // For CCE Records
											$aos_count[] = $dataKey2['ob_qus_id']; 
											$CCEScore[] = $dataKey2['ob_qus_id'];  
										}else{
											$selectedScore[] = $dataKey4->score;
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore) + count(array_count_values($CCEScore));
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function stuLearningPercentage($ObservationsData,$NewNoObservations,$oldValue,$observation_data){
		
		$stuLearning = $ObservationsData['quest_list'];
		
		if($stuLearning){
			for($i=0;$i<count($stuLearning);$i++){
				$TotalAOS[] = $stuLearning[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			
			$TotalObsByQuest = $NewNoObservations * count($stuLearning);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100; 
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('totalAOSValue' => $totalAOSValue, 'TotalAOS' => $TotalAOS, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue,  'NewNoObservations' => $NewNoObservations);
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getProfessionalDevelopment($observation_data,$getStateRecords){
		
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->pro_dev_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 6){ //Teacher Professional Development
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount;
						$aodCount;

						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key2->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$aosCount[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count;
						$aod_count;
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										$selectedScore[] = $dataKey4->score;
										if(in_array( $selectedAns ,$aos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore);
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	function proDevPercentage($ObservationsData,$NewNoObservations,$oldValue){
		$proDev = $ObservationsData['quest_list'];
		if($proDev){
			for($i=0;$i<count($proDev);$i++){
				$TotalAOS[] = $proDev[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($proDev);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'totalAOSValue' => $totalAOSValue, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue,  'NewNoObservations' => $NewNoObservations,  'proDev' => $proDev, 'TotalQuestions' => $TotalQuestions);
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function DikshaPercentage($ObservationsData,$NewNoObservations,$oldValue){
		
		$diksha = $ObservationsData['quest_list'];
		if($diksha){
			for($i=0;$i<count($diksha);$i++){
				$TotalAOS[] = $diksha[$i]->aos_score;
			}
			$totalAOSValue = array_sum($TotalAOS);
			$TotalObsByQuest = $NewNoObservations * count($diksha);
			if($TotalObsByQuest != 0){
				$percentage = $totalAOSValue / $TotalObsByQuest;
				$PercentageValue = $percentage * 100;
			}
			if($PercentageValue){
				return round($PercentageValue);
				//return array('TotalAOS' => $TotalAOS, 'TotalObsByQuest' => $TotalObsByQuest, 'percentage' => $percentage, 'PercentageValue' => $PercentageValue, 'NewNoObservations' => $NewNoObservations,  'diksha' => $diksha);
			}else{
				return $oldValue;
			}
		}else{
			return $oldValue;
		}
	}
	
	function getDiksha($observation_data,$getStateRecords){
		
		$oldLessonPlanInfo = json_decode($getStateRecords[0]->diksha_info);
		$oldNoofObservations = $getStateRecords[0]->no_of_teachers_observed; //No of Observations
		$oldLPQuestionCount = $oldLessonPlanInfo[0]->question_count;
		$oldLPAos_Score = $oldLessonPlanInfo[0]->aos_score;
		$oldLPAos_Count = $oldLessonPlanInfo[0]->aos_count;
		$oldLPAod_Count = $oldLessonPlanInfo[0]->aod_count;
		$ScoreQuestions = $oldLessonPlanInfo[0]->quest_list;
		$ScoreQuestionsList = $oldLessonPlanInfo[0]->quest_array;
		
		foreach($observation_data as $dataKey){
			$questionsList = $dataKey['questionList'];
			
			foreach($questionsList as $dataKey2){
				$ScoreId = $dataKey2['score_id'];
				if($ScoreId == 7){ //DIKSHA
					$scoreData = json_decode($dataKey2['score']);
				
					if($scoreData){
						$scoreOBQuestId = $dataKey2['ob_qus_id'];
						$aosCount = array();
						$aodCount = array();
						if(in_array( $scoreOBQuestId ,$ScoreQuestionsList )){
							if($dataKey2['type_of_ans'] == 1){						// Percentage Calculation Single Choice
								$AnswerIdselected = $dataKey2['selectedAnswer']['answer_id'];
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								$ScoreAns = $scoreData->scores;
								foreach($ScoreAns as $Key1){
									$ScoreSelectedAnsId = $Key1->ansId;
									if($ScoreSelectedAnsId == $AnswerIdselected){
										$ScoresSelected[] = $Key1->score;
										if(in_array( $AnswerIdselected ,$ScoreAos )){
											$ScoresAOS[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $AnswerIdselected ,$ScoreAod )){
											$ScoresAOD[] = $dataKey2['ob_qus_id'];
										}
									} 
								}
							}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
								$ScoreMultipleChoice = $dataKey2['selectedAnswer'];
								$ScoreAns = $scoreData->scores;
								$ScoreAos = $dataKey2['ans']['aos'];
								$ScoreAod = $dataKey2['ans']['aod'];
								
								foreach($ScoreAns as $Key2){
									$ScoreSelectedAnsId = $Key2->ansId;
									foreach($ScoreMultipleChoice as $Key3){
										$AnswerIdselected = $Key3['answer_id'];
										if($ScoreSelectedAnsId == $AnswerIdselected){
											$ScoresSelected[] = $Key2->score;
											if(in_array( $AnswerIdselected ,$ScoreAos )){
												$aosCount[] = $dataKey2['ob_qus_id'];
											}
											if(in_array( $AnswerIdselected ,$ScoreAod )){
												$aodCount[] = $dataKey2['ob_qus_id'];
											}
										}
									}
								}
							}
						}
						
						for($i=0;$i<count($ScoreQuestions);$i++){ //Update Existing value into new value
							$CheckQuestion = $ScoreQuestions[$i]->ques_id;
							
							if(in_array( $scoreOBQuestId ,$CheckQuestion )){
								$ScoreQuestions[$i]->aos_score = $ScoreQuestions[$i]->aos_score + array_sum($ScoresSelected);
								$ScoreQuestions[$i]->aos_count = $ScoreQuestions[$i]->aos_count + count(array_count_values($ScoresAOS)) + count(array_count_values($aosCount));
								$ScoreQuestions[$i]->ques_id = $CheckQuestion;
								$ScoresSelected= array();
								$aosCount= array();
								$ScoresAOS= array();
								break;
							}
							
						}
						
						$questionsCount[] = count($dataKey2['ob_qus_id']);
						$aos_count = array();
						$aod_count = array();
						
						if($dataKey2['type_of_ans'] == 1){ 						//Single Choice
							$selectedAnswerId = $dataKey2['selectedAnswer']['answer_id'];
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							$ScoreTypeAns = $scoreData->scores;
							foreach($ScoreTypeAns as $dataKey3){
								$selectedTypeAnsId = $dataKey3->ansId;
								if($selectedTypeAnsId == $selectedAnswerId){
									$selectedScore[] = $dataKey3->score;
									if(in_array( $selectedAnswerId ,$aos )){
										$SingleAOS[] = $dataKey2['ob_qus_id'];
									}
									if(in_array( $selectedAnswerId ,$aod )){
										$SingleAOD[] = $dataKey2['ob_qus_id'];
									}
								}
							}
							
						}else if($dataKey2['type_of_ans'] == 2){ 				//Multiple Choice
							$multipleChoice = $dataKey2['selectedAnswer'];
							$ScoreTypeAns = $scoreData->scores;
							$aos = $dataKey2['ans']['aos'];
							$aod = $dataKey2['ans']['aod'];
							
							foreach($ScoreTypeAns as $dataKey4){
								$selectedTypeAns = $dataKey4->ansId;
								foreach($multipleChoice as $dataKey5){
									$selectedAns = $dataKey5['answer_id'];
									if($selectedTypeAns == $selectedAns){
										$selectedScore[] = $dataKey4->score;
										if(in_array( $selectedAns ,$aos )){
											$aos_count[] = $dataKey2['ob_qus_id'];
										}
										if(in_array( $selectedAns ,$aod )){
											$aod_count[] = $dataKey2['ob_qus_id'];
										}
									}
								}
							}
						}
						$final_questionsCount = count($questionsCount);
						$final_AosCount = count(array_count_values($SingleAOS)) + count(array_count_values($aos_count));
						$final_AodCount = count(array_count_values($SingleAOD)) + count(array_count_values($aod_count));
						$totalScore = array_sum($selectedScore);
						
						$finalScore['question_count'] = ($oldLPQuestionCount == 0 && $oldLPQuestionCount == '') ? $final_questionsCount : $oldLPQuestionCount + $final_questionsCount;
						$finalScore['aos_score'] = ($oldLPAos_Score == 0 && $oldLPAos_Score == '') ? $totalScore : $oldLPAos_Score + $totalScore;
						$finalScore['aos_count'] = ($oldLPAos_Count == 0 && $oldLPAos_Count == '') ? $final_AosCount : $oldLPAos_Count + $final_AosCount;
						$finalScore['aod_count'] = ($oldLPAod_Count == 0 && $oldLPAod_Count == '') ? $final_AodCount : $oldLPAod_Count + $final_AodCount;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}else{
						$finalScore['question_count'] = $oldLPQuestionCount;
						$finalScore['aos_score'] = $oldLPAos_Score;
						$finalScore['aos_count'] = $oldLPAos_Count;
						$finalScore['aod_count'] = $oldLPAod_Count;
						$finalScore['quest_array'] = $ScoreQuestionsList;
						$finalScore['quest_list'] = $ScoreQuestions;
					}
				}
			}
		}
		return $finalScore;
    }
	
	
	function getLearningOutcome($records,$A_count,$B_count,$C_count,$D_count,$StudentsObserved){
		$stateTamil = json_decode($records[0]->tamil);
		$stateEnglish = json_decode($records[0]->english);
		$stateMaths = json_decode($records[0]->maths);
		$stateScience = json_decode($records[0]->science);
		$stateSocial = json_decode($records[0]->social);
		$stateEvs = json_decode($records[0]->evs);
		$oldLOData = $records[0]->learning_outcome;
		$allSubjects = array_merge($stateTamil,$stateEnglish,$stateMaths,$stateScience,$stateSocial,$stateEvs);
		
		foreach($allSubjects as $subjectKey){
			$GradeA[] =  $subjectKey->no_a;
			$GradeB[] =  $subjectKey->no_b;
			$GradeC[] =  $subjectKey->no_c;
			$GradeD[] =  $subjectKey->no_d;
			$TotalStudents[] =  $subjectKey->total_students;
		}
		
		$GradeASum = array_sum($GradeA) + $A_count;
		$GradeBSum = array_sum($GradeB) + $B_count;
		$GradeCSum = array_sum($GradeC) + $C_count;
		$GradeDSum = array_sum($GradeD) + $D_count;
		$TotalStudentsSum = array_sum($TotalStudents) + $StudentsObserved;
		
		$Agrade = $GradeASum * 100;
		$Bgrade = $GradeBSum * 66;
		$Cgrade = $GradeCSum * 33;
		$Dgrade = $GradeDSum * 0;
		
		$TotalSLO = '';
		$TotalAllGrade = $Agrade + $Bgrade + $Cgrade + $Dgrade;
		if($TotalStudentsSum != 0){
			$TotalSLO = ($TotalAllGrade / $TotalStudentsSum);
		}
		
		if($TotalSLO){
			return round($TotalSLO);
		}else{
			return $oldLOData;
		}
		
		//return array('TotalAllGrade' => $TotalAllGrade , 'GradeASum' => $GradeASum, 'GradeBSum' => $GradeBSum, 'GradeCSum' => $GradeCSum, 'GradeDSum' => $GradeDSum, 'TotalStudentsSum' => $TotalStudentsSum, 'TotalSLO'=> $TotalSLO );
		
    }
	
	function removeCharacters($array){

		$new_array = array_filter($array, function($key) {
		  return is_numeric($key);
		}, ARRAY_FILTER_USE_KEY);

		$string = $new_array[0];
		$myArray = explode(',', $string);
		return $myArray;
	}
}


?>

