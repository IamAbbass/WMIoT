<?php
    
    require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');
	require_once('../class_function/validate.php');
	require_once('../class_function/language.php');
    
    $id             = $_POST['id'];
    $temp_start     = $_POST['temp_start'];
    $temp_end       = $_POST['temp_end'];
    $temp_margin    = $_POST['temp_margin'];
    $do_start       = $_POST['do_start'];
    $do_end         = $_POST['do_end'];
    $do_margin      = $_POST['do_margin'];
    $ph_start       = $_POST['ph_start'];
    $ph_end         = $_POST['ph_end'];
    $ph_margin      = $_POST['ph_margin'];
    
		
        sql($DBH, "UPDATE tbl_geo_fence set 
        temp_start = ?, temp_end = ?, temp_margin = ?, 
        do_start = ?, do_end = ?, do_margin = ?, 
        ph_start = ?, ph_end = ?, ph_margin = ?, update_date_time = ?
        where id = ? and admin_id = ?", 
        array($temp_start,$temp_end,$temp_margin,
        $do_start,$do_end,$do_margin,
        $ph_start,$ph_end,$ph_margin,time(),$id,$SESS_ID), "rows");
        
        $_SESSION['info'] = "<strong>SUCCESS: </strong> Pond range updated!";
		redirect('ranges.php');
	

    

    
	/*

    
    $id = $_GET['id'];
    $rows 		= 
	foreach($rows as $row){	
		$id					= $row['id'];
		$name				= $row['name'];
		$polygon_json		= $row['polygon_json'];                                                        
        $temp_start		    = $row['temp_start'];
        $temp_end		    = $row['temp_end'];
        $temp_margin		= $row['temp_margin'];
        $do_start	  	    = $row['do_start'];
        $do_end		        = $row['do_end'];
        $do_margin		    = $row['do_margin'];
        $ph_start		    = $row['ph_start'];
        $ph_end 		    = $row['ph_end'];  
        $ph_margin		    = $row['ph_margin'];
	}
    
    update_date_time*/
    
?>