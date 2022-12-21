<?php
    session_start();
    include 'dbconnection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Entering data to the DB
            $sql = "SELECT * from teacher WHERE phonenumber='$phonenumber' LIMIT 1";
            $result = mysqli_query($connection,$sql);
            $user = mysqli_fetch_assoc($result);

            if($user)
            {
                ?>
                <script type="text/javascript">
                    alert("Phone Number Already Exists.");
                    window.location.href=window.location.href;
                </script>
                <?php
            }
            else
            {
                //Encrypting password
                $password = md5($password);

                $sql2 = "INSERT into Teacher (phoneNumber,firstName,lastName,password,fieldOfExpertise,status)
                        values ('$phonenumber','$firstname','$lastname','$password','$fieldOfExpertise',1)";
                mysqli_query($connection,$sql2);
                $_SESSION['phoneNumber']=$phonenumber;

                ?>
                <script type="text/javascript">
                    window.location.href="dashboard-teacher.php";
                </script>
                <?php
            }
    }
?>

<html>
    <head>
        <title>Sign Up</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/teacher-style.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>

    <body>
        <div class="background">
            <div class="form-box">
                <div class="form-img"></div>

                <div class="signup-form-details">
                    <!--Login form-->
                    <form onsubmit="return signupFor()" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="sign-up-form" name="signupForm">
                        <h2>Sign Up</h2>

                        <div class="input-box">
                            <input type="text" class="input-text" name="phonenumber" placeholder="Phone number" id="phone" required>
                            <span id="phone-error" class="hide error">Invalid Input</span>
                            <span id="empty-phone" class="hide error">Phone number Cannot Be Empty</span> 
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="firstName" placeholder="First name" id="first-name-input">
                            <span id="first-name-error" class="hide error">Invalid Input</span>
                            <span id="empty-first-name" class="hide error">First Name Cannot Be Empty</span> 
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="lastName" placeholder="Last name" id="last-name-input">
                            <span id="last-name-error" class="hide error">Invalid Input</span>
                            <span id="empty-first-name" class="hide error">Last Name Cannot Be Empty</span> 
                        </div>

                        <div class="input-box">
                            <input type="password" class="input-text" name="password" placeholder="Password" id="password">
                            <span id="password-error" class="hide error">Passwords Should Have Letter, Special symbols, Numbers And Length >=8</span>
                            <span id="empty-password" class="hide error">Password Cannot Be Empty</span>
                        </div>

                        <div class="input-box">
                            <input type="password" class="input-text" name="repassword" placeholder="Re-enter Password" id="verify-password">
                            <span id="verify-password-error" class="hide error">Invalid Input</span>
                            <span id="empty-verify-password" class="hide error">This Cannot Be Empty</span>
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="fieldOfExpertise" placeholder="Field of expertise" id="field-of-expertise">
                            <span id="field-error" class="hide error">Invalid Input</span>
                            <span id="empty-field" class="hide error">Field of expertise Cannot Be Empty</span>
                        </div>

                        <input type="submit" class="input-text submit-btn" name="SignUp" value="Sign Up">
                        <div class="signup">
                            <p>Have an account already? <a href="index.php"> Log in </a> </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        <!-- Script -->
        <script src="js/signupvalidation.js"></script>

    </body>
</html>