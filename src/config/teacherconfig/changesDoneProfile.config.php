<?php
    session_start();
    require_once('src\assets\includes\navbar-teacher.php');
    require('dbconnection.php');

    if(!isset($_SESSION['firstname']))
    {
        header('location:index.php');
    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['firstname']);
        header('location:index.php');
    }
?>