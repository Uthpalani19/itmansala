<?php
    require_once 'dbconnection.php';

    if(isset($_POST['signup']))
    {
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);


        $password = md5($password);

        $sql = "INSERT into admin (name,password)
            VALUES('$name','$password')";

        if($connection->query($sql) === TRUE)
        {
            echo 'Successful';
            header("location:viewTeachers.php");
        }
        else
        {
            echo mysqli_error($connection);
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
                            <input type="text" placeholder="Name" name="name" required>   
                        </div>
                        <div class="inputbox">
                            <input type="password" placeholder="Password" name="password" required>   
                        </div>
                        <div class="inputbox">
                            <input type="password" placeholder="Re-enter Password" name="repassword" required>   
                        </div>
                        <div class="inputbox">
                            <input type="submit" value="Sign up" name="">
                        </div>
                        
                    </form>
                </div>

            </div>
        </section>
</body>
</html>