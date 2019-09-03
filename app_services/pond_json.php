<?php
	header("Access-Control-Allow-Origin: *");
	
	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');	
    
    $user_id        = $_GET['id']; //or admin ID
    $timestamp      = $_GET['ts'];
    $timestamp_new  = $timestamp; 
    
    $arr            = array();  
    $i              =0;
    
    $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where user_id = ? and (update_date_time > ?)", array($user_id,$timestamp), "rows");		
	foreach($rows as $row){	
		$temp_start		         = $row['temp_start'];
        $temp_end		         = $row['temp_end'];
        $temp_margin		     = $row['temp_margin'];
        $do_start	  	         = $row['do_start'];
        $do_end		             = $row['do_end'];
        $do_margin		         = $row['do_margin'];
        $ph_start		         = $row['ph_start'];
        $ph_end 		         = $row['ph_end'];  
        $ph_margin		         = $row['ph_margin']; 
        $pond_name               = $row['name'];  
        
        //array       
        
        
        $arr["pond"][$i]['id']   = $row['id'];
        $arr["pond"][$i]['name'] = $pond_name; 
   
        $polygons 	= array();  
        
              
        //polygon start
		$points 			= array();		
		$polygon_json 		= json_decode($row['polygon_json']);
		$polygon			= array();		
		$j = 0;
		foreach($polygon_json as $point){
			$point 					= explode(",",$point);
			$polygon[$j]["lat"] 	= $point[0];
			$polygon[$j]["lng"] 	= $point[1];
			$j++;
		}
        
        $pond_id         = $row['id'];		
		$polygons[$i][0] = $row['id'];
		$polygons[$i][1] = ""; //we will make content
		$polygons[$i][2] = $polygon;
		$polygons[$i][3] = $row['date_time'];
        $polygons[$i][4] = "#000000"; // we will decide color
        
        //color deciding        
        $rows2 = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? order by (timestamp) desc limit 1", array($pond_id), "rows");							
        foreach($rows2 as $row2){            
            $json       = json_decode($row2['json'], true);           
            
            $polygons[$i][1] .= "<table style='border-collapse:collapse !important; width:100% !important;'>";
            $polygons[$i][1] .= "<tr><th>Pond: </th><td>$pond_name</td></tr>";
            $polygons[$i][1] .= "<tr><th>Temp: </th><td>".$json['temp']." C</td></tr>";
            $polygons[$i][1] .= "<tr><th>DO: </th><td>".$json['d_o']." mg/L</td></tr>";
            $polygons[$i][1] .= "<tr><th>pH: </th><td>".$json['ph']."</td></tr>";
            $polygons[$i][1] .= "<tr><th>Time: </th><td>".my_simple_date($row2['timestamp'])."</td></tr>";
            $polygons[$i][1] .= "</table>";        
            
            if($json['temp'] >= ($temp_start) && $json['temp'] <= ($temp_end)){
                $polygons[$i][4] = "#34a853"; //green
            }if($json['d_o'] >= ($do_start) && $json['d_o'] <= ($do_end)){
                $polygons[$i][4] = "#34a853"; //green
            }if($json['ph'] >= ($ph_start) && $json['ph'] <= ($ph_end)){
                $polygons[$i][4] = "#34a853"; //green
            }if(($json['temp'] >= ($temp_start-$temp_margin) && $json['temp'] < ($temp_start))){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if($json['temp'] > ($temp_end) && $json['temp'] <= ($temp_end+$temp_margin)){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if(($json['d_o'] >= ($do_start-$do_margin) && $json['d_o'] < ($do_start))){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if($json['d_o'] > ($do_end) && $json['d_o'] <= ($do_end+$do_margin)){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if(($json['ph'] >= ($ph_start-$ph_margin) && $json['ph'] < ($ph_start))){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if($json['ph'] > ($ph_end) && $json['ph'] <= ($ph_end+$ph_margin)){
                $polygons[$i][4] = "#fbbc05"; //yellow
            }if($json['temp'] < ($temp_start-$temp_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }if($json['temp'] > ($temp_end+$temp_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }if($json['d_o'] < ($do_start-$do_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }if($json['d_o'] > ($do_end+$do_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }if($json['ph'] < ($ph_start-$ph_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }if($json['ph'] > ($ph_end+$ph_margin)){
                $polygons[$i][4] = "#ea4335"; //red 
            }             
        }        
        //color deciding
        
        
        $arr["pond"][$i]['polygon_json'] = $polygons; 
        
        if($row['update_date_time'] >= $timestamp_new){
            $timestamp_new = $row['update_date_time'];
        }      
        $i++; 
        
    }
    $arr['timestamp_new'] = $timestamp_new;
    echo json_encode($arr, true);
?>