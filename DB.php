<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
    $dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ  
    $dbname = "BSD_CHALLANGE"; // the name of the database that you are going to use for this project  
    $dbuser = "root"; // the username that you created, or were given, to access your database  
    $dbpass = ""; // the password that you created, or were given, to access your database  
    
    $con = mysqli_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
    mysqli_select_db($con,$dbname) or die("MySQL Error: " . mysql_error());  
?>