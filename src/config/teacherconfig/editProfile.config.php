<?php 

function getUserById($id, $connection){
    $query = " SELECT * FROM teacher WHERE $id = phoneNumber";
    $result = mysqli_query($connection, $query);
    $user =  mysqli_fetch_assoc($result);
    return $user;
}

$user = getUserById($_SESSION['phone'],$connection); 
$phoneNumber = $user['phoneNumber'];

if (isset($_POST["form_1"])){

    // check if a new image was uploaded
    if(isset($_FILES['image'])) {
        // handle file upload
        $target_dir = "../../assets/uploads/teacher/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $newImage = $target_dir . $_SESSION['phone'] . "." . $imageFileType;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $newImage)) {
            // update teacher image path in database
            $userid = $_SESSION['phone'];
            $sql = "UPDATE teacher SET teacherImage='$newImage' WHERE phoneNumber='$phoneNumber '";
            $result = mysqli_query($connection, $sql);
            if (!$result) {
                header("Location: ../../views/teacherviews/viewProfile.php?error=1");
            }
        } else {
            header("Location: ../../views/teacherviews/viewProfile.php?error=1");
        }
    }

    // update name and email
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $sql = "UPDATE teacher SET name='$newName', email='$newEmail' WHERE phoneNumber='$phoneNumber'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Location: ../../views/teacherviews/viewProfile.php?success=1");
        exit();
    } else {
        header("Location: ../../views/teacherviews/viewProfile.php?error=1");
        exit();
    }
}

// password change ================================================================================================
function display_error($error_message) {
    echo "<span class='error'>$error_message</span>";
}

if(isset($_POST["form_2"])){
    $current_password = mysqli_real_escape_string($connection, $_POST['current-password']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new-password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm-new-password']);

    $user_id = $_SESSION['phone'];
    $Password_Error2 ='';
    $Password_Error = array();
    $query = "SELECT password FROM usertable WHERE phoneNumber = $user_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];

    if(md5( $current_password) !=  $stored_password){
        display_error("Current password is incorrect!");
        

    }else{
        if ($new_password != "") {
            $uppercase = preg_match('@[A-Z]@', $new_password);
            $lowercase = preg_match('@[a-z]@', $new_password);
            $number = preg_match('@[0-9]@', $new_password);
            $specialChars = preg_match('@[^\w]@', $new_password); 
            
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8) {
                display_error("New password should be minimum 8 characters long with at least one upper case letter, one number and a special character!");
                
            }

        }else{
            display_error("New password is required!");
        }
        if($new_password != $confirm_password){
            display_error("The two passwords do not match");
        }
        if (count($Password_Error) == 0) {
            $hashed_password = md5($new_password);
            $query = "UPDATE usertable SET password='$hashed_password' WHERE phoneNumber = $user_id";
            mysqli_query($connection, $query);
            header("Location: ../../views/teacherviews/viewProfile.php?success=1");

        }
    }  
}
?>

