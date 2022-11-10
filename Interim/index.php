<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css"></link>
    </head>

    <body>
        <div class="background">
            <div class="form-box">
                <div class="form-img">
                </div>
                
                <div class="form-details">
                    <h2>Log In</h2>

                    <!--Login form-->
                    <div class="login-form">
                        <form action="login.php" method="POST">
                            <input type="text" class="input-text" name="username" placeholder="Username or phone number" required><br />
                            <input type="password" class="input-text" name="password" placeholder="Password" required><br />
                            <input type="submit" class="submit-btn" name="Login" value="Log in" >
                        </form>

                        <div class="signup">
                            <p>Not on our platform? <a href="signup.php"> Create New Account </a> </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>