<?php include "sendemail.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact form</title>
</head>

<!--alert messages start-->
<?php echo $alert; ?>
<!--alert messages end-->


<body>
    <main>
        <p>Send Email</p>
        <form class="contact-form" action="contactform.php" method="post">
            <input type="hidden" name="email" value="yamen.g333@gmail.com">
            <button type="submit" name="contact">Contact</button>
        </form>
    </main>

    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    
</body>

</html>