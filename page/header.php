<?php
      require_once('../class_function/language.php');
      require_once('../class_function/language.php');
        
       $device_colon_xml        = $xml->header->device_colon;
       $add_new_user_xml        = $xml->header->add_new_user;
       $you_xml                 = $xml->header->you;
       $download_app_xml        = $xml->header->download_app;
       $my_profile_xml          = $xml->header->my_profile;
       $set_default_access_xml  = $xml->header->set_default_access;
       $geo_fencing_xml         = $xml->header->geo_fencing;
       $logout_xml              = $xml->header->logout;
       $root_admin_xml          = $xml->header->root_admin;
       $admin_xml               = $xml->header->admin;
       $user_xml                = $xml->header->user;                    
                                                               
                
		if($SESS_ACCESS_LEVEL == "Super Administrator"){
			$shop = "<li class='classic-menu-dropdown active' aria-haspopup='true'>
					<a href='profile.php'> <i style='color: #fff;' class='fa fa-star'></i>'.$admin_xml.'
						<span class='selected'></span>
					</a>
				</li>";
		}
		
        if($selected_lang == "en"){
            $en_class = "green";
            $my_class = "default";            
        }else if($selected_lang == "my"){
            $en_class = "default";
            $my_class = "green";            
        }
        
        
        $header = '<div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <div class="page-logo">
                        <a href="index.php">
                            <h3 class="logo-default">'.$website_title.'</h3>
                        </a>                        
                    </div> 
                    <div class="hor-menu hidden-sm hidden-xs">
                        <ul class="nav navbar-nav">';                            
                        $header .= '<li class="classic-menu-dropdown active" aria-haspopup="true">
                            <a href="profile.php"> <i style="color: #fff;" class="fa fa-user"></i> '.ucfirst($SESS_ACCESS_LEVEL).'
                                <span class="selected"></span>
                            </a>
                        </li>';
                        $header .= '</ul>
                    </div>  
                    
                    <div class="top-menu hidden" style="float:left;">
                        <ul class="nav navbar-nav pull-left">    
                            <li class="dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" style="color:#FFF !important;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="fa fa-mobile" style="color:#FFF !important;"></i> '.$SESS_DEVICE_NAME.' <i class="fa fa-angle-down" style="color:#FFF !important;"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="dropdown-menu-list scroller dropdown-menu-default" style="height: 250px;" data-handle-color="#637283">
                                            
                                            ';
                                            
                                            $header .= '<li>
                                                        <a href="select_device.php?id='.$SESS_ID.'">
                                                            <span class="details">
                                                            <span class="label label-sm label-icon label-success">
                                                                <i class="fa fa-user"></i>
                                                            </span> '.$SESS_FULLNAME.' </span>
                                                        </a>
                                                    </li>';
							
                                            $rows = sql($DBH, "SELECT * FROM tbl_login where access_level = ? and parent_id = ? AND status = ?", 
                							array("user",$SESS_ID,"active"), "rows");
                							foreach($rows as $row){	
                								$id					= $row['id'];
                								$fullname			= $row['fullname'];
                								
                                                
                                                $header .= '<li>
                                                                <a href="select_device.php?id='.$id.'">
                                                                    <span class="details">
                                                                    <span class="label label-sm label-icon label-success">
                                                                        <i class="fa fa-mobile"></i>
                                                                    </span> '.$fullname.' </span>
                                                                </a>
                                                            </li>';
                							}                            
                							
                							
                							$header .= '<li>
                                                    <a href="add_user.php">
                                                        <span class="details">
                                                        <span class="label label-sm label-icon label-success '.$selected_class.'">
                                                            <i class="fa fa-plus"></i>
                                                        </span> '.$add_new_user_xml.' </span>
                                                    </a>
                                                </li>';
                                            
                                            
                                            
                                            $header .= '
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>    
                    </div>
                         
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>                    
                    
                    <!-- END TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="'.$SESS_PHOTO.'" />
                                    <span class="username username-hide-on-mobile"> '.$SESS_FULLNAME.'</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="profile.php">
                                            <i class="icon-user"></i> '.$my_profile_xml.' <span class="badge badge-success"> '.ucfirst($SESS_ACCESS_LEVEL).'</span>  											
										</a> 
                                    </li>';
																		
                                    $header .= '<li class="divider"> </li>                                    
                                    <li>
                                        <a href="../logout.php">
                                            <i class="icon-key"></i> '.$logout_xml.' </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">                            
                            
                            <li class="dropdown" style="padding:10px">
                                <div class="btn-toolbar"> 
                                	<div class="btn-group btn-group-sm btn-group-solid">
                                		<a style="border-radius:5px 0 0 5px !important; padding: 5px 2px 5px 2px; min-width:45px;" href="select_lang.php?lang=en" class="btn '.$en_class.'">EN</a>
                                		<a style="border-radius:0 5px 5px 0 !important; padding: 5px 2px 5px 2px; min-width:45px;" href="select_lang.php?lang=my" class="btn '.$my_class.'">MY</a>
                                	</div>
                                </div>
                            </li>
                                                  
                        </ul>                        
                        
                    </div>
                    
                </div>
                <!-- END HEADER INNER -->
            </div>';        
                            
                            
            $order_header = "";
?>