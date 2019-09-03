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
    
    
    $id             = $_GET['id'];    
    $STH 	 		= $DBH->prepare("SELECT count(*) FROM tbl_login where id = ? and parent_id = ?");
    $result  		= $STH->execute(array($id,$SESS_ID));
    $valid_user	    = $STH->fetchColumn();
    if($valid_user == 1){
        $rows = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($id), "rows");
        foreach($rows as $row){	
    	   $user_fullname			= $row['fullname'];
        }
        $view_all = "false"; //view list of individual user	
        $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where user_id = ? ", array($id), "rows");		
		
                                                	
    }else{
        $view_all = "true"; //view list of all ponds
        $rows 		= sql($DBH, "SELECT * FROM tbl_geo_fence where admin_id = ? ", array($SESS_ID), "rows");		
		
                                                	
    }
    
    $geo_fencing             = $xml->geo_fencing->geo_fencing;
    $saved_locations         = $xml->geo_fencing->saved_locations;
    $name_this               = $xml->geo_fencing->name_this;
    $saving_location         = $xml->geo_fencing->saving_location;
    $location_saved          = $xml->geo_fencing->location_saved;
    $saving_location_failed  = $xml->geo_fencing->saving_location_failed;  
    $name_xml                = $xml->geo_fencing->name; 
    $confirm_delete_location = $xml->geo_fencing->confirm_delete_location;
    $created_xml             = $xml->geo_fencing->created;
    $delete_xml              = $xml->geo_fencing->delete;
    $access_denied_xml       = $xml->geo_fencing->access_denied;  
	$no_access_xml           = $xml->geo_fencing->no_access; 
   		

	$polygons 	= array();	
	$sno 		= 0;
	foreach($rows as $row){	
		$sno++;
        
		$points 			= array();		
		$polygon_json 		= json_decode($row['polygon_json']);
		$polygon			= array();		
		$i = 0;
		foreach($polygon_json as $point){
			$point 					= explode(",",$point);
			$polygon[$i]["lat"] 	= $point[0];
			$polygon[$i]["lng"] 	= $point[1];
			$i++;
		}
		
        $pond_id           = $row['id'];   
        $pond_name         = $row['name'];
        $user_id           = $row['user_id'];
        
        $rows3 = sql($DBH, "SELECT * FROM tbl_login where id = ?", array($user_id), "rows");
        foreach($rows3 as $row3){	
    	   $user_fullname			= $row3['fullname'];
        }        
        
		$polygons[$sno][0] = $row['id'];        
        $polygons[$sno][1] = ""; //we will make content
        $polygons[$sno][2] = $polygon;
        $polygons[$sno][3] = "Created: ".my_simple_date($row['date_time']) . "<br> Assigned To: ".$user_fullname; 
		$polygons[$sno][4] = ""; // we will decide color
        $polygons[$sno][5] = $row['name'];
        
        $temp_start		    = $row['temp_start'];
        $temp_end		    = $row['temp_end'];
        $temp_margin		= $row['temp_margin'];
        $do_start	  	    = $row['do_start'];
        $do_end		        = $row['do_end'];
        $do_margin		    = $row['do_margin'];
        $ph_start		    = $row['ph_start'];
        $ph_end 		    = $row['ph_end'];  
        $ph_margin		    = $row['ph_margin'];  
               
        $polygons[$sno][4] = "#000000"; //black
        
        //color start        
        $rows2 = sql($DBH, "SELECT * FROM tbl_pond_log where pond_id = ? order by (timestamp) desc limit 1", array($pond_id), "rows");							
        foreach($rows2 as $row2){            
            $json       = json_decode($row2['json'], true);           
            
            $polygons[$sno][1] .= "<tr><th>Temp: </th><td>".$json['temp']." C</td></tr>";
            $polygons[$sno][1] .= "<tr><th>DO: </th><td>".$json['d_o']." mg/L</td></tr>";
            $polygons[$sno][1] .= "<tr><th>pH: </th><td>".$json['ph']."</td></tr>";
            $polygons[$sno][1] .= "<tr><th>Time: </th><td>".my_simple_date($row2['timestamp'])."</td></tr>";
            
            if($json['temp'] >= ($temp_start) && $json['temp'] <= ($temp_end)){
                $polygons[$sno][4] = "#34a853"; //green
            }if($json['d_o'] >= ($do_start) && $json['d_o'] <= ($do_end)){
                $polygons[$sno][4] = "#34a853"; //green
            }if($json['ph'] >= ($ph_start) && $json['ph'] <= ($ph_end)){
                $polygons[$sno][4] = "#34a853"; //green
            }if(($json['temp'] >= ($temp_start-$temp_margin) && $json['temp'] < ($temp_start))){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if($json['temp'] > ($temp_end) && $json['temp'] <= ($temp_end+$temp_margin)){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if(($json['d_o'] >= ($do_start-$do_margin) && $json['d_o'] < ($do_start))){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if($json['d_o'] > ($do_end) && $json['d_o'] <= ($do_end+$do_margin)){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if(($json['ph'] >= ($ph_start-$ph_margin) && $json['ph'] < ($ph_start))){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if($json['ph'] > ($ph_end) && $json['ph'] <= ($ph_end+$ph_margin)){
                $polygons[$sno][4] = "#fbbc05"; //yellow
            }if($json['temp'] < ($temp_start-$temp_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }if($json['temp'] > ($temp_end+$temp_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }if($json['d_o'] < ($do_start-$do_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }if($json['d_o'] > ($do_end+$do_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }if($json['ph'] < ($ph_start-$ph_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }if($json['ph'] > ($ph_end+$ph_margin)){
                $polygons[$sno][4] = "#ea4335"; //red 
            }             
        }
        //color end  
        
       
	}
	//echo json_encode($polygons);
	//exit;
	
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
            
            .map_table{
                border-collapse: collapse;
                width:100%;
                border:1px solid #000;
            }
            .map_table td, .map_table th{
                border:1px solid #000;
            }
            
            
		  /* Always set the map height explicitly to define the size of the div
		   * element that contains the map. */
		  #map {
			height: 100%;
		  }
		  /* Optional: Makes the sample page fill the window. */
		  html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		  }
		  .geo-fence-status{
			  display:none;
		  }
          #list_locations_here{
            padding-left:15px;
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
								<?php if($view_all == "true"){ ?>                        
                                    <h1 class="page-title"> <i class="fa fa-street-view"></i> Pond Geofence <small>To create pond, go to <a href='list_users.php'>Users</a> and click 'Assign Pond'.</small> </h1> 
                                <? }else{ ?>
                                    <h1 class="page-title"> <i class="fa fa-street-view"></i> <?php echo $user_fullname; ?>'s Pond Geofence</h1>       
                                <?php } ?>							
								<div class='note note-info geo-fence-status'><p></p></div>
                                <a class="btn btn-primary btn-xs my_location pull-right" href="javascript:;"><i class='fa fa-map-marker'></i> Navigate To My Location</a>
							</div>
						</div>
						
						<div class="row">							
						      
                            <div class="col-md-2">	
								<ol id="list_locations_here">
                                
								</ol>
							</div>
							
                            
							<div class="col-md-10">	
								<div id="map"></div>
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
	  
		var map;
		var infoWindow;
        
		
		function initMap() {
			
				map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -34.397, lng: 150.644},
				zoom: 8
				});
				var drawingManager = new google.maps.drawing.DrawingManager({
    				//drawingMode: google.maps.drawing.OverlayType.MARKER,
    				// drawingControl: true,
    				drawingControlOptions: {
    				position: google.maps.ControlPosition.TOP_CENTER,
    				drawingModes: ['<?php if($view_all == "false"){echo "polygon";} ?>'] /*['marker', 'circle', 'polygon', 'polyline', 'rectangle']*/
    				},			    
    				polygonOptions: {
                        icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35
    				}
				});

				google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
    				var points = [];			
    				for (var i = 0; i < polygon.getPath().getLength(); i++) {		
    				    points.push(polygon.getPath().getAt(i).toUrlValue(6));
    				}	
    
    				var name = prompt("<?php echo $name_this; ?>", "");
    
    				if (name != null) {				
        				$(".geo-fence-status p").html("<i class='fa fa-spinner fa-spin'></i> <?php echo $saving_location; ?>..");
        				$(".geo-fence-status").slideDown();
        				$.get("ajax/save_geo_fence.php?id=<?php echo $id; ?>&name="+name+"&ploygon="+encodeURI(JSON.stringify(points)),function(data){					
            				if(data != "FAILED"){
            				    $(".geo-fence-status p").html("<i class='fa fa-check'></i> <?php echo $location_saved; ?>");
            				    $("#list_locations_here").load("ajax/get_locations.php?id=<?php echo $id; ?>&view_all=<?php echo $view_all; ?>");
                            }else{
            				    $(".geo-fence-status p").html("<i class='fa fa-times'></i> <?php echo $saving_location_failed;?>");
            				}
            				$(".geo-fence-status").slideDown();	
            				setTimeout(function(){
            				    $(".geo-fence-status").slideUp();
            				},3000);
        				});				
    				}else{
    				    //remove polygon
    				    polygon.setMap(null);
    				}
				});

				drawingManager.setMap(map);
				
				
				var my_polygons = '<?php echo json_encode($polygons); ?>';
				my_polygons 	= $.parseJSON(my_polygons);
				
				$.each(my_polygons,function(key, value){
					//key = index					
                    
                    var location_id				= value[0];
					var polygon_content 		= value[1];
					var polygon_points 			= value[2];
					var date_time				= value[3];
					var color					= value[4];               
                    var name                    = value[5];
					
					var proper_polygon_json = [];					
					$.each(polygon_points,function(point_index, point_lat_lng){						
						proper_polygon_json.push({"lat": +point_lat_lng.lat, "lng": +point_lat_lng.lng});
					});
            
                    
					var office_locations = new google.maps.Polygon({
					  paths: proper_polygon_json,
					  strokeColor: color,
					  strokeOpacity: 0.8,
					  strokeWeight: 3,
					  fillColor: color,
					  fillOpacity: 0.35,
                      clickable: true,
                      zIndex: 1,
                      editable: false
					});
					office_locations.setMap(map);					
					office_locations.addListener('mouseover', function(event) {
						var vertices = this.getPath();
						var contentString = '<b><?php echo $name_xml; ?> '+name+'</b><br>' +
							/*'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +*/
							'<br />' +
							'<table class="map_table">'+polygon_content+'</table>'+
                            '<br />'+
							''+ date_time+//+assigned to
                            '<br />'+
							'<a class="btn btn-success btn-xs" href="update_range.php?id='+location_id+'"><i class="fa fa-pencil"></i> Update Range</a>'+
                            '<a class="btn btn-danger btn-xs del_fence" href="exe_del_fence.php?location_id='+location_id+'"><i class="fa fa-times"></i> <?php echo $delete_xml ; ?></a>';
						/*
						for (var i =0; i < vertices.getLength(); i++) {
						  var xy = vertices.getAt(i);
						  contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
							  xy.lng();
						}*/
						infoWindow.setContent(contentString);
						infoWindow.setPosition(event.latLng);
						infoWindow.open(map);
					});
                    
                    map.setCenter({lat: +value[2][0].lat, lng: +value[2][0].lng});
                    map.setZoom(15);
					
					office_locations.addListener('mouseout', function(event) {
						infoWindow.close(map);
					});					
				});				

				infoWindow = new google.maps.InfoWindow;
		}
	  
		
		$(document).ready(function(){
			setTimeout(function(){
    		    $(".remove_after_5").slideUp();
    		},5000);
            
            
            $(".my_location").click(function(){
                $(".my_location").html("<i class='fa fa-refresh fa-spin'></i> Finding your location");
                if (navigator.geolocation) {
  				    navigator.geolocation.getCurrentPosition(function (position) {
        				initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        				map.setCenter(initialLocation);
                        map.setZoom(15);
                        
                        setTimeout(function(){
                            $(".my_location").html("<i class='fa fa-map-marker'></i> Navigate To My Location");
                        },1000);
    				});
				}else{
				    $(".my_location").html("<i class='fa fa-times'></i> Browser doesn't support or doesn't allow location.");
				}
            })
        
        

				
            
            
            $("#list_locations_here").load("ajax/get_locations.php?id=<?php echo $id; ?>&view_all=<?php echo $view_all; ?>");
            
            $(document).delegate(".del_fence","click",function(e){
				var x = confirm("<?php echo $confirm_delete_location; ?>");				
				if(!x){
					e.preventDefault();
				}
			});
            
            $(document).delegate(".map-re-center","click",function(e){
				var lat = +$(this).attr("lat");
				var lng = +$(this).attr("lng");
				map.setCenter({lat: lat, lng: lng});				 
				map.setZoom(17);
				
			});
		});
	
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_api_key; ?>&libraries=drawing&callback=initMap"
         async defer></script>		
    </body>

</html>