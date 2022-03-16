<?php include 'user.php'; ?>
<html>
    <head>

    </head>
    <body>
        <?php
            if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))  
            {
                    header("Location: Home.php"); 
            }
            elseif(!empty($_POST['username']) && !empty($_POST['password']))
            {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                //$password = mysql_real_escape_string($_POST['password']);
                $user = new user();
                $user->login($username, $password);
            }
            else
            {
        ?>
        <h1>Login</h1>
        <form method="post" action="index.php" name="loginform" id="loginform">  
        <fieldset>  
            <label id="mylabel" for="username">Username </label>
            <input class="textfield" type="text" name="username" id="username" /><br />  
            <label id="mylabel" for="password">Password </label>
            <input class="textfield" type="password" name="password" id="password"/><br />  
            <br />
            <input type="submit" name="login" id="login" value="Login" />  
            <br />
            <a href = "Signup.php">Signup</a>
            <a href = "Reset.php">Reset Password</a>
        </fieldset>  
        </form>
        <?php } ?>
    </body>
</html>