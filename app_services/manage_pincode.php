<?php
	header("Access-Control-Allow-Origin: *");
	
	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');	
	
    $id 			= $_GET['id'];
    $pin            = $_GET['pin'];
    
    
    if(strlen($id) > 0 && strlen($pin) > 0){        
        if($pin == "null"){
            $pin = 0;
        }
        $rows = sql($DBH, "UPDATE tbl_login set app_pin_code = ? where id = ?", array($pin,$id), "rows");
	}
    
?>