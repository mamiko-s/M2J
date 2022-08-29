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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <section class="nav_section">
        <div class="title_top">
            <h2>M2J Trip</h2>
            <span><i class="fas fa-user-circle"></i></span>
            <p>User Name</p>
        </div>
        <ul>
            <li><i class="fas fa-home"></i><a href="adminHome.php">ADMIN HOME</a></li>
            <li class="link_hover"><i class="fas fa-user-plus"></i><a href="AddNewUser.php">ADD NEW USER</a></li>
            <li><i class="fas fa-edit"></i><a href="EditUser.php">EDIT USER</a></li>
            <li><i class="fa-solid fa-map-location-dot"></i><a href="AddNewTour.php">ADD NEW TOUR</a></li>
        </ul>
        <button type="submit">LOGOUT</button>
    </section>

    <section class="panel_section">
        <h1>Create New Account</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <label for="fname">First Name</label> 
                <input name="fname" placeholder="Enter your first name"/>
            </div>
            <div>
                <label for="lname">Last Name</label> 
                <input name="lname" placeholder="Enter your last name"/>
            </div>
            <div>
                <label for="dob">Date of birth</label>
                <input type="date" name="dob" require/>
            </div>
            <div>
                <label for="email">Email</label> 
                <input type="email" name="email" placeholder="Enter your email"/>
            </div>
            <div>
                <label for="password">Password</label> 
                <input type="password" name="pass" placeholder="Enter a password"/>
            </div>
            <div>
                <label for="phone">Phone</label> 
                <input type="text" name="phone" placeholder="Enter your phone number"/>
            </div>
            <div>
            <label for="UserType">Type of User</label> 
                <select name="usertype">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
                if($dbCon->connect_error){
                    die ("Connection error ".$dbCon->connect_error);
                }else{
                    $dbPass = password_hash($_POST['pass'],PASSWORD_BCRYPT,["cost"=>9]);
                    $insertCmd = "INSERT INTO user_tb (firstName,lastName,dob,email,pass,phone,usertype) VALUES ('".$_POST['fname']."','".$_POST['lname']."','".$_POST['dob']."','".$_POST['email']."','".$dbPass."','".$_POST['phone']."','".$_POST['usertype']."')";
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
</main>
</body>
</html>