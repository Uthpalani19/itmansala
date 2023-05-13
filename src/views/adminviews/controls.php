<?php
include('../../config/dbconnection.php');
include('../../config/adminconfig/controls-backend.php');
session_start();
if(!isset($_SESSION['adminname']))
{
    header('location:../../student_login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/adminCourse.css">
</head>
<body>
<?php include('../../assets/includes/navbar-admin.php') ?>
    <div class="addcourse-name">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="addcourse-div">
                <input type="text" class="addcourse-text" name="course_name" placeholder="Course Name">
                <button class="addcourse-button" name="addcourse" id="course">Add</button>
            </div>
        </form>
    </div>

    <div class="addcourse-name">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="addcourse-div">
                <input type="text" class="addcourse-text" name="course_price" placeholder="<?php echo "Current price of courses: $price LKR"; ?>">
                <button class="addcourse-button" name="setprice" id="course">Set Price</button>
            </div>
        </form>
    </div>

    <div class="addcourse-name">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="addcourse-div">
                <input type="text" class="addcourse-text" name="expertise" placeholder="Teacher Field of expertise">
                <button class="addcourse-button" name="teacherexpertise" id="course">Add</button>
            </div>
        </form>
    </div>

    <div class="addcourse-name">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="addcourse-div addtextdiv">
                <textarea rows="10" cols="130" name="tip" class="addcourse-text addtextarea" placeholder="Pro Tip"></textarea>
                <button class="addcourse-button" name="setprotip" id="course">Add</button>
            </div>
        </form>
    </div>

    
</body>

</html>