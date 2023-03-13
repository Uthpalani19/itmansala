

<?php

function loginError(){ 
    require('server.php') ;
    if (count($Login_Error) > 0) :
  	foreach ($Login_Error as $log_error) :
  	echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$log_error."</span>" ;
    endforeach;
    endif;
    }



function userError(){ 
    require('server.php') ;
    if (count($Username_Error) > 0) :
  	foreach ($Username_Error as $user_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$user_error."</span>" ;
    endforeach;
    endif;
    }


function passError(){ 
    require('server.php') ;
    require('password-backend.php');
    if (count($Password_Error) > 0) :
  	foreach ($Password_Error as $pass_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$pass_error."</span>" ;
    endforeach;
    endif;
    }


function FirstnameError(){ 
    require('server.php') ;
    if (count($Firstname_Error) > 0) :
  	foreach ($Firstname_Error as $first_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$first_error."</span>" ;
    endforeach;
    endif;
    }


function LastnameError(){ 
    require('server.php') ;
    if (count($Lastname_Error) > 0) :
  	foreach ($Lastname_Error as $last_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$last_error."</span>" ;
    endforeach;
    endif;
    }


function EmailError(){ 
    require('server.php') ;
    require('password-backend.php');
    if (count($Email_Error) > 0) :
  	foreach ($Email_Error as $email_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$email_error."</span>" ;
    endforeach;
    endif;
    }


function PhoneError(){ 
    require('server.php') ;
    if (count($PhoneNumber_Error) > 0) :
  	foreach ($PhoneNumber_Error as $phone_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$phone_error."</span>" ;
    endforeach;
    endif;
    }


function DobError(){ 
    require('server.php') ;
    if (count($DOB_Error) > 0) :
  	foreach ($DOB_Error as $dob_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$dob_error."</span>" ;
    endforeach;
    endif;
    }


function AlError(){ 
    require('server.php') ;
    if (count($ALyear_Error) > 0) :
  	foreach ($ALyear_Error as $al_error) :
    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$al_error."</span>" ;
    endforeach;
    endif;
    }




?>






    

