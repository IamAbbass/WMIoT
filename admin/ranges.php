<?php
    
    require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
	require_once('../class_function/function.php');
	require_once('../class_function/validate.php');
	require_once('../class_function/language.php');
	require_once('../page/title.php');
	require_once('../page/meta.php');
	require_once('../page/header.php');
	require_once('../page/menu.php');
    require_once('../page/footer.php');
    
    $installed_apps_xml         = $xml->installed_apps->users_installed_apps;
    $last_synced_xml            = $xml->installed_apps->last_synced;
    $never_synced_xml           = $xml->installed_apps->never_synced;
    $entries_xml                = $xml->installed_apps->entries;
    $search_colon_xml           = $xml->installed_apps->search_colon;
    $app_name_xml               = $xml->installed_apps->app_name;
    $app_icon_xml               = $xml->installed_apps->app_icon;
    $no_data_xml                = $xml->installed_apps->no_data;
    $app_id_xml                 = $xml->installed_apps->app_id;
    $app_package_name_xml       = $xml->installed_apps->app_package_name;
    $action_xml                 = $xml->installed_apps->action;
    $blocked_xml                = $xml->installed_apps->blocked;
    $unblocked_xml              = $xml->installed_apps->unblocked;
    $access_denied_xml          = $xml->installed_apps->access_denied;
    $no_access_xml              = $xml->installed_apps->no_access;
    
    
    $id = $_GET['id'];
    $STH 	 		= $DBH->prepare("SELECT count(*) FROM tbl_geo_fence where id = ?");
    $result  		= $STH->execute(array($id));
    $valid_user	    = $STH->fetchColumn();
    if($valid_user == 1){
        $rows = sql($DBH, "SELECT * FROM tbl_geo_fence where id = ?", array($id), "rows");
        foreach($rows as $row){	
    	   $user_id     = $row['user_id']; 
           $pond_name	= $row['name'];
        }
    }else{
        redirect("list_users.php");
    }
                      
    $rows 		= sql($DBH, "SELECT * FROM tbl_login where id = ? ", array($user_id), "rows");		
    foreach($rows as $row){	
        $user_fullname	= $row['fullname'];
    }
 
?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
<?php
	echo $title;
	echo $meta;
	echo $favicon;
?>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		
		<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <style>
            .small_pic{
                width:100%;
                border-radius:100%;
            }
            .refresh_btn{
                padding: 22px !important;
                font-size: 18px !important;
            }     
            .list-title{
                
            }
            .no-margin{
                margin: 0 !important;
            }  
            .store_logo, .mt-element-list .list-news.ext-1 .list-thumb{
                width:60px !important;
                height:60px !important;
            } 
            .mt-widget-1{
                border:none;
            }
			.user-dp{
				width:50px; 
				border-radius:100% !important;
				padding:3px;
				background:#eee;
				border:1px solid #ccc;
			}
			#reportrange span{
				display:none;
			}
        </style>
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
<?php
	echo $header;
?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
<?php
	echo $menu;
?>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <!-- END PAGE HEADER-->
                        
                        
                        <h1 class="page-title"> <i class="fa fa-sliders"></i> Tolerant Range for <b><?php echo $pond_name ?></b> <small>(Assigned to <a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $user_fullname; ?></a>)</small> </h1>
                        
                        
                        <?php
							if($_SESSION['msg']){        
								$error = "<div class='note note-danger remove_after_5'><p>".$_SESSION['msg']."</p></div>"; 	
								unset($_SESSION['msg']);
							}else if($_SESSION['info']){        
								$error = "<div class='note note-success remove_after_5'><p>".$_SESSION['info']."</p></div>"; 	
								unset($_SESSION['info']);
							}else{
								$error = "";  
							}
							
							echo $error;
						?>
                        
                        <div class="row">							
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                
                                <p style="margin: 0;">
                                    <b>Colors:</b>
                                    <span class="btn btn-success btn-sm">GOOD</span>
                                    <span class="btn btn-warning btn-sm">WARNING</span>
                                    <span class="btn btn-danger btn-sm">DANGER</span>
                                    <br /><br />
                                </p>
                                
                        		<table class="table table-striped table-bordered table-hover table-header-fixed">
									<thead>
										<tr>
											<th>Temperature Range(°C )</th>
                                            <th>DO Range(mg/L)</th>
                                            <th>pH Range</th>
                                            <th>Options</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
										
													
											$polygons 	= array();	
                                        	$rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where id = ? ", array($id), "rows");		
                                        	$sno 		= 0;
                                        	foreach($rows as $row){	
                                        		$sno++;
                                        		$id					= $row['id'];
                                        		$name				= $row['name'];
                                        		$polygon_json		= $row['polygon_json'];                                                        
                                                $temp_start		    = $row['temp_start'];
                                                $temp_end		    = $row['temp_end'];
                                                $temp_margin		= $row['temp_margin'];
                                                $do_start	  	    = $row['do_start'];
                                                $do_end		        = $row['do_end'];
                                                $do_margin		    = $row['do_margin'];
                                                $ph_start		    = $row['ph_start'];
                                                $ph_end 		    = $row['ph_end'];  
                                                $ph_margin		    = $row['ph_margin'];                                                      
                                        		$date_time			= my_simple_date($row['date_time']);                                                		                                                      
												
                                                $temp_range = "<span class='text-danger'>Less than ".($temp_start-$temp_margin)."</span><br>";
                                                $temp_range .= "<span class='text-warning'>Between ".($temp_start-$temp_margin)." and ".($temp_start)."</span><br>";
                                                $temp_range .= "<span class='text-success'>Between ".$temp_start." and ".$temp_end."</span><br>";
                                                $temp_range .= "<span class='text-warning'>Between ".($temp_end)." and ".($temp_end+$temp_margin)."</span><br>";
                                                $temp_range .= "<span class='text-danger'>Greater than ".($temp_end+$temp_margin)."</span>";
                                                
                                                $do_range = "<span class='text-danger'>Less than ".($do_start-$do_margin)."</span><br>";
                                                $do_range .= "<span class='text-warning'>Between ".($do_start-$do_margin)." and ".($do_start)."</span><br>";
                                                $do_range .= "<span class='text-success'>Between ".$do_start." and ".$do_end."</span><br>";
                                                $do_range .= "<span class='text-warning'>Between ".($do_end)." and ".($do_end+$do_margin)."</span><br>";
                                                $do_range .= "<span class='text-danger'>Greater than ".($do_end+$do_margin)."</span>";
                                                
                                                $ph_range = "<span class='text-danger'>Less than ".($ph_start-$ph_margin)."</span><br>";
                                                $ph_range .= "<span class='text-warning'>Between ".($ph_start-$ph_margin)." and ".($ph_start)."</span><br>";
                                                $ph_range .= "<span class='text-success'>Between ".$ph_start." and ".$ph_end."</span><br>";
                                                $ph_range .= "<span class='text-warning'>Between ".($ph_end)." and ".($ph_end+$ph_margin)."</span><br>";
                                                $ph_range .= "<span class='text-danger'>Greater than ".($ph_end+$ph_margin)."</span>";
                                                
												echo "<tr>
													<td>$temp_range</td>
                                                    <td>$do_range</td>
                                                    <td>$ph_range</td>
                                                    <td>
                                                        <a href='update_range.php?id=$id' class='btn btn-success btn-sm'>
                                                            <i class='fa fa-pencil'></i> Update Range
                                                        </a>
                                                    </td>
													
												</tr>";
											}
										
										?>
										
									</tbody>
								</table>
							</div>
                            
                            
                        
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
<?php
	echo $footer;
?>
            <!-- END FOOTER -->
        </div>
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
		<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
		<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		
		<script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL SCRIPTS -->
		<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
		<!-- END THEME GLOBAL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="assets/pages/scripts/table-datatables-fixedheader.min.js" type="text/javascript"></script>
		<script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN THEME LAYOUT SCRIPTS -->
		<script src="assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
		<script src="assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
		<script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
		<script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
		<!-- END THEME LAYOUT SCRIPTS -->        
        <script>
            $(document).ready(function(){
            
                $(document).delegate(".active_inactive","click",function(e){
					e.preventDefault();
					
					var this_ = $(this);
					$(this_).children("i").removeClass("fa-lock fa-unlock").addClass("fa-refresh fa-spin");
					$.get($(this).attr("href"),function(data){
						data = $.parseJSON(data);
						if(data.error == ""){
							alert(data.error);                            
						}else{
							$(this_).html(data.new_html);
							$(this_).removeClass("btn-success btn-danger").addClass(data.new_class);
						}					
					});
					
				});
            });
        
        </script>
    </body>

</html>