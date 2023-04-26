<!-- Navigation Bar -->
<?php
    require '../../assets/includes/navbar-admin.php';
    require_once '../../config/dbconnection.php';

    // Add Teacher 
    if(isset($_POST['addTeacher']))
    {
        // Check if the fields are not empty
        if(!empty($_POST['telephone']) && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['expertise']) && !empty($_POST['email']))
        {
            $phoneNumber = mysqli_real_escape_string($connection,$_POST['telephone']);
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['expertise']);
            $status = mysqli_real_escape_string($connection,1);

            $password = md5($password);

            $image =$_FILES['profilePhoto'];
            $image_name = $image['name'];
            $imagefileerror = $image['error'];
            $image_tempname = $image['tmp_name'];
            $img_separate =explode('.',$image_name);
            $file_extention = strtolower(end($img_separate));
            print_r($image);
            
            $extention = array('jpeg','jpg','png');

            if(in_array($file_extention,$extention))
            {
                    $upload_image ='../../assets/images'.$image_name;
                    move_uploaded_file($image_tempname,$upload_image);

                $sql = "INSERT into teacher (phoneNumber, name, email,password,teacherImage,fieldOfExpertise,status)
                    VALUES('$phoneNumber','$name', '$email','$password','$upload_image','$fieldOfExpertise','$status')";

                if($connection->query($sql) === TRUE)
                {
                    echo 'Successful';
                    header("location:viewTeachers.php");
                }
                else
                {
                    echo mysqli_error($connection);
                }
            }
        }
        else
        {
        ?>
            <script type="text/javascript">
                alert("All fields are required.");
            </script>
        <?php
        }
    }
?>
<?php

?>
<html>
    <head>
        <title>IT Mansala</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/addteacher.css">

         <!-- Java Script validation -->
        <script type="text/javascript">
            function addTeacher()
            {
                var name = document.forms["teacherForm"]["name"].value;
                var email = document.forms["teacherForm"]["email"].value;
                var password = document.forms["teacherForm"]["password"].value;
                var expertise = document.forms["teacherForm"]["expertise"].value;

                var regName = /\d+$/g;                                          // JS reGex for Name validation
                var regPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;      // JS reGex for password validation

                if(name=="" || password=="" || expertise=="" || email=="")
                {
                    return false;
                }
                else if(regName.test(name))
                {
                    alert("Please enter a valid first name without numbers.");
                    return false;
                }
                else if(!regPassword.test(password))
                {
                    alert("Please enter a valid password.");
                    return false;
                }
                else
                {
                    return true;
                }

            }
    </script>
    </head>
    
    <body>
        <div class="form-container">
            <div class="teacher-form">
                <p class="form-title">Teacher Details</p>

                <!-- Form for adding teachers -->
                <form method="post" onsubmit="return addTeacher()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" name="teacherForm">
                    <div class="row">
                        <div class="column1">
                            <p>Name</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="name" required>
                        </div>
                    </div>
                            
                     <div class="row">
                        <div class="column1">
                            <p>Tel-No</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="telephone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Email</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="email">
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="column1">
                            <p>Password</p>
                        </div>  
                        <div class="column2">
                            <input type="password" class="teacher-input title" name="password" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Expertise Field</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="expertise" required>
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="column1">
                            <p>Profile Photo</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" class="teacher-input" name="profilePhoto">
                                <i class="fa-solid fa-file-import"></i> 
                                <br>
                                <div class="select">Select file</div>
                            </label>
                        </div>
                    </div>
                               
                    <!-- Drag and Drop -->
                    <!-- <p class="upload-option">OR</p>
                    <div class="drop -zone">
                        <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
                        <input type="file" accept="img/*" name="profilePhoto" class="drop-zone-input">
                    </div> -->

                    <button type="submit" name="addTeacher" class="form-btn">Add Teacher</button>
                    <button type="reset" class="form-btn" onclick="window.location.href='viewTeachers.php'">Discard</a></button>
                </form>
            </div>
        </div>

        
    </body>
</html>