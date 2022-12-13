<?php
    session_start();

    require_once('dbconnection.php');
    // $host = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'emansala';

    // // Set DSN
    // $dsn = 'mysql:host=' . $host . ';dbname=' . $database;

    // // Create a PDO instance
    // $pdo = new PDO($dsn, $username, $password);
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

    // // Prepared Statement
    // $phoneNumber='0763361822';

    // $sql = 'SELECT * from teacher where phoneNumber = ?';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$phoneNumber]);
    // $posts = $stmt->fetchAll();
    
    // var_dump($posts);
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
                header('location:dashboard-teacher.php');
            }
            else
            {
                header("location:index.php");
            }
        }
    }


?>