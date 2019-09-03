<?php
	header("Access-Control-Allow-Origin: *");
	
	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');	
	
	$input 			= $_GET['input']; //phone
    $sim_serial_1   = $_GET['sim_serial_1'];
    $sim_serial_2   = $_GET['sim_serial_2'];
    
    
	$arr    		= array();    
    if(strlen($input) > 0){        
        $STH 	 = $DBH->prepare("SELECT count(*) FROM tbl_login WHERE contact = ? AND status = ?");
        $result  = $STH->execute(array($input,"active"));
        $count	 = $STH->fetchColumn();         
        if($count == 1){			
            $rows = sql($DBH, "SELECT * FROM tbl_login where contact = ?", array($input), "rows");							
            foreach($rows as $row){
                
                //if(strlen($row['sim_serial']) > 0){//existing customer                
                    if(($row['sim_serial']  == $sim_serial_1) || ($row['sim_serial']  == $sim_serial_2)){ 
    				    //sim serial matched that means user has the valid sim card
                        if($row['app_pin_code'] == 0 || strlen($row['app_pin_code'])  == 0){	               
                       		//login_success
                            $arr['input'] 	= $input;						
        					$arr['id']		= $row['id'];
        					$arr['name']	= $row['fullname'];
        					$arr['success'] = true;
                            $arr['action']  = "login"; 
        					$arr['error'] 	= "Welcome, ".$row['fullname']."!";
                            $arr["photo"]   =  $row['photo'];
                            $arr["app_pin_code"]= "false";  
                            /*
                            if($row['access_level'] == "user"){
                                $rows1 = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($row['parent_id']), "rows");							
                                foreach($rows1 as $row1){
                                    $arr["office"]  =  $row1['fullname']."'s Office";
                                }                                
                            }else{
                                $rows1 = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($row['id']), "rows");							
                                foreach($rows1 as $row1){
                                    $arr["office"]  =  $row1['fullname']."'s Office";
                                }
                            } */             
                        }else{
        					$arr['input'] 	= $input;
        					$arr['success'] = true;
                            $arr['action']  = "pin_code";                    
        					$arr['error'] 	= "Please enter your pin code!";
        				}
                    }else{
                        $arr['input'] 	= $input;
                    	$arr['success'] = true;
                        $arr['action']  = "sms_auth"; 
                    	$arr['error'] 	= "Sim card not matched, please enter verification code sent to $input.";
                    }
                //}else{ //new customer
                //    $arr['input'] 	= $input;
                //	$arr['success'] = true;
                //    $arr['action']  = "sms_auth"; 
                //	$arr['error'] 	= "Waiting for SMS verification code sent to $input.";
                //}
            }
        }else{
            $arr['input'] 	= $input;
			$arr['success'] = false;
			$arr['error'] 	= "No account belongs with this phone number.";
    	}
    }else{
		$arr['input'] 	= $input;
		$arr['success'] = false;
		$arr['error'] 	= "Please enter your phone number!";
	}
	
    die(json_encode($arr, true));
?>