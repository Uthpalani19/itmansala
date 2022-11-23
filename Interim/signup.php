<?php
    session_start();
    include 'dbconnection.php';

    $phoneError = $fNameError = $lNameError = $passwordError = $repasswordError = $fieldError = "";
    $phone = $firstname = $lastname = $password = $repassword = $fieldOfExpertise = "";

    if(isset($_POST['SignUp']))
    {
        // Check if all fields are filled
        if(empty($_POST['phonenumber']))
        {
            $phoneError = "* Phone number is required";
        }
        else
        {
            $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber']);
        }

        if(empty($_POST['firstName']))
        {
            $fNameError = "* First name is required";
        }
        else
        {
            $firstname = mysqli_real_escape_string($connection,$_POST['firstName']);
        }

        if(empty($_POST['lastName']))
        {
            $lNameError = "* Last name is required";
        }
        else
        {
            $lastname = mysqli_real_escape_string($connection,$_POST['lastName']);
        }

        if(empty($_POST['password']))
        {
            $passwordError = "* Password is required";
        }
        else
        {
            $password = mysqli_real_escape_string($connection,$_POST['password']);
        }

        if(empty($_POST['repassword']))
        {
            $repasswordError = "* Re-enter password";
        }
        else
        {
            $repassword = mysqli_real_escape_string($connection,$_POST['repassword']);
        }

        if(empty($_POST['fieldOfExpertise']))
        {
            $fieldError = "* This is required";
        }
        else
        {
            $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['fieldOfExpertise']);
        }

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
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!-- Java Script validation -->
        <script type="text/javascript">
            function signupFor()
            {
                var phonenumber = document.forms["signupForm"]["phonenumber"].value;
                var firstName = document.forms["signupForm"]["firstName"].value;
                var lastName = document.forms["signupForm"]["lastName"].value;
                var password = document.forms["signupForm"]["password"].value;
                var repassword = document.forms["signupForm"]["repassword"].value;
                var fieldOfExpertise = document.forms["signupForm"]["fieldOfExpertise"].value;

                var regPhone=/^\d{10}$/;                                        // JS reGex for Phone Number validation.
                var regName = /\d+$/g;                                          // JS reGex for Name validation
                var regPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;      // JS reGex for password validation

                if(phonenumber=="" || firstName=="" || lastName=="" || password=="" || repassword=="" || fieldOfExpertise=="")
                {
                    return false;
                }
                else if(!regPhone.test(phonenumber))
                {
                    alert("Please enter a valid phone number.");
                    return false;
                }
                else if(regName.test(firstName) || regName.test(lastName))
                {
                    alert("Please enter a valid name.");
                    return false;
                }
                else if(!regPassword.test(password))
                {
                    alert("Please enter a valid password.");
                    return false;
                }
                else if(password!=repassword)
                {
                    alert("Passwords are not matching.");
                    return false;
                }
                else
                {
                    return true;
                }

            }
        </script>
        <!-- End of JS -->
        
    </head>

    <body>
        <div class="background">
            <div class="form-box">
                <div class="form-img"></div>

                <div class="signup-form-details">
                    <!--Login form-->
                    <form onsubmit="return signupFor()" method="POST" class="sign-up-form" name="signupForm">
                        <h2>Sign Up</h2>

                        <div class="input-box">
                            <input type="text" class="input-text" name="phonenumber" placeholder="Phone number">
                            <span class="error"> <?php echo $phoneError; ?></span> 
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="firstName" placeholder="First name">
                            <span class="error"> <?php echo $fNameError; ?></span>
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="lastName" placeholder="Last name">
                            <span class="error"> <?php echo $lNameError; ?></span>
                        </div>

                        <div class="input-box">
                            <input type="password" class="input-text" name="password" placeholder="Password">
                            <span class="error"> <?php echo $passwordError; ?></span>
                        </div>

                        <div class="input-box">
                            <input type="password" class="input-text" name="repassword" placeholder="Re-enter Password">
                            <span class="error"> <?php echo $repasswordError; ?></span>
                        </div>

                        <div class="input-box">
                            <input type="text" class="input-text" name="fieldOfExpertise" placeholder="Field of expertise">
                            <span class="error"> <?php echo $fieldError; ?></span>
                        </div>

                        <input type="submit" class="input-text submit-btn" name="SignUp" value="Sign Up">
                        <div class="signup">
                            <p>Have an account already? <a href="index.php"> Log in </a> </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>
</html>