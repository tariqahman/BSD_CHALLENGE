<?php
    include 'user.php';
    if(empty($_SESSION['Username']))  
    {
            header("Location: index.php"); 
    }

    $user = new User();
    $user->history($_SESSION['Username']);
    echo "<p><a href=\"Home.php\">click here to search again</a>.</p>";  
?>