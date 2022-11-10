<?php

    $connection = mysqli_connect('localhost','root','','emansala');

    if(!$connection)
    {
        die('Please Check your connection'.mysqli_error());
    }


?>