<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/addteacher.css">
</head>
<body>
<div class="form-container">
            <div class="teacher-form">
                <p class="form-title">Teacher Details</p>

                <!-- Form for adding teachers -->
                <form method="post" action="addTeacherBE.php">
                <div class="row">
                    <div class="column1-name">
                            <p>First Name</p>
                        </div>  
                        <div class="column2-name">
                            <input type="text" class="teacher-input" name="firstName" required>
                        </div>
                        <div class="column3-name">
                            <p>Last Name</p>
                        </div>  
                        <div class="column2-name">
                            <input type="text" class="teacher-input" name="lastName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column1">
                            <p>E-mail</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column1">
                            <p>Tel-No</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="telephone" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="column1">
                            <p>Password</p>
                        </div>  
                        <div class="column2">
                            <input type="password" class="teacher-input title" name="password" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Expertise Field</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="teacher-input title" name="expertise" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="column1">
                            <p>Profile Photo</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" accept="img/*" name="profilePhoto">
                                <i class="fa-solid fa-file-import"></i> 
                                <br> <div class="select">Select file</div>
                            </label>
                            </div>
                        </div>
                        <p class="upload-option">OR</p>
                        <div class="drop-zone">
		                        <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
		                        <input type="file" accept="img/*" name="profilePhoto" class="drop-zone-input">
	                    </div>
                        <button type="submit" name="addTeacher" class="form-btn">Add Teacher</button>
                        <button type="reset" class="form-btn">Discard</button>
                    </div>
                </form>
            </div>
        </div>


        <script type="text/javascript" src="js/addTeacher.js"></script>
</body>
</html>