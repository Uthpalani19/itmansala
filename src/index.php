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

    <link rel="stylesheet" href="assets/css/style4.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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
            <img src="assets/images/robo-1.png" alt="">
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

    <div class="lpage-2-bar">
        <div class="bar-item"><h2 class="lpage2-bar-heading">13 <br>courses </h2></div>
        <div class="bar-item"><h2 class="lpage2-bar-heading">100 <br>Students </h2></div>
        <div class="bar-item"><h2 class="lpage2-bar-heading">1500 <br>Questions </h2></div>
    </div>
</div>

<div class="landing-page-3" id="section-3">

    
    
    <div class="lpage3-courseses">
    <?php include("views/landingPages/pi.php"); ?>
    </div>

            <!-- this is jus a comment -->
    <div class="lpage3-course-des">
            <div class="course-des-heading">
                <h3>01 තොරතුරු සහ සන්නිවේදන තාෂණය පිළිබඳ සංකල්ප</h3>
            </div>

            <div class="course-des-description">
                <h3>තොරතුරු හා සන්නිවේදන තාෂණයේ මූලික සංකල්ප, වර්තමාන දැනුම පාදක සමාජෙයහි ද යොදා ගන්නා ආකාරය,
                     එහි භූමිකාව හා උජිත උපෙයෝගීතාව සමග ගවේෂණය කරයි  </h3>
            </div>

            <hr></hr>
            <!-- this is a comment -->
            <div class="course-des-subtopics">
                    <h3>
                    1.1 දත්තවල සහ තොරතුරුවල මූලක තැනුම් ඒකකය<br>
                    1.2 දත්ත හා තොරතුරු, නිමාණය, බෙදාහැරීම හා කළමනාකරණය<br>
                    1.3 තොරතුරු නිරමාණ කිරීමේ වියුක්ත ආකෘතිය<br>
                    1.4  පරිඝණක පද්ධතියක මූලික සංරචක<br>
                    1.5  දත්ත සැකසීමේ ක්‍රියාකාරකම්<br>
                    1.6 විවිධ වසම් තළ, තොරත හා සන්නිදෙන තාෂණය යෙදම<br>
                    1.7  සමාජය කෛරහි තොරත හා සන්නිදෙන තාෂණෙය් බලපෑම 
                    </h3>
            </div>
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
        <!-- <div class="lpage-4-des-heading">
            <h4>
                Select your intrest
            </h4>
        </div> -->
        
        <div class="lpage-4-interests">
            <button class="lpage-4-button">Programming</button>
            <button class="lpage-4-button">Designing</button>
            <button class="lpage-4-button">Web developping</button>
            <button class="lpage-4-button">Programming</button>
            <button class="lpage-4-button">Data analysing</button>
            <button class="lpage-4-button">Artificial Intelligance</button>
            <button class="lpage-4-button">Game Development</button>
        </div>

        <div class="lpage-4-interests">
            <button class="lpage-4-button">Cyber Security</button>
            <button class="lpage-4-button">Networking</button>
            <button class="lpage-4-button">machine learning</button>
            <button class="lpage-4-button">Bussiness IT</button>
            <button class="lpage-4-button">Cloud computing</button>
            <button class="lpage-4-button">Project Management</button>
            <button class="lpage-4-button">Database</button>
        </div>

        <div class="lpage-4-interests">
            <button class="lpage-4-button">Programming</button>
            <button class="lpage-4-button">Designing</button>
            <button class="lpage-4-button">Web developping</button>
            <button class="lpage-4-button">Programming</button>
            <button class="lpage-4-button">Data analysing</button>
            <button class="lpage-4-button">Artificial Intelligance</button>
            <button class="lpage-4-button">Game Development</button>
        </div>

        <div class="lpage-4-interests">
            <button class="lpage-4-button">Cyber Security</button>
            <button class="lpage-4-button">Networking</button>
            <button class="lpage-4-button">machine learning</button>
            <button class="lpage-4-button">Bussiness IT</button>
            <button class="lpage-4-button">Cloud computing</button>
            <button class="lpage-4-button">Project Management</button>
            <button class="lpage-4-button">Database</button>
        </div>  
    </div>

    <div class="interest-jobpath">
        <div class="job-paths">
            <h4 class="job-path-heading">
                Programming
            </h4>
            <hr class="job-path-hr">

            <div class="job-paths-container">
                <div class="job-path-line">
                    <div class="job-card">
                        <div class="job-card-heading">
                        Computer Programmer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-card-heading">
                            Web Developer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-card-heading">
                            Front-End Developer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="job-path-line">
                    <div class="job-card">
                        <div class="job-card-heading">
                            Back-End Developer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-card-heading">
                        Full-Stack Developer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-card-heading">
                        Software Application Developer
                        </div>
                        <div class="job-card-des">
                            <h5>Skills Requierd</h5>
                            <br>
                            <ul>
                                <li>Proficiency with programming languages.</li>
                                <li>Learning concepts and applying them to problems.</li>
                                <li>Data structures and algorithms.</li>
                                <li>Database and SQL.</li>
                                <li>Object-oriented programming (OOP) languages.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
</body>
</html>