<?php
    require_once '../../config/dbconnection.php';
    require '../../assets/includes/navbar-admin.php';

    $id = $_GET['updateId'];

    $sql="SELECT * FROM teacher where phoneNumber='$id'";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $firstName = mysqli_real_escape_string($connection,$_POST['firstName']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $fieldOfExpertise = mysqli_real_escape_string($connection,$_POST['expertise']);

        $password = md5($password);

        $sql = "UPDATE teacher SET name = '$firstName', email = '$email',fieldOfExpertise = '$fieldOfExpertise' WHERE phoneNumber = '$id'";
        
        $result=mysqli_query($connection,$sql);

        if($result){

            header('location:../../views/adminviews/viewTeachers.php');

        }
        else{
            echo 'unsuccesful';
        }
    }
?>
    

<html>
    <head>
        <title>Update Teachers</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/addteacher.css">
    </head>

    <body>
    <div class="form-container">
            <div class="teacher-form">
                <p class="form-title">Teacher Details</p>
    <?php
    if($row['status']==1)
    {
        $name=$row['name'];
        $fieldOfExpertise=$row['fieldOfExpertise'];
        $email=$row['email'];

        ?>
        <form method="post">
            <div class="row">
                <div class="column1-name">
                    <p>Name</p>
                </div>  
                <div class="column2-name">
                    <input type="text" class="teacher-input" name="firstName" required value="<?php echo $name; ?>">
                </div>
            </div>
              
            <div class="row">
                <div class="column1">
                    <p>Tel-No</p>
                </div>  
                <div class="column2">
                    <input type="text" class="teacher-input title" name="telephone" readonly value="<?php echo $id; ?>">
                </div>
            </div>

            <div class="row">
                <div class="column1">
                    <p>email</p>
                </div>  
                <div class="column2">
                    <input type="text" class="teacher-input title" name="email" readonly value="<?php echo $email; ?>">
                </div>
            </div>
               
            <div class="row">
                <div class="column1">
                    <p>Expertise Field</p>
                </div>  
                <div class="column2">
                    <input type="text" class="teacher-input title" name="expertise" required value="<?php echo $fieldOfExpertise; ?>">
                </div>
            </div>

            
            <button type="submit" name="update" class="form-btn">Update Teacher</button>
            <button type="reset" class="form-btn" onclick="window.location.href='../../views/adminviews/viewTeachers.php'">Discard</button>
    </form>

            <?php
    }
    else
    {
        echo "No data found";
    }
    ?>
    </div>
</div>

    </body>
</html>