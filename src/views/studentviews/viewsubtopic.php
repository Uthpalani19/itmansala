<?php

session_start();
require('../../config/dbconnection.php');
include('../../assets/includes/navbar-student.php');


if (!isset($_SESSION['name'])) {
    header('location: ../student_login.php');
}
?>
<?php include('../../config/studentconfig/viewsubtopic-backend.php') ?>
<html>

<head>
    <title>IT Mansala</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/subtopic.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">
</head>

<body>

    <div class="lesson-info viewlessoninfo">
        <div class="lesson-num">
            <p class="lesson-number">Course 0<?php echo $subtopic_row['courseId']; ?>:</p>
            <p class="lesson-name">
                <?php echo $subtopic_row['courseName']; ?>
            </p>
        </div>
        <p class="lesson-desc">
            <?php echo $subtopic_row['courseDescription']; ?>
        </p>

    </div>
    <div class="content">


        <?php
        $retrieve_subtopic = "SELECT * FROM subtopic WHERE courseID = $lesson";
        $retrieve_subtopic_result = mysqli_query($connection, $retrieve_subtopic);
        $check_retrieve_subtopic = mysqli_num_rows($retrieve_subtopic_result) > 0;

        if ($check_retrieve_subtopic) {
            while ($retrieve_subtopic_row = mysqli_fetch_array($retrieve_subtopic_result)) {
                $subtopic = $retrieve_subtopic_row['subTopicId'];
                ?>
                <div class="db-subtopic">
                    <div class="db-subtopic-left">
                        <i class="fa-solid fa-lock subtopic-lock"></i>
                        <p>
                            <?php echo $retrieve_subtopic_row['subTopicId']; ?>
                        </p>
                        <p id="dbsubtopic">
                            <?php echo $retrieve_subtopic_row['subTopicName']; ?>
                        </p>
                    </div>
                    <div class="db-subtopic-right">
                        <p id="hidediv"><i class="fa-solid fa-chevron-down"></i></p>
                    </div>

                </div>


                <?php
            }
        }
        ?>
        <?php
        if (empty($subtopic)) {

        } else {
            $retrieve_lesson = "SELECT * FROM lesson WHERE subTopicId = $subtopic";
            $retrieve_lesson_result = mysqli_query($connection, $retrieve_lesson);
            $check_retrieve_lesson = mysqli_num_rows($retrieve_lesson_result) > 0;

            if ($check_retrieve_lesson) {
                while ($retrieve_lesson_row = mysqli_fetch_array($retrieve_lesson_result)) {
                    $content = $retrieve_lesson_row['content'];
                    $name = $retrieve_lesson_row['lessonName'];
                    $id = str_replace(' ', '', $name);
                    $pdf = pathinfo($content, PATHINFO_FILENAME);
                    $pdfId = str_replace(' ', '', $pdf);

                    ?>

                    <div class="dblesson">

                        <p>
                            <?php echo $retrieve_lesson_row['lessonName']; ?>
                        </p>
                        <p class="show-pdf" id="<?php echo $id ?>">Click here to learn</p>
                        <i class="fa-solid fa-lock subtopic-lock subtopiclock2"></i>
                        <div id="<?php echo $pdfId ?>">
                            <embed src="../../assets/uploads/<?php echo $content ?>#toolbar=0" height="500" width="1000"/>
                        </div>

                    </div>
                    <?php
                }

            }
        }
        ?>

    </div>


    <script>
        const dbsubtopic = document.getElementById("dbsubtopic");
        const dblesson = document.getElementsByClassName("dblesson");
        const addlesson = document.getElementById("addlesson");
        const hidediv = document.getElementById("hidediv");
        const button = document.getElementById("<?php echo $id ?>");
        const showfile = document.getElementById("<?php echo $pdfId ?>");

        dbsubtopic.onclick = function () {
            var i;
            for (i = 0; i < dblesson.length; i++) {
                dblesson[i].style.display = 'block';
            }
        }

        hidediv.onclick = function () {
            var x;
            for (x = 0; x < dblesson.length; x++) {
                dblesson[x].style.display = 'none';
            }

        }

        button.onclick = function () {
            
        }




    </script>
</body>

</html>