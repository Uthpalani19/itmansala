<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/cart.css">
</head>
<body>
<?php
    include('../../assets/includes/navbar-student.php') 
?>

        
<div class="section">
        <div class="heding">
            <h2 class="section-heading">
                My cart
            </h2>
        </div>

        <div class="cart-heading">
            <h4 >
                <?php 
                echo sizeof($_SESSION['cart']);
                ?> Courses in cart  
                <br>
            </h4>
        </div>
        <?php
foreach($_SESSION['cart'] as $cid) {
            $element = $cid;
            $key = array_search($cid, $_SESSION['cart'],true);         
            $course_query= "SELECT * FROM course WHERE courseID = $element";
            $course_result = mysqli_query($connection, $course_query);
            
                $course_row = mysqli_fetch_array($course_result);

                    ?>
                    <div class="cart-item1">
                    <div class="item-image">
                        <img class="item-img" src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" alt="">
                    </div>

                    <div class="item-content">
                        <h3 class="item-title"><?php echo $course_row['courseName'];?></h3>
                        <button class="btn-item1">1000 LKR <i class="fas fa-tag"></i></button>
                    </div>

                    <div class="item-buttons">
                        <form method="post">
                        <button type="submit" name="remove_btn" class="btn-item1">Remove</button>
                        <input type="text" value="<?php echo $key; ?>" name="delete_key" hidden readonly>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['remove_btn'])){
                            $delete = mysqli_real_escape_string($connection, $_POST['delete_key']);
                            unset($_SESSION['cart'][$delete]);
                            header('location: cartSudentView.php');
                            exit();
                        }
                    ?>
                    
                </div>
                    <?php
        }

        ?>

   

<script src="js/script.js"></script>
</body>
</html>