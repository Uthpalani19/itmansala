<?php
    include('../config/errors.php');
    include('../config/password-backend.php');
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
            <p class="message">Hi!<br>Welcome to IT Mansala</p>
        </div>
        <img class="avatar "src="../assets/images/avatar.png">     
    </div>
    <div class="right">
        <h1 class="pass-heading">Reset your password</h1>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="login_field signupfield">
              <i class="login_icon fa-solid fa-envelope"></i>
              <input type="email" class="login_input" placeholder="Please enter your Email" name="email" value="<?php echo $email;?>">
              <div>
                <?php rstEmailError(); ?>
              </div>
            </div>

            <div class="login">
              <button type="submit" name="send_email" class="loginbtn signupbtn pass-btn">Continue</button><br>
              <p>Back to <a href="../student_login.php" class="create-account">Sign In</a></p>
            </div> 
          </form>
    
    </div>

<script type="text/javascript" src="../assets/js/student.js"></script>
</body>
</html>
