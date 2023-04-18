<?php
require('C:\xampp\htdocs\itmansala\src\config\dbconnection.php');

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}


?>