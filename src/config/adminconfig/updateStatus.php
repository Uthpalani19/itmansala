<?php
require_once '../../config/dbconnection.php';

if(isset($_POST['phoneNumber']) && isset($_POST['checked'])) {
    $phoneNumber = $_POST['phoneNumber'];
    $checked = $_POST['checked'];

    $status = $checked ? 1 : 0;

    $sql = "UPDATE student SET status=$status WHERE phoneNumber='$phoneNumber'";
    $result = mysqli_query($connection, $sql);

    if($result) {
        echo "Status updated successfully";
    }
    else {
        echo "Error updating status: " . mysqli_error($connection);
    }
}
else {
    echo "Invalid request";
}
?>

