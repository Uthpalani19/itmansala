<?php include('config/server.php') ?>
<?php include('config/errors.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/student.css">
</head>
<body>
    <!-- <div class="splash" id="hide">
        <img class="logo fade-in" src="assets/images/logo.png">
    </div> -->
    <div class="left signupleft">
        <div class="welcome">
            <p class="message signupmessage">Add your details</p>
        </div>
        <img class="avatar"src="assets/images/avatar-bye.png">     
    </div>

    <div class="right">
        <h1 class="signup">Sign Up as a student</h1>
        <div class="container">
            <div class="slider">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div id="form1">
                        <div class="signup-top">
                            <p><?php passError(); ?></p>
                        </div>                        
                        <div class="login_field signupfield">
                            <i class="login_icon fa-solid fa-user"></i>
                            <input type="text" class="login_input" placeholder="  Name" name="name" value="<?php echo $name;?>">
                            <div>
                                <?php FirstnameError(); ?>
                            </div>
                        </div>

                        <div class="login_field signupfield">
                            <i class="login_icon fa-solid fa-envelope"></i>
                            <input type="text" class="login_input" placeholder="  Email" name="email" value="<?php echo $Email;?>">
                            <div>
                                <?php EmailError(); ?>
                            </div>
                        </div>

                        <div class="login_field signupfield">
                            <i class="login_icon fa-solid fa-phone"></i>
                            <input type="text" class="login_input" placeholder="  Phone Number" name="phonenumber" id="phone" value="<?php echo $PhoneNumber;?>">
                            <div>
                                <?php PhoneError(); ?>
                            </div>
                        </div>

                        <div class="login">
                            <button disabled type="button" id="next1" class="loginbtn">Next</button><br>
                            <p>Already have an account? <a href="student_login.php" class="create-account">Sign In</a></p>

                        </div>  

                    </div>

                    <div id="form2">
                        <div class="back">
                            <button type="button" id="back1"><i class="fa-solid fa-chevron-left"></i></button>
                        </div> 

                        <div class="login_field signupfield signup_padding">
                            <i class="login_icon fa-solid fa-lock"></i>
                            <input type="password" class="login_input" id="psw1" placeholder="  Password" name="password_1" value="<?php echo $password_1;?>">
                            <i class="fa-regular fa-eye-slash" id="hidePsw1"></i>
                        </div>

                        <div class="login_field signupfield">
                            <i class="login_icon fa-solid fa-lock"></i>
                            <input type="password" class="login_input" id="psw2" placeholder="  Re-enter password" name="password_2">
                            <i class="fa-regular fa-eye-slash" id="hidePsw2"></i>
                        </div>

                        <div class="login">
                            <button type="submit" name="signup_student" class="loginbtn signupbtn">Sign Up</button><br>
                        </div> 

                    </div>
                </form>

            </div>
        </div>
    </div>
    

<script type="text/javascript" src="assets/js/signup.js"></script>
</body>
</html>

