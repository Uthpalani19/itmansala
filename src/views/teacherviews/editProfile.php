<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-teacher.php');
    require('../../config/dbconnection.php');

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
    <div class="container-editprofile">
        <div class="heading">
            <p class="heading-p">Edit Profile</p>
            <div class="edit-profile-form">
                <form method="POST" action="../../config/teacherconfig/editProfile.config.php">
                        <!-- Edit profile details -->
                        <table>
                            <tr>
                                <!-- Name field -->
                                <td>
                                    <label for="name" class="label-field">Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" class="input-field" value="<?php echo $_SESSION['name']?>">
                                </td>
                            </tr>

                            <tr>
                                <!-- Email field -->
                                <td>
                                    <label for="name" class="label-field">E-mail</label>
                                </td>
                                <td>
                                    <input type="email" name="email" class="input-field" value="<?php echo $_SESSION['email']?>">
                                </td>
                            </tr>

                            <tr>
                                <!-- Phone Number field -->
                                <td>
                                    <label for="name" class="label-field" read only>Phone Number</label>
                                </td>
                                <td>
                                    <input type="text" name="contact" class="input-field" value="0763361822" readonly id="disabled-txt-field">
                                </td>
                            </tr>
                        </table>
                </div>
                       
                <div class="heading">
                    <p class="heading-p">Change Password</p>
                </div>
                        <!-- Change passwords -->
                        <table class="change-password">
                            <tr>
                                <!-- Current password field -->
                                <td>
                                    <label for="name" class="label2-field">Current Password</label>
                                </td>
                                <td>
                                    <input type="password" name="current-password" class="input-field">
                                </td>
                                <td>
                                    <i class="fa-solid fa-magnifying-glass" id="icon-search" a href="changePassword.config.php?id='.$_SESSION['name'].'"></i></a>
                                    
                                </td>
                            </tr>

                            <tr>
                                <!-- New password field -->
                                <td>
                                    <label for="name" class="label2-field" >New Password</label>
                                </td>
                                <td>
                                    <input type="password" name="new-password" class="input-field" readonly id="disabled-txt-field">
                                </td>
                            </tr>

                            <tr>
                                <!-- Confirm new password field -->
                                <td>
                                    <label for="name" class="label2-field">Confirm New Password</label>
                                </td>
                                <td>
                                    <input type="password" name="confirm-new-password" class="input-field" readonly id="disabled-txt-field">
                                </td>
                            </tr>
                        </table>
                <div class="heading">
                    <p class="heading-p">User Picture</p>
                </div>
                        <!-- User picture -->
                        <!-- <table class="user-picture">
                            <tr>
                                <td>
                                    <label for="name" class="label2-field">Upload Picture</label>
                                </td>
                                <td>
                                    <input type="file" name="user-picture" class="input-field" readonly id="disabled-txt-field">
                                </td>
                            </tr>
                        </table>
                        <div class="btn-container">
                            <button type="submit" class="btn btn-1">Save Changes</button>
                        </div> -->

                        <!-- Submit the form for changes -->
                        <input type="submit" value="Apply changes" class="btn-question" name="finish">
                </form>
            </div>
        </div>
    </div>
</body>
</html>