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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="..\..\assets\css\viewTeachers.css">
</head>

<body>
    <br />
    <!-- Top pane -->
    <div class="teacher-options-container">
        <!-- Add Teacher Button -->
        <button class="addTeacher"><i class="fa fa-plus plus-icon" aria-hidden="true"></i><a href="addTeacher.php">Add new teacher</a> </button>

        <!-- Search Teacher -->
        <div class="container">
            <div class="container-item">
                <form class="searchBar" method="POST">
                <p><input type="text" placeholder="Search Teachers"  class="search-bar" name="search">
                    <button type="submit"><i class="fa-solid fa-search"></i></button></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="content">
        <table class="tableTeacher" id="teacher-details">
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

                if(isset($_POST['search'])){
                    $search_text = $_POST['search'];

                    $sql = "SELECT teacherImage,name,phoneNumber,email,status from teacher WHERE phoneNumber LIKE '%$search_text%' OR name LIKE '%$search_text%' OR email LIKE '%$search_text%'";
                } else {
                    $sql = "SELECT teacherImage,name,phoneNumber,email,status from teacher";
                }

                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['status']== '1')
                    {
                        $checkStatus = "checked";
                    }
                    else
                    {
                        $checkStatus = "";
                    }

                    echo '
                        <tr>
                            <td> <img class="teacherimg" src="'.$row['teacherImage'].'"</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['phoneNumber'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>
                                <label class="switch">
                                <input type="checkbox" class="active-status" '.$checkStatus.' data-phone="'.$row['phoneNumber'].' ">
                                <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a href="../../config/adminconfig/update.php?updateId='.$row['phoneNumber'].'"><i class="fa-solid fa-file-pen" id="icons"></i></td>
                            <td>
                                <form action="../../config/adminconfig/delete.php?deleteId='.$row['phoneNumber'].'" method="POST">
                                    <button type="submit" class="delete" onclick="return confirm(\'Are you sure you want to delete this teacher?\')">
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
</body>

<!-- Ajax for active status -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".active-status").click(function(){
            var input = $(this).val();
            var isChecked = $(this).prop("checked"); // check if the checkbox is checked or not
            var phoneNumber = $(this).data("phone"); 

            $.ajax({
                url: "../../config/adminconfig/teacherActiveStatus.php",
                method: "POST",
                data: {input:input, isChecked:isChecked, phoneNumber:phoneNumber},
                success: function(){
                    load("#student-details");
                }
            });
        });
    });
</script>

</html>
