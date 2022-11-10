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
    </head>

    <body>
        <div class="background">
            <div class="form-box">
                <div class="form-img"></div>

                <div class="signup-form-details">
                    <!--Login form-->
                    <form method="POST" class="sign-up-form">
                        <h2>Sign Up</h2>
                        <input type="text" class="input-text" name="phonenumber" placeholder="Phone Number" required>
                        <input type="text" class="input-text" name="firstName" placeholder="First Name" required>
                        <input type="text" class="input-text" name="lastName" placeholder="Last Name" required>
                        <input type="password" class="input-text" name="password" placeholder="Password" required><br />
                        <input type="password" class="input-text" name="repassword" placeholder="Re-enter Password" required><br />
                        <input type="text" class="input-text" name="fieldOfExpertise" placeholder="Field of Expertise" required><br />

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