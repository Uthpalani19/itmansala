

<?php

function loginError(){ 
    require('server.php') ;
    if (count($Login_Error) > 0) :
  	foreach ($Login_Error as $log_error) :
  	echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$log_error."</span>" ;
    endforeach;
    endif;
    }

function passError(){ 
    require('server.php') ;
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

function EmailError(){ 
    require('server.php') ;
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

    function rstpassError(){ 
      require('password-backend.php');
      if (count($rstPassword_Error) > 0) :
      foreach ($rstPassword_Error as $rstpass_error) :
      echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$rstpass_error."</span>" ;
      endforeach;
      endif;
      }

      function rstEmailError(){ 
        require('password-backend.php');
        if (count($rstEmail_Error) > 0) :
        foreach ($rstEmail_Error as $rstemail_error) :
        echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$rstemail_error."</span>" ;
        endforeach;
        endif;
        }

        function teacherPhoneError(){ 
          require('../../config/adminconfig/addTeacher-backend.php') ;
          if (count($teacherPhoneNumber_Error) > 0) :
          foreach ($teacherPhoneNumber_Error as $teacherphone_error) :
          echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$teacherphone_error."</span>" ;
          endforeach;
          endif;
          }

          function teacherEmailError(){ 
            require('../../config/adminconfig/addTeacher-backend.php');
            if (count($teacherEmail_Error) > 0) :
            foreach ($teacherEmail_Error as $teacheremail_error) :
            echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$teacheremail_error."</span>" ;
            endforeach;
            endif;
            }

            function teacherNameError(){ 
              require('../../config/adminconfig/addTeacher-backend.php');
              if (count($teachername_Error) > 0) :
              foreach ($teachername_Error as $teacher_error) :
              echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$teacher_error."</span>" ;
              endforeach;
              endif;
              }
          


?>






    

