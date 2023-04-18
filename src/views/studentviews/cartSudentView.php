<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if (!isset($_SESSION['name'])) {
  	header('location: ../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header("location: ../student_login.php");
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
                2 Courses in cart 
            </h4>
        </div>

        <div class="cart">
            <div class="cart-items">
                
                <div class="cart-item1">
                    <div class="item-image">
                        <img class="item-img" src="img/lesson1.jpg" alt="">
                    </div>

                    <div class="item-content">
                        <h4>lesson 7</h4>
                        <h3 class="item-title">පද්ධති විශ්ලේෂණය හා පරිසැලසුම</h3>
                        <div class="item-detail">
                            <div>20 students</div>
                            <div><i class="fas fa-circle" style="font-size: 10px;"></i></div>
                            <div>20 Subtopics</div>
                            <div><i class="fas fa-circle" style="font-size: 10px;"></i></div>
                            <div>20 Quizes</div>
                        </div>   
                    </div>

                    <div class="item-buttons">
                        <button class="btn-item1">Remove</button>
                        <button class="btn-item1">1000 LKR <i class="fas fa-tag"></i></button>

                    </div>
                    
                </div>

                
            </div>

            <div class="cart-checkout">
                <div>
                    <h4>Total :</h4>
                </div>

                <div>
                    <h2>2000 LKR</h2>
                    <h5>2 Courses</h5>
                </div>

                <!-- Checkout Form -->
                <form class="checkout-form" >
                    <div>
                        <input type="radio" value="card" name="select">
                        <label for="">Online payment</label>
                    </div>

                    <div>
                        <input type="radio" value="cash" name="select">
                        <label for="">Offline payment</label>
                    </div>
                    <div class="btncheckout">
                        <input type="button" value="checkout" class="btn-checkout" id="btn-checkout" name="checkout">
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="bg-modal">
            <div class="modal-content">
                <div>
                    <div class="pop-header">
                        <h4>Payment details</h4>
                    </div>
                    
                    <div class="box-container">
                        <!-- Payment Pop up -->
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="name-fields">
                            <div class="telNo">
                                <label for="telNo">Tel-Number</label>
                                <?php if (isset($_SESSION['phoneNumber'])) { ?>
                                    <input type="number" class="tel input" name="contactNumber" readonly value="<?php echo $_SESSION['phoneNumber']; ?>">
                                <?php } ?>  
                            </div>
                            <div class="paidDate">
                                <label for="paidDate">Paid-Date</label>
                                <input type="date" class="p-date input" name="paidDate" required>
                            </div>
                        </div>

                        <div class="other-fields">
                            <div class="nic-field">
                                <label for="NIC-No">NIC</label>
                                <input type="number" class="nic input" name="nic" required>
                            </div>

                            <div class="payment-field">
                                <div class="amount">
                                    <label for="payment-amount">Paid-amount</label>
                                    <input type="number" class="c-amount input" name="paidAmount" value="2000" readonly>
                                </div>

                                <div class="no-courses">
                                    <label for="no-courses">No of Courses</label>
                                    <input type="number" class="c-number input" name="noOfCourses"value="2" readonly>
                                </div>  
                            </div>

                            <div class="select-container">
                                <div class="slip-label">
                                    <label for="slip">Payment Slip</label>
                                </div>
                                <div class="slip-select">
                                    <input type="file" name="imgSlip" clas="slip_select">
                                      
                                </div>
                            </div>

                            <div class="drop-container">
                                <div class="drop-zone">
                                    <input type="file" name="imgSlip" class="drop-zone__input">
                                    <span class="drop-zone__prompt"> <i class="fas fa-upload"></i> Drag & drop files here</span>

                                    <!-- <div class="drop-zone__thumb" data-label="imagefile.txt"></div> -->
                                </div>                         
                            </div>
                        </div>

                        <div class="button-container">
                            <input type="submit" id="payment-submit" value="Submit" class="pop-submit" name="submit">
                            <input type="button" class="pop-discard"  value="Discard">
                            <!-- <button class="pop-discard" id="payment-submit">Discard</button> -->
                        </div>
                    </form>
                    </div>
                </div>
                

            </div>
    </div>

<script src="js/script.js"></script>
</body>
</html>