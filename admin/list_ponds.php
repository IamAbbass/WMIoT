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

    $id             = $_GET['id'];
    $STH 	 		= $DBH->prepare("SELECT count(*) FROM tbl_login where id = ? and parent_id = ?");
    $result  		= $STH->execute(array($id,$SESS_ID));
    $valid_user	    = $STH->fetchColumn();
    if($valid_user == 1){
        $rows = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($id), "rows");
        foreach($rows as $row){
    	   $user_fullname			= $row['fullname'];
        }
        $view_all = false; //view list of individual user
        $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where user_id = ? ", array($id), "rows");

    }else{
        $view_all = true; //view list of all ponds
        $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where admin_id = ? ", array($SESS_ID), "rows");

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

                        <?php if($view_all == true){ ?>
                            <h1 class="page-title"> <i class="fa fa-leaf"></i> All Ponds</h1>
                        <? }else{ ?>
                            <h1 class="page-title"> <i class="fa fa-leaf"></i> <?php echo $user_fullname; ?>'s Ponds</h1>
                        <?php } ?>



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

                                <div class="portlet box red">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-leaf"></i> Ponds List
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
											<thead>
												<tr>
													<th>#</th>
                            <?php if($view_all == true){ ?>
                            <th>Assigned To</th>
                            <?php } ?>
                            <th>Pond Name</th>

                            <th>Device ID</th>
                            <th>Temperature</th>
                            <th>DO</th>
                            <th>pH</th>
                            <th>Battery Volt</th>
                            <th>Solar Volt</th>

                            <th>Options</th>
												</tr>
											</thead>
											<tbody>
                        <?php
                          $polygons 	= array();
                          $sno 		= 0;
                          foreach($rows as $row){
                            $sno++;
                            $id					= $row['id'];
                            $name				= $row['name'];
                            $user_id            = $row['user_id'];
                            $date_time			= my_simple_date($row['date_time']);

                            //solar_data
                            $rows_solar = sql($DBH,"select * from tbl_solar_data where pond_id = ? order by (date_time) DESC limit 1",array($id),"rows");
                            foreach($rows_solar as $row){
                              $solar_voltage = $row['solar_voltage'];
                              $battery_voltage = $row['battery_voltage'];
                            }

                            //pond datatable
                            $rows_pond = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? order by(timestamp) desc limit 1",
                            array($id), "rows");
                            foreach($rows_pond as $row){
                                $json   = json_decode($row['json'], true);

                                $temp     = $json['temp'];
                                $d_o      = $json['d_o'];
                                $ph       = $json['ph'];
                            }

                            $T = (-139.3411)+(157570.1/$temperature)-(66423080/pow($temperature,2))+(12438000000/pow($temperature,3))-(862194900000/pow($temperature,4));
                            $arr["data"][$i]['d_o'] = round(exp($T),2);
                            //Standard DO end




                            if($view_all == true){
                            //show user name as well
                            $rows2 = sql($DBH, "SELECT * FROM tbl_login where id = ? ", array($user_id), "rows");
                            foreach($rows2 as $row2){
                                $user_fullname = $row2['fullname'];
                              }
                              $show_user_name = "<td><a href='profile.php?id=$user_id'>$user_fullname</a></td>";
                            }
                            //<td>$date_time</td>

                            //data viewable
                            $temperature = "";
                            if($temp == ""){
                              $temperature = "No Data";
                            }else{
                              $temperature = $temp." °C";
                            }

                            $dissolved_oxygen = "";
                            if($d_o == ""){
                              $dissolved_oxygen = "No Data";
                            }else{
                              $dissolved_oxygen = $d_o." mg/L";
                            }

                            $battery_voltage_display = "";
                            if($battery_voltage == ""){
                              $battery_voltage_display = "No Data";
                            }else{
                              $battery_voltage_display = $d_o." V";
                            }

                            $solar_voltage_display = "";
                            if($solar_voltage == ""){
                              $solar_voltage_display = "No Data";
                            }else{
                              $solar_voltage_display = $d_o." V";
                            }

                            echo "<tr>
                            <td>$sno</td>
                            $show_user_name
                            <td>$name</td>
                            <td>-</td>
                            <td>$temperature</td>
                            <td>$dissolved_oxygen</td>
                            <td>$ph</td>
                            <td>$battery_voltage_display</td>
                            <td>$solar_voltage_display</td>
                            <td>
                              <a href='ranges.php?id=$id' class='btn purple btn-xs'>
                              <i class='fa fa-sliders'></i> View/Update Tolerant Range
                              </a>
                              <a href='pond_data.php?id=$id' class='btn btn-success btn-xs'>
                              <i class='fa fa-leaf'></i> View Pond Data
                              </a>
                              <a href='solar_data.php?id=$id' class='btn btn-danger btn-xs'>
                              <i class='fa fa-sun-o'></i> View Solar Data
                              </a>
                            </td>
                            </tr>";
                          }
                        ?>

											</tbody>
										</table>
									</div>
								</div>
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
