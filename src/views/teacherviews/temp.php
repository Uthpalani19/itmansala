<?php
    session_start(); 

    if (!isset($_SESSION['name'])) {
  	    header('location: ../student_login.php');
    }
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['name']);
        header("location: ../student_login.php");
    }

    include('../../config/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="filters">
        <select name="courseName" id="huhu">
            <option value="" disabled="" selected="">Select your course </option>
            <option value="Data and information">Data and information</option>
            <option value="Networking">Networking</option>
            <option value="DBMS">DBMS</option>
        </select>
    </div>

    <div class="container">
        <table class="studentDetails">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Enrollment Status</th>
                    <th>Last logged in date & time</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $sql = "SELECT * from student";
                    $result = mysqli_query($connection,$sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $enrolstatus = 'Enrolled';
                        echo '
                            <tr>
                                <td><img src="../../assets/images/profile/'.$row['profilePicture'].'" alt="profile" id="profile"></td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['phoneNumber'].'</td>
                                <td>'.$row['email'].'</td>
                                <td id="status">'.$enrolstatus.'</td>
                                <td>2023-02-01 12:00:00</td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#huhu").on('change',function(){
                var value = $(this).val();
                // alert(value);

                $.ajax({
                    url: '../../config/teacherconfig/studenttable-load.php',
                    type: 'POST',
                    data: 'request='+value,
                    beforeSend: function(){
                        $('.studentDetails').html('<img src="../../assets/images/loading.gif" alt="loading" id="loading">');
                    },
                    success: function(data){
                        $('.studentDetails').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>