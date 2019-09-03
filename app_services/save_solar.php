<?php
	header("Access-Control-Allow-Origin: *");

	require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');

  //die(json_encode($_REQUEST));

  $pond_id 								= $_GET['pond_id'];
  $solar_voltage 					= $_GET['solar_voltage'];
  $solar_ampere 					= $_GET['solar_ampere'];
  $battery_voltage 				= $_GET['battery_voltage'];
  $battery_ampere 				= $_GET['battery_ampere'];
  $battery_percentage 		= $_GET['battery_percentage'];
  $battery_charging 			= $_GET['battery_charging'];
  $load_voltage 					= $_GET['load_voltage'];
  $load_ampere 						= $_GET['load_ampere'];
  $energy_gen_24hrs 			= $_GET['energy_gen_24hrs'];
  $energy_gen_1week 			= $_GET['energy_gen_1week'];
  $energy_gen_1month 			= $_GET['energy_gen_1month'];
  $energy_used_24hrs 			= $_GET['energy_used_24hrs'];
  $energy_used_1week 			= $_GET['energy_used_1week'];
  $energy_used_1month 		= $_GET['energy_used_1month'];

  $row = sql($DBH,"insert  into tbl_solar_data
  (pond_id,
  solar_voltage,solar_ampere,
  battery_voltage,battery_ampere,battery_percentage,battery_charging,
  load_voltage,load_ampere,
  energy_gen_24hrs,energy_gen_1week,energy_gen_1month,
  energy_used_24hrs,energy_used_1week,energy_used_1month,date_time) values
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);",
  array($pond_id,
  $solar_voltage,$solar_ampere,
  $battery_voltage,$battery_ampere,$battery_percentage,$battery_charging,
  $load_voltage,$load_ampere,
  $energy_gen_24hrs,$energy_gen_1week,$energy_gen_1month,$energy_used_24hrs,
  $energy_used_1week,$energy_used_1month,time()),"rows");

	echo "Solar Data Saved";

?>
