<?php
include 'DB.php';
class user{

    private function CheckUsername($username)
    {
        global $con;
        $checkusername = mysqli_query($con , "SELECT * FROM user WHERE Username = '".$username."'") or die('error in selection');
        if(mysqli_num_rows($checkusername) == 1) // there is return false
            return TRUE;
        else
            return FALSE;
    }
    
    private function CheckPassword($password,$username)
    {
        global $con;
        $checkpassowrd = mysqli_query($con , "SELECT * FROM user WHERE Username = '".$username."' AND Password = '".$password."'") or die('error in selection');
        if(mysqli_num_rows($checkpassowrd) >= 1)
            return TRUE;
        else
            return FALSE;
    }

    public function ResetPassword($username,$password)
    {
        $result1 = $this->CheckUsername($username);
        if($result1)
        {
            global $con;
            $updatequery = mysqli_query($con,"Update user set Password='".$password."'  , modify_date=current_timestamp() WHERE Username = '".$username."'") or die('error in update');
            if($updatequery)
            {
                echo "<h1>Success</h1>";
                echo "<p>The password was successfully reset. Please <a href=\"index.php\">click here to login</a>.</p>";
            }
        }
        if(!$result1)
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, that username doesnt exist . Please go back and try again.<a href='Reset.php'>Reset Password</a></p>";
        }
    }

    public function Signup($username,$password)
    {
        $result1 = $this->CheckUsername($username);
        if(!$result1)
        {
            global $con;
            $registerquery = mysqli_query($con , "INSERT INTO `User` (Username, Password) VALUES('".$username."', '".$password."')") or die('error in insertion');
            if($registerquery)
            {
                echo "<h1>Success</h1>";
                echo "<p>The user was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
            }
        }
        if($result1)
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, that username is taken. Please go back and try again.<a href='Signup.php'>Signup</a></p>";
        }
    }

    public function login($username,$password)
    {
        $result1 = $this->CheckUsername($username);
        $result2 = $this->CheckPassword($password,$username);
        if($result1 && $result2)
        {
            global $con;
            $row = mysqli_fetch_array(mysqli_query($con , "SELECT * FROM user WHERE Username = '".$username."' AND Password = '".$password."'")) or die('error in selection');

            $_SESSION['Username'] = $username; 
            $_SESSION['LoggedIn'] = 1;
            echo "<meta http-equiv='refresh' content='0;URL = Home.php' />";
        } 
        else  
        {  
            echo "<h1>Error</h1>";  
            echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";  
        }
    }

    public function history_add($username,$Twitch_username,$Twitch_id)
    {
        global $con;
        $historyaddquery = mysqli_query($con , "INSERT INTO `user_history` (Username, Twitch_username, Twitch_id) VALUES('".$username."', '".$Twitch_username."', '".$Twitch_id."')") or die('error in insertion');
    }

    public function history_search($username,$random_id)
    {
        global $con;
        $result = mysqli_query($con , "SELECT * FROM user_history WHERE Username = '".$username."' AND Twitch_id = '".$random_id."'") or die('error in selection');
        if (mysqli_num_rows($result) == 1)
        {
            return true;
        }
        return false;
    }

    public function history($username)
    {
        global $con;
        $result = mysqli_query($con , "SELECT * FROM user_history WHERE Username = '".$username."'") or die('error in selection');
        if ($result)
        {
            echo '<p>You search for below valid Twitch users either by username or lucky button</p>';
            while($row = mysqli_fetch_array($result))
            {

                echo '<p>username : '.$row['Twitch_username'];
                echo ' , id : '.$row['Twitch_id'].'</p>';
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
    }

}

?>