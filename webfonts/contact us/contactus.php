<?php include 'sendemail.php'; ?>

<link href="../css/comment.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<script>
function validate(val) {
v1 = document.getElementById("full-name");
v2 = document.getElementById("email");
v3 = document.getElementById("phone-number");
v4 = document.getElementById("subject");
v5 = document.getElementById("message");

flag1 = true;
flag2 = true;
flag3 = true;
flag4 = true;
flag5 = true;

if(val>=1 || val==0) {
if(v1.value == "") {
v1.style.borderColor = "red";
flag1 = false;
}
else {
v1.style.borderColor = "green";
flag1 = true;
}
}

if(val>=2 || val==0) {
if(v2.value == "") {
v2.style.borderColor = "red";
flag2 = false;
}
else {
v2.style.borderColor = "green";
flag2 = true;
}
}
if(val>=3 || val==0) {
if(v3.value == "") {
v3.style.borderColor = "red";
flag3 = false;
}
else {
v3.style.borderColor = "green";
flag3 = true;
}
}
if(val>=4 || val==0) {
if(v4.value == "") {
v4.style.borderColor = "red";
flag4 = false;
}
else {
v4.style.borderColor = "green";
flag4 = true;
}
}
if(val>=5 || val==0) {
if(v5.value == "") {
v5.style.borderColor = "red";
flag5 = false;
}
else {
v5.style.borderColor = "green";
flag5 = true;
}
}


flag = flag1 && flag2 && flag3 && flag4 && flag5 ;

return flag;
}
</script>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Contact Us</h3>
            <p class="blue-text"><br> Write a comment, suggestion or question so we can stay in touch</p>
            <div class="card">
                <h5 class="text-center mb-4">Powering world-class companies</h5>
                <form class="form-card" action="" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Full name<span class="text-danger"> *</span></label> <input type="text" id="full-name" name="full-name" placeholder="Enter your name" onblur="validate(1)"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label> <input type="text" id="email" name="email" placeholder="" onblur="validate(2)"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> <input type="text" id="phone-number" name="phone-number" placeholder="" onblur="validate(3)"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Subject<span class="text-danger"> *</span></label> <input type="text" id="subject" name="subject" placeholder="" onblur="validate(4)"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Your message<span class="text-danger"> *</span></label> <input type="text" id="message" name="message" placeholder="" onblur="validate(5)"> </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" name="submit" class="btn-block btn-primary">Send</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
<lord-icon
    src="https://cdn.lordicon.com//mecwbjnp.json"
    trigger="hover"
    colors="primary:#121331,secondary:#08a88a"
    style="width:250px;height:250px;left: 40%">
</lord-icon>