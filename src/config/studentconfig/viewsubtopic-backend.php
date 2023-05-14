<?php
    require('C:\xampp\htdocs\itmansala\src\config\dbconnection.php');
    $lesson = $_GET['lesson'];

    $subtopic_query= "SELECT * FROM course WHERE courseID = $lesson";
    $subtopic_result = mysqli_query($connection, $subtopic_query);
    $subtopic_row = mysqli_fetch_assoc($subtopic_result);

    if(isset($_POST['checkbtn'])){
        $subtopicNo = mysqli_real_escape_string($connection, $_POST['subtopicNo']);
        $dateTime = date('Y-m-d H:i:s');
        $phoneNumber = $_SESSION['studentphone'];

        $updateQuery = "UPDATE student_subtopic
                        SET status = '1', lastaccesstime = '$dateTime'
                        WHERE subtopicId = '$subtopicNo' AND phoneNumber = '$phoneNumber'";
        mysqli_query($connection, $updateQuery);
        header("location: purchasedCourseDetails.php?lesson=".$lesson);
    }

    if(isset($_POST['uncheckbtn'])){
        $subtopicNo = mysqli_real_escape_string($connection, $_POST['remove']);
        $phoneNumber = $_SESSION['studentphone'];
        $removeQuery = "UPDATE student_subtopic
                        SET status = '0'
                        WHERE subtopicId = '$subtopicNo' AND phoneNumber = '$phoneNumber'";
        mysqli_query($connection, $removeQuery);
        header("location: purchasedCourseDetails.php?lesson=".$lesson);
    }


    if (isset($_POST['publish_to_students'])){
        $query = "UPDATE course
        SET status = '1', review = '0'
        WHERE courseID = '$lesson'";
        mysqli_query($connection, $query);
        header('location: adminCourse.php');
    }

    if (isset($_POST['send_to_revision'])){
        $message = mysqli_real_escape_string($connection, $_POST['reason']);

        $phone = $subtopic_row['teacherPhoneNumber'];
        $teacher_query = "SELECT * FROM teacher WHERE phoneNumber = '$phone'";
        $teacher_result = mysqli_query($connection, $teacher_query);
        $teacher_row = mysqli_fetch_assoc($teacher_result);

        $name = $teacher_row['name'];
        $email = $teacher_row['email'];
        $coursename = $subtopic_row['courseName'];

        $query = "UPDATE course
        SET review = '0'
        WHERE courseID = '$lesson'";
        mysqli_query($connection, $query);

        if($connection->query($query) === TRUE)
                {
                    include('../../assets/phpmailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer;
        
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
        
                    // h-hotel account
                    $mail->Username='itmansala@gmail.com';
                    $mail->Password='luwhdtlomqauknsb';
        
                    // send by h-hotel email
                    $mail->setFrom('itmansala@gmail.com', 'Course Revision');
                    // get email from input
                    $mail->addAddress($email);
                  
        
                    // HTML body
                    $mail->isHTML(true);
                    $mail->Subject="Course not published to students - IT Mansala";
                    $mail->Body="<b>Dear $name,</b>
                    <p>The course $coursename was not published to students due to the following reasons,<p>
                    <p>$message</p><br><br>
                    <p>Please address the mentioned issues and resubmit the course for revision.</p>
                    <br>
                    <p>Thank You,</p>
                    <b>IT Mansala</b>";
        
                    if($mail->send()){
                        header('location: adminCourse.php');
                    }
                }
    }
?>