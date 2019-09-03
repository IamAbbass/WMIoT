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
                    <div class="page-content">

                        <!-- END PAGE HEADER-->
                        <h1 class="page-title"> <i class="fa fa-leaf"></i> Pond Data <b><?php echo $pond_name ?></b> <small>(Assigned to <a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $user_fullname; ?></a>)</small> </h1>
                        <div class="btn-group btn-group btn-group-justified">
                            <a hrs="3h" href="javascript:;" class="chart_filter btn btn-default">3 Hours</a>
                            <a hrs="6h" href="javascript:;" class="chart_filter btn btn-default">6 Hours</a>
                            <a hrs="12h" href="javascript:;" class="chart_filter btn btn-default">12 Hours</a>
                            <a hrs="24h" href="javascript:;" class="chart_filter btn btn-info">24 Hours</a>
                        </div>

                        <div class="row">
                            </br>
                            <form action="" method="get" class="chart_filter_form">
                              <input value="<?php echo $_GET['id']; ?>" name="id" type="hidden"/>

                              <div class="col-md-3"><input readonly placeholder="Date From" value="<?php echo $_GET['from']; ?>" class="date-picker form-control" name="from" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><input readonly placeholder="Date To" value="<?php echo $_GET['to']; ?>" class="date-picker form-control" name="to" type="text"  data-date-format="dd-M-yyyy"/></div>
                              <div class="col-md-3"><button class="btn btn-default" type="submit">Filter</button></div>
                            </form>
                        </div>

                        <div style="padding: 20px;" class="loading_here text-center"></div>

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
										<div class="caption"><i class="fa fa-line-chart"></i>Chart</div>
									</div>
									<div class="portlet-body">
                    <div id="pond_chart" style="height: 400px; width: 100%;"></div>
                    <div class="trial_hider"></div>

										<div id="chart_div"></div>
									</div>
								</div>
							</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-history"></i> History</div>
									</div>
									<div class="portlet-body">
										<table class="table table-striped table-bordered table-hover table-header-fixed"> <!-- id="sample_2" -->
											<thead>
												<tr>
													<th>#</th>
													<th>Temperature</th>
                                                    <th>DO</th>
                                                    <th>pH</th>
                                                    <th>Time</th>
												</tr>
											</thead>
											<tfoot class="hidden">
                                                <tr>
													<th>#</th>
													<th>Temperature</th>
                                                    <th>DO</th>
                                                    <th>pH</th>
                                                    <th>Time</th>
												</tr>
											</tfoot>
											<tbody id="history">
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



    <script src="chart.js" type="text/javascript"></script>


        <script>
            google.charts.load('current', {'packages':['corechart']});

            var chart_data 	= [];
            var chart_index	= 1;

            $(document).ready(function(){

                $(".chart_filter").click(function(){
                    var filter = $(this).attr('hrs');
                    $(".chart_filter").removeClass("btn-info").addClass("btn-default");
                    $(".chart_filter[hrs='"+filter+"']").addClass("btn-info");
                    get_data("<?php echo $_GET['id'] ?>",filter,null,null);
                });

                $(".chart_filter_form").submit(function(e){
                    e.preventDefault();

                    var filter = "input";
                    $(".chart_filter").removeClass("btn-info").addClass("btn-default");

                    var ts      = $("input[name='from']").val();
                    var ts_end  = $("input[name='to']").val();

                    get_data("<?php echo $_GET['id'] ?>",filter,ts,ts_end);
                });


                var sno = 0;
                function get_data(id,filter,ts,ts_end){
                    $(".loading_here").html('<i class="fa fa-circle-o-notch fa-2x fa-spin"></i>');

                    var canvas_do       = [];
                    var canvas_ph       = [];
                    var canvas_temp     = [];

                    var url = "";
                    if(filter == "input"){
                      url = "../app_services/pond_data_json.php?id="+id+"&filter=input&ts="+ts+"&ts_end="+ts_end;
                    }else{
                      url = "../app_services/pond_data_json.php?id="+id+"&filter="+filter;
                    }



                    $.get(url,function(data){

                        $("#history").empty();
                        chart_data  = [];
                        chart_index	= 1;
                        sno         = 0;


                        data = $.parseJSON(data);

                        var timestamp_new = data.timestamp_new;

                        $(data.data).each(function(key,value){
                            sno++;
                            var ph          = +value.ph;
                            var d_o         = +value.d_o;
                            var temp        = +value.temp;
                            var date_time   = value.date_time;
                            var timestamp   = value.timestamp;

                            var ph_color    = value.ph_color;
                            var do_color    = value.do_color;
                            var temp_color  = value.temp_color;

                            var ts = +Math.floor(timestamp/100)*100000;

                            canvas_do.push({ x: new Date(ts),  y: +d_o });
                            canvas_ph.push({ x: new Date(ts),  y: +ph });
                            canvas_temp.push({ x: new Date(ts),  y: +temp });

                            $("#history").prepend("<tr><td>"+sno+"</td><td class='"+temp_color+"'>"+temp+"</td><td class='"+do_color+"'>"+d_o+"</td><td class='"+ph_color+"'>"+ph+"</td><td>"+date_time+"</td></tr>");


                            //chart start
                    				chart_data.push([chart_index,ph,d_o,temp]);//just create the data. chat will generate when chart page will open
                    				chart_index++;
                    				//chart end
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
                            name: "pH",
                            showInLegend: true,
                            xValueFormatString: "DD-MM-YYYY, hh:mm TT",
                            yValueFormatString: "#,##0.###",
                            dataPoints: canvas_ph,
                          },{
                            type: "spline",
                            name: "DO",
                            showInLegend: true,
                            xValueFormatString: "DD-MM-YYYY, hh:mm TT",
                            yValueFormatString: "#,##0.### mg/L",
                            dataPoints: canvas_do,
                          },{
                            type: "spline",
                            name: "Temperature",
                            showInLegend: true,
                            xValueFormatString: "DD-MM-YYYY, hh:mm TT",
                            yValueFormatString: "#,##0.### °C",
                            dataPoints: canvas_temp,
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

                        $("#pond_chart").CanvasJSChart(options);


                        if(sno == 0){
                            if(filter == "input"){
                              $(".loading_here").html('<strong class="text-danger">No data from '+ts+' to '+ts_end+'</strong>');
                            }else{
                              $(".loading_here").html('<strong class="text-danger">No data since last '+filter+'</strong>');
                            }
                        }else{
                            if(filter == "input"){
                              $(".loading_here").html('<strong class="text-info">Showing data from '+ts+' to '+ts_end+'</strong>');
                            }else{
                              $(".loading_here").html('<strong class="text-info">Showing last '+filter+' data</strong>');
                            }

                        }

                        try{
                            /*var data = new google.visualization.DataTable();
            				data.addColumn('number', 'X');
            				data.addColumn('number', 'pH');
            				data.addColumn('number', 'DO');
            				data.addColumn('number', 'Temp');
            				data.addRows(chart_data);
            				var options = {hAxis: {title: 'Reading'},vAxis: {title: 'Values'},series: {1: {curveType: 'function'}}};
            				var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            				chart.draw(data, options);
                    */
                        }catch(e){

                        }

                        setTimeout(function(){
                           //get_data(id,filter);
                        },3000);
                    });
                }


                setTimeout(function(){
                    get_data("<?php echo $_GET['id'] ?>","24h",null,null);
                },1000);

                $(document).delegate(".active_inactive","click",function(e){
        					e.preventDefault();

        					var this_ = $(this);
        					$(this_).children("i").removeClass("fa-lock fa-unlock").addClass("fa-refresh fa-spin");
        					$.get($(this).attr("href"),function(data){

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
