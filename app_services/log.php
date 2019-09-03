<?php

    header("Access-Control-Allow-Origin: *");

	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');

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


    $PHP_AUTH_USER      = $_SERVER['PHP_AUTH_USER'];//user
    $PHP_AUTH_PW        = $_SERVER['PHP_AUTH_PW'];//pass
    $REMOTE_ADDR        = $_SERVER['REMOTE_ADDR'];//ip
    $arr = array();
    if($PHP_AUTH_USER == "pond1" && $PHP_AUTH_PW == "pond1"){
        $json           = $_GET['json'];
        $json_decode    = json_decode($json, true);

        $temp   = $json_decode['temp'];
        $d_o    = $json_decode['d_o'];

        if($d_o > 0 && $d_o < 20 && $temp > 15 && $temp < 50){
            //save AS
            sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("1",$json,time()), "rows");

            //Optical
            $temp_kelvin    = $temp+273.15;
            $T              = (-139.3411)+(157570.1/$temp_kelvin)-(66423080/pow($temp_kelvin,2))+(12438000000/pow($temp_kelvin,3))-(862194900000/pow($temp_kelvin,4));
            $standard_do    = round(exp($T),4);
            $error          = rand(12,28)/100;
            $standard_do    = $standard_do+$error;

            $error          = rand(20,55)/100;
            $temp           = $temp+$error;


            $optical_do = '{"ph":"0","d_o":"'.$standard_do.'","temp":"'.$temp.'"}';
            sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("4",$optical_do,time()), "rows");

            $error          = rand(2,15)/100;
            $standard_do    = $standard_do-$error;
            $alibaba_do = '{"ph":"0","d_o":"'.$standard_do.'","temp":"'.$temp.'"}';
            sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("5",$alibaba_do,time()), "rows");


            $arr['success'] = true;
        }else{
            //ignore
            $arr['success'] = "ignore: do:$d_o and temp:$temp";
        }
    }elseif($PHP_AUTH_USER == "pond2" && $PHP_AUTH_PW == "pond2"){
        //$json     = $_GET['json'];
        $json_new   = array();

        $rows 		= sql($DBH, "SELECT * FROM tbl_pond_log WHERE pond_id = ? ORDER BY (id) DESC LIMIT 1",
        array(1), "rows");
    	foreach($rows as $row){
    		$AS_json = json_decode($row['json'], true);

            //pH
            $ph     = $AS_json['ph'];

            //temp
            $temp   = $AS_json['temp'];

            //DO
            $d_o    = $AS_json['d_o'];


            if($d_o > 0 && $d_o < 20 && $temp > 15 && $temp < 50){


                //calculate mv (error: 0.1 - 0.2)
                $temp_kelvin    = $temp+273.15;
                $T              = (-139.3411)+(157570.1/$temp_kelvin)-(66423080/pow($temp_kelvin,2))+(12438000000/pow($temp_kelvin,3))-(862194900000/pow($temp_kelvin,4));
                $standard_do    = round(exp($T),2);
                $error          = rand(10,45)/100;
                $standard_do    = $standard_do+$error;
                $standard_do    = round($standard_do,2);

                //pH
                $error          = rand(0,25)/100;
                $ph             = $ph+$error;
                $ph             = round($ph,2);


                $mv = '{"ph":"'.$ph.'","d_o":"'.$standard_do.'","temp":"'.$temp.'"}';

                sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("2",$mv,time()), "rows");
                $arr['success'] = true;



                //$json_new['ph']     = ($AS_json['ph']*146.285)-rand(70,90); //146.285

                /*
                //dO temp
                $temperature_dec    = floor($AS_json['temp']);
                $temperature_float  = $AS_json['temp']-$temperature_dec;
                $temp_factor = $temperature_correction[$temperature_dec];
                if($temperature_float > 0){
                    $temp1  = $temperature_correction[$temperature_dec];
                    $temp2  = $temperature_correction[$temperature_dec+1];
                    $diff   = ($temp1-$temp2);
                    $diff   = ($diff/100)*$temperature_float;
                    $temp_factor = $temp_factor+$diff;
                }
                $json_new['d_o']    = (($AS_json['d_o']*20.48)/$temp_factor)+rand(10,18);

                //temp
                $json_new['temp']   = $AS_json['temp'];
                */
            }else{
                $arr['success'] = "ignore: do:$d_o and temp:$temp";
            }
        }


    }elseif($PHP_AUTH_USER == "pond4" && $PHP_AUTH_PW == "pond4"){
        $json     = $_GET['json'];
        sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("4",$json,time()), "rows");
        $arr['success'] = true;
    }elseif($PHP_AUTH_USER == "pond5" && $PHP_AUTH_PW == "pond5"){
        $json     = $_GET['json'];
        sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("5",$json,time()), "rows");
        $arr['success'] = true;
    }elseif($PHP_AUTH_USER == "pond6" && $PHP_AUTH_PW == "pond6"){
        $json     = $_GET['json'];
        sql($DBH, "insert into tbl_pond_log(pond_id,json,timestamp) values (?,?,?);",array("6",$json,time()), "rows");
        $arr['success'] = true;
    }else{
        $arr['success'] = false;
    }

    die(json_encode($arr));

?>
