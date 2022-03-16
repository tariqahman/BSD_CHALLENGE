<?php
    include 'user.php';
    if(empty($_SESSION['Username']))  
    {
            header("Location: index.php"); 
    }
    $user = new User();
    $error_msg = "";
    if($_GET['username'])
    {
        $username = $_GET['username'];
        $error_msg =  "<p> no user was found by username : ".$username." </p>";
        $url = "https://api.twitch.tv/helix/users?login=".$username;
    }
    else
    {
        $id_exist = true;
        while ($id_exist)
        {
            $random_id = rand();
            if(!$user->history_search($_SESSION['Username'], $random_id))
            {
                $id_exist = false;
            }
        }
        $error_msg =  "<p> no user was found by random ID : ".$random_id." </p>";
        $url = "https://api.twitch.tv/helix/users?id=".$random_id;
    }
    
    
    
    
	$headers = array( 
        "Authorization: Bearer 2ujutsz0sumuw4gm3nvune96a8gs9r",
        "Client-Id: 1a5dgireers0kf2voqc77a7s9thrx1"
    ); 


	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $data = curl_exec($ch);
    if (curl_errno($ch)) { 
        print "Error: " . curl_error($ch); 
    } else { 
        // Show me the result 
        if(json_decode($data,true)['data'])
        {
            $id = json_decode($data,true)['data'][0]['id'];
            echo "<p> Twitch user ID: ".$id."</p>";
            $login = json_decode($data,true)['data'][0]['login'];
            echo "<p> Twitch user login: ".$login."</p>";
            $user->history_add($_SESSION['Username'], $login, $id);
        }
        else
        {
            echo $error_msg;
        }
        curl_close($ch); 
    }
    echo "<p><a href=\"Home.php\">click here to search again</a>.</p>";  
?>
