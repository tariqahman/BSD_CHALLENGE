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
                $user = new user();
                $user->ResetPassword($username, $password);
            }
            else
            {
        ?>
        <h1>Reset Password</h1>  
        <form method="post" action="Reset.php" name="resetform" id="resetform">  
        <fieldset>  
            <label id="mylabel" for="username">Username </label>
            <input class="textfield" type="text" name="username" id="username" /><br />  
            <label id="mylabel" for="password">New Password </label>
            <input class="textfield" type="password" name="password" id="password"/><br />  
            <br />
            <input type="submit" name="reset" id="reset" value="Reset" />  
            <br />
        </fieldset>  
        </form>
        <?php } ?>
    </body>
</html>