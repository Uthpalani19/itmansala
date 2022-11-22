<?php
    session_start();
    include 'dbconnection.php';

    if(isset($_POST['SignUp']))
    {
        $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber']);
        $firstname = mysqli_real_escape_string($connection,$_POST['firstName']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lastName']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $repassword = mysqli_real_escape_string($connection,$_POST['repassword']);
        $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['fieldOfExpertise']);

        $sql = "SELECT * from teacher WHERE phonenumber='$phonenumber' LIMIT 1";
        $result = mysqli_query($connection,$sql);
        $user = mysqli_fetch_assoc($result);

        if($password==$repassword)
        {
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
                    alert("User Recorded.");
                    window.location.href="editCourseContent.php";
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script type="text/javascript">
                alert("Passwords are not matching.");
                window.location.href=window.location.href;
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
                    alert("Please fill all the fields.");
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
                        <input type="text" class="input-text" name="phonenumber" placeholder="Phone Number">
                        <input type="text" class="input-text" name="firstName" placeholder="First Name">
                        <input type="text" class="input-text" name="lastName" placeholder="Last Name">
                        <input type="password" class="input-text" name="password" placeholder="Password"><br />
                        <input type="password" class="input-text" name="repassword" placeholder="Re-enter Password"><br />
                        <input type="text" class="input-text" name="fieldOfExpertise" placeholder="Field of Expertise"><br />

                        <input type="submit" class="submit-btn" name="SignUp" value="Sign Up">
                        <div class="signup">
                            <p>Have an account already? <a href="index.php"> Log in </a> </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>
</html>