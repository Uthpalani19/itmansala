<?php
    session_start();
    require('../../config/dbconnection.php');
    include('../../assets/includes/navbar-student.php');


    if (!isset($_SESSION['studentname'])) {
        header('location: ../../student_login.php');
    }

    include('../../config/studentconfig/viewsubtopic-backend.php') ;
    $phoneNumber = $_SESSION['studentphone'];

?>

<!DOCTYPE html>

<head>
    <title>IT Mansala</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/subtopic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/student-style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="body" class="purhasedBody">

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
    <?php
    if($check_student){
    ?>
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
                    <?php
                    $check_query = "SELECT * FROM student_subtopic WHERE subtopicId = $subtopic AND phoneNumber = $phoneNumber ";
                    $check_result = mysqli_query($connection, $check_query);
                    $empty_check_result = mysqli_num_rows($check_result) > 0;
                    ?>
                    <div class="db-subtopic-left">
                    <?php
                    if($empty_check_result){
                        $check_row = mysqli_fetch_array($check_result);
                    
                    if($check_row['status'] == 1){
                        ?>
                    <form class="checkbox" method="post">
                        <input type="text" value="<?php echo $subtopic; ?>" name="remove" readonly hidden>
                        <button type="submit" name="uncheckbtn"><i class="fa-regular fa-circle-check"></i></button>
                    </form>
                        <?php
                    }else{
                    ?>
                    <form class="checkbox" method="post">
                        <input type="text" value="<?php echo $subtopic; ?>" name="subtopicNo" readonly hidden>
                        <button type="submit" name="checkbtn"><i class="fa-regular fa-circle"></i></button>
                    </form>
                    <?php
                    }
                }else{
                    ?>
                    <form class="checkbox" method="post">
                        <input type="text" value="<?php echo $subtopic; ?>" name="insertsubtopicNo" readonly hidden>
                        <button type="submit" name="insertcheckbtn"><i class="fa-regular fa-circle"></i></button>
                    </form>
                    <?php
                }
                    ?>
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
                            $quizbtn = bin2hex(random_bytes(4));
                            $instructionbox = bin2hex(random_bytes(4));
                            $closeinstruction = bin2hex(random_bytes(4));
                            $closeinstructionclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $instructionboxclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                            $quizbtnclik = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
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
                                <a class="show-pdf" id="<?php echo $show; ?>">Click here to learn</a>
                                <br>
                                
                                <?php
                                if(!empty($url)){
                                ?>
                                <a class="show-pdf" id="<?php echo $showvideo; ?>">Lesson Video</a>
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
                        ?>
                        <!-- Attempt quiz button -->
                                <a id="<?php echo $quizbtn; ?>" style="display:none;">
                                <input type="button" value="Attempt Quiz" class="btn-questions add-questions attemptBtn" name="attemptQuiz" ></a>

                                <!-- Quiz instructions -->
                                
                                <div class="info-box" id="<?php echo $instructionbox; ?>" style="display:none;">
                                    <div class="info-title">
                                        <span>Instructions for the quiz</span>
                                    </div>

                                    <div class="info-list">
                                        <div class="info">1. You'll be given with 2 minutes to attempt each question. </div>
                                        <div class="info">2. You can't exit from the quiz until you complete it.</div>
                                        <div class="info">3. You can't go back to the previous question.</div>
                                        <div class="info">4. You can't skip any question.</div>
                                        <div class="info">5. If you don't score 90%, you'll have to attempt the quiz once again.</div>
                                    </div>

                                    <div class="buttons">
                                        <a href="questionsViewStudent.php?subId=<?php echo $subtopic;?>&courseId=<?php echo $lesson;?>&attempt=1&questionNumber=0"><input type="button" value="Start Quiz" class="btn-questions add-questions" name="startQuiz" id="startQuizbtn"></a>
                                        <input type="button" value="Exit Quiz" class="btn-questions add-questions" name="exitQuiz" id="<?php echo $closeinstruction; ?>">
                                    </div>
                                </div>
                        <?php
                    }
                }
                ?>
                <script>
                    const <?php echo $subidonclick; ?> = document.getElementById("<?php echo $subid; ?>");
                    const <?php echo $dblessonIDonclick; ?> = document.getElementsByClassName("<?php echo $class; ?>"); 
                    const <?php echo $hideIDonclick; ?> = document.getElementById("<?php echo $hideid; ?>");
                    const <?php echo $quizbtnclik; ?> = document.getElementById("<?php echo $quizbtn; ?>");
                    const <?php echo $instructionboxclick; ?> = document.getElementById("<?php echo $instructionbox; ?>");
                    const <?php echo $closeinstructionclick; ?> = document.getElementById("<?php echo $closeinstruction; ?>");

                    <?php echo $subidonclick; ?>.onclick = function(){
                        var i;
                        for (i=0; i< <?php echo $dblessonIDonclick; ?>.length; i++){
                            <?php echo $dblessonIDonclick; ?>[i].style.display = "block";
                        }
                        <?php echo $quizbtnclik; ?>.style.display = "block";
                    }

                    <?php echo $hideIDonclick; ?>.onclick =function(){
                        var x;
                        for (x=0; x< <?php echo $dblessonIDonclick; ?>.length; x++){
                        <?php echo $dblessonIDonclick; ?>[x].style.display = "none";
                        }
                        <?php echo $quizbtnclik; ?>.style.display = "none";
                    }

                    <?php echo $quizbtnclik; ?>.onclick = function(){
                        <?php echo $instructionboxclick; ?>.style.display = "block"; 
                    }

                    <?php echo $closeinstructionclick; ?>.onclick = function(){
                        <?php echo $instructionboxclick; ?>.style.display = "none"; 
                    }

                </script>
                
                <?php
            }
        }
        ?>
    </div>
    
    
    <!-- this contains course ratings -->
    <?php
        $student_id = $_SESSION['studentphone'];
        $course_id = $lesson;

        // Check if the student has already rated the course
        $check_rating_sql = "SELECT * FROM course_ratings WHERE phoneNumber = '$student_id' AND courseId = '$course_id'";
        $check_rating_result = mysqli_query($connection, $check_rating_sql);
                        
        if (mysqli_num_rows($check_rating_result) > 0) {
    ?>
            <div class="rating_container">
                <div class="rating_prompt" onclick="showPopup()">
                    <p>Rate this course !</p>
                </div>

                <div class="rating_form" id="rating_form" role="document">
                <div class="rt-popup">
                    <div class="rt-popup-head">
                       <div> <span>Review submitted</span></div>
                       <div> <button class="close-btn" onclick="closePopup()"><i class="fas fa-times-circle"></i></button></div>
                    </div>
                    <div>
                        <hr>
                    </div>

                    <div class="rt-popup-correct">
                    <i class="far fa-check-circle"></i>
                    </div>
                    <div>
                        <hr>
                    </div>
                </div>
                </div>
            </div>
    <?php
        } else {
    ?>
            <div class="rating_container">

            <div class="rating_prompt" onclick="showPopup()">
                <p>Click here to rate this course !</p>
            </div>
    
            <div class="rating_form" id="rating_form" role="document">
                <form  method="POST">
                <div class="rt-popup">
                    <div class="rt-popup-head">
                       <div> <span>Write a review</span></div>
                       <div> <button class="close-btn" onclick="closePopup()"><i class="fas fa-times-circle"></i></button></div>
                    </div>
                    
                    <div class="rt-popup-stars">
                        <div>
                        <i class="fas fa-star star-light " id="submit_star_1" data-index="0"></i>
                        <i class="fas fa-star star-light " id="submit_star_2" data-index="1"></i>
                        <i class="fas fa-star star-light " id="submit_star_3" data-index="2"></i>
                        <i class="fas fa-star star-light " id="submit_star_4" data-index="3"></i>
                        <i class="fas fa-star star-light " id="submit_star_5" data-index="4"></i>
                        </div>
                    </div>
    
                    <div class="rt-popup-messge">
                    <div> <textarea name="reviewMessage" id="review-message" cols="40" rows="5"></textarea></div>
                    <!-- <input type="text" name="rating" id="rating" class="popup-messge" > -->
                    </div>
    
                    <div class="rt-popup-btn">
                        <button type="submit" name="rating-submit" id="submit-btn" class="rt-submit-btn">Submit Review</button>
                    </div>
                    
                    <?php
                        if (isset($_POST["rating"]) && isset($_POST["reviewMessage"])) {
                            $rating = $_POST['rating'];
                            $reviewMessage = $_POST['reviewMessage'];
                            $student_id = $_SESSION['studentphone'];
                            $course_id = $lesson;
    
                            // Check if the student has already rated the course
                            $check_rating_sql = "SELECT * FROM course_ratings WHERE phoneNumber = '$student_id' AND courseId = '$course_id'";
                            $check_rating_result = mysqli_query($connection, $check_rating_sql);
                            
                            if (mysqli_num_rows($check_rating_result) > 0) {
                            } else {
                                // Insert the new rating
                                $rating_insert = "INSERT INTO course_ratings(phoneNumber, courseId, rating, reviewMessage) VALUES ('$student_id', '$course_id', '$rating', '$reviewMessage')";
                                $result = mysqli_query($connection, $rating_insert);
    
                                // Check if the query was successful
                                if ($result) {
                                    echo "Rating added successfully!";
                                } else {
                                    echo "Error: " . mysqli_error($connection);
                                }
                            }
                        }
                    ?>
                </div>
                </form>
    
                
            </div>
        </div>
    <?php    
        }
    }else{
        ?>
        <div class="notpurchased">
            <p>Sorry! You have not purchased this course.</p>
            <img class="empty-img" src="../../assets/images/welcome_avatar.png">
        </div>
        <?php
    }
    ?>
   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src ="../../assets/js/student.js"></script>
</body>
</html>