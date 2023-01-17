<?php
	
	session_start();
	if(isset($_SESSION['client_id'])){
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
        $client_id = $_SESSION['client_id'];
		
	}
	

?>

<!DOCTYPE html>

<html>
	<head>
	 <title>
		Client Account
	 </title>
	 
	<script src="jquery.js">
		
	</script>

	<script>

	</script>
		<script>
			
			
			$(document).ready(function(){
				
				

				$("#r").click(function(event){

					 event.preventDefault();
					 username = $("#username").val(); 
					 gender = $("input[name='gender']:checked").val();
					 location1 = $("#location1").val(); 
					 birthdate = $("#birthdate").val();
					 work = $("#work").val();
					 email = $("#email").val();
           nu = $("#nu").val();
					 d = $("#about_you").val();
					 about_you =d.replace(/\"/g, "").replace(/\'/g, "");
					 password = $("#password").val();
					 console.log(location1);
					 imgURL = 'https://bootdey.com/img/Content/avatar/avatar7.png';
           console.log(gender);

					$.post("addClient.php", {
						username:username, 
						gender:gender,
						location1:location1, 
						birthdate:birthdate, 
						work:work,
						email:email,
						about_you:about_you,
						password:password, 
            nu:nu,
						imgURL:imgURL

					}, function(result){
						if(result !=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>Invalid email !</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>invalid date!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>fill in all required fields!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>there is alredy account with this email!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>there there were som errors!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>')
            {
              
              document.getElementById("result").innerHTML = result+'*';
              window.setTimeout(function(){window.location.href="ajaxtest2.php";},3000);
            }else{
              console.log(result);
              document.getElementById("result").innerHTML = result+'*';
            }
						
					});
					
				});
				
			});
				
				
		</script>
		
		
	</head>
	
	<body>
		
<link href="style.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="form1.css" rel="stylesheet">
      <link href="all.css" rel="stylesheet">
      <link href="all.min.css" rel="stylesheet">
      <link href="fontawesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/c83b2f6af9.js" crossorigin="anonymous"></script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Sign Up Your User Account</h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Account</strong></li>
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Account Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Email: *</label> 
                            <input type="email" name="email" id="email" placeholder="Email Id" /> 
                            <label class="fieldlabels">Username: *</label>
                             <input type="text" name="uname" placeholder="UserName"  id="username"/> 
                             <label class="fieldlabels" >Password: *</label>
                              <input type="password" name="pwd" placeholder="Password" id="password"/> 
                              
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Location : *</label>
                             <input type="text" name="fname" placeholder="Location" id="location1"/> 
                            <hr>
                            <label class="fieldlabels">Gender : *</label> 
                              <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                  <input id="male" name="gender" type="radio"  value="male" class="custom-control-input" checked required>
                                  <label class="custom-control-label" for="credit" style="padding-left: 4%">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input id="female" name="gender" type="radio"  value="female" class="custom-control-input" required>
                                  <label class="custom-control-label" for="debit" style="padding-left: 4%">Female</label>
                                </div>
                              </div>
                            <hr>
                            <label class="fieldlabels">Contact Number.: *</label>
                             <input type="text" name="phno" placeholder="Contact No." id="nu" /> 
                             <label class="fieldlabels">Your job *</label> 
                             <input type="text" name="phno_2" placeholder="Your job"  id="work" />
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Image Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 4</h2>
                                </div>
                            </div> 
                              
                          <div>
                      <label for="birthday">Birthday:</label></div>
                          <div>
                           <input type="date"  id="birthdate" name="birthday">
                            </div>
                            <label class="fieldlabels">About you :</label>
                            <textarea id="about_you"></textarea> 
                        </div>
                         <input type="button" name="next" class="next action-button" value="Submit" id="r" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
</script>

   <div id="result"></div>
<script src="../../../../code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="../../dist/js/bootstrap.bundle.min.js"></script>
     
	</body>
</html>