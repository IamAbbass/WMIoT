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
        .text-red{
        	color:#ea4335 !important;
        }
        .text-yellow{
        	color:#fbbc05 !important;
        }
        .text-green{
        	color:#34a853 !important;
        }
        </style>

        <!-- Spectrogram -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/ribbon.css" />
        <script src="js/wavesurfer.js"></script>
        <script src="js/wavesurfer.spectrogram.min.js"></script>
        <script src="js/wavesurfer.timeline.js"></script>
        <script src="js/app.js"></script>
        <script src="js/trivia.js"></script>

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
                        <h1 class="page-title"> <i class="fa fa-bar-chart"></i> Spectrogram <b><?php echo $pond_name ?></b> <small>(Assigned to <a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $user_fullname; ?></a>)</small> </h1>

                        <div class="row" style="display:none;">
                            </br>
                            <form action="" method="get" class="chart_filter_form">
                              <input value="<?php echo $_GET['id']; ?>" name="id" type="hidden"/>

                              <div class="col-md-3"><input readonly placeholder="Date From" value="<?php echo $_GET['from']; ?>" class="date-picker form-control" name="from" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><input readonly placeholder="Date To" value="<?php echo $_GET['to']; ?>" class="date-picker form-control" name="to" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><button class="btn btn-default" type="submit">Filter</button></div>
                            </form>
                        </div>

                        <div class="loading_here text-center"></div>

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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet box yellow">
              									<div class="portlet-title">
              										<div class="caption"><i class="fa fa-bar-chart"></i> Spectrogram</div>

                                  <button class="btn btn-sm btn-primary pull-right" data-action="play" style="margin-top:6px;">
                                      <i class="glyphicon glyphicon-play"></i>Play /
                                      <i class="glyphicon glyphicon-pause"></i>Pause
                                  </button>
                                </div>
              									<div class="portlet-body">


                                    <div id="demo">
                                        <div id="labels" class="hidden">
                                          <span>24.0 <span id="tag">KHz</span></span><br><br><br>
                                          <span>19.2 <span id="tag">KHz</span></span><br><br><br>
                                          <span>14.4 <span id="tag">KHz</span></span><br><br><br>
                                          <span>9.6 <span id="tag">KHz</span></span><br><br><br>
                                          <span>4.8 <span id="tag">KHz</span></span><br><br>
                                          <span>0 <span id="tag">Hz</span></span>

                                        </div>

                                        <div id="wave-spectrogram"></div>


                                        <div id="waveform" >
                                            <div class="progress progress-striped active" id="progress-bar">
                                                <div class="progress-bar progress-bar-info"></div>
                                            </div>
                                            <!-- Here be waveform -->
                                        </div>
                                        <div id="timeline"></div>

                                        <div class="text-center" style="padding-top:15px; font-size:18px;">
                                            <p><strong>Time (Seconds)</strong></p> <hr>
                                        </div>

                                    </div>


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



    </body>

</html>
