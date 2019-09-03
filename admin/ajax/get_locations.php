<?php    
    require_once('../../class_function/session.php');
	require_once('../../class_function/error.php');
	require_once('../../class_function/dbconfig.php');
	require_once('../../class_function/function.php');
	require_once('../../class_function/validate.php');
    require_once('../../class_function/language.php');	
    
    
    $access_denied_xml      = $xml->get_locations->access_denied;
    $no_access_xml          = $xml->get_locations->no_access;
    $no_location_xml        = $xml->get_locations->no_location;
    
	
	
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
    
    $id         = $_GET['id'];
    $view_all   = $_GET['view_all'];
    
    if($view_all == "true"){//all
        $rows 			= sql($DBH, "SELECT * FROM tbl_geo_fence where admin_id = ? ", array($SESS_ID), "rows");		
	}else{//individual
        $rows 			= sql($DBH, "SELECT * FROM tbl_geo_fence where user_id = ? and admin_id = ? ", array($id,$SESS_ID), "rows");		
	}
        
    $sno 			= 0;
	$atleast_one 	= false;
	foreach($rows as $row){	
		$atleast_one = true;
		$sno++;
		$id					= $row['id'];
        $user_id            = $row['user_id'];
		$name				= $row['name'];
		$polygon_json		= $row['polygon_json'];
		$date_time			= my_simple_date($row['date_time']);
		
		$points 			= array();		
		$polygon_json 		= json_decode($polygon_json);
		$polygon			= array();		
		$i = 0;
		foreach($polygon_json as $point){
			$point 					= explode(",",$point);
			$polygon[$i]["lat"] 	= $point[0];
			$polygon[$i]["lng"] 	= $point[1];
			$i++;
		}
        
        if($view_all == "true"){//all            
            $rows2 = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($user_id), "rows");        
            foreach($rows2 as $row2){	
        		$fullname	= $row2['fullname'];
                $user_fullname = "<small class='text-muted'>Assigned: $fullname</small>";
            }
        }
        
		echo "<li class='map-re-center' lat='".$point[0]."' lng='".$point[1]."'>".
        "<a href='javascript:;'>$name</a>".
        "<br/>".
        $user_fullname.
        "</li>";
        
	}
	
	if($atleast_one == false){
		echo "<li><span class='text-danger'><i class='fa fa-search'></i> $no_location_xml</span></li>";
	}