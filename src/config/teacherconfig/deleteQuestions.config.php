<?php
    require('../../config/dbconnection.php');
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
        $questionID = $_GET['deleteId'];
        $sql = "UPDATE modelpaperquestion set status=0 WHERE questionId='$questionID'";
        $result = mysqli_query($connection,$sql);

        if($result)
        {
            echo "<script>window.location.href='../../views/teacherviews/viewAddedQuestions.php'</script>";        }
        else
        {
            echo "Question Deletion Failed";
        }
    ?>
</body>
</html>