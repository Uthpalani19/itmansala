<?php
    require '..\..\assets\includes\navbar-admin.php';
    include_once '..\..\config\dbconnection.php';
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
    <?php
        if(isset($_POST['input'])){  
            $input = $_POST['input'];
            {
                    if(empty($input)){
                        $sql = "SELECT * from student";
                    }
                    else{
                        $sql = "SELECT * from student where name LIKE '%{$input}%'";
                    }
                }
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0)
                {
                    ?>
                    <table class="tableTeacher" id="teacher-details">
                    <tr>
                        <th>Student Image</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Active</th>
                    </tr>
                        <?php
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

                                if($row['profilePicture'] == NULL)
                                {
                                    $row['profilePicture'] = '<i class="fa-regular user-profile fa-user fa-lg"></i>';
                                }
                                else
                                {
                                    $row['profilePicture'] = '<img class="teacherimg" src="'.$row['profilePicture'].'">';
                                }
                                    echo '
                                    <tr>
                                        <td>'.$row['profilePicture'].'</td>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$row['phoneNumber'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>
                                            <label class="switch">
                                            <input type="checkbox" class="active-status" '.$checkStatus.' data-phone="'.$row['phoneNumber'].' ">
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                ';
                            }
                        ?>
                    </table>

                    <?php
                }
                else
                {?>
                    <div class="no-results-found"></div>
                    <?php
                }
            }
        
    ?>
</body>
</html>