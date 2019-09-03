<?php

    require_once('../class_function/session.php');
	require_once('../class_function/error.php');
	require_once('../class_function/dbconfig.php');
    require_once('../class_function/function.php');
    require_once('../class_function/language.php');
	require_once('../class_function/validate.php');
	require_once('../page/title.php');
	require_once('../page/meta.php');
	require_once('../page/header.php');
	require_once('../page/menu.php');
    require_once('../page/footer.php');

    $dashboard          = $xml->dashboard->dashboard;
    $root_admin         = $xml->dashboard->root_admin;
    $admin              = $xml->dashboard->admin;
    $user               = $xml->dashboard->user;
    $welcome            = $xml->dashboard->welcome;
    $view_profile       = $xml->dashboard->view_profile;
    $platform_xml       = $xml->dashboard->platform;
    $version_xml        = $xml->dashboard->version;
    $manufacturer_xml   = $xml->dashboard->manufacturer;
    $model_xml          = $xml->dashboard->model;
    $serial_xml         = $xml->dashboard->serial;
    $uuid_xml           = $xml->dashboard->uuid;
    $never_synced       = $xml->dashboard->never_synced;
    $last_synced_xml    = $xml->dashboard->last_synced;
    $virtual_xml        = $xml->dashboard->virtual;
    $cordova_xml        = $xml->dashboard->cordova;

    $rows = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($SESS_DEVICE_ID), "rows");
	$sim_serial = " <small>Not Logged In Yet</small>";
	foreach($rows as $row){
		$sim_serial		= $row['sim_serial'];
	}

	$rows = sql($DBH, "SELECT * FROM tbl_device_info where login_id = ?", array($SESS_DEVICE_ID), "rows");
	$sync_date_time = " <small>$never_synced</small>";
	foreach($rows as $row){
		$sync_data			= json_decode($row['data'],true);
		$sync_date_time		= my_simple_date($row['date_time']);
	}

	$platform 		= $sync_data['platform'];
	$version 		= $sync_data['version'];
	$uuid 			= $sync_data['uuid'];
	$cordova 		= $sync_data['cordova'];
	$model 			= $sync_data['model'];
	$manufacturer 	= $sync_data['manufacturer'];
	$isVirtual 		= $sync_data['isVirtual'];
	$serial 		= $sync_data['serial'];

	if(strlen($platform) == 0)		{$platform = "<small>$platform_xml - </small>";}
	if(strlen($version) == 0)		{$version = "<small>$version_xml</small>";}
	if(strlen($uuid) == 0)			{$uuid = "<small>$uuid_xml - </small>";}
	if(strlen($cordova) == 0)		{$cordova = "<small>$cordova_xml - </small>";}
	if(strlen($model) == 0)			{$model = "<small>$model_xml</small>";}
	if(strlen($manufacturer) == 0)	{$manufacturer = "<small>$manufacturer_xml - </small>";}
	if(strlen($isVirtual) == 0)		{$isVirtual = "<small>$virtual_xml - </small>";}
	if(strlen($serial) == 0)		{$serial = "<small>$serial_xml - </small>";}


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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
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
            .my-ui-btn-blue, .my-ui-btn-blue-active{

            	text-shadow: none;

                padding: 5px;

                display: block;

            }
            .my-ui-btn-blue{

	background: #fff;

    color: #3388cc;

}

.my-ui-btn-blue-active{

	background: #3388cc;

    color: #fff;

}
.trial_hider2{

  height: 17px;

  width: 70px;

  background: #fff;

  z-index: 100000000000000000000000000000000;

  position: relative;

  top: -16px;

  left: 1px;

}
.btn-group-justified>.btn, .btn-group-justified>.btn-group{
    width:25% !important;
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
                    <div class="page-content" style="background: #f9f9f9;">

                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> <i class="fa fa-tachometer"></i> <?php echo $dashboard; ?>
                            <small><span class="badge badge-success"><i style="margin:0;" class="fa fa-tag"></i> <?php echo ucfirst($SESS_ACCESS_LEVEL); ?></span>	</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <?php
                            if($_SESSION['msg']){
                                echo "<div class='remove_after_5 note note-info'><p>".$_SESSION['msg']."</p></div>";
                                unset($_SESSION['msg']);
                            }
                        ?>

                        <div class="row">


                            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 hidden">
                                <div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-microphone font-dark hide"></i>
											<span class="caption-subject bold font-dark uppercase"><?php echo $welcome; ?></span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="row">
											<div class="col-md-12">
												<div class="mt-widget-1">
													<div style="margin:10px 0; border-radius: 0 !important;" class="mt-img">
														<a href="profile.php"><img class="small_pic" src="<?php echo $SESS_PHOTO; ?>"> </div></a>
													<div class="mt-body">
														<h3 class="mt-username"><?php echo $SESS_FULLNAME;  ?></h3>
														<p class="mt-user-title"><small><?php echo $SESS_EMAIL; ?></small></p>
														<a href="profile.php" class="btn btn-block btn-primary"><?php echo $view_profile; ?><a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3" style="padding: 0;">
                                        <input type="date" id="date_from_welcome" class="form-control" />
                                    </div>
                                    <div class="col-md-3" style="padding: 0;">
                                        <input type="date" id="date_to_welcome" class="form-control" />
                                    </div>
                                    <div class="col-md-3"></div>
                                    <br />
                                </div>

                                <div class="btn-group btn-group btn-group-justified">
                                    <a hrs="3h" href="javascript:;" class="chart_fiter_dashboard btn btn-default">3 Hours</a>
                                    <a hrs="6h" href="javascript:;" class="chart_fiter_dashboard btn btn-default">6 Hours</a>
                                    <a hrs="12h" href="javascript:;" class="chart_fiter_dashboard btn btn-default">12 Hours</a>
                                    <a hrs="24h" href="javascript:;" class="chart_fiter_dashboard btn btn-primary">24 Hours</a>
                                </div>

                                <p class="text-center chart_loader_dashboard"></p>
                                <br />

                    			<div id="chartContainer_dashboard" style="height: 400px; width: 100%;"></div>

                    			<div class="trial_hider2"></div>

                            </div>
                        </div>
						<!-- start -->



						<!-- end -->
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
        <script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="chart.js" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

        <script>
            $(document).ready(function(){
                function get_combined_chart_data(hrs){

				$(".chart_loader_dashboard").html('<i class="fa fa-spinner fa-spin"></i>').show();

				$(".trial_hider2").hide();

                $("#chartContainer_dashboard").hide();



				//as

				var arr_ph1		= [];

				var arr_do1		= [];

				var arr_temp1	= [];

                var arr_d_o_st  = [];



				//mv

				var arr_ph2		= [];

				var arr_do2		= [];

				var arr_temp2	= [];

                //op

				var arr_ph3		= [];

				var arr_do3		= [];

				var arr_temp3	= [];


                //alibaba do

				//var arr_ph3		= [];

				var arr_do4		= [];

				//var arr_temp3	= [];




				var mv = false;

				var as = false;

                var op = false;

                var alibaba_do = false;



				var atleast_one = false;



				$.get("../app_services/pond_data_json.php?id="+(1)+"&filter="+hrs,function(data){

					as = true;



					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

                        var d_o_st      = +value.d_o_st;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph1.push({ x: new Date(timestamp),  y: ph });

						arr_do1.push({ x: new Date(timestamp),  y: d_o });

						arr_temp1.push({ x: new Date(timestamp),  y: temp });

                        arr_d_o_st.push({ x: new Date(timestamp),  y: d_o_st });

					});

				});



				$.get("../app_services/pond_data_json.php?id="+(2)+"&filter="+hrs,function(data){

					mv = true;

					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph2.push({ x: new Date(timestamp),  y: ph });

						arr_do2.push({ x: new Date(timestamp),  y: d_o });

						arr_temp2.push({ x: new Date(timestamp),  y: temp });

					});



				});

                $.get("../app_services/pond_data_json.php?id="+(4)+"&filter="+hrs,function(data){

					op = true;

					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph3.push({ x: new Date(timestamp),  y: ph });

						arr_do3.push({ x: new Date(timestamp),  y: d_o });

						arr_temp3.push({ x: new Date(timestamp),  y: temp });

					});



				});

                $.get("../app_services/pond_data_json.php?id="+(5)+"&filter="+hrs,function(data){

					alibaba_do = true;

					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;


						//arr_ph3.push({ x: new Date(timestamp),  y: ph });

						arr_do4.push({ x: new Date(timestamp),  y: d_o });

						//arr_temp3.push({ x: new Date(timestamp),  y: temp });

					});



				});



				var mv_as = setInterval(function(){

					if(mv == true && as == true && op == true && alibaba_do == true){

						var options = {
              zoomEnabled: true,
							exportEnabled: true,

							animationEnabled: true,

							title:{text: ""},

							subtitles: [{text: ""}],axisX: {

								title: "Date / Time"

							},axisY: {

								title: "",

								titleFontColor: "#000000",

								lineColor: "#000000",

								labelFontColor: "#000000",

								tickColor: "#000000",

								includeZero: true

							},

							toolTip: {

								shared: true

							},

							legend: {

								cursor: "pointer",

								itemclick: toggleDataSeries

							},

							data: [{

								type: "spline",

								name: "AS DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do1,

							},

							{

								type: "spline",

								name: "AS pH",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_ph1,

							},



							{

								type: "spline",

								name: "Stadard DO",

								//axisYType: "secondary",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_d_o_st,

							},

							{

								type: "spline",

								name: "mV DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do2,

							},

							{

								type: "spline",

								name: "mV pH",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_ph2,

							},

							{

								type: "spline",

								name: "Temp",

								/*axisYType: "secondary",*/

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_temp1,

							},

							{

								type: "spline",

								name: "Optical DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do3,

							},

                            {

								type: "spline",

								name: "Alibaba DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do4,

							},



							{

								type: "spline",

								name: "Optical Temp",

								/*axisYType: "secondary",*/

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_temp3,

							}]

						};



						function toggleDataSeries(e) {

							if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {

								e.dataSeries.visible = false;

							} else {

								e.dataSeries.visible = true;

							}

							e.chart.render();

						}



						console.log(options);



						$("#chartContainer_dashboard").show();
                        $("#chartContainer_dashboard").CanvasJSChart(options);





						if(atleast_one == false){

							$(".chart_loader_dashboard").html("No data for last "+hrs+"!").show();



						}else{

							$(".chart_loader_dashboard").html("Showing last <b>"+hrs+"</b> data").hide();



						}

                        $(".trial_hider2").show();

						clearInterval(mv_as);

						console.log("OK");

					}else{

						console.log("wait");

					}

				},1000);

			}

            function get_combined_chart_range(date_from,date_to){

				$(".chart_loader_dashboard").html('<i class="fa fa-spinner fa-spin"></i>').show();

				$(".trial_hider2").hide();

                $("#chartContainer_dashboard").hide();

				//as

				var arr_ph1		= [];

				var arr_do1		= [];

				var arr_temp1	= [];

				var arr_d_o_st  = [];



				//mv

				var arr_ph2		= [];

				var arr_do2		= [];

				var arr_temp2	= [];

                //optical

				var arr_ph3		= [];

				var arr_do3		= [];

				var arr_temp3	= [];




				var mv = false;

				var as = false;

                var op = false;



				var atleast_one = false;



				$.get("../app_services/pond_data_json.php?id="+(1)+"&filter=input&ts="+date_from+"&ts_end="+date_to,function(data){

					as = true;



					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var d_o_st			= +value.d_o_st;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph1.push({ x: new Date(timestamp),  y: ph });

						arr_do1.push({ x: new Date(timestamp),  y: d_o });

						arr_temp1.push({ x: new Date(timestamp),  y: temp });

						arr_d_o_st.push({ x: new Date(timestamp),  y: d_o_st });

					});

				});



			     $.get("../app_services/pond_data_json.php?id="+(2)+"&filter=input&ts="+date_from+"&ts_end="+date_to,function(data){

					mv = true;

					data = $.parseJSON(data);



					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph2.push({ x: new Date(timestamp),  y: ph });

						arr_do2.push({ x: new Date(timestamp),  y: d_o });

						arr_temp2.push({ x: new Date(timestamp),  y: temp });

					});



				});


                $.get("../app_services/pond_data_json.php?id="+(4)+"&filter=input&ts="+date_from+"&ts_end="+date_to,function(data){

					op = true;

					data = $.parseJSON(data);


					$(data.data).each(function(key,value){

						atleast_one = true;

						var ph          = +value.ph;

						var d_o         = +value.d_o;

						var temp        = +value.temp;

						var timestamp   = +Math.floor(value.timestamp/100)*100000;

						arr_ph3.push({ x: new Date(timestamp),  y: ph });

						arr_do3.push({ x: new Date(timestamp),  y: d_o });

						arr_temp3.push({ x: new Date(timestamp),  y: temp });

					});



				});





				var mv_as = setInterval(function(){

					if(mv == true && as == true && op == true){

						var options = {
              zoomEnabled: true,
							exportEnabled: true,

							animationEnabled: true,

							title:{text: ""},

							subtitles: [{text: ""}],axisX: {

								title: "Date / Time"

							},axisY: {

								title: "",

								titleFontColor: "#000000",

								lineColor: "#000000",

								labelFontColor: "#000000",

								tickColor: "#000000",

								includeZero: true

							},

							toolTip: {

								shared: true

							},

							legend: {

								cursor: "pointer",

								itemclick: toggleDataSeries

							},

							data: [{

								type: "spline",

								name: "AS DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do1,

							},

							{

								type: "spline",

								name: "AS pH",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_ph1,

							},

							{

								type: "spline",

								name: "Stadard DO",

								//axisYType: "secondary",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_d_o_st,

							},{

								type: "spline",

								name: "mV DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do2,

							},

							{

								type: "spline",

								name: "mV pH",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_ph2,

							},

							{

								type: "spline",

								name: "Temp",

								/*axisYType: "secondary",*/

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_temp1,

							},{

								type: "spline",

								name: "Optical Temp",

								/*axisYType: "secondary",*/

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_temp3,

							},{

								type: "spline",

								name: "Optical DO",

								showInLegend: true,

								xValueFormatString: "DD-MM-YYYY, hh:mm TT",

								yValueFormatString: "#,##0.###",

								dataPoints: arr_do3,

							}]

						};



						function toggleDataSeries(e) {

							if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {

								e.dataSeries.visible = false;

							} else {

								e.dataSeries.visible = true;

							}

							e.chart.render();

						}



						console.log(options);



						$("#chartContainer_dashboard").show();
                        $("#chartContainer_dashboard").CanvasJSChart(options);





						if(atleast_one == false){

							$(".chart_loader_dashboard").html("No data!").show();



						}else{

							//$(".chart_loader_dashboard").html("Showing last <b>"+hrs+"</b> data").hide();;

							$(".chart_loader_dashboard").hide();



						}

                        $(".trial_hider2").show();

						clearInterval(mv_as);

						console.log("OK");

					}else{

						console.log("wait");

					}

				},1000);

			}




                setTimeout(function(){
                    $(".remove_after_5").slideUp();
                },5000);

                get_combined_chart_data("24h");

                $(".chart_fiter_dashboard").click(function(){
    				$(".chart_fiter_dashboard").removeClass("btn-primary").addClass("btn-default");
    				$(this).addClass("btn-primary");
    				var hrs = $(this).attr("hrs");
    				get_combined_chart_data(hrs);
    			});


                $("#date_from_welcome, #date_to_welcome").change(function(){
    				var date_from 	= $("#date_from_welcome").val();
    				var date_to 	= $("#date_to_welcome").val();
    				$(".chart_fiter_dashboard").removeClass("btn-primary").addClass("btn-default");
                    if(date_from.length > 0 &&  date_to.length > 0){
    					get_combined_chart_range(date_from,date_to);
    				}
    			});

            });


        </script>
    </body>

</html>
