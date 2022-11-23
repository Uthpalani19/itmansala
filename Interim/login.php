<?php
    require('dbconnection.php');
    session_start();
    
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

            $query="Select * from teacher where phoneNumber='".$_POST['username']."' && password='$decrypt' having status=1";
            $result=mysqli_query($connection,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['User']=$_POST['username'];
                header("location:dashboard-teacher.php");
            }
            else
            {
                header("location:index.php");
            }
        }
    }
    else
    {
        echo 'Not workingg';
    }

?>