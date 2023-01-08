<?php
    session_start();

    require_once('config/dbconnection.php');
    
    if(isset($_POST['Login']))
    {
        if(empty($_POST['username']) || empty($_POST['password']))
        {
            header("location:index.php");
        }
        else
        {
            //decrypting password
            $decrypt = md5($_POST['password']);

            $query="Select * from teacher where phoneNumber='".$_POST['username']."' && password='$decrypt'";
            $result=mysqli_query($connection,$query);
            if (mysqli_num_rows($result)==1)
            {
                $row = mysqli_fetch_array($result);
                $Firstname = $row['firstName'];
                $_SESSION['firstname'] = $Firstname;
                header('location:views/teacherviews/dashboard-teacher.php');
            }
            else
            {
                header("location:index.php");
            }
        }
    }


?>