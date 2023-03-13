<?php 

if(!isset($_SESSION)){
    session_start();
}

require('dbconnection.php');
$email = "";
$rstpassword_1 = "";
$rstpassword_2 = "";
$chgpassword_1 = "";
$chgpassword_2 = "";
$Email_Error = array();
$Password_Error = array();

if(isset($_POST['send_email'])){
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $email_check = "SELECT * FROM student WHERE email = '$email'";
    $email_query = mysqli_query($connection, $email_check);
    $email_row = mysqli_fetch_assoc($email_query);
    $name = $email_row['name'];
    $phone = $email_row['phoneNumber'];

    if(mysqli_num_rows($email_query) == 0){
        array_push($Email_Error, "Please enter the email <br>you used when signing up with IT Mansala");   
        }
        else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['name'] = $name;
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            include('../assets/phpmailer/PHPMailerAutoload.php');
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
            $mail->setFrom('itmansala@gmail.com', 'Reset Password');
            // get email from input
            $mail->addAddress($_POST['email']);
          

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Reset Password - IT Mansala";
            $mail->Body="<b>Dear $name,</b>
            <p>We received a request to reset your password,<p>
            <p>Kindly click on the link below to reset your password</p>
            http://localhost/itmansala/src/views/resetpassword.php
            <br><br>
            <p>Thank You,</p>
            <b>IT Mansala</b>";

            if(!$mail->send()){
                header('location: forgotpassword.php');
            }else{
                header('location: emailsent.php'); 
            }
        }
    }


if(isset($_POST["reset_pass"])){
    $rstpassword_1 = mysqli_real_escape_string($connection, $_POST['rstpassword_1']);
    $rstpassword_2 = mysqli_real_escape_string($connection, $_POST['rstpassword_2']);

    $rstEmail = $_SESSION['email'];
    $phoneNumber = $_SESSION['phone'];

        if($rstEmail){

            if($rstpassword_1 != ""){
                $uppercase = preg_match('@[A-Z]@', $rstpassword_1);
                $lowercase = preg_match('@[a-z]@', $rstpassword_1);
                $number = preg_match('@[0-9]@', $rstpassword_1);
                $specialChars = preg_match('@[^\w]@', $rstpassword_1);
            
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($rstpassword_1) < 8) {
                    array_push($Password_Error, "Password should be minimum 8 characters long with <br>at least one upper case letter, one number and a special character!");
                }
                }

            if (empty($rstpassword_1)) {
                array_push($Password_Error, "Password is required!");
            }
            if ($rstpassword_1 != $rstpassword_2) {
                array_push($Password_Error, "The two passwords do not match");
            }

            if (count($Password_Error) == 0){
                $encrypt = md5($rstpassword_1);
                $student_table = "UPDATE student SET password='$encrypt' WHERE email='$rstEmail'";
                $user_table = "UPDATE usertable SET password='$encrypt' WHERE phoneNumber='$phoneNumber'";
                $student_query = mysqli_query($connection, $student_table);
                $user_query = mysqli_query($connection, $user_table);
                header('location: ../student_login.php'); 
            }


        }else{
            
        }
    }


if(isset($_POST["teacher_pass"])){
    $chgpassword_1 = mysqli_real_escape_string($connection, $_POST['chgpassword_1']);
    $chgpassword_2 = mysqli_real_escape_string($connection, $_POST['chgpassword_2']);

    $chgPhone = $_SESSION['phone'];

    if($chgPhone){

        if($chgpassword_1 != ""){
            $uppercase = preg_match('@[A-Z]@', $chgpassword_1);
            $lowercase = preg_match('@[a-z]@', $chgpassword_1);
            $number = preg_match('@[0-9]@', $chgpassword_1);
            $specialChars = preg_match('@[^\w]@', $chgpassword_1);
        
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($chgpassword_1) < 8) {
                array_push($Password_Error, "Password should be minimum 8 characters long with <br>at least one upper case letter, one number and a special character!");
            }
        }
        if (empty($chgpassword_1)) {
            array_push($Password_Error, "Password is required!");
        }
        if ($chgpassword_1 != $chgpassword_2) {
            array_push($Password_Error, "The two passwords do not match");
        }

        if (count($Password_Error) == 0){
            $teacherPass = md5($chgpassword_1);
            $teacher_table = "UPDATE teacher SET password='$teacherPass', status='1' WHERE phoneNumber='$chgPhone'";
            $user_table = "UPDATE usertable SET password='$teacherPass' WHERE phoneNumber='$chgPhone'";
            $teacher_query = mysqli_query($connection, $teacher_table);
            $user_query = mysqli_query($connection, $user_table);
            header('location: dashboard-teacher.php'); 
        }
    }else{

    }
}

?>
