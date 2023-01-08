<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/css/global.css"></link>
    <title>Under Construction</title>
</head>
<body>
    <!--Navigation Bar-->
    <?php
            require_once('src\assets\includes\navbar-teacher.php');
    ?>

    <div class="container">
        <div class="encouragement-msg">
            <p> Oops! We are currently working on this page. </p>
        </div>
        <br><br>
        <div class="avatar">
            <img src="src\assets\images\avatar4.png" alt="quizReviewAvatar" id="quizReviewAvatar" width = "500">
        </div>
        <br><br>
        <div class="encouragement-msg2">
            <p> !!!! UNDER CONSTRUCTION !!!! </p>
        </div>
    </div>

</body>
</html>