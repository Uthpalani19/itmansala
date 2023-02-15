<?php
    require '..\..\assets\includes\navbar-admin.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Profile </title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "..\..\assets\css\adminProfile.css">
</head>

<body>
<div class="container">
        <div class="profilepicture">
            <img src="..\..\assets\images\person.png" class="rounded-circle"width="150">
        </div>

        <div class="admin-details">
            <div class="admin-name">
                <p >Administrator</p>
            </div>

            <div class = "adm-details">
                <p id="admin-details">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore</p>
            </div>
        </div>
    </div>

    <!-- Student Details -->
    <div class="user-container">
        <div class="user-details">
            <table class="tbl-user-details">
                <tr>
                    <th><h3>User Details</h3></th>
                </tr>
                <tr>
                    <td>Email address</td>
                </tr>
                <tr>
                    <td>admin001@gmail.com</td>
                </tr>
                <tr>
                    <td>Telephone Number</td>
                </tr>
                <tr>
                    <td>071 4570986</td>
                </tr>
                <tr>
                    <td>Address</td>
                </tr>
                <tr>
                    <td id="last-row">No.13, Kings Road, Colombo 06</td>
                </tr>
            </table>
        </div>
        <div></div>
        <div class="login-activity">
            <table class="tbl-login-activity">
                <tr>
                    <th><h3>Login Activity</h3></th>
                </tr>
                <tr>
                    <td>First access to site</td>
                </tr>
                <tr>
                    <td>01 January 2023, 10:00 AM
                        (36 days 20 hours)</td>
                </tr>
                <tr>
                    <td>Last access to site</td>
                </tr>
                <tr>
                    <td>06 February0 2023, 11:52 AM 
                    (now)</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Edit Details button -->
    <div class="edit-details">
        <button type="button" class="btn-edit" onclick="window.location.href='editProfile.php'">Edit Details</button>
    </div>

</body>

</html>