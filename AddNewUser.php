<?php
    include './config.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/AddNewUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
<main>
    <section class="left">
        <h2>UserName</h2>
        <i class="fa-solid fa-user"></i>
        <ul>
            <li><i class="fa-solid fa-house-user"></i><a href="#">ADMIN HOME</a></li>
            <li><i class="fa-solid fa-user"></i><a href="#">ADD NEW USER</a></li>
            <li><i class="fa-solid fa-user-pen"></i><a href="#">EDIT USER</a></li>
            <li><i class="fa-solid fa-map-location-dot"></i><a href="#">ADD NEW TOUR</a></li>
        </ul>
        <a href="#">LOGOUT</a>
    </section>
    <section class="right">
        <h1>Create New Account</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fname">First Name:</label> 
            <input name="fname" placeholder="Enter a First Name"/>
            <label for="lname">Last Name:</label> 
            <input name="lname" placeholder="Enter a Last Name"/>
            <label for="email">Email:</label> 
            <input type="email" placeholder="Enter a Email"/>
            <label for="password">Password:</label> 
            <input type="password" name="password" placeholder="Enter a Password"/>
            <label for="dob">Date of birth:</label>
            <input type="date" name="dob" require/>
            <label for="phone">Phone:</label> 
            <input type="text" name="phone" placeholder="Enter a Phone Number"/>
            <label for="addr">Address:</label>
            <input name="addr" require/>
            <label for="UserType">Type of User:</label> 
            <select name="UserType">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <button type="submit">Sign Up</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
                if($dbCon->connect_error){
                    die ("Connection error ".$dbCon->connect_error);
                }else{
                    $dbPass = password_hash($_POST['pass'],PASSWORD_BCRYPT,["cost"=>9]);
                    $insertCmd = "INSERT INTO user_tb (firstName,lastName,email,pass,dob,phone,addr) VALUES ('".$_POST['fname']."','".$_POST['lname']."','".$_POST['email']."','".$dbPass."','".$_POST['dob']."','".$_POST['phone']."','".$_POST['addr']."')";
                    $result = $dbCon->query($insertCmd);
                    if($result === true){
                        echo "<h1 style='color: green;'>DONE!!!</h1>";
                    }else{
                        echo "<h1 style='color: red;'>".$dbCon->error."</h1>";
                    }

                    $dbCon->close();
                }
            }
        ?>
    </section>
    
</body>
</html>