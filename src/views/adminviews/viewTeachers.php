<?php 
//   session_start(); 

//   if (!isset($_SESSION['name'])) {
//   	header('location: index.php');
//   }

//   if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['name']);
//     header("location: index.php");
//  } 
 ?>

 <?//php include('login.php') ?> 

<!-- Navigation Bar -->

<?php
    require '..\..\assets\includes\navbar-admin.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Teacher Details </title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "..\..\assets\css\viewTeachers.css">
</head>

<body>
    <br />
    <!-- Search Teacher -->
    <div class="container">
        <div class="container-item">
            <form class="searchBar">
            <p><input type="text" placeholder="Search Teachers"  class="search-bar">
                <button type="submit"><i class="fa-solid fa-search"></i></button></p>
            </form>
        </div>
    </div>

    <!-- Table Content -->
    <div class="content">
        <table>
            <tr>
              <th>Teacher Image</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Active</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>

            <!-- PHP code -->
            <?php
                require_once '..\..\config\dbconnection.php';

                $sql = "SELECT teacherImage,name,phoneNumber,email from teacher";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                        <tr>
                            <td> <img class="teacherimg" src="'.$row['teacherImage'].'"</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['phoneNumber'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>
                                <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a href="../../config/adminconfig/update.php?updateId='.$row['phoneNumber'].'"><i class="fa-solid fa-file-pen" id="icons"></i></td>
                            <td><a href="../../config/adminconfig/delete.php?deleteId='.$row['phoneNumber'].'"><i class="fa-solid fa-trash" id="icons"></i></a></td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>

    <!-- Add Teacher Button -->
    <button class="addTeacher"> <a href="addTeacher.php">Add new teacher</a> </button>
</body>
</html>