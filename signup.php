<?php
    session_start();
    include 'dbconnection.php';

    if(isset($_POST['Signup']))
    {
        $userName = mysqli_real_escape_string($connection,$_POST['username']);
        $firstname = mysqli_real_escape_string($connection,$_POST['fName']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lName']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $dob = mysqli_real_escape_string($connection,$_POST['dob']);
        $alYear = mysqli_real_escape_string($connection,$_POST['year']);
        $phonenumber = mysqli_real_escape_string($connection,$_POST['contact']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $repassword = mysqli_real_escape_string($connection,$_POST['repassword']);
        

        $sql = "SELECT * from student WHERE phonenumber='$phonenumber' LIMIT 1";
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
                //Encryp password
                $password = md5($password);

                $sql2 = "INSERT into student (phoneNumber,firstName,lastName, userName, email, dob, alYear, password, status)
                        values ('$phonenumber','$firstname','$lastname', '$email', '$dob', $alYear', '$password',1)";
                        
                mysqli_query($connection,$sql2);
                $_SESSION['phoneNumber']=$phonenumber;

                ?>
                <script type="text/javascript">
                    alert("User Recorded.");
                    window.location.href="viewStudents.php";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Signup Page </title>
    <link rel="stylesheet" href = "css/signup.css">
</head>
<body>
        <section>
            <div class="imgbox">
                <img src="img/bg3.jpg">

            </div>
            <div class="contentbox">
                <div class="formbox">
                    <h2>Sign Up</h2>
                    
                    <form method="post" >
                        <div class="inputbox">
                            <input type="text" placeholder="Username" name="username" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="First Name" name="fName" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="Last Name" name="lName" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="Email" name="email" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="Date of Birth" name="dob" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="A/L Year" name="year" required>   
                        </div>
                        <div class="inputbox">
                            <input type="text" placeholder="Phone Number" name="contact" required>   
                        </div>
                        <div class="inputbox">
                            <input type="password" placeholder="Password" name="password" required>   
                        </div>
                        <div class="inputbox">
                            <input type="password" placeholder="Re-enter Password" name="repassword" required>   
                        </div>
                        <div class="inputbox">
                            <input type="submit" value="Sign in" name="">
                        </div>
                        
                    </form>
                </div>

            </div>
        </section>
</body>
</html>