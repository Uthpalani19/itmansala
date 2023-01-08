<?php
    session_start();
    require_once('src\assets\includes\navbar-teacher.php');
    require('dbconnection.php');

    if(!isset($_SESSION['firstname']))
    {
        header('location:index.php');
    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['firstname']);
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Questions</title>
</head>

<body>
    <?php
        require_once 'dbconnection.php';

        $questionID = $_GET['deleteId'];
        $sql = "UPDATE modelpaperquestion set status=0 WHERE questionId='$questionID'";
        $result = mysqli_query($connection,$sql);

        if($result)
        {
            echo "<script>window.location.href='viewAddedQuestions.php'</script>";        }
        else
        {
            echo "Question Deletion Failed";
        }
    ?>
</body>
</html>