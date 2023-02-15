<!-- Navigation Bar -->
<?php
    require '..\..\assets\includes\navbar-admin.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Details </title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "../../assets/css/viewStudents.css">
</head>

<body>
    <br />
    <!-- Search Teacher -->
    <div class="container">
        <div class="container-item">
            <form class="searchBar">
            <p><input type="text" placeholder="Search Students"  class="search-bar">
                <button type="submit"><i class="fa-solid fa-search"></i></button></p>
            </form>
        </div>
    </div>

    <!-- Table Content -->
    <div class="content">
        <table>
            <tr>
              <th>Name</th>
              <th>Phone Number</th>
              <!-- <th>Email</th> -->
              <th>Active</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>

            <!-- PHP code -->
            <?php
                require_once '../../config/dbconnection.php';

                $sql = "SELECT phoneNumber, name from student";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                        <tr>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['phoneNumber'].'</td>
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

</body>
</html>