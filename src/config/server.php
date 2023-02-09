<?php
   if(!isset($_SESSION)){
    session_start();
}

// initializing variables
$Username = "";
$password = "";
$Firstname = "";
$Lastname = "";
$Email = "";
$PhoneNumber = "";
$DOB = "";
$ALyear ="";
$Firstname_Error = array();
$Lastname_Error = array();
$Username_Error = array(); 
$Email_Error = array();
$Password_Error = array();
$PhoneNumber_Error = array();
$DOB_Error = array();
$ALyear_Error = array();
$Login_Error = array();


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'emansala');

// Register student

if (isset($_POST['signup_student'])) {
    // get all input values from the form
    $Firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $Lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $Username = mysqli_real_escape_string($db, $_POST['username']);
    $Email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $PhoneNumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $DOB = mysqli_real_escape_string($db, $_POST['dob']);
    $ALyear = mysqli_real_escape_string($db, $_POST['alyear']);

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
            $fnamenum = preg_match('@[0-9]@', $Firstname);
            $fnamespc = preg_match('@[^\w]@', $Firstname);
            $lnamenum = preg_match('@[0-9]@', $Lastname);
            $lnamespc = preg_match('@[^\w]@', $Lastname);
        
            if ($fnamenum != NULL){
                array_push($Firstname_Error, "Name cannot contain numbers <br> or special characters!");
            }
        
            if ($fnamespc != NULL){
                array_push($Firstname_Error, "Name cannot contain numbers <br> or special characters!");
            }
            
            if ($lnamenum != NULL){
                array_push($Lastname_Error, "Name cannot contain numbers <br> or special characters!");
            }
        
            if ($lnamespc != NULL){
                array_push($Lastname_Error, "Name cannot contain numbers <br> or special characters!");
            }
  
    // empty form validation
    
    if (empty($Firstname)) {
        array_push($Firstname_Error, "First name is required!");
    }
    if (empty($Lastname)) {
        array_push($Lastname_Error, "Last name is required!");
    }
    if (empty($Username)) {
        array_push($Username_Error, "Username is required!");
    }
    if (empty($Email)) {
        array_push($Email_Error, "E-mail is required!");
    }
    if (empty($password_1)) {
        array_push($Password_Error, "Password is required!");
    }
    if ($password_1 != $password_2) {
        array_push($Password_Error, "The two passwords do not match");
      }
    if (empty($PhoneNumber)) {
        array_push($PhoneNumber_Error, "Phone Number is required!");
    }
    if (empty($DOB)) {
        array_push($DOB_Error, "Date of birth is required!");
    }
    if (empty($ALyear)) {
        array_push($ALyear_Error, "A/L year is required!");
    }

  
    // check if same data already exists in database
    $user_check_query = "SELECT * FROM student WHERE userName='$Username' OR email='$Email' OR phoneNumber='$PhoneNumber' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { 
      if ($user['userName'] === $Username) {
        array_push($Username_Error, "Username already exists");
      }
  
      if ($user['email'] === $Email) {
        array_push($Email_Error, "Email already exists");
      }
      if ($user['phoneNumber'] === $PhoneNumber) {
        array_push($PhoneNumber_Error, "Phone number already exists");
      }
    }


    // register user if there are no errors in the form
    $master_error = array_merge($Firstname_Error, $Lastname_Error, $Username_Error, $Email_Error, $Password_Error, $PhoneNumber_Error, $DOB_Error, $ALyear_Error);
    if (count($master_error) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
  
        $query = "INSERT INTO student (firstName, lastName, userName, email, password, phoneNumber, dob, alYear) 
                  VALUES('$Firstname', '$Lastname', '$Username', '$Email', '$password', '$PhoneNumber', '$DOB', '$ALyear')";
        $userquery = "INSERT INTO usertable (phoneNumber, password, role)
                        VALUES('$PhoneNumber', '$password', 'student')";
        mysqli_query($db, $query);
        mysqli_query($db, $userquery);
        $_SESSION['Username'] = $Username;
        header('location: studentview/availablecourses.php');
    }
  }


// Login student
if (isset($_POST['login_student']))  {
    $User = mysqli_real_escape_string($db, $_POST['user']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($User)) {
        array_push($PhoneNumber_Error, "Username or Phone number is required!");
    }
    if (empty($password)) {
        array_push($Password_Error, "Password is required!");
    }
  
    if (count($PhoneNumber_Error) == 0) {
        if (count($Password_Error) == 0) {
            $decrypt = md5($password);
            $query = "SELECT * FROM usertable WHERE phoneNumber = '$User' AND password ='$decrypt'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1){
              $row = mysqli_fetch_assoc($results);
              $role = $row['role'];
              if ($role == 'student'){
                  $stdquery = "SELECT * FROM student WHERE phoneNumber = '$User'";
                  $stdresults = mysqli_query($db, $stdquery);
                  $stdrow = mysqli_fetch_assoc($stdresults);
                  $Username = $stdrow['userName'];
                  $_SESSION['Username'] = $Username;
                  header('location: studentview/availablecourses.php');
              }
              if ($role == 'teacher'){
                $tchquery = "SELECT * FROM teacher WHERE phoneNumber = '$User'";
                $tchresults = mysqli_query($db, $tchquery);
                $tchrow = mysqli_fetch_assoc($tchresults);
                $Firstname = $tchrow['firstName'];
                $_SESSION['firstname'] = $Firstname;
                header('location: teacherview/addcourse.php');
             }
             if ($role == 'admin'){
                $admquery = "SELECT * FROM admin WHERE phoneNumber = '$User'";
                $admresults = mysqli_query($db, $admquery);
                $admrow = mysqli_fetch_assoc($admresults);
                $name = $admrow['name'];
                $_SESSION['name'] = $name;
                header('location: teacherview/viewTeachers.php');
             }
            }else {
              array_push($Login_Error, "Incorrect username or password");
          }

    }
    }
  }


  ?>