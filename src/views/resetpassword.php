<?php
    include('../config/errors.php');
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
    <div class="right">
        <h1>Enter new password</h1>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="login_field signupfield">
                <input type="password" class="login_input" id="psw1" placeholder="  New Password" name="rstpassword_1" value="<?php echo $rstpassword_1;?>">
                <i class="fa-regular fa-eye-slash" id="hidePsw1"></i>
                <div>
                    <?php passError(); ?>
                </div>
            </div>

            <div class="login_field signupfield">
                <input type="password" class="login_input" id="psw2" placeholder="  Confirm Password" name="rstpassword_2">
                <i class="fa-regular fa-eye-slash" id="hidePsw2"></i>
                <div>
                    <?php passError(); ?>
                </div>
            </div>

            <div class="login">
              <button type="submit" name="reset_pass" class="loginbtn signupbtn">Change Password</button><br>
            </div> 
          </form>

    
    </div>

<script type="text/javascript" src="../assets/js/student.js"></script>
</body>
</html>
