<?php
    require_once '../dbconnection.php';

    if(isset($_POST['input']))
    {
        $isChecked = $_POST["isChecked"];
        $phoneNumber = $_POST["phoneNumber"];

        if ($isChecked == "true") {
            // the checkbox is checked
            $status=1;
        } else {
            // the checkbox is not checked
            $status=0;
        }

        $sql = "UPDATE teacher SET status = '$status' WHERE phoneNumber = '$phoneNumber'";
        $result = mysqli_query($connection, $sql);

        if($result){
           
        }
        else{
           
        }
    }
?>