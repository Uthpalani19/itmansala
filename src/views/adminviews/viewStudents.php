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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href = "../../assets/css/viewStudents.css">
</head>

<body>
    <div class="box">
        <br />
        <!-- Search Student -->
        <div class="container1">
            <div class="container-item">
                <form class="searchBar" method="POST">
                    <p><input type="text" placeholder="Search Students" name="search" class="search-bar">
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
                <!-- <th>Edit</th> -->
                <th>Delete</th>
                </tr>

                <!-- PHP code -->
                <?php
                    require_once '../../config/dbconnection.php';

                    if(isset($_POST['search'])) {
                        $search_text = $_POST['search'];

                        $sql = "SELECT phoneNumber, name FROM student WHERE name LIKE '%$search_text%' OR phoneNumber LIKE '%$search_text%'";
                    }
                    else {
                        $sql = "SELECT phoneNumber, name, status FROM student";
                    }

                    $result = mysqli_query($connection, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['phoneNumber'].'</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" '.($row['status'] == 1 ? "checked" : "").' onchange="updateStatus(\''.$row['phoneNumber'].'\', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <form action="../../config/adminconfig/delete.php?deleteStuId='.$row['phoneNumber'].'" method="POST">
                                        <button type="submit" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this student?\')">
                                            <i class="fa-solid fa-trash" id="icons"></i>
                                        </button>
                                    </form>
                                </td>
                                
                            </tr>
                        ';
                    }
                ?>
            </table>
        </div>
    </div>

    <?php include('../../assets/includes/footer.php') ?>
</body>
</html>