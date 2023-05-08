<?php
    require('../../config/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-wi dth, initial-scale=1.0">
    <title>Delete Questions</title>
</head>

<body>
    <?php   
        // Get Subtopic ID
        $subId = $_GET['subId'];
    
        // Get Course ID
        $courseId = $row['courseId'];

        $questionID = $_GET['recoverId'];
        $sql = "UPDATE modelpaperquestion set status=1 WHERE questionId='$questionID'";
        $result = mysqli_query($connection,$sql);

        if($result)
        {
            echo "<script>window.location.href='../../views/teacherviews/viewAddedQuestions.php?subId=".$subId."&courseId=".$courseId."';</script>";
        }
        else
        {
            echo "Question Deletion Failed";
        }
    ?>
</body>
</html>