<?php
    include('config/server.php');
    include('config/errors.php');
?>

<!DOCTYPE html>
<html>
<head>

  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/student.css">
</head>
<body>
    <div class="splash" id="hide">
        <img class="logo fade-in" src="assets/images/logo.png">
    </div>
    <div class="left">
        <div class="welcome">
            <p class="message">Hi!<br>Welcome to IT Mansala</p>
        </div>
        <img class="avatar "src="assets/images/avatar.png">     
    </div>

    <div class="right">
        <h1>Sign In</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="login_field">

                <i class="login_icon fa-regular fa-user"></i>
				<input type="text" class="login_input" placeholder="  Phone number" name="user" value="<?php echo $PhoneNumber;?>">
                <div>
                    <?php PhoneError(); ?>
                </div>
			</div>
			<div class="login_field">
                <i class="login_icon fa-solid fa-lock"></i>
				<input type="password" class="login_input" placeholder="  Password" name="password" value="<?php echo $password;?>">
                <div>
                    <?php passError(); ?>
                    <?php loginError(); ?>
                </div>
			</div>

            <div class="options">
                    <input type="checkbox" class="tick" name="remember"> 
                    <p>Remember Me</p>
                    <a href="forgotpassword.php" class="forgot-password">Forgot Password?</a>
                   
            </div>
            <div class="login">
                <button type="submit" name="login_student" class="loginbtn">Sign In</button><br>
                <p>Not on our platform? <a href="student_signup.php" class="create-account">Create Account</a></p>
            </div>  
        </form>
    
    </div>

<script type="text/javascript" src="assets/js/student.js"></script>

</body>
</html>