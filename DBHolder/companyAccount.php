<?php
	
	session_start();
	if(isset($_SESSION['com_id'])){
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		$com_id = $_SESSION['com_id'];
	}
	

?>

<!DOCTYPE html>

<html>
	<head>
	 <title>
		company account
	 </title>
	 
	<script src="jquery.js">
		
	</script>

	<script>

	</script>
		<script>
			
			var lat = 1, lng = 1;

			function handle_geolocation_query(position){
					lat = (position.coords.latitude);
					lng = (position.coords.longitude);

			}

			$(document).ready(function(){
				
				if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(handle_geolocation_query);
				
			}else{
				alert('not supported!!');
			}
				

				$("#r").click(function(event){
					 event.preventDefault();
					 name = $("#name").val(); 
					 branch = $("#branch").val();
					 comp_location = $("#comp_location").val();
					// comp_location = lat+','+ lng;
					 date_launch = $("#date_launch").val();
					 lisence_number = $("#lisence_number").val();
					 owner = $("#owner").val();
					 email = $("#email").val();
					 d = $("#aboutus").val();
					 imgURL = 'uploads/defaultman.jpg';
					
					/* function jsonEscape(str){
					 	return str.replace(/\n/g, "&ly;br&gt").replace(/\"/g, '"').replace(/\'/g, "'");
					 }*/
					 aboutus =d.replace(/\"/g, "").replace(/\'/g, "");
					 //aboutus = encodeURI(aboutus);
					 psd = $("#psd").val();

					$.post("addCompany.php", {
						name:name, 
						branch:branch,
						comp_location:comp_location, 
						date_launch:date_launch, 
						lisence_number:lisence_number, 
						owner:owner, 
						email:email,
						aboutus:aboutus,
						psd:psd,
						imgURL:imgURL
						
					}, function(result){
						if(result !=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>Invalid email !</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>invalid date!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>fill in all required fields!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>there is alredy account with this email!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>' && result!=='<div class="row justify-content-center"><div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2"><div class="card px-0 pt-4 pb-0 mt-3 mb-3"><fieldset><div class="form-card"><div class="row"></div> <br><br><h2 class="purple-text text-center"><strong>there there were som errors!</strong></h2> <br><div class="row justify-content-center"><br><br></div></fieldset></div></div></div>')
						{

							
							document.getElementById("result").innerHTML = result+'*';
							window.setTimeout(function(){window.location.href="ajaxtest1.php";},3000);
						}else{
                            alert ("ssssssssssssssss");
							console.log(result);
							document.getElementById("result").innerHTML = result+'*';
						}
						
					});
					
				});
				
			});
				
				
		</script>

		<link href="companyform.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="form1.css" rel="stylesheet">
		<link href="all.css" rel="stylesheet">
		<link href="all.min.css" rel="stylesheet">
		<link href="fontawe   some.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/c83b2f6af9.js" crossorigin="anonymous"></script>
		
	</head>
	
	<body>
		<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Sign Up Your Company Account</h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Account</strong></li>
                        <li id="personal"><strong>Information</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuemin="0" aria-valuemax="100"></div>
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
                            </div><label class="fieldlabels">Company name: *</label>
                            <input type="text" name="cname" placeholder="CompanyName" id="name" required />
                            <label class="fieldlabels">Email: *</label>
                            <input type="email" name="email" placeholder="Email Id" id="email" required />

                            <label class="fieldlabels">Password: *</label>
                            <input type="password" name="pwd" placeholder="Password" id="psd" required />
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Company Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                </div>
                            </div>

                            <label class="fieldlabels">Owner name: *</label>
                            <input type="text" name="ownnam" placeholder="Owner name" id="owner" required />
                            <label class="fieldlabels">Branch: *</label>
                            <input type="text" name="branch" placeholder="Branch" id="branch" />
                            <label class="fieldlabels">Location : *</label>
                            <input type="text" name="loc" placeholder="Location" id="comp_location" required />
                            <label class="fieldlabels">Lisence number : *</label>
                            <input type="text" name="lisnum" placeholder="Lisence number" id="lisence_number" required />
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
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
                                <label>date lunch :</label>
                            </div>
                            <div>
                                <input type="date" id="date_launch"  name="date_launch">
                            </div>
                            <label class="fieldlabels">About us</label>
                            <textarea id="aboutus"  ></textarea>
                            
                        </div> <input type="button" name="next" class="next action-button" value="Submit" id="r" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                   
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function () {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function () {
            return false;
        })

    });
</script>
    <div id="result"></div>
	</body>
</html>