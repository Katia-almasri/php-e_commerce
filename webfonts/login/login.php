<?php
header('Content-Type: text/html; charset = utf-8');
session_start();
if (isset($_SESSION['email']) and $_SESSION['email'] != '') {
    header("location:../home.php");
    exit();
}
// ***********************************************************************************************
// ***************************  add REMEMEBER ME option to the form ******************************
// ***********************************************************************************************


?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <mate http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>
            login
        </title>
        <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="mainLayout">
        <div class="header">
            <a href="#">home</a>
            <a href="login.php">login</a>
            <a href="signup.php">sign up</a>
        </div>
        <div class="content">
            <form action="login.php?action=submit" method="POST">
                <table>
                    <tr>
                        <td><label>Email : </label></td>
                        <td><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td><label>Password :</label></td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="rememberme"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="log in"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="footer">
            <span>All RIGHTS RESERVED</span><br>
        </div>
    </div>
</body>

</html>

<?php

require '../../DBHolder/DBManager.php';

/***** LOGIN *****/

/*  WE SHOULD USE THE EMAIL INSTEAD OF USERNAMES */

function login($email, $password)
{
    $pdo   = pdo_connect_mysql();

    $stmt1 = $pdo->prepare("SELECT * FROM client WHERE email = '$email'");       // To check in companies emails
    $stmt1->execute();
    $result1 = $stmt1->fetch();

    $stmt2 = $pdo->prepare("SELECT * FROM company  WHERE email = '$email'");      // To check in clients   emails
    $stmt2->execute();
    $result2 = $stmt2->fetch();

    if ($result1 != null) {
        if ($result1['password'] == $password) {
            return $result1['client_id'];
        } else {
            echo "Password isn't correct !!";
            return false;
        }
    }
    if ($result2 != null) {
        if ($result2['password'] == $password) {
            return $result2['com_id'];
        } else {
            echo "Password isn't correct !!";
            return false;
        }
    } else {
        echo "<h3 style='color:#F33;'>You don't have an account ... please sign up !</h3>";
        return false;
    }
}

if (isset($_GET['action']) and $_GET['action'] == 'submit') {
    if (isset($_POST['email']) and $_POST['email'] != null and isset($_POST['password']) and $_POST['password'] != null) {
        $email    = $_POST['email'];
        $password = $_POST['password'];
        if (login($email, $password)) {
            if (!empty($_POST["rememberme"])) {
                
                // Useremail is stored as cookie for 10 years as
                // 10years * 365days * 24hrs * 60mins * 60secs
                setcookie("user_email", $_POST['email'], time() +
                    (10 * 365 * 24 * 60 * 60));
            
                // Password is stored as cookie for 10 years as 
                // 10years * 365days * 24hrs * 60mins * 60secs
                setcookie("user_password", $_POST['password'], time() +
                    (10 * 365 * 24 * 60 * 60));
        
            } else {
                if (isset($_COOKIE["user_email"])) {
                    setcookie("user_email", "");
                }
                if (isset($_COOKIE["user_password"])) {
                    setcookie("user_password", "");
                }
            }
            $_SESSION['user_id'] = login($email, $password);
            echo "<h3 style='color:#0F0'>You logged in successfuly ...Welcome ...</h3>";
            echo "<h5 style='color:#0F0;'> Redirecting to the home page ... <h5>";
            echo '<script type="text/javascript">
            setTimeout(function(){
                window.location.href = "../home.php";
            },2000);
            </script>';
        }
    } else {
        echo "<h3 style='color:#F33;'>Please full all fields</h3>";
    }
}



?>