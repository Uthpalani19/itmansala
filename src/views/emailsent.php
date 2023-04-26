<?php
    include('../config/password-backend.php');

    if (!isset($_SESSION['token'])) {
        header('location: forgotpassword.php');
    }
?>
<!DOCTYPE html>
<html>
<head>

  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../assets/css/student.css">
</head>
<body>
    <div class="left">
        <div class="welcome">
            <p class="message">Hi! <?php echo $_SESSION['name']; ?>,<br>Welcome to IT Mansala</p>
        </div>
        <img class="avatar "src="../assets/images/avatar.png">     
    </div>
    <div class="right email-right">
        <h3>Check your Email</h3>
        <div class="success-msg">
            <div class="top">
                <i class="fa-solid fa-check email-check"></i>
                <p>Success! We have sent an Email to:<br>
                <b><?php echo $_SESSION['email'];?></b> with a link to reset the password</p>
            </div>
            <div class="bottom">
                <p>If you don't receive an Email in the next couple of minutes, check your spam folder. We sent it from <b>itmansala@gmail.com</b></b></p>
                <div class="retry">
                    <p>The Email didn't arrive? <a href="forgotpassword.php">Re-enter your email and try again</a></p>
                </div>
            </div>
        </div>


    </div>

<script type="text/javascript" src="../assets/js/student.js"></script>
</body>
</html>