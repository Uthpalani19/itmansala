<!-- Navigation Bar -->
<?php
    session_start();
    require '../../assets/includes/navbar-admin.php';
    require_once '../../config/dbconnection.php';

if(!isset($_SESSION['adminname']))
{
    header('location:../../student_login.php');
}

    // Add Teacher 
    if(isset($_POST['addTeacher']))
    {
        // Check if the fields are not empty
        if(!empty($_POST['telephone']) && !empty($_POST['name']) && !empty($_POST['expertise']) && !empty($_POST['email']))
        {
            $phoneNumber = mysqli_real_escape_string($connection,$_POST['telephone']);
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['expertise']);

            $password = bin2hex(random_bytes(4));
            $encrypt = md5($password);
// Select file

            $image =$_FILES['profilePhoto'];
            $image_name = $image['name'];
            $imagefileerror = $image['error'];
            $image_tempname = $image['tmp_name'];
            $img_separate =explode('.',$image_name);
            $file_extention = strtolower(end($img_separate));
            
            $extention = array('jpeg','jpg','png');

            if(in_array($file_extention,$extention))
            {
                    $upload_image ='../../assets/uploads/teacherdp'.$image_name;
                    move_uploaded_file($image_tempname,$upload_image);
            }

// drag & drop
$image2 =$_FILES['profilePhoto2'];
$image_name = $image2['name'];
$imagefileerror = $image2['error'];
$image_tempname = $image2['tmp_name'];
$img_separate =explode('.',$image_name);
$file_extention = strtolower(end($img_separate));

$extention = array('jpeg','jpg','png');

if(in_array($file_extention,$extention))
{
        $upload_image2 ='../../assets/uploads/teacherdp'.$image_name;
        move_uploaded_file($image_tempname,$upload_image2);
}

if(!empty($upload_image)){
    $teacherdp = $upload_image;
}

if(!empty($upload_image2)){
    $teacherdp = $upload_image2;
}


                $sql = "INSERT into teacher (phoneNumber, name, email,password,teacherImage,fieldOfExpertise,status)
                    VALUES('$phoneNumber','$name', '$email','$encrypt','$teacherdp','$fieldOfExpertise','0')";
                $userquery = "INSERT INTO usertable (phoneNumber, password, role)
                    VALUES('$phoneNumber', '$encrypt', 'Teacher')";
                mysqli_query($connection, $userquery);

                if($connection->query($sql) === TRUE)
                {
                    include('../../assets/phpmailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer;
        
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
        
                    // h-hotel account
                    $mail->Username='itmansala@gmail.com';
                    $mail->Password='luwhdtlomqauknsb';
        
                    // send by h-hotel email
                    $mail->setFrom('itmansala@gmail.com', 'Teacher Password');
                    // get email from input
                    $mail->addAddress($_POST['email']);
                  
        
                    // HTML body
                    $mail->isHTML(true);
                    $mail->Subject="Teacher Password - IT Mansala";
                    $mail->Body="<b>Dear $name,</b>
                    <p>You have been successfully registered as a teacher on IT Mansala,<p>
                    <p>Please use the below mentioned credentials to login to the system.</p>
                    <p><b>Phone Number: $phoneNumber</b></p>
                    <p><b>Password: $password</b></p>
                    <p>*Note: You will have to change your password on first login.</p>
                    <br><br>
                    <p>Thank You,</p>
                    <b>IT Mansala</b>";
        
                    if($mail->send()){
                        header('location: viewTeachers.php');
                    }
                }
                else
                {
                    echo mysqli_error($connection);
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
                var expertise = document.forms["teacherForm"]["expertise"].value;

                var regName = /\d+$/g;                                          // JS reGex for Name validation     

                if(name=="" || expertise=="" || email=="")
                {
                    return false;
                }
                else if(regName.test(name))
                {
                    alert("Please enter a valid first name without numbers.");
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