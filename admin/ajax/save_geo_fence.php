<?php
    
    require_once('../../class_function/session.php');
	require_once('../../class_function/error.php');
	require_once('../../class_function/dbconfig.php');
	require_once('../../class_function/function.php');
	require_once('../../class_function/validate.php');
    require_once('../../class_function/language.php');
    
    $access_denied_xml       = $xml->geo_fence->access_denied;
    $no_access_xml           = $xml->geo_fence->no_access;
    $office_location_xml     = $xml->geo_fence->office_location;
    $success_xml             = $xml->geo_fence->success;
    $failed_xml              = $xml->geo_fence->failed;
    
	
	if($SESS_ACCESS_LEVEL == "root admin"){
		//allow
	}else if($SESS_ACCESS_LEVEL == "admin"){
		//allow
	}else if($SESS_ACCESS_LEVEL == "user"){
		$_SESSION['msg'] = "<strong>$access_denied_xml </strong> $no_access_xml";
		redirect('index.php');
	}else{
		$_SESSION['msg'] = "<strong>$access_denied_xml </strong> $no_access_xml";
		redirect('index.php');
	}	
	
	$ploygon	= $_GET['ploygon'];	
	$name		= $_GET['name'];
    $id         = $_GET['id'];//user id
	
	if($SESS_ID && $name && $ploygon){	
		$rows = sql($DBH, "insert  into tbl_geo_fence (user_id,admin_id,name,polygon_json,date_time,update_date_time) 
        values 
        (?,?,?,?,?,?);",
		array($id,$SESS_ID,$name,$ploygon,time(),time()), "rows");  
		die("$office_location_xml '$name' $success_xml");		
	}else{
		die("$failed_xml");
	}	
	die("$failed_xml");
?>