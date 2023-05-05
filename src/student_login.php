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
   <!--- <div class="splash" id="hide">
        <img class="logo fade-in" src="assets/images/logo.png">
    </div> --->
    <div class="left">
        <div class="welcome">
            <p class="message">Hi!<br>Welcome to IT Mansala</p>
        </div>
        <img class="avatar "src="assets/images/avatar.png">     
    </div>

    <div class="right">
        <h1>Sign In</h1>
        <img class="signin-icon" src="assets/images/icon.png">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="login_field">

                <i class="login_icon fa-solid fa-user"></i>
				<input id="loginphone" type="text" class="login_input" placeholder="  Phone number" name="user" value="<?php echo $Cookie_Username;?>">
                <div>
                    <?php PhoneError(); ?>
                </div>
			</div>
			<div class="login_field">
                <i class="login_icon fa-solid fa-lock"></i>
				<input id="password" type="password" class="login_input" placeholder="  Password" name="password" value="<?php echo $Cookie_Password;?>">
                <i class="fa-regular fa-eye-slash" id="hidePass"></i>
                <div>
                    <?php passError(); ?>
                    <?php loginError(); ?>
                </div>
			</div>

            <div class="options">
                    <input type="checkbox" class="tick" name="remember"> 
                    <p>Remember Me</p>
                    <a href="views/forgotpassword.php" class="forgot-password">Forgot Password?</a>
                   
            </div>
            <div class="login">
                <button disabled id="signinbtn" type="submit" name="login_student" class="loginbtn">Sign In</button><br>
                <p>Not on our platform? <a href="student_signup.php" class="create-account">Create Account</a></p>
            </div>  
        </form>
    
    </div>
<script>

    const loginphone = document.getElementById("loginphone");
    const signinbtn = document.getElementById("signinbtn");

    if (loginphone.value != ""){
        signinbtn.disabled = false;
    signinbtn.style.background = "#5C26A9";
    signinbtn.style.cursor = "pointer";
    }

    loginphone.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    signinbtn.disabled = false;
    signinbtn.style.background = "#5C26A9";
    signinbtn.style.cursor = "pointer";
    if (value === ""){
        signinbtn.disabled = true;
        signinbtn.style.background = "#c1b7cf";
        signinbtn.style.cursor = "not-allowed";
    }
    });

    const password = document.getElementById("password");
    password.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    signinbtn.disabled = false;
    signinbtn.style.background = "#5C26A9";
    signinbtn.style.cursor = "pointer";
    if (value === ""){
        signinbtn.disabled = true;
        signinbtn.style.background = "#c1b7cf";
        signinbtn.style.cursor = "not-allowed";
    }
    });

    const pass = document.getElementById("password");
    const hidePass = document.getElementById("hidePass");

    hidePass.onclick = function(){
        if (pass.type === "password"){
            pass.type = "text";
        }else{
            pass.type = "password";
        }
        if (hidePass.className == "fa-regular fa-eye-slash"){
            hidePass.className = "fa-regular fa-eye";
        }else{
            hidePass.className = "fa-regular fa-eye-slash";
        }
    }
</script>
<script type="text/javascript" src="assets/js/student.js"></script>

</body>
</html>