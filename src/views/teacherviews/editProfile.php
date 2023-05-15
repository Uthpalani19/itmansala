<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-teacher.php');
    require('../../config/dbconnection.php');
    include('../../config/errors.php');
    include('../../config/teacherconfig/editProfile.config.php');

    if(!isset($_SESSION['name']))
    {
        header('location: ../../student_login.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['name']);
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
    <link rel="stylesheet" href="../../assets/css/student-style.css"></link>
    <script src="../../assets/js/editProfile.js"></script>
    <title>Edit profile</title>
</head>

<body class="body-2">



<!-- action="../../views/teacherviews/viewProfile.php" -->
<form method="POST" enctype="multipart/form-data" >
    <div class="container-editprofile">
        <div class="heading">
            <p class="heading-p">Eidt Profile</p>
            
            <div class="edit-profile-form">
                
                <div class="name-container">
                    <div><label for="name" class="label-field">Name</label></div>
                    <div><input type="text" name="name" class="input-field" value="<?php echo $user['name']?>"></div>
                </div>
                
                <div class="name-container">
                    <div> <label for="name" class="label-field">E-mail</label></div>
                    <div> <input type="text" name="email" class="input-field" value="<?php echo $user['email']?>"></div>
                </div>

                <div class="name-container">
                    <div><label for="name" class="label-field-num" read only>Phone Number</label></div>
                    <div ><input type="text" name="contact" class="input-field" value="<?php echo $user['phoneNumber']?>" readonly id="disabled-txt-field"></div>
                </div>

                
            </div>
        </div>

        <div class="edit-image">
            <div><img src="<?php echo $user['teacherImage'];?>" class="change-image" ></div>
            <div class="edit-image-container" id="preview-image">
                <input type="file" name="image" class="edit-image-btn">
            </div>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn btn-1" name="form_1">Save Changes</button>
        </div> 
</form>    


<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="heading">
            <p class="heading-p">Edit password</p>

            <div class="password-left">
                <div><label for="name" class="label-field-pass">Password</label></div>
                <div><label for="name" class="label-field-pass">New Password</label></div>
                <div><label for="name" class="label-field-pass">Confirm New Password</label></div>
            </div>

            <div class="password-right">
                <div>
                    <input type="password" name="current-password" class="input-field">
                </div>
                <div> <input type="password" name="new-password" class="input-field" ></div>
                <div><input type="password" name="confirm-new-password" class="input-field" ></div>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-1" name="form_2">Save Changes</button>
        </div> 

</form>



</body>
</html>