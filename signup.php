<?php
	require_once('class_function/session.php');
	require_once('class_function/error.php');
	require_once('class_function/dbconfig.php');
	require_once('class_function/function.php');
	require_once('class_function/language.php');
        
    $this_email         = $xml->signup_screen->this_email; 
    $this_phone         = $xml->signup_screen->this_phone;
    $sorry_but          = $xml->signup_screen->sorry_but;
    $already_exists     = $xml->signup_screen->already_exists;  
    $please_try_later   = $xml->signup_screen->please_try_later;
    $success            = $xml->signup_screen->success;
    $you_signed_up      = $xml->signup_screen->you_signed_up;
    $exclamation_mark   = $xml->login_screen->exclamation_mark;    
               
        try { 
			// INSERT RECORD
			$fullname	 = strip_tags($_POST['fullname']);
			$email	     = strip_tags($_POST['email']);
			$contact	 = strip_tags($_POST['contact']);
			$address	 = "";//strip_tags($_POST['address']);
			$city	     = "";//strip_tags($_POST['city']);
			$country	 = "";//strip_tags($_POST['country']);
			$pass		 = strip_tags($_POST['password']);
			$md5_token   = md5($login_token);
			$password 	 = md5(md5(md5($md5_token) . md5($pass)) . md5($md5_token));
			
			$STH 			= $DBH->prepare("select count(*) FROM tbl_login where email =  ?");
			$result 	   	= $STH->execute(array($email));
			$count_email	= $STH->fetchColumn();
			
			
			$STH 			= $DBH->prepare("select count(*) FROM tbl_login where contact =  ?");
			$result 	   	= $STH->execute(array($contact));
			$count_contact	= $STH->fetchColumn();
			
			if($count_email == 1){
				$_SESSION['msg'] = "<strong> '$sorry_but', </strong> '$this_email' '$email' <strong>$already_exists</strong>!";
				redirect('index.php');				
			}else if($count_contact == 1){
				$_SESSION['msg'] = "<strong>'$sorry_but', </strong> '$this_phone'.'$contact' <strong>$already_exists</strong>!";
				redirect('index.php');				
			}else{
				sql($DBH,"INSERT INTO tbl_login (fullname, email, contact, address, city, country, password, pass_token, hash, date_time, access_level)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
				array($fullname, $email, $contact, $address, $city, $country, $password, $md5_token, unique_md5(), time(), "admin"));
				
				
							
				
				$_SESSION['info'] = "<strong>$success</strong> $exclamation_mark $you_signed_up $exclamation_mark";				
				redirect('index.php');
			}
			
		}
		catch(PDOException $e) { 
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND); # Errors Log File			
			$_SESSION['msg'] = "<strong>'$sorry_but', </strong> '$please_try_later'";
			redirect('index.php');	
			
		}
?>