<?php 

function getUserById($id, $connection){
    $query = " SELECT * FROM teacher WHERE $id = phoneNumber";
    $result = mysqli_query($connection, $query);
    $user =  mysqli_fetch_assoc($result);
    return $user;
}

 ?>
