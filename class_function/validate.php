<?php  
    session_start();    
    if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')){			
        //$_SESSION["looking_for"] = "https://saegroup.us/saegroup/res".$_SERVER['REQUEST_URI'];
        //logout check admin or vendor or affiliate
        redirect('../index.php');
	}					
      
?>