<?php
    include "./config.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
</head>
<body id="login">
    <section class="login_page">
        <div class="login_panel">
            <h3>
                Welcome to M2J Trip!
            </h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                    <label for="username">User Name</label> 
                    <input type="email" name="username" placeholder="Enter your username"/>
                </div>
                <div>
                    <label for="pass">Password</label> 
                    <input type="password" name="pass" placeholder="Enter your password"/>
                </div>
                <button type="submit">Sign in</button>
            </form>
        </div>
    </section>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $dbconn = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
            if($dbconn->connect_error){
                die("Error: ".$dbconn->connect_error);
            }else{
                $selectCmd = "SELECT * FROM user_tb WHERE email='$username';";
                $result = $dbconn->query($selectCmd);
                if($result->num_rows > 0){
                    $user = $result->fetch_assoc();
                    $hashedPass = $user['pass'];
                    if(password_verify($pass, $hashedPass)){
                        if($user['usertype']=="admin"){
                            $_SESSION['user'] = $user;
                            $_SESSION['session_timeout'] = time() + 600;
                            $sessionId=$_SESSION['session_id'] = rand(1000,9999);
                            $update_cmd = "UPDATE user_tb SET session_ID = ' $sessionId' WHERE email='$username'";
                            $dbconn->query($update_cmd);
                            $dbconn->close();
                            header("Location: http://localhost/PHP/M2J/adminHome.php");
                        }else{
                            echo "<script>alert('Admin only');</script>";
                        }
                    }else{
                        echo "<script>alert('User not valid1');</script>";
                    }
                }else{
                    echo "<script>alert('User not valid2');</script>";
                }
            }
            $dbconn->close();
        }
    ?>

</body>
</html>