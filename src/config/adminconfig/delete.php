<?php

    require_once '../../config/dbconnection.php';

    if(isset($_GET['deleteId'])){

        $phoneNumber = $_GET['deleteId'];

        $sql = "DELETE FROM teacher WHERE phoneNumber='$phoneNumber'";

        $result=mysqli_query($connection,$sql);

        if($result){

            header('location:../../views/adminviews/viewTeachers.php');

        }else{

            die(mysqli_error($connection));

        }
    }

    if(isset($_GET['deleteStuId'])){

        $phoneNumber = $_GET['deleteStuId'];

        $sql = "DELETE FROM student WHERE phoneNumber='$phoneNumber'";

        $result=mysqli_query($connection,$sql);

        if($result){

            header('location:../../views/adminviews/viewStudents.php');

        }else{

            die(mysqli_error($connection));

        }
    }

?>