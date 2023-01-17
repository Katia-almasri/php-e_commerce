<?php
	require_once '../CompanyManager.php';
    require_once '../ClientManager.php';
    require_once '../AdminManager.php';
    require_once 'adminSynch.php';
    require_once '../Admin 0 /functions.php';
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Marktech</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="../jquery.js"></script>
    <script type="text/javascript">

       $(document).ready(function(){
       		waitForAnn();

       	 	$("#ann_not").click(function(event){
			event.preventDefault();
			removeAnnounment();
		});
       	 $(".notification-menu").mouseover(function (){
			$(".launch_announcement").unbind("click");
			$(".launch_announcement").click(function(event){
					event.preventDefault();
					ann_ord_id = $(this).attr('id');
					alert(ann_ord_id);
					$.ajax({
						type:'post',
						url:'../acceptAnn.php', 
						data:{ann_ord_id:ann_ord_id},
						success:function(result){
							$('#'+ann_ord_id).remove();
							removeAnnounment();
							//alert(result);
						}

					});
				});
		});

       	 $(".notification-menu").mouseover(function (){
			$(".reject_announcement").unbind("click");
			$(".reject_announcement").click(function(event){
					event.preventDefault();
					ann_ord_id = $(this).attr('id');
					alert(ann_ord_id);
					$.ajax({
						type:'post',
						url:'../rejectAnn.php', 
						data:{ann_ord_id:ann_ord_id},
						success:function(result){
							$('#'+ann_ord_id).remove();
							removeAnnounment();
							alert(result);
						}

					});
				});
		});

       		
       		});
                     
       
    </script>
</head>

	<body>
		 <span id="ann_count" class="ann"></span>
         <a href="#" id="ann_not" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:gray;"></i></a>
   		 <ul class="notification-menu">
         <?php
         $admin = new AdminManager();
        $sql1 = $admin->selectQuery("SELECT announcement_orders.*, time_an.type AS duration FROM  announcement_orders
        	INNER JOIN time_an ON time_an.time_an_id = announcement_orders.time_on_id
         WHERE is_processed = 0");
        if($sql1!==NULL){
        for($i = 0; $i<sizeof($sql1); ++$i){
        ?>
        <li id="<?php echo $sql1[$i]['a_o_id'];?>">
        <a href="#">
        <div class="notification-content">
        <span class="order-date"><?php echo $sql1[$i]['date_of_order'];?></span>
        <h2>
        	Start of advertise: <?php echo $sql1[$i]['start_of_ann'];?>
        </h2>
        <img src="../<?php echo $sql1[$i]['image'];?>" alt="" class="thumb-lg rounded-circle" width="100"><br>
        <?php echo getTypeINFO($sql1[$i]['type_id'], 'company');

        ?>
        <p>
        	Duration of ad:<?php 
        	$duration = $sql1[$i]['duration'];
        	if($duration==='day')
        	echo 'for one day';
        	else if($duration==='month')
        		echo 'for one month';
        	else if($duration==='week')
        		echo 'for one week';
        	else
        		echo 'for one year';

        ?> 
    	</p>
        <button type="button" class="btn btn-primary launch_announcement" id="<?php echo  $sql1[$i]['a_o_id'];?>">Accept</button><button type="button" class="btn btn-danger reject_announcement" id="<?php echo  $sql1[$i]['a_o_id'];?>">Refuse</button>
         </div>
        </a>
         </li>
          <?php } } 
          else{
          	echo 'There is no ads orders..';
          }
          ?>
		</ul>
    </body>
