<?php

    $connection = mysqli_connect('localhost','root','','itmansala');

    if(!$connection)
    {
        die('Please Check your connection'.mysqli_error());
    }
?>