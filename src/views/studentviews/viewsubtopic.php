<?php

session_start();
require('../../config/dbconnection.php');
include('../../assets/includes/navbar-student.php');


if (!isset($_SESSION['studentname'])) {
    header('location: ../../student_login.php');
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

<body id="body">

    <div class="lesson-info viewlessoninfo">
        <div class="lesson-num">
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
                $subid = bin2hex(random_bytes(4));
                $hideid = bin2hex(random_bytes(4)); 
                $class = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                $subidonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                $dblessonIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                $hideIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                ?>
                <style>
                    <?php echo '.'.$class ?>{
                        display: none;
                        padding-bottom: -100px;
                    }
                </style>
                <div class="db-subtopic">
                    <div class="db-subtopic-left">
                        <i class="fa-solid fa-lock subtopic-lock"></i>
                        <p id="<?php echo $subid; ?>"><?php echo $retrieve_subtopic_row['subTopicName']; ?></p>
                    </div>
                    <div class="db-subtopic-right">
                        <p id="<?php echo $hideid; ?>"><i class="fa-solid fa-chevron-down"></i></p>
                    </div>

                </div>

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
                            $show = bin2hex(random_bytes(4));
                            $close = bin2hex(random_bytes(4));
                            $pdfid = bin2hex(random_bytes(4));
                            $showvideo = bin2hex(random_bytes(4));
                            $videoclose = bin2hex(random_bytes(4));
                            $player = bin2hex(random_bytes(4));
                            $showvideoclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $playerIDclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $videocloseclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $closeonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $showonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $pdfIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $bodyonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $videobody = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $videoContent = $retrieve_lesson_row['videoContent'];
                            $url = "";
                            if(!empty($videoContent)){
                                $url = substr($videoContent, -11);  
                            }   
                            ?>
        
                            <div class="dblesson <?php echo $class; ?>">
                                <p><?php echo $retrieve_lesson_row['lessonName']; ?></p>
                                <a class="show-pdf locked-content" id="">Click here to learn</a>
                                <i class="fa-solid fa-lock subtopic-lock subtopiclock2"></i><br>
                                <?php
                                if(!empty($url)){
                                ?>
                                <a class="show-pdf locked-content" id="">Lesson Video</a>
                                <?php
                                }
                                ?>  
                            </div>

                            <?php 
                            if(!empty($url)){
                            ?>
                            <div class="youtubediv" id="<?php echo $player; ?>" style="display:none;">
                                <i class="fa-regular fa-rectangle-xmark lesson-close" id="<?php echo $videoclose ?>"></i>
                                <iframe width="900" height="640" src="https://www.youtube.com/embed/<?php echo $url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                            <script>
                                const <?php echo $showvideoclick; ?> = document.getElementById("<?php echo $showvideo; ?>");
                                const <?php echo $playerIDclick; ?> = document.getElementById("<?php echo $player; ?>");
                                const <?php echo $videocloseclick; ?> = document.getElementById("<?php echo $videoclose; ?>");
                                const <?php echo $videobody; ?> = document.getElementById("body");

                                <?php echo $showvideoclick; ?>.onclick = function(){
                                    <?php echo $playerIDclick; ?>.style.display = "block";
                                    <?php echo $videobody; ?>.classList.add("fixed");
                                }

                                <?php echo $videocloseclick; ?>.onclick = function(){
                                    <?php echo $playerIDclick; ?>.style.display = "none";
                                    <?php echo $videobody; ?>.classList.remove("fixed");
                                }

                            </script>
                            <?php
                                }
                            ?>

                            <div class="pdfdiv" id="<?php echo $pdfid; ?>" style="display:none;">
                                <i class="fa-regular fa-rectangle-xmark lesson-close" id="<?php echo $close ?>"></i>
                                <embed src="../../assets/uploads/<?php echo $content ?>" height="630" width="1000"/>
                            </div>
                            <script>
                                const <?php echo $showonclick; ?> = document.getElementById("<?php echo $show; ?>");
                                const <?php echo $pdfIDonclick; ?> = document.getElementById("<?php echo $pdfid; ?>");
                                const <?php echo $closeonclick; ?> = document.getElementById("<?php echo $close; ?>");
                                const <?php echo $bodyonclick; ?> = document.getElementById("body");

                                <?php echo $showonclick; ?>.onclick = function(){
                                    <?php echo $pdfIDonclick; ?>.style.display = "block";
                                    <?php echo $bodyonclick; ?>.classList.add("fixed");
                                }

                                <?php echo $closeonclick; ?>.onclick = function(){
                                    <?php echo $pdfIDonclick; ?>.style.display = "none";
                                    <?php echo $bodyonclick; ?>.classList.remove("fixed");
                                }

                            </script>
                            <?php
                        }
        
                    }
                }
                ?>
                <script>
                    const <?php echo $subidonclick; ?> = document.getElementById("<?php echo $subid; ?>");
                    const <?php echo $dblessonIDonclick; ?> = document.getElementsByClassName("<?php echo $class; ?>"); 
                    const <?php echo $hideIDonclick; ?> = document.getElementById("<?php echo $hideid; ?>");

                    <?php echo $subidonclick; ?>.onclick = function(){
                        var i;
                        for (i=0; i< <?php echo $dblessonIDonclick; ?>.length; i++){
                            <?php echo $dblessonIDonclick; ?>[i].style.display = "block";
                        }
                    }

                    <?php echo $hideIDonclick; ?>.onclick =function(){
                        var x;
                        for (x=0; x< <?php echo $dblessonIDonclick; ?>.length; x++){
                        <?php echo $dblessonIDonclick; ?>[x].style.display = "none";
                        }
                    }
                </script>
                
                <?php
            }
        }
        ?>
        

    </div>

</body>

</html>