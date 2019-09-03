<?php
	require_once('class_function/session.php');
	require_once('class_function/error.php');
	require_once('class_function/dbconfig.php');
	require_once('class_function/function.php');
	require_once('class_function/language.php');
	
    
    $welcome_back               = $xml->login_screen->welcome_back;
    $you_are_login_as           = $xml->login_screen->you_are_login_as;
    $invalid_password           = $xml->login_screen->invalid_password;
    $invalid_email_or_password  = $xml->login_screen->invalid_email_or_password ;
    
    //if(isset($_POST['username']) && isset($_POST['password'])){
          
            
        $email	   		 = strip_tags($_POST['username']);
	    $password		 = strip_tags($_POST['password']);
        
        $STH 	 = $DBH->prepare("SELECT count(*) FROM tbl_login WHERE (email = ? OR contact = ?) AND status = ?");
        $result  = $STH->execute(array($email,$email,"active"));
        $count	 = $STH->fetchColumn();
         
        if($count == 1){
            
            $rows = sql($DBH, "SELECT * FROM tbl_login where (email = ? OR contact = ?)", array($email,$email), "rows");							
            foreach($rows as $row){	
                $id = $row['id']; //to login
                
                if($row['password'] == md5(md5(md5($row['pass_token']) . md5($password)) . md5($row['pass_token']))){
					$rows = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($id), "rows");							
                    foreach($rows as $row){	
                        session_regenerate_id();
                		$_SESSION['SESS_ID']  					= $row['id'];
                        $_SESSION['SESS_FB_ID']  			    = $row['fb_id'];
                        $_SESSION['SESS_USER_TOKEN']    	    = $row['access_token'];
                		$_SESSION['SESS_FULLNAME']  		    = $row['fullname'];
                		$_SESSION['SESS_EMAIL']  	  	     	= $row['email'];
                        $_SESSION['SESS_CRON_EMAIL']            = $row['cron_email'];
                		$_SESSION['SESS_CONTACT']  		 	    = $row['contact'];
                		$_SESSION['SESS_ADDRESS']  		 	    = $row['address'];
                		$_SESSION['SESS_USERNAME']  		    = $row['username'];
                		$_SESSION['SESS_PASSWORD']  			= $row['password'];
                		$_SESSION['SESS_PASS_TOKEN']  			= $row['pass_token'];
                		$_SESSION['SESS_PHOTO']   	 			= $row['photo'];
                        $_SESSION['SESS_CITY']   	 			= $row['city'];
                        $_SESSION['SESS_COUNTRY']   	 		= $row['country'];
                		$_SESSION['SESS_REGISTRATION_DATE']   	= $row['date_time'];
                		$_SESSION['SESS_ACCESS_LEVEL']   	 	= $row['access_level'];
                		$_SESSION['SESS_MODULE_ACCESS']   	 	= $row['module_access'];
                		$_SESSION['SESS_HASH']   	 	 		= $row['hash'];
                		$_SESSION['SESS_STATUS']   	 			= $row['status'];
                		$_SESSION['SESS_LOGIN_TOKEN']   	 	= $login_token;
                		$_SESSION['msg'] = "$welcome_back<b> ".$row['fullname']."</b>! $you_are_login_as <b>".ucfirst($row['access_level'])."</b>";
						
						$_SESSION['SESS_DEVICE_ID']		        = $row['id'];
						$_SESSION['SESS_DEVICE_NAME']	        = $row['fullname'];
                        						
                        session_write_close();
                    }
                    
    				
                    
                    redirect('admin/index.php');
                    
				}
				else{
					$_SESSION['msg'] = "$invalid_password";
                    redirect('index.php');
				}
            }
        }else{
            $_SESSION['msg'] = "$invalid_email_or_password";
            redirect('index.php');
    	}
    //}
?>