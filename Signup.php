<?php
include 'user.php';
?>
<html>
<head>
</head>
<body>
    
            <?php
            if(!empty($_POST['username']) && !empty($_POST['password']))
            {
                 $username = $_POST['username'];
                 $password = md5($_POST['password']);
                 $user = new User();
                 $user->Signup($username, $password);
            }
            else
            {
            ?>
            <h1>Sign Up</h1>

            <p>Please enter user details below.</p>
                    <form method="post" action="Signup.php" name="registerform" id="registerform">
                    <fieldset>
                        <label for="username" id="mylabel">UserName</label>
                        <input class="textfield" type="text" name="username" class="required" minlength="3" id="username" /><br/>
                        
                        <label for="password" id="mylabel">Password</label>
                        <input class="textfield" type="password" name="password" class="required" minlength="3" id="password" /><br/>
                        </br>
                        <input type="submit" name="register" id="register" value="Signup" />
                    </fieldset>
                    </form>
            <?php
            }
            ?>
</body>
</html>