<?php
include 'user.php';
if(empty($_SESSION['Username']))  
{
        header("Location: index.php"); 
}

$response['status']=200;
$response['status_message']='success';
$response['data']='Hello World '.$_SESSION['Username'];
http_response_code(200);
$json_response = json_encode($response);
echo $json_response;
echo "</br>";
echo "<p><a href=\"Home.php\">click here to go back to Home</a>.</p>";  
?>