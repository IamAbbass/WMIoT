<?php
	header("Access-Control-Allow-Origin: *");

	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');

    //Temperature Correction
    $temperature_correction = array();
    $temperature_correction[0]=1.000;
    $temperature_correction[1]=0.973;
    $temperature_correction[2]=0.947;
    $temperature_correction[3]=0.922;
    $temperature_correction[4]=0.898;
    $temperature_correction[5]=0.876;
    $temperature_correction[6]=0.854;
    $temperature_correction[7]=0.829;
    $temperature_correction[8]=0.814;
    $temperature_correction[9]=0.788;
    $temperature_correction[10]=0.777;
    $temperature_correction[11]=0.753;
    $temperature_correction[12]=0.742;
    $temperature_correction[13]=0.719;
    $temperature_correction[14]=0.709;
    $temperature_correction[15]=0.694;
    $temperature_correction[16]=0.679;
    $temperature_correction[17]=0.658;
    $temperature_correction[18]=0.650;
    $temperature_correction[19]=0.637;
    $temperature_correction[20]=0.623;
    $temperature_correction[21]=0.610;
    $temperature_correction[22]=0.596;
    $temperature_correction[23]=0.589;
    $temperature_correction[24]=0.575;
    $temperature_correction[25]=0.563;
    $temperature_correction[26]=0.555;
    $temperature_correction[27]=0.541;
    $temperature_correction[28]=0.534;
    $temperature_correction[29]=0.527;
    $temperature_correction[30]=0.513;
    $temperature_correction[31]=0.504;
    $temperature_correction[32]=0.494;
    $temperature_correction[33]=0.485;
    $temperature_correction[34]=0.475;
    $temperature_correction[35]=0.474;

    //get variables
    $pond_id        = $_GET['id'];
    $filter         = $_GET['filter'];

    //variable initialization
    $arr            =   array();
    $i              =   0;
    $timestamp_new  =   $timestamp;

    //pond tolerate ranges
    $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where id = ? ", array($pond_id), "rows");
		foreach($rows as $row){
			$arr['name']      = $row['name'];
			$temp_start		    = $row['temp_start'];
			$temp_end		    	= $row['temp_end'];
			$temp_margin			= $row['temp_margin'];
			$do_start	  	    = $row['do_start'];
			$do_end		        = $row['do_end'];
			$do_margin		    = $row['do_margin'];
			$ph_start		    	= $row['ph_start'];
			$ph_end 		    	= $row['ph_end'];
			$ph_margin		    = $row['ph_margin'];
    }

    //logic
    if($filter == "last_reading"){
        $tbl_pond_log = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? order by(timestamp) desc limit 1",
        array($pond_id), "rows");
    }else if($filter == "24h" || $filter == "12h" || $filter == "6h" || $filter == "3h"){
        if($filter == "24h"){
            $timestamp      = time()-86400;     //last 24 hour
        }else if($filter == "12h"){
            $timestamp      = time()-43200;     //last 12 hour
        }else if($filter == "6h"){
            $timestamp      = time()-21600;     //last 6 hour
        }else if($filter == "3h"){
            $timestamp      = time()-10800;     //last 3 hour
        }
        $timestamp_end  = time();               //now

        $tbl_pond_log = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? and timestamp > ? AND timestamp < ? order by(timestamp) asc",
        array($pond_id,$timestamp,$timestamp_end), "rows");

    }else if($filter == "input"){//custom date ranges
        $timestamp      = strtotime($_GET['ts']);//start
				$timestamp_end	= strtotime($_GET['ts_end']);//end

        if(strlen($timestamp_end) == 0){
            $timestamp_end = time();//end
        }

        $tbl_pond_log = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? and timestamp > ? AND timestamp < ? order by(timestamp) asc",
        array($pond_id,$timestamp,$timestamp_end), "rows");
    }


    if($pond_id == 3){ // SF

        //Standard DO start
        $rows = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? order by(timestamp) desc limit 1",
        array(1), "rows");
        foreach($rows as $row){
            $json   = json_decode($row['json'], true);
            $arr["data"][$i]['temp']        = $json['temp'];
            $temperature = $json['temp']+273.15;
        }

        $T = (-139.3411)+(157570.1/$temperature)-(66423080/pow($temperature,2))+(12438000000/pow($temperature,3))-(862194900000/pow($temperature,4));
        $arr["data"][$i]['d_o'] = round(exp($T),2);
        //Standard DO end

        //Standard pH Start
        $ph1 = 4.00;
        $ph2 = 7.00;
        $E1 = 580;
        $E2 = 1025;
        $slope = ($E2-$E1)/($ph2-$ph1);

        $temp_c_value   = ($slope)/(273.15 + 25);
        $pH             = $temp_c_value*$temperature;
        $arr["data"][$i]['ph']  = $pH;
        //Standard pH End

        $arr["data"][$i]['lat']         = $row['lat'];
        $arr["data"][$i]['lon']         = $row['lon'];
        $arr["data"][$i]['date_time']   = my_simple_date($row['timestamp']);
        $arr["data"][$i]['timestamp']   = $row['timestamp'];

        if($json['temp'] < ($temp_start-$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-red";
            $arr["data"][$i]['temp_alert']      = "Very low temperature";
        }else if($json['temp'] > ($temp_end+$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-red";
            $arr["data"][$i]['temp_alert']      = "Very high temperature";
        }else if(($json['temp'] >= ($temp_start-$temp_margin) && $json['temp'] < ($temp_start))){
            $arr["data"][$i]['temp_color']      = "text-yellow";
            $arr["data"][$i]['temp_alert']      = "Low temperature";
        }else if($json['temp'] > ($temp_end) && $json['temp'] <= ($temp_end+$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-yellow";
            $arr["data"][$i]['temp_alert']      = "High temperature";
        }else if($json['temp'] >= ($temp_start) && $json['temp'] <= ($temp_end)){
            $arr["data"][$i]['temp_color']      = "text-green";
            $arr["data"][$i]['temp_alert']      = "";
        }

        if($json['d_o'] < ($do_start-$do_margin)){
            $arr["data"][$i]['do_color']        = "text-red";
            $arr["data"][$i]['do_alert']        = "Very low DO";
        }else if($json['d_o'] > ($do_end+$do_margin)){
            $arr["data"][$i]['do_color']        = "text-red";
            $arr["data"][$i]['do_alert']        = "Very high DO";
        }else if(($json['d_o'] >= ($do_start-$do_margin) && $json['d_o'] < ($do_start))){
            $arr["data"][$i]['do_color']        = "text-yellow";
            $arr["data"][$i]['do_alert']        = "Low DO";
        }else if($json['d_o'] > ($do_end) && $json['d_o'] <= ($do_end+$do_margin)){
            $arr["data"][$i]['do_color']        = "text-yellow";
            $arr["data"][$i]['do_alert']        = "High DO";
        }else if($json['d_o'] >= ($do_start) && $json['d_o'] <= ($do_end)){
            $arr["data"][$i]['do_color']        = "text-green";
            $arr["data"][$i]['do_alert']        = "";
        }

        if($json['ph'] < ($ph_start-$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-red";
            $arr["data"][$i]['ph_alert']        = "Very low pH";
        }else if($json['ph'] > ($ph_end+$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-red";
            $arr["data"][$i]['ph_alert']        = "Very high pH";
        }else if(($json['ph'] >= ($ph_start-$ph_margin) && $json['ph'] < ($ph_start))){
            $arr["data"][$i]['ph_color']        = "text-yellow";
            $arr["data"][$i]['ph_alert']        = "Low pH";
        }else if($json['ph'] > ($ph_end) && $json['ph'] <= ($ph_end+$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-yellow";
            $arr["data"][$i]['ph_alert']        = "High pH";
        }else if($json['ph'] >= ($ph_start) && $json['ph'] <= ($ph_end)){
            $arr["data"][$i]['ph_color']        = "text-green";
            $arr["data"][$i]['ph_alert']        = "";
        }

        //battery

				$battery_charging = false;
				$solar_voltage = "";
				$battery_percentage = "";

				$rows_solar = sql($DBH,"select * from tbl_solar_data where pond_id = ? order by (date_time) DESC limit 1",array($pond_id),"rows");
		    foreach($rows_solar as $row){
		      $solar_voltage = $row['solar_voltage'];
					$battery_percentage = $row['battery_percentage'];
		      $battery_charging = $row['battery_charging'];
		    }

        $arr["data"][$i]['battery_status']      = $battery_percentage;
        $arr["data"][$i]['battery_charging']    = $battery_charging === 'true'? true: false;
        $arr["data"][$i]['solar_status']        = $solar_voltage;
    }

    //pond log
    foreach($tbl_pond_log as $row){
        $json   = json_decode($row['json'], true);


        if($pond_id == 1){//AS
            //make standards START
            $temperature = $json['temp']+273.15;
            $T = (-139.3411)+(157570.1/$temperature)-(66423080/pow($temperature,2))+(12438000000/pow($temperature,3))-(862194900000/pow($temperature,4));
            $arr["data"][$i]['d_o_st'] = round(exp($T),2);
            //make standards END

        }else if($pond_id == 2){ //mV readings

            //DO stabilizing start

            $do_arr = array();
            $do_history = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ?
            order by(timestamp) desc limit 1", array($pond_id), "rows");
            foreach($do_history as $do_history_row){
                $json2   = json_decode($do_history_row['json'], true);
                $d_o_old = $json2['d_o'];
                if(is_numeric($d_o_old)){
                    $do_arr[] = $d_o_old;
                }
            }
            $do_arr[] = $json['d_o'];//new one
            $do_new = array_sum($do_arr)/count($do_arr);
            $json['d_o'] = $do_new;


            //temperature factor
            /*
            $temperature_dec    = floor($json['temp']);
            $temperature_float  = $json['temp']-$temperature_dec;
            $temp_factor = $temperature_correction[$temperature_dec];


            if($temperature_float > 0){
                $temp1  = $temperature_correction[$temperature_dec];
                $temp2  = $temperature_correction[$temperature_dec+1];
                $diff   = ($temp1-$temp2);
                $diff   = ($diff/100)*$temperature_float;
                $temp_factor = $temp_factor+$diff;
            }
            $do_new         = (($do_new*100)/2048)*$temp_factor;
            $json['d_o']    = $do_new;
            */


            //ph Start

            //slope
            $ph1 = 4.00;
            $ph2 = 7.00;
            $E1 = 1025;
            $E2 = 580;
            $s = ($E2-$E1)/($ph1-$ph2);

            //stabilize

            $ph_arr = array();
            $ph_history = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ?
            order by(timestamp) desc limit 10", array($pond_id), "rows");
            foreach($ph_history as $ph_history_row){
                $json2   = json_decode($ph_history_row['json'], true);
                $ph_old = $json2['ph'];
                //if(is_numeric($ph_old)){
                    $ph_arr[] = $ph_old;
                //}
            }
            $ph_arr[] = $json['ph'];//new one
            $ph_new = array_sum($ph_arr)/count($ph_arr);
            $json['ph'] = $ph_new;
        }



        $arr["data"][$i]['d_o']         = $json['d_o'];
        $arr["data"][$i]['ph']          = $json['ph'];
        $arr["data"][$i]['temp']        = $json['temp'];
        $arr["data"][$i]['lat']         = $row['lat'];
        $arr["data"][$i]['lon']         = $row['lon'];
        $arr["data"][$i]['date_time']   = my_simple_date($row['timestamp']);
        $arr["data"][$i]['timestamp']   = $row['timestamp'];

        if($json['temp'] < ($temp_start-$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-red";
            $arr["data"][$i]['temp_alert']      = "Very low temperature";
        }else if($json['temp'] > ($temp_end+$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-red";
            $arr["data"][$i]['temp_alert']      = "Very high temperature";
        }else if(($json['temp'] >= ($temp_start-$temp_margin) && $json['temp'] < ($temp_start))){
            $arr["data"][$i]['temp_color']      = "text-yellow";
            $arr["data"][$i]['temp_alert']      = "Low temperature";
        }else if($json['temp'] > ($temp_end) && $json['temp'] <= ($temp_end+$temp_margin)){
            $arr["data"][$i]['temp_color']      = "text-yellow";
            $arr["data"][$i]['temp_alert']      = "High temperature";
        }else if($json['temp'] >= ($temp_start) && $json['temp'] <= ($temp_end)){
            $arr["data"][$i]['temp_color']      = "text-green";
            $arr["data"][$i]['temp_alert']      = "";
        }

        if($json['d_o'] < ($do_start-$do_margin)){
            $arr["data"][$i]['do_color']        = "text-red";
            $arr["data"][$i]['do_alert']        = "Very low DO";
        }else if($json['d_o'] > ($do_end+$do_margin)){
            $arr["data"][$i]['do_color']        = "text-red";
            $arr["data"][$i]['do_alert']        = "Very high DO";
        }else if(($json['d_o'] >= ($do_start-$do_margin) && $json['d_o'] < ($do_start))){
            $arr["data"][$i]['do_color']        = "text-yellow";
            $arr["data"][$i]['do_alert']        = "Low DO";
        }else if($json['d_o'] > ($do_end) && $json['d_o'] <= ($do_end+$do_margin)){
            $arr["data"][$i]['do_color']        = "text-yellow";
            $arr["data"][$i]['do_alert']        = "High DO";
        }else if($json['d_o'] >= ($do_start) && $json['d_o'] <= ($do_end)){
            $arr["data"][$i]['do_color']        = "text-green";
            $arr["data"][$i]['do_alert']        = "";
        }

        if($json['ph'] < ($ph_start-$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-red";
            $arr["data"][$i]['ph_alert']        = "Very low pH";
        }else if($json['ph'] > ($ph_end+$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-red";
            $arr["data"][$i]['ph_alert']        = "Very high pH";
        }else if(($json['ph'] >= ($ph_start-$ph_margin) && $json['ph'] < ($ph_start))){
            $arr["data"][$i]['ph_color']        = "text-yellow";
            $arr["data"][$i]['ph_alert']        = "Low pH";
        }else if($json['ph'] > ($ph_end) && $json['ph'] <= ($ph_end+$ph_margin)){
            $arr["data"][$i]['ph_color']        = "text-yellow";
            $arr["data"][$i]['ph_alert']        = "High pH";
        }else if($json['ph'] >= ($ph_start) && $json['ph'] <= ($ph_end)){
            $arr["data"][$i]['ph_color']        = "text-green";
            $arr["data"][$i]['ph_alert']        = "";
        }

        //battery
				$battery_charging = false;
				$solar_voltage = "";
				$battery_percentage = "";

				$rows_solar = sql($DBH,"select * from tbl_solar_data where pond_id = ? order by (date_time) DESC limit 1",array($pond_id),"rows");
		    foreach($rows_solar as $row){
		      $solar_voltage = $row['solar_voltage'];
					$battery_percentage = $row['battery_percentage'];
		      $battery_charging = $row['battery_charging'];
		    }

        $arr["data"][$i]['battery_status']      = $battery_percentage;
        $arr["data"][$i]['battery_charging']    = $battery_charging === 'true'? true: false;
        $arr["data"][$i]['solar_status']        = $solar_voltage;

        if($row['timestamp'] >= $timestamp_new){
            $timestamp_new = $row['timestamp'];
        }
        $i++;
    }
    //new time stamp
    $arr['timestamp_new'] = $timestamp_new;
    echo json_encode($arr, true);
?>
