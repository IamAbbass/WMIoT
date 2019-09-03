<?php
		require_once('../class_function/language.php');
        
        $STH 	 		= $DBH->prepare("SELECT count(*) FROM tbl_login where access_level = ? AND parent_id = ?;");
        $result  		= $STH->execute(array("user", $SESS_ID));
        $count_users	= $STH->fetchColumn();
        
        if($count_users > 0){
            $count_users = "<span class='badge'>$count_users</span>";
        }else{
            $count_users = "";
        }
        
        $STH 	 		= $DBH->prepare("SELECT count(*) FROM tbl_geo_fence where admin_id = ?;");
        $result  		= $STH->execute(array($SESS_ID));
        $count_ponds	= $STH->fetchColumn();
        
        if($count_ponds > 0){
            $count_ponds = "<span class='badge'>$count_ponds</span>";
        }else{
            $count_ponds = "";
        }
        
		$dashboard             = $xml->left_menu->dashboard;
        $menu_head = "<div class='page-sidebar-wrapper'>                    
                    <div class='page-sidebar navbar-collapse collapse'>
                        <ul class='page-sidebar-menu  page-header-fixed ' data-keep-expanded='false' data-auto-scroll='true' data-slide-speed='200'>
                            <li class='sidebar-toggler-wrapper hide'>
                                <div class='sidebar-toggler'>
                                    <span></span>
                                </div>
                            </li>
							<li class='nav-item start'>
                                <a href='index.php' class='nav-link nav-toggle'>
                                    <i class='icon-home'></i>
                                    <span class='title'>$dashboard</span>									
                                </a>								
                            </li>";                            
                            
                            $menu_body .= "<li class='nav-item'>
							<a href='list_users.php' class='nav-link nav-toggle'><i class='fa fa-user'></i>
							<span class='title'>Users $count_users </span></a></li>";
                            
                            $menu_body .= "<li class='nav-item'>
							<a href='list_ponds.php' class='nav-link nav-toggle'><i class='fa fa-list'></i>
							<span class='title'> Ponds List $count_ponds </span></a></li>";
                            
                            $menu_body .= "<li class='nav-item'>
							<a href='geo_fencing.php' class='nav-link nav-toggle'><i class='fa fa-map'></i>
							<span class='title'> Ponds Map $count_ponds </span></a></li>";
                            
                            
                        $menu_foot ="</ul>
                    </div>
                </div>";    
    //user access now    
    $menu .= $menu_head;            
    $menu .= $menu_body;
    $menu .= $menu_foot;
?>


<script>
window.onload = function() {    
    var current_url = "<?php echo basename($_SERVER['PHP_SELF']); ?>";
    
    if($("a[href='"+current_url+"']").parent().parent().hasClass("sub-menu")){
        //add color on parent
        $("a[href='"+current_url+"']").parent().parent().parent().addClass("active");
        //arrow down
        $("a[href='"+current_url+"']").parent().parent().siblings("a").children(".arrow").addClass("open");
        //cut triangle
        $("a[href='"+current_url+"']").parent().parent().siblings("a").append("<span class='selected'></span>");
        //highlight child
        $("a[href='"+current_url+"']").parent().addClass("active");
    }
    
    if($("a[href='"+current_url+"']").parent().parent().hasClass("page-sidebar-menu")){
        //is parent
        $("a[href='"+current_url+"']").parent().addClass("active");
        $("a[href='"+current_url+"']").append("<span class='selected'></span>");        
    }
	/*
	function count_noti(){
		$.get("../admin/count_noti.php",function(data){
			json   				= $.parseJSON(data); 
			var message_count   = json.message_count;
			if(message_count > 0){
				$("#message_count").text(message_count).slideDown();
			}else{
				$("#message_count").slideUp();
			}
			setTimeout(function(){
				count_noti();
			},4000);
		});
	}
	count_noti();
	*/
    
	if($("#message_count").text() == "0"){
		$("#message_count").hide();
	}else{
		$("#message_count").show();
	}
	
}

</script>