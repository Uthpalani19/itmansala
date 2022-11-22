<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page </title>
    <link rel="stylesheet" href = "css/index.css">
</head>
<body>
        <section>
            <div class="imgbox">
                <img src="img/bg3.jpg">

            </div>
            <div class="contentbox">
                <div class="formbox">
                    <h2>Sign In</h2>
                    <form method="post" action="viewTeachers.php">
                        <div class="inputbox">
                            <input type="text" placeholder="Username" name="username" value="">
                            
                        </div>
                        
                        <div class="inputbox">
                            <input type="password" placeholder="Password" name="password" value="">
                            
                        </div>

                        <div class="remember">
                            <label><input type="checkbox" name=""> Remember me </label>
                        </div>
                        <div class="inputbox">
                            <input type="submit" value="Sign in" name="">
                        </div>
                        <div class="inputbox">
                            <p>Don't have an acount? <a href="signup.php">Sign up</a> </p>
                        </div>
                    </form>
                </div>

            </div>
        </section>
</body>
</html>