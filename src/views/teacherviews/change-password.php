<?php
    include('../../config/errors.php');
    include('../../config/password-backend.php');

    if (!isset($_SESSION['name'])) {
        header('location: ../../student_login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>

  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/student.css">
</head>
<body>
    <div class="left">
        <div class="welcome">
            <p class="message">Hi! <?php echo $_SESSION['name']; ?>,<br>Just a few more steps...</p>
        </div>
        <img class="avatar "src="../../assets/images/avatar.png">     
    </div>
    <div class="right">
        <h1 class="chgpasstitle">Change your password</h1>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="login_field signupfield">
                <input type="password" class="login_input" id="psw1" placeholder="  New Password" name="chgpassword_1" value="<?php echo $chgpassword_1;?>">
                <i class="fa-regular fa-eye-slash" id="hidePsw1"></i>
                <div>
                    <?php passError(); ?>
                </div>
            </div>

            <div class="login_field signupfield">
                <input type="password" class="login_input" id="psw2" placeholder="  Confirm Password" name="chgpassword_2">
                <i class="fa-regular fa-eye-slash" id="hidePsw2"></i>
                <div>
                    <?php passError(); ?>
                </div>
            </div>

            <div class="login">
              <button type="submit" name="teacher_pass" class="loginbtn signupbtn">Change Password</button><br>
            </div> 
          </form>

    
    </div>


<script>
const psw1 = document.getElementById("psw1");
const psw2 = document.getElementById("psw2");
const hidePsw1 = document.getElementById("hidePsw1");
const hidePsw2 = document.getElementById("hidePsw2");

hidePsw1.onclick = function(){
    if (psw1.type === "password"){
        psw1.type = "text";
    }else{
        psw1.type = "password";
    }
    if (hidePsw1.className == "fa-regular fa-eye-slash"){
        hidePsw1.className = "fa-regular fa-eye";
    }else{
        hidePsw1.className = "fa-regular fa-eye-slash";
    }
}

hidePsw2.onclick = function(){
    if (psw2.type === "password"){
        psw2.type = "text";
    }else{
        psw2.type = "password";
    }
    if (hidePsw2.className == "fa-regular fa-eye-slash"){
        hidePsw2.className = "fa-regular fa-eye";
    }else{
        hidePsw2.className = "fa-regular fa-eye-slash";
    }
}
</script>
</body>
</html>
