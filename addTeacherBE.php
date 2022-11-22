<?php
    require_once 'dbconnection.php';

    if(isset($_POST['addTeacher']))
    {
        $phoneNumber = mysqli_real_escape_string($connection,$_POST['telephone']);
        $firstName = mysqli_real_escape_string($connection,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($connection,$_POST['lastName']);
        // $teacherImage = $_POST[''];
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['expertise']);
        $status = mysqli_real_escape_string($connection,1);

        $password = md5($password);

        $sql = "INSERT into teacher (phoneNumber,firstName,lastName,password,fieldOfExpertise,status)
            VALUES('$phoneNumber','$firstName','$lastName','$password','$fieldOfExpertise','$status')";

        if($connection->query($sql) === TRUE)
        {
            echo 'Successful';
            header("location:viewTeachers.php");
        }
        else
        {
            echo mysqli_error($connection);
        }
    }
?>