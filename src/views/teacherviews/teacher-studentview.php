<?php
    session_start(); 

    if (!isset($_SESSION['name'])) {
  	    header('location: ../../student_login.php');
    }


    include('../../config/dbconnection.php');
    include('../../assets/includes/navbar-teacher.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Details </title>
    <script src="../../assets/js/teacher.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "../../assets/css/teacher-style.css">
    <link rel="stylesheet" href = "../../assets/css/global.css">
</head>

<body>

    <div class="container">
        <div class="container-item">
            <div class="search-bar-course">
                <!-- Search Teacher -->
                <?php
                    // Getting the course name from the database
                    $sql_dropdown = "SELECT courseName from course where teacherPhoneNumber = '{$_SESSION['phone']}'";
                    $result_dropdown = mysqli_query($connection,$sql_dropdown);
                ?>

                    <!-- Dropdown content -->
                    <?php
                        if(mysqli_num_rows($result_dropdown) > 0)
                        {?>
                            Select your course  :
                            <div id="filters">
                            <select id="courses" class="courseName dropdown-courses">
                                <option value="" disabled="" selected="">Select your course </option>
                                <?php
                                    while($row = mysqli_fetch_assoc($result_dropdown))
                                    {
                                ?>
                                        <option value="<?php echo $row['courseName']; ?>"> <?php echo $row['courseName'];?> </option>
                                        <?php
                                    }
                                ?>
                            </select>
                            </div>
                        <?php
                        }
                        else
                        {
                            echo '<a href="#">No Courses</a>';
                        }
                    ?>

                    <!-- Search Bar -->
                    <form class="searchBar">
                        <p><input type="text" placeholder="Search Students"  class="search-bar" id="livesearch">
                        <button type="submit"><i class="fa-solid fa-search"></i></button></p>
                    </form>
                    </div>
        </div>
    </div>

        <table class="tableStudent" id="student-details">
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
                    $sql = "SELECT DISTINCT phoneNumber, enrolmentDateTime FROM student_course INNER JOIN course ON student_course.courseID = course.courseID WHERE course.teacherPhoneNumber = '{$_SESSION['phone']}' GROUP BY student_course.phoneNumber";
                    $result = mysqli_query($connection,$sql);
                            
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sql_studentDetails = "SELECT * FROM student WHERE phoneNumber = '{$row['phoneNumber']}'";
                        $result_studentDetails = mysqli_query($connection,$sql_studentDetails);
                        $row_studentDetails = mysqli_fetch_assoc($result_studentDetails);
                        $enrolstatus = 'Enrolled';
                        if($row_studentDetails['profilePicture'] != null)
                        {
                            $proPic = $row_studentDetails['profilePicture'];
                        }
                        else
                        {
                            $proPic = '<i class="fa-solid fa-user"></i>';
                        }

                        echo '
                            <tr>
                                <td><i class="fa-regular fa-user fa-lg"></i></td>
                                <td>'.$row_studentDetails['name'].'</td>
                                <td>'.$row_studentDetails['phoneNumber'].'</td>
                                <td>'.$row_studentDetails['email'].'</td>
                                <td id="status">'.$enrolstatus.'</td>
                                <td>'.$row['enrolmentDateTime'].'</td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
</body>

<script type="text/javascript">
    $(document).ready(function(){
            $("#courses").on('change',function(){
                var value = $(this).val();

                $.ajax({
                    url: '../../config/teacherconfig/studenttable-load.php',
                    type: 'POST',
                    data: 'request='+value,
                    beforeSend: function(){
                        $('#student-details').html('<img src="../../assets/images/loading.gif" alt="loading" id="loading">');
                    },
                    success: function(data){
                        $('#student-details').html(data);
                    }
                });
            });
        });

    $(document).ready(function(){
        $("#livesearch").keyup(function(){
            var input = $(this).val();

            if(input != "")
            {
                $.ajax({
                    url: '../../config/teacherconfig/studenttable-search.php',
                    type: 'POST',
                    data: {input:input},

                    success:function(data){
                        $("#student-details").html(data);
                    }
                });
            }
            else
            {
                $.ajax({
                    url: '../../config/teacherconfig/studenttable-search.php',
                    type: 'POST',
                    data: {input: ''},

                    success:function(data){
                        $("#student-details").html(data);
                    }
                });
            }
            });
    });
</script>
</html>