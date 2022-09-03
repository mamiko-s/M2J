<?php

    include "./config.php";
    $dbconn = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
    if($dbconn->connect_error){
        die("Error: ".$dbconn->connect_error);
    }else{
        $username = $_SESSION['user']['email'];
        $sessionId = $_SESSION['session_id'];
        $selectCmd = "SELECT session_ID FROM user_tb WHERE email='$username';";
        // $selectCmd = "SELECT * FROM `user_tb` WHERE email='$username' and password='$pass';";
        $result = $dbconn->query($selectCmd);
        $user = $result->fetch_assoc();
        $dbconn -> close();
        if($user['session_ID']==$sessionId){
            // echo "<h1>Correct!!!!!!</h1>";
            if ($_SESSION['session_timeout'] > time()){
                if(!isset($_SESSION['user'])){
                    session_unset();
                    session_destroy();
                    header("Location: http://localhost/PHP/M2J/login.php");
                }
                $_SESSION['session_timeout'] = time() + 600;
            }else{
                session_unset();
                session_destroy();
                header("Location: http://localhost/PHP/M2J/login.php");
            }
        }

    }

    

?>