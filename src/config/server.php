<?php
   if(!isset($_SESSION)){
    session_start();
}

require('dbconnection.php');

// initializing variables
$Cookie_Username = "";
$Cookie_Password = "";
$remember = "";
$User = "";
$password = "";
$password_1 = "";
$password_2 = "";
$name = "";
$Email = "";
$PhoneNumber = "";
$Firstname_Error = array();
$Username_Error = array(); 
$Email_Error = array();
$Password_Error = array();
$PhoneNumber_Error = array();
$Login_Error = array();

if (isset($_COOKIE['ITPASSWORD']) && isset($_COOKIE['ITUSERNAME'])){
    $Cookie_Username = $_COOKIE['ITUSERNAME'];
    $Cookie_Password = $_COOKIE['ITPASSWORD']; 
}

// Register student

if (isset($_POST['signup_student'])) {
    // get all input values from the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $Email = mysqli_real_escape_string($connection, $_POST['email']);
    $password_1 = mysqli_real_escape_string($connection, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($connection, $_POST['password_2']);
    $PhoneNumber = mysqli_real_escape_string($connection, $_POST['phonenumber']);


        // Validate password strength
        if($password_1 != ""){
            $uppercase = preg_match('@[A-Z]@', $password_1);
            $lowercase = preg_match('@[a-z]@', $password_1);
            $number = preg_match('@[0-9]@', $password_1);
            $specialChars = preg_match('@[^\w]@', $password_1);
        
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8) {
                array_push($Password_Error, "Password should be minimum 8 characters long with <br>at least one upper case letter, one number and a special character!");
            }
            }
        
            //validate phone number
            if($PhoneNumber != ""){
            if (strlen($PhoneNumber)!=10){
                array_push($PhoneNumber_Error, "Enter a valid phone number!");
            }
            }
        
            //name validation
            $namenum = preg_match('@[0-9]@', $name);
            $namespc = preg_match('@[^\w]@', $name);
        
            if ($namenum != NULL){
                array_push($Firstname_Error, "Name cannot contain numbers <br> or special characters!");
            }
        
            if ($namespc != NULL){
                array_push($Firstname_Error, "Name cannot contain numbers <br> or special characters!");
            }
            
  
    // empty form validation
    
    if (empty($name)) {
        array_push($Firstname_Error, "Name is required!");
    }

    if (empty($Email)) {
        array_push($Email_Error, "E-mail is required!");
    }
    if (empty($PhoneNumber)) {
        array_push($PhoneNumber_Error, "Phone Number is required!");
    }
    if (empty($password_1)) {
        array_push($Password_Error, "Password is required!");
    }
    if ($password_1 != $password_2) {
        array_push($Password_Error, "The two passwords do not match");
      }

  
    // check if same data already exists in database
    $user_check_query = "SELECT * FROM usertable WHERE phoneNumber='$PhoneNumber' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
      if ($user['phoneNumber'] === $PhoneNumber) {
        array_push($PhoneNumber_Error, "Phone number already exists");
      }
    }


    // register user if there are no errors in the form
    $master_error = array_merge($Firstname_Error, $Email_Error, $Password_Error, $PhoneNumber_Error);
    if (count($master_error) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
  
        // $query = "INSERT INTO student (name, userName, email, password, phoneNumber) 
        //           VALUES('$name', '$Username', '$Email', '$password', '$PhoneNumber')";

        $query = "INSERT INTO student (name, email, password, phoneNumber, status) 
                  VALUES('$name', '$Email', '$password', '$PhoneNumber', '1')";

        $userquery = "INSERT INTO usertable (phoneNumber, password, role)
                        VALUES('$PhoneNumber', '$password', 'student')";
        mysqli_query($connection, $query);
        mysqli_query($connection, $userquery);
        $_SESSION['name'] = $name;
        header('location: views/studentviews/quizReview.php');
    }
  }


// Login student
if (isset($_POST['login_student']))  {
    $User = mysqli_real_escape_string($connection, $_POST['user']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $remember = isset($_POST['remember']);
  
    if (empty($User)) {
        array_push($PhoneNumber_Error, "Phone number is required!");
    }
    if (empty($password)) {
        array_push($Password_Error, "Password is required!");
    }
  
    if (count($PhoneNumber_Error) == 0) {
        if (count($Password_Error) == 0) {
            $decrypt = md5($password);
            $query = "SELECT * FROM usertable WHERE phoneNumber = '$User' AND password ='$decrypt'";
            $results = mysqli_query($connection, $query);
            if (mysqli_num_rows($results) == 1){
                $row = mysqli_fetch_assoc($results);
                $role = $row['role'];
        
                if ($remember == true){
                    setcookie('ITUSERNAME',$User, time()+604800);
                    setcookie('ITPASSWORD',$password, time()+604800);
                }

              if ($role == 'student'){
                  $stdquery = "SELECT * FROM student WHERE phoneNumber = '$User'";
                  $stdresults = mysqli_query($connection, $stdquery);
                  $stdrow = mysqli_fetch_assoc($stdresults);
                  $Username = $stdrow['name'];
                  $_SESSION['name'] = $Username;
                  echo $_SESSION['name'];
                  header('location: views/studentviews/student-dashboard.php');
              }
              if ($role == 'Teacher'){
                $tchquery = "SELECT * FROM teacher WHERE phoneNumber = '$User'";
                $tchresults = mysqli_query($connection, $tchquery);
                $tchrow = mysqli_fetch_assoc($tchresults);
                $name = $tchrow['name'];
                $status = $tchrow['status'];
                $_SESSION['name'] = $name;
                $_SESSION['phone']=$User;
                $_SESSION['email']=$tchrow['email'];

                if($status == 0){
                    header('location: views/teacherviews/change-password.php'); 
                }else{
                    header('location: views/teacherviews/dashboard-teacher.php');
                }
             }
             
             if ($role == 'admin'){
                $admquery = "SELECT * FROM admin WHERE phoneNumber = '$User'";
                $admresults = mysqli_query($connection, $admquery);
                $admrow = mysqli_fetch_assoc($admresults);
                $name = $admrow['name'];
                $_SESSION['name'] = $name;
                header('location: views/adminviews/Admin-dashboard.php');
             }
            }else {
              array_push($Login_Error, "Incorrect username or password");
          }

    }
    }
  
}

  ?>