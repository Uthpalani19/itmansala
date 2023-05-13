<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-teacher.php');
    require('../../config/dbconnection.php');
    include('../../config/teacherconfig/editProfile.config.php');

    if(!isset($_SESSION['name']))
    {
        header('location:index.php');
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


<?php 
$user = getUserById($_SESSION['phone'],$connection); 

?>
<form method="POST" action="../../views/teacherviews/viewProfile.php" enctype="multipart/form-data">
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
                <input type="file" name="image" class="edit-image-btn" onchange="displayImage(this)">
            </div>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn btn-1">Save Changes</button>
        </div> 
</form>

<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_FILES['image'];

    $user_id = $_SESSION['phone'];

    // update the user details in the database
    $sql = "UPDATE teacher SET name = '$name', email = '$email'";

    if (!empty($image['name'])) {
        // upload the new image and get its path
        $image_path = uploadImage($image);

        // update the image path in the database
        $sql .= ", teacherImage = '$image_path'";
    }

    $sql .= " WHERE phoneNumber = '$user_id'";

    if (mysqli_query($connection, $sql)) {
        // success message
        echo "User details updated successfully";
    } else {
        // error message
        echo "Error updating user details: " . mysqli_error($connection);
    }

    // function to upload the new image and get its path
    function uploadImage($image) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_path = $target_dir . $new_filename;

        if (move_uploaded_file($image["tmp_name"], $target_path)) {
            return $target_path;
        } else {
            return "";
        }
    }

 }

?>

        <div class="heading">
            <p class="heading-p">Edit password</p>

            <div class="password-left">
                <div><label for="name" class="label-field-pass">Password</label></div>
                <div><label for="name" class="label-field-pass">New Password</label></div>
                <div><label for="name" class="label-field-pass">Confirm New Password</label></div>
            </div>

            <div class="password-right">
                <div><input type="password" name="current-password" class="input-field"></div>
                <div> <input type="password" name="new-password" class="input-field" readonly id="disabled-txt-field"></div>
                <div><input type="password" name="confirm-new-password" class="input-field" readonly id="disabled-txt-field"></div>
            </div>
        </div>




    </div>

</body>
</html>