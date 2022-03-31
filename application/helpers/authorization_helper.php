<?php

class AUTHORIZATION
{
    public static function validateTimestamp()
    {
        $CI =& get_instance();
        $headersData = getallheaders();
        
        if (!array_key_exists("Token",$headersData))
        {
            set_status_header(REST_CONTROLLER::HTTP_OK,"OK");
            $response['status']=false;
            $response['error']="Token required!";
            echo json_encode($response);
            exit;
        }
        else{
            $token = self::validateToken($headersData['Token']);
			//print_r($token);
			if($token != false && (now() - $token->exp < ($CI->config->item('token_timeout') * 60))){
            //if($token != false && (now() -  ($CI->config->item('token_timeout') * 60))){
               set_status_header(200,"OK");
               return true;
           }
          else if($token == false){
               set_status_header(REST_CONTROLLER::HTTP_UNAUTHORIZED,"Unauthorized");
               $response['status']=false;
               $response['error']="Invalid token!";
			   log_message('error','Invalid token!');
               echo json_encode($response);
               exit;
           }
           
           else{
				set_status_header(REST_CONTROLLER::HTTP_UNAUTHORIZED,"Unauthorized");
               $response['status'] = false;
			   $response['message'] = 'Token Experied';
			   log_message('error','Token Experied');
                echo json_encode($response);
               exit;
   
           }
        }
    }

    public static function validateToken($token)
    {
       
        return JWT::decode($token);
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

    //check authorization user or not

    public static function checkAuthorizationUser($routingName){
        $CI =& get_instance();
        $headersData = getallheaders();	
		//print_r($headersData);
 
        if (!array_key_exists("Authorization",$headersData) OR $headersData['Authorization']!=$CI->config->item('authorization_key'))
        {
            set_status_header(REST_CONTROLLER::HTTP_UNAUTHORIZED,"Unauthorized");
            $response['status']=false;
             $response['error']="Access denied!";
			       log_message('error','Access denied!');
             echo json_encode($response);
             exit;  
        }
        //For all route name except  contant route
        else if($routingName!=ROUTE_LOGIN){
            $validateToken = self::validateTimestamp();
            return $validateToken;
        }
         else{
            return true;
          }
		  
		  
	 
    }
	
}