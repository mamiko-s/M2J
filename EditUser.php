<?php
    include './config.php';
    session_start();
    if(!isset($_SESSION['userData'])){
        header("Location:http://localhost/PHP/M2J/EditUser.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/EditUser.css">
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
            <h1>Edit User</h1>
            <?php
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
                    $updateCmd = "UPDATE user_tb SET firstName='".$_POST['firstName']."', lastName='".$_POST['lastName']."',  dob='".$_POST['dob']."', email='".$_POST['email']."', pass='".$_POST['pass']."', phone='".$_POST['phone']."', usertype='".$_POST['usertype']."' WHERE user_id=".$_POST['user_id'];
                    
                    
                    if($dbcon->query($updateCmd) === true){
                        $dbcon->close();
                        unset($_SESSION['userData']);
                        header("Location:http://localhost/PHP/M2J/EditAdmin.php");
                    }
                }
            ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php
                    foreach($_SESSION['userData'] as $fieldName=>$value){
                        $label = $fieldName;
                        switch($fieldName){
                            case "dob":
                                $type = "date";
                                $label = "date of birth";
                            break;
                            case "email":
                                $type = "email";
                            break;
                            case "phone":
                                $type = "tel";
                            break;
                            case "pass":
                                $type = "password";
                                $label = "password";
                            break;
                            default:
                                $type = "text";
                        }
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' required/></br>";
                       
                    }
                ?>
                <button type="submit">Update</button>
            </form>
        </section>
    </main>
</body>
</html>