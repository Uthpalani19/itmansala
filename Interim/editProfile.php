<?php
    require_once('navbar-student.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editProfile.css"></link>
    <title>Edit Profile</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div>
                <div class="edit-profile-box">
    
                </div>
                <h3 class="edit-profile">Edit Profile</h3>

                <div class="edit-profile-form">
                    <form method="POST">
                        <div>
                            <label for="firstName" class="firstName">First Name</label>
                            <input type="text" name="firstName" class="firstName" id="firstName" placeholder="First Name">
                        </div>
                        <div class="lastName">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                        </div>
                        <div class="userName"></div>
                            <label for="userName">User Name</label>
                            <input type="text" name="userName" id="userName" placeholder="User Name">
                        </div>
                        <div class="email">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" readonly>
                        </div>
                        <div class="telephone">
                            <label> Tel </label>
                            <input type="tel" name="tel" placeholder="Tel" readonly>
                        </div>
                        <div class="alYear">
                            <label for="alYear">A/L Year</label>
                            <input type="text" name="alYear" id="alYear" placeholder="A/L Year">
                        </div>
                        <div class="school">
                            <label for="school">School</label>
                            <input type="text" name="school" id="school" placeholder="School">
                        </div>
                        <div class="address">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" placeholder="Address">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<body>
</body>
</html>