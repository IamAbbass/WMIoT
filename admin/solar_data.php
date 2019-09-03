<?php

    require_once('../class_function/session.php');
    //require_once('../class_function/error.php');
    require_once('../class_function/dbconfig.php');
    require_once('../class_function/function.php');
    require_once('../class_function/language.php');
    require_once('../class_function/validate.php');

    $id   = $_GET['id'];
    $from = strtotime($_GET['from']);
    $to   = strtotime($_GET['to']);

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
        header("location: list_ponds.php");
        exit;
    }

    require_once('../page/title.php');
    require_once('../page/meta.php');
    require_once('../page/header.php');
    require_once('../page/menu.php');
    require_once('../page/footer.php');


    $id = $_GET['id'];
    $rows 		= sql($DBH, "SELECT * FROM tbl_login where id = ? ", array($user_id), "rows");
    foreach($rows as $row){
        $user_fullname	= $row['fullname'];
    }

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

    function wh($A, $V){
      return round($A*$V,2);
    }

    //last reading
    $rows = sql($DBH,"select * from tbl_solar_data where pond_id = ? order by (date_time) DESC limit 1",array($id),"rows");
    foreach($rows as $row){
      $solar_voltage = $row['solar_voltage'];
      $solar_ampere = $row['solar_ampere'];
      $battery_voltage = $row['battery_voltage'];
      $battery_ampere = $row['battery_ampere'];
      $battery_percentage = $row['battery_percentage'];
      $battery_charging = $row['battery_charging'];
      $load_voltage = $row['load_voltage'];
      $load_ampere = $row['load_ampere'];



      $energy_gen_24hrs = round($row['energy_gen_24hrs'],2)." Wh";
      $energy_gen_1week = round($row['energy_gen_1week'],2)." Wh";
      $energy_gen_1month = round($row['energy_gen_1month'],2)." Wh";
      $energy_used_24hrs = round($row['energy_used_24hrs'],2)." Wh";
      $energy_used_1week = round($row['energy_used_1week'],2)." Wh";
      $energy_used_1month = round($row['energy_used_1month'],2)." Wh";
      $date_time = my_simple_date($row['date_time']);
    }


    if($battery_charging == "true"){
      $battery_charging = "<i class='fa fa-plug'></i> Charging";
    }else{
      $battery_charging = "<i class='fa fa-unlink'></i> Not Charging";
    }

    //graph reading
    $last_30_days_ts = time()-86400*0.75;

    $solar_voltage_arr = array();
    $battery_voltage_arr = array();
    $load_voltage_arr = array();
    $solar_ampere_arr = array();
    $battery_ampere_arr = array();
    $load_ampere_arr = array();
    $date_time_arr = array();

    $solar_w = array();
    $load_w = array();
    $battery_w = array();

    if(($to-$from) > 0){
      $rows = sql($DBH,"select * from tbl_solar_data where pond_id = ? and date_time > ? and date_time < ? order by (date_time) desc ",array($id, $from, $to),"rows");
    }else{
      $rows = sql($DBH,"select * from tbl_solar_data where pond_id = ? and date_time > ? order by (date_time) desc ",array($id, $last_30_days_ts),"rows");

    }

    foreach($rows as $row){
      $solar_voltage_arr[]        = $row['solar_voltage'];
      $battery_voltage_arr[]      = $row['battery_voltage'];
      $load_voltage_arr[]         = $row['load_voltage'];

      $solar_ampere_arr[]        = $row['solar_ampere'];
      $battery_ampere_arr[]      = $row['battery_ampere'];
      $load_ampere_arr[]         = $row['load_ampere'];

      $solar_w[]                 = wh($row['solar_ampere'], $row['solar_voltage']);
      $load_w[]                  = wh($row['load_ampere'], $row['load_voltage']);
      $battery_w[]               = wh($row['battery_ampere'], $row['battery_voltage']);


      $date_time_arr[]            = $row['date_time'];
    }

    //die(json_encode($solar_voltage_arr));
    //die(json_encode($battery_voltage_arr));
    //die(json_encode($load_voltage_arr)); //0
    //die(json_encode($solar_ampere_arr));
    //die(json_encode($battery_ampere_arr));
    //die(json_encode($load_ampere_arr));


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
            .trial_hider{

              height: 17px;

              width: 70px;

              background: #fff;

              z-index: 100000000000000000000000000000000;

              position: relative;

              top: -16px;

              left: 1px;

            }
        </style>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                        <h1 class="page-title"> <i class="fa fa-sun-o"></i> Solar Data <b><?php echo $pond_name ?></b> <small>(Assigned to <a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $user_fullname; ?></a>)</small> <span class="pull-right"><i class="fa fa-clock-o"></i> Last Synced: <?php echo $date_time; ?></span> </h1>


                        <!-- END PAGE HEADER-->
                        <?php
                            if($_SESSION['msg']){
                                echo "<div class='remove_after_5 note note-info'><p>".$_SESSION['msg']."</p></div>";
                                unset($_SESSION['msg']);
                            }
                        ?>

                        <div class="row">
                            <form action="" method="get" >
                              <input value="<?php echo $_GET['id']; ?>" name="id" type="hidden"/>

                              <div class="col-md-3"><input readonly placeholder="Date From" value="<?php echo $_GET['from']; ?>" class="date-picker form-control" name="from" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><input readonly placeholder="Date To" value="<?php echo $_GET['to']; ?>" class="date-picker form-control" name="to" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><button class="btn btn-default" type="submit">Filter</button></div>
                            </form>
                            </br></br>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="portlet box yellow">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-sun-o"></i> Solar Info
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table">
                                            <tr>
                                                <th>Voltage (V):</th>
                                                <td class="text-right"><?php echo $solar_voltage; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ampere (A):</th>
                                                <td class="text-right"><?php echo $solar_ampere; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total (W):</th>
                                                <td class="text-right"><?php echo wh($solar_ampere, $solar_voltage); ?></td>
                                            </tr>
                                        </table>
									</div>
								</div>
                            </div>

                            <div class="col-md-4">
                                <div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-battery-half"></i> Battery <?php echo $battery_percentage; ?>% &bull; <small><?php echo $battery_charging; ?></small>
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table">
                                            <tr>
                                                <th>Voltage (V):</th>
                                                <td class="text-right"><?php echo $battery_voltage; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ampere (A):</th>
                                                <td class="text-right"><?php echo $battery_ampere; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total (W):</th>
                                                <td class="text-right"><?php echo wh($battery_ampere, $battery_voltage); ?></td>
                                            </tr>
                                        </table>
									</div>
								</div>
                            </div>

                            <div class="col-md-4">
                                <div class="portlet box red">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-power-off"></i> Load Info
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table">
                                            <tr>
                                                <th>Voltage (V):</th>
                                                <td class="text-right"><?php echo $load_voltage; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ampere (A):</th>
                                                <td class="text-right"><?php echo $load_ampere; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total (W):</th>
                                                <td class="text-right"><?php echo wh($load_ampere, $load_voltage); ?></td>
                                            </tr>
                                        </table>
									</div>
								</div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-12">
                              <div id="solar_chart" style="height: 400px; width: 100%;"></div>
                              <div class="trial_hider"></div>
                            </div>
                        </div>






                        <div class="row">

                            <div class="col-md-6">
                                <div class="portlet box yellow">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-sun-o"></i> Energy Generation (Solar)
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table">
                                            <tr>
                                                <th>Today (24 Hours):</th>
                                                <td class="text-right"><?php echo $energy_gen_24hrs; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Weekly (7 days):</th>
                                                <td class="text-right"><?php echo $energy_gen_1week; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Monthly (30 days):</th>
                                                <td class="text-right"><?php echo $energy_gen_1month; ?></td>
                                            </tr>
                                        </table>
									</div>
								</div>
                            </div>

                            <div class="col-md-6">
                                <div class="portlet box red">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-sun-o"></i> Energy Consumption (Solar)
                                        </div>
									</div>
									<div class="portlet-body">
										<table class="table">
                                            <tr>
                                                <th>Today (24 Hours):</th>
                                                <td class="text-right"><?php echo $energy_used_24hrs; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Weekly (7 days):</th>
                                                <td class="text-right"><?php echo $energy_used_1week; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Monthly (30 days):</th>
                                                <td class="text-right"><?php echo $energy_used_1month; ?></td>
                                            </tr>
                                        </table>
									</div>
								</div>
                            </div>


                        </div>
						<!-- start -->



						<!-- end -->
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
        <script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="chart.js" type="text/javascript"></script>


        <script>
            $(document).ready(function(){

              var solar_voltage_arr        = <?php echo json_encode($solar_voltage_arr); ?>;
              var battery_voltage_arr      = <?php echo json_encode($battery_voltage_arr); ?>;
              var load_voltage_arr         = <?php echo json_encode($load_voltage_arr); ?>;

              var solar_ampere_arr        = <?php echo json_encode($solar_ampere_arr); ?>;
              var battery_ampere_arr      = <?php echo json_encode($battery_ampere_arr); ?>;
              var load_ampere_arr         = <?php echo json_encode($load_ampere_arr); ?>;

              var solar_w_arr             = <?php echo json_encode($solar_w); ?>;
              var battery_w_arr           = <?php echo json_encode($battery_w); ?>;
              var load_w_arr              = <?php echo json_encode($load_w); ?>;

              var date_time_arr            = <?php echo json_encode($date_time_arr); ?>;

              //voltage
              var solar_voltage = [];
              $(solar_voltage_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  solar_voltage.push({ x: new Date(ts),  y: +solar_voltage_arr[i] });
              });

              var battery_voltage = [];
              $(battery_voltage_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  battery_voltage.push({ x: new Date(ts),  y: +battery_voltage_arr[i] });
              });

              var load_voltage = [];
              $(load_voltage_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  load_voltage.push({ x: new Date(ts),  y: +load_voltage_arr[i] });
              });


              //ampere
              var solar_ampere = [];
              $(solar_ampere_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  solar_ampere.push({ x: new Date(ts),  y: +solar_ampere_arr[i] });
              });

              var battery_ampere = [];
              $(battery_ampere_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  battery_ampere.push({ x: new Date(ts),  y: +battery_ampere_arr[i] });
              });

              var load_ampere = [];
              $(load_ampere_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  load_ampere.push({ x: new Date(ts),  y: +load_ampere_arr[i] });
              });


              //wH
              var solar_w = [];
              $(solar_w_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  solar_w.push({ x: new Date(ts),  y: +solar_w_arr[i] });
              });

              var battery_w = [];
              $(battery_w_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  battery_w.push({ x: new Date(ts),  y: +battery_w_arr[i] });
              });

              var load_w = [];
              $(load_w_arr).each(function(i){
                  var ts = +Math.floor(date_time_arr[i]/100)*100000;
                  load_w.push({ x: new Date(ts),  y: +load_w_arr[i] });
              });




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
  								name: "Solar (V)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Volts",
  								dataPoints: solar_voltage,
  							},{
  								type: "spline",
  								name: "Solar (A)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Ampere",
  								dataPoints: solar_ampere,
  							},{
  								type: "spline",
  								name: "Load (V)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Volts",
  								dataPoints: load_voltage,
  							},{
  								type: "spline",
  								name: "Load (A)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Ampere",
  								dataPoints: load_ampere,
  							},{
  								type: "spline",
  								name: "Battery (V)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Volts",
  								dataPoints: battery_voltage,
  							},{
  								type: "spline",
  								name: "Battery (A)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### Volts",
  								dataPoints: battery_ampere,
  							},{
  								type: "spline",
  								name: "Load (W)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### wH",
  								dataPoints: load_w,
  							},{
  								type: "spline",
  								name: "Battery (W)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### wH",
  								dataPoints: battery_w,
  							},{
  								type: "spline",
  								name: "Solar (W)",
  								showInLegend: true,
  								xValueFormatString: "DD-MM-YYYY, hh:mm TT",
  								yValueFormatString: "#,##0.### wH",
  								dataPoints: solar_w,
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

              $("#solar_chart").CanvasJSChart(options);
            });


        </script>
    </body>

</html>
