<?php
    require '..\..\assets\includes\navbar-admin.php';
    require_once '..\..\config\dbconnection.php';
    session_start();
if(!isset($_SESSION['adminname']))
{
    header('location:../../student_login.php');
}
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
                <form class="searchBar">
                        <p><input type="text" placeholder="Search Teachers"  class="search-bar" id="livesearch">
                        <button type="submit"><i class="fa-solid fa-search"></i></button></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Content -->
        <table class="tableTeacher" id="teacher-details">
            <tr>
              <th>Teacher Image</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Active</th>
              <th>Edit</th>
            </tr>

            <!-- PHP code -->
            <?php
                $sql = "SELECT teacherImage,name,phoneNumber,email,status from teacher";
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

                    if($row['teacherImage'] == NULL)
                    {
                        $row['teacherImage'] = '<i class="fa-regular user-profile fa-user fa-lg"></i>';
                    }
                    else
                    {
                        $row['teacherImage'] = '<img class="teacherimg" src="'.$row['teacherImage'].'">';
                    }
                            echo '
                            <tr>
                                <td>'.$row['teacherImage'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['phoneNumber'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>
                                    <label class="switch">
                                    <input type="checkbox" class="active-status" '.$checkStatus.' data-phone="'.$row['phoneNumber'].' ">
                                    <span class="slider round"></span>
                                    </label>
                                </td>
                                <td><a href="../../config/adminconfig/update.php?updateId='.$row['phoneNumber'].'"><i class="fa-solid fa-file-pen" id="icons"></i></a></td>
                            </tr>
                        ';
                }
            ?>
        </table>
    
</body>

<!-- confirmation dialog box -->
<div id="confirmation-dialog" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to change the active status of this teacher?</p>
        <div class="modal-buttons">
            <button id="confirm-button" class="btn-confirm">Yes, I'm sure</button>
            <button id="cancel-button" class="btn-cancel">No, It was a mistake</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".active-status").click(function(){
            var input = $(this).val();
            var isChecked = $(this).prop("checked");
            var phoneNumber = $(this).data("phone");
            var confirmClicked = false; // Flag variable to check if the confirm button was clicked

            // Show the confirmation dialog box
            $("#confirmation-dialog").css("display", "block");

            // Handle the confirm button click event
            $("#confirm-button").click(function(){
                confirmClicked = true;

                $.ajax({
                    url: "../../config/adminconfig/teacherActiveStatus.php",
                    method: "POST",
                    data: {input: input, isChecked: isChecked, phoneNumber: phoneNumber},
                    success: function(){
                        location.reload();

                        // Update the state of the checkbox
                        $(".active-status[data-phone='" + phoneNumber + "']").prop("checked", isChecked);
                    }
                });

                $("#confirmation-dialog").css("display", "none");
            });

            // Handle the cancel button click event
            $("#cancel-button").click(function(){
                confirmClicked = false; 
                $("#confirmation-dialog").css("display", "none");
            });

            $("#confirmation-dialog .close").click(function(){
                confirmClicked = false;
                $("#confirmation-dialog").css("display", "none");
            });

            if (!confirmClicked) {
                return false;
            }
        });
    });


    $(document).ready(function(){
        $("#livesearch").keyup(function(){
            var input = $(this).val();

            if(input != "")
            {
                $.ajax({
                    url: '../../config/adminconfig/teachertable-search.php',
                    type: 'POST',
                    data: {input:input},

                    success:function(data){
                        $("#teacher-details").html(data);
                    }
                });
            }
            else
            {
                $.ajax({
                    url: '../../config/adminconfig/teachertable-search.php',
                    type: 'POST',
                    data: {input: ''},

                    success:function(data){
                        $("#teacher-details").html(data);
                    }
                });
            }
            });
    });
</script>

</html>
