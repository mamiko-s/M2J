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
                    <label for="fname">User Name</label> 
                    <input type="email" name="username" placeholder="Enter your username"/>
                </div>
                <div>
                    <label for="password">Password</label> 
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
                // $selectCmd = "SELECT * FROM `user_tb` WHERE email='$username' and password='$pass';";
                $result = $dbconn->query($selectCmd);
                // print_r($result);
                if($result->num_rows > 0){
                    echo "User valid";
                    $user = $result->fetch_assoc();
                    $hashedPass = $user['password'];
                    $pass = password_hash($pass,PASSWORD_BCRYPT,["cost" => 8]);
                    $hashedPass = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 8]);
                    if(password_verify($pass,$hashedPass)){
                        $_SESSION['user'] = $user;
                        $_SESSION['session_timeout'] = time() + 5;
                        $_SESSION['session_id'] = "1234";
                        $dbconn->close();
                        header("Location: http://localhost/PHP/M2J/M2J-adminHome/adminHome.php");
                    }else{
                        echo "User not valid";
                    }
                }else{
                    echo "User not valid";
                }
            }
            $dbconn->close();
        }
    ?>

</body>
</html>