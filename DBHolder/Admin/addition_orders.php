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
       	 waitForMsg();
       	  $('#notificationLink').click(function(){
                event.preventDefault();
			 	removeNotification();
            });
       		$(".notification-menu").mouseover(function(){
			$(".accept").unbind("click");
			$(".accept").click(function(event){
					event.preventDefault();
					var not_id = $(this).attr('id');
					updateAfterAccept(not_id);
					removeNotification();
				});

		}); 

       		$(".notification-menu").mouseover(function(){
			$(".refuse").unbind("click");
			$(".refuse").click(function(event){
					event.preventDefault();
						not_id = $(this).attr('id');
					$.ajax({
						type:'GET',
						url:'../refuseproduct.php', 
						data:{not_id:not_id},
						success:function(result){
							alert(result);
							$('#'+not_id).remove();
							removeNotification();
							//document.getElementById("admin_action").innerHTML = result;
						}
					});
				});

		});
       		});
                     
       
    </script>
</head>

	<body>
		 <span id="notification_count" class="noti"></span>
         <a href="#" id="notificationLink" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 10px;font-size: 20px;"></i></a>
   		 <ul class="notification-menu">
         <?php
         $admin = new AdminManager();
        $sql1 = $admin->selectQuery("SELECT * from notification where is_procecced = 0");
        if($sql1!==NULL){
        for($i = 0; $i<sizeof($sql1); ++$i){
        ?>
        <li id="<?php echo $sql1[$i]['not_id'];?>">
        <a href="#">
        <div class="notification-content">
        <span class="notification-date"><?php echo $sql1[$i]['date_of_not'];?></span>
        <h2><?php echo $sql1[$i]['not_type'];?></h2>
        <p>product name: <?php echo $sql1[$i]['pro_name'];?><br>
        applicant name: <?php echo $sql1[$i]['applicant'];?><br>
        applicant name: <?php echo $sql1[$i]['applicant_name'];?><br>
        amount: <?php echo  $sql1[$i]['amount'];?><br>cost: <?php echo $sql1[$i]['cost'];?><br>
        <img src="../<?php echo $sql1[$i]['img'];?>" alt="" class="thumb-lg rounded-circle" width="150"><br>
        Description: <?php echo  $sql1[$i]['description'];?>
    </p>
        <button type="button" class="btn btn-primary accept" id="<?php echo  $sql1[$i]['not_id'];?>">Accept</button><button type="button" class="btn btn-danger refuse" id="<?php echo  $sql1[$i]['not_id'];?>">Refuse</button>
         </div>
        </a>
         </li>
          <?php } } 
          else{
          	echo 'There is no addition orders..';
          }
          ?>
		<ul>
    </body>
   