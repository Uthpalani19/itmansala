<?php
   include("assets/includes/navbar-landingPage.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script>
            function login()
            {
                window.location.href="student_login.php";
            }
            function signup()
            {
                window.location.href="student_signup.php";
            }
    </script>
    <script src="assets/js/counter.js"></script>


    <link rel="stylesheet" href="assets/css/style4.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery CDN for counter -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    
</head>
<body>

<div class="landing-page-1" id="section-1">
    <div class="heading-div">
        <div class="left-content">
        <div class="page-heading">
            <h1 class="landing-heading">
                TAKE YOUR <span class="blue-text">ICT</span> 
            </h1>
            <h1 class="landing-heading">
                <span class="blue-text">SKILLS</span>  TO THE NEXT LEVEL  
            </h1>
        </div>
            <div>
                <p class="landing-subheading">ICT permeates all aspects of life, providing newer, better,</br> and quicker ways for people to interact, network, seek help, gain access to information, and learn</p>
            </div>

            <div class="page-signup">
                <button class="landing-btn-signin" onClick="login()">Sign in</button>
                <button class="landing-btn-signup" onClick="signup()">Sign up</button>
            </div>
        </div>

        <div class="image-container-page1">
            <img class="lpage1-iamge" src="assets/images/eva2.png" alt="">
        </div>
    </div>
</div>

<div class="landing-page-2" id="section-2">
    <h1 class="lpage-2-heading">
        About Us
    </h1>

    <p class="lpage-2-paragraph">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br> sed do eiusmod tempor incididunt ut labore et dolore magna 
    </p>

    <div class="lpage-2-cards">
        <div class="lpage-card">
            <h4>Tailored for you</h4>
            <p class="card-description">No matter your experience level, you'll be writing real, 
                functional code within minutes of starting your first course.</p>
        </div>

        <div class="lpage-card">
            <h4>Bite-sized</h4>
            <p class="card-description">Go step-by-step through our unique courses. 
                Assess what you've learned with in-lesson quizzes, and gradually advance your skills with practice..</p>
        </div>

        <div class="lpage-card">
            <h4>Get proof</h4>
            <p class="card-description">Earn a certificate to validate your newly acquired skills. Post it on social for others to see..</p>
        </div>

        <div class="lpage-card">
            <h4>More than 10 courses</h4>
            <p class="card-description">From Python, through data, to web dev. 
                We got everything you need to cover the Advancend level syllabus.</p>
        </div>

    </div>

    <section class="counters">
        <div class="lpage-2-bar">
            <!-- PHP part for page statistics -->
            <?php
            include('config/dbconnection.php');

                $sql = "SELECT COUNT(*) FROM course";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result);
                $totalCourse = (int)$row[0];

                $sql = "SELECT COUNT(*) FROM student";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result);
                $totalStudent = (int)$row[0];

                $sql = "SELECT COUNT(*) FROM modelpaperquestion";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result);
                $totalQuestions = (int)$row[0];
            ?>

            <div class="bar-item"><h2 class="lpage2-bar-heading"><?php echo $totalCourse ?> <br>Courses </h2></div>
            <div class="bar-item"><h2 class="lpage2-bar-heading"><?php echo $totalStudent ?> <br>Students </h2></div>
            <div class="bar-item"><h2 class="lpage2-bar-heading"><?php echo $totalQuestions ?> <br>Questions </h2></div>
        </div>
    </section>
</div>

<div class="landing-page-3" id="section-3">

    
    
    <div class="lpage3-courseses">
    <?php include("views/landingPages/lpage-courses.php"); ?>
    </div>

    <div class="lpage3-course-des-container">
    <?php include("views/landingPages/lpage-course-des.php"); ?>
    </div> 
    
</div>

<div class="landing-page-4" id="section-4">
    <div class="lpage-4-heading">
        <h2>
            Choose your path
        </h2>
        <br>    
        <p class="lpage-4-paragraph">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br> sed do eiusmod tempor incididunt ut labore et dolore magna 
    </p>
    </div>

    <div class="lpage-4-des">
        
        <div class="lpage-4-interests">
            <a href="#section-6"><button class="lpage-4-button">Programming</button></a>
            <a href="#section-6"><button class="lpage-4-button">Designing</button></a>
            <a href="#section-6"><button class="lpage-4-button">Web Development</button></a>
            <a href="#section-6"><button class="lpage-4-button">Cybersecurity</button></a>
            <a href="#section-6"><button class="lpage-4-button">Data analysis</button></a>
            <a href="#section-6"><button class="lpage-4-button">Artificial Intelligence</button></a>
            <a href="#section-6"><button class="lpage-4-button">Game Development</button></a>
        </div>

        <div class="lpage-4-interests">
            <a href="#section-6"><button class="lpage-4-button">Mobile app development</button></a>
            <a href="#section-6"><button class="lpage-4-button">Networking</button></a>
            <a href="#section-6"><button class="lpage-4-button">Machine learning</button></a>
            <a href="#section-6"><button class="lpage-4-button">E-commerce</button></a>
            <a href="#section-6"><button class="lpage-4-button">Cloud computing</button></a>
            <a href="#section-6"><button class="lpage-4-button">Project Management</button></a>
            <a href="#section-6"><button class="lpage-4-button">Big data</button></a>
        </div>

        <div class="lpage-4-interests">
            <a href="#section-6"><button class="lpage-4-button">Database management</button></a>
            <a href="#section-6"><button class="lpage-4-button">Technical writing</button></a>
            <a href="#section-6"><button class="lpage-4-button">Quality assurance</button></a>
            <a href="#section-6"><button class="lpage-4-button">VR and AR</button></a>
            <a href="#section-6"><button class="lpage-4-button">Robotics</button></a>
            <a href="#section-6"><button class="lpage-4-button">Social media and marketing</button></a>
            <a href="#section-6"><button class="lpage-4-button">It consulting</button></a>
        </div>

        <div class="lpage-4-interests">
            <a href="#section-6"><button class="lpage-4-button">IT operations</button></a>
            <a href="#section-6"><button class="lpage-4-button">Quantum computing</button></a>
            <a href="#section-6"><button class="lpage-4-button">Cloud security</button></a>
            <a href="#section-6"><button class="lpage-4-button">Internet of Things</button></a>
            <a href="#section-6"><button class="lpage-4-button">Cloud computing</button></a>
            <a href="#section-6"><button class="lpage-4-button">Blockchain</button></a>
            <a href="#section-6"><button class="lpage-4-button">User experience</button></a>
        </div>  
    </div>

    <div class="interest-jobpath" id="section-6">
        <?php include ("views/landingPages/lpage-jobDes.php");?>
        <div class="footer">
            <div class="footer-upper">

                <div>
                    <h3>IT Mansala</h3>
                </div>
                    
                <div class="right">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-linkedin"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>  
                </div>
            </div>
            <hr>

            <div class="footer-middle">
                <div><h4>Join with us!</h4></div>
                <div>
                    <button >Sign In</button>
                    <button>Sign Up</button>
                </div> 
            </div>

            <div class="footer-footer">
                <div class="footer-footer-left">
                        <div>Privacy Policy</div>
                        <div>Terms & Conditions</div>
                        <div>Cookies Policy</div>
                        <div>Return Policy</div>
                </div>

                <div class="footer-footer-right">
                Copyright © 2022, IT Mansala. All Rights Reserved
                </div>
            </div>
        </div>
    </div>
    
</div>


    
    <!-- <?php include("../../assets/includes/footer.php"); ?>  -->
<script src="assets/js/script.js"></script>

<!-- Counter -->
<!-- <script type="text/javascript">

    $(document).ready(function() {
        $('.lpage2-bar-heading').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script> -->

</body>
</html>