<?php

require('../../config/dbconnection.php');
$teacherEmail_Error = array();
$teachername_Error = array();
$teacherPhoneNumber_Error = array();
$phoneNumber = "";
$name = "";
$email = "";

    // Add Teacher 
    if(isset($_POST['addTeacher']))
    {
        // Check if the fields are not empty
        if(!empty($_POST['telephone']) && !empty($_POST['name']) && !empty($_POST['expertise']) && !empty($_POST['email']))
        {
            $phoneNumber = mysqli_real_escape_string($connection,$_POST['telephone']);
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['expertise']);

            $password = bin2hex(random_bytes(4));
            $encrypt = md5($password);

            //check if user details exist in database
            //phoneNo query
            $checkphone = substr($phoneNumber, -9); 
            $user_check_query = "SELECT * FROM teacher WHERE phoneNumber='$checkphone' LIMIT 1";
            $result = mysqli_query($connection, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            //email query
            $email_check_query = "SELECT * FROM teacher WHERE email='$email' LIMIT 1";
            $email_result = mysqli_query($connection, $email_check_query);
            $email_user = mysqli_fetch_assoc($email_result);   

            //check if phone number exists
            if ($user) {
                if ($user['phoneNumber'] === $checkphone) {
                  array_push($teacherPhoneNumber_Error, "Phone number already exists");
                }
            }

            //check if email exists
            if ($email_user) {
                if ($email_user['email'] === $email) {
                  array_push($teacherEmail_Error, "Email already exists");
                }
            }

            //check if phone number is of correct length
            if($phoneNumber != ""){
            if (strlen($phoneNumber)!=10){
                array_push($teacherPhoneNumber_Error, "Enter a valid phone number!");
            }
            }
        
            //check if name contains numbers, symbols or special charachters
            $namenum = preg_match('@[0-9]@', $name);
            $namespc = preg_match('/[-+\/*!@#$%^&()_=.?|\\><{}\[\]":;,]/', $name);
            if ($namenum != NULL || $namespc != NULL){
                array_push($teachername_Error, "Name cannot contain numbers or special characters!");
            }

            // Select file
            $teacherdp = "";
            $image =$_FILES['profilePhoto'];
            $image_name = $image['name'];
            $imagefileerror = $image['error'];
            $image_tempname = $image['tmp_name'];
            $img_separate =explode('.',$image_name);
            $file_extention = strtolower(end($img_separate));
            
            $extention = array('jpeg','jpg','png');

            if(in_array($file_extention,$extention))
            {
                    $upload_image ='../../assets/uploads/teacherdp'.$image_name;
                    move_uploaded_file($image_tempname,$upload_image);
            }

            // drag & drop
            $image2 =$_FILES['profilePhoto2'];
            $image_name = $image2['name'];
            $imagefileerror = $image2['error'];
            $image_tempname = $image2['tmp_name'];
            $img_separate =explode('.',$image_name);
            $file_extention = strtolower(end($img_separate));

            $extention = array('jpeg','jpg','png');

            if(in_array($file_extention,$extention))
            {
                    $upload_image2 ='../../assets/uploads/teacherdp'.$image_name;
                    move_uploaded_file($image_tempname,$upload_image2);
            }

            if(!empty($upload_image)){
                $teacherdp = $upload_image;
            }

            if(!empty($upload_image2)){
                $teacherdp = $upload_image2;
            }

            //if the user doesn't already exist and there are no erros, insert into db
            $master_error = array_merge($teacherEmail_Error, $teacherPhoneNumber_Error);
            if (count($master_error) == 0) {


                $sql = "INSERT into teacher (phoneNumber, name, email,password,teacherImage,fieldOfExpertise,status)
                    VALUES('$phoneNumber','$name', '$email','$encrypt','$teacherdp','$fieldOfExpertise','0')";
                $userquery = "INSERT INTO usertable (phoneNumber, password, role)
                    VALUES('$phoneNumber', '$encrypt', 'Teacher')";
                mysqli_query($connection, $userquery);


                if($connection->query($sql) === TRUE)
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
                    $mail->setFrom('itmansala@gmail.com', 'Teacher Password');
                    // get email from input
                    $mail->addAddress($_POST['email']);
                  
        
                    // HTML body
                    $mail->isHTML(true);
                    $mail->Subject="Teacher Password - IT Mansala";
                    $mail->Body="<b>Dear $name,</b>
                    <p>You have been successfully registered as a teacher on IT Mansala,<p>
                    <p>Please use the below mentioned credentials to login to the system.</p>
                    <p><b>Phone Number: $phoneNumber</b></p>
                    <p><b>Password: $password</b></p>
                    <p>*Note: You will have to change your password on first login.</p>
                    <br><br>
                    <p>Thank You,</p>
                    <b>IT Mansala</b>";
        
                    if($mail->send()){
                        header('location: viewTeachers.php');
                    }
                }
                else
                {
                    echo mysqli_error($connection);
                }
            
        }
    }
        else
        {
        ?>
            <script type="text/javascript">
                alert("All fields are required.");
            </script>
        <?php
        }
    }
?>
