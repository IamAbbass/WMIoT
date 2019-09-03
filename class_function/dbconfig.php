<?php
	header("Access-Control-Allow-Origin: *");
        
	$host = 'localhost'; $dbname = 'zedexper_mmrs_wmiot'; $user = 'zedexper_mmrs'; $pass = 'zedexper_mmrs';
	
	
	# connect to the database 
	try { 
	  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); 
	  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  # set error attribute
	} 
	catch(PDOException $e) { 
		echo "A Database Error Occurred, Please Contact Your System Administrator"; 
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND); # Errors Log File
	}
?>
