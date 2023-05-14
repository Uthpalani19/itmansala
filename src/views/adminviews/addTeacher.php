<!-- Navigation Bar -->
<?php
    session_start();
    include('../../config/dbconnection.php');
    include('../../config/adminconfig/addTeacher-backend.php');
    include('../../config/errors.php');
    if(!isset($_SESSION['adminname']))
{
    header('location:../../student_login.php');
}
?>
<?php

?>
<html>
    <head>
        <title>IT Mansala</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/addteacher.css">

    </head>
    
    <body>
        <div class="form-container">
            <div class="teacher-form">
                <p class="form-title">Teacher Details</p>

                <!-- Form for adding teachers -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" name="teacherForm">
                    <div class="row">
                        <div class="column1">
                            <p>Name</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="name" required value="<?php echo $name; ?>">
                            <div>
                                <?php teacherNameError(); ?>
                             </div>
                        </div>
                    </div>
                            
                     <div class="row">
                        <div class="column1">
                            <p>Tel-No</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="telephone" required value="<?php echo $phoneNumber; ?>">
                            <div>
                                <?php teacherPhoneError(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Email</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="email" required value="<?php echo $email; ?>">
                            <div>
                                <?php teacherEmailError(); ?>
                             </div>
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="column1">
                            <p>Expertise Field</p>
                        </div>  
                        <div class="column2">
                            <select class="teacher-input title" name="expertise" required>
                                <?php
                                $expertiseQuery = "SELECT * FROM teacher_expertise";
                                $expertiseResult = mysqli_query($connection, $expertiseQuery);
                                while($expertiseRow = mysqli_fetch_assoc($expertiseResult)){
                                    $expertise = $expertiseRow['expertise'];
                                ?>
                                <option value="<?php echo $expertise ?>"><?php echo $expertise ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="column1">
                            <p>Profile Photo</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" class="teacher-input" name="profilePhoto" id="selectfile">
                                <i class="fa-solid fa-file-import"></i> 
                                <br>
                                <label id="selectlabel" for="selectfile">Select File</label>
                            </label>
                        </div>
                            <p class="upload-option">OR</p>
                        <div class="drop-zone">
                            <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
                            <input type="file" accept="img/*" name="profilePhoto2" class="drop-zone-input">
                        </div>                       
                    </div>
                               
                    <!-- Drag and Drop -->


                    <button type="submit" name="addTeacher" class="form-btn">Add Teacher</button>
                    <button type="reset" class="form-btn" onclick="window.location.href='viewTeachers.php'">Discard</a></button>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../../assets/js/admin.js"></script>

    </body>

</html>