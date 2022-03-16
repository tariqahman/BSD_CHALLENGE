<?php
include 'user.php';
if(empty($_SESSION['Username']))  
{
    header("Location: index.php"); 
}
?>
<html>
    <head>

    </head>
    <body>
        <form method="get" action="ConsumeAPI.php">
            <label>Username</label>
            <input type="text" name="username"/>
            <button type="submit">Search</button>
            <button type="submit">I'm feeling lucky button</button>
        </form>
        <a href = "HelloWorld.php">Hello Wolrd</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </body>
</html>