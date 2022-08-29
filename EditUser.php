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
                <li><i class="fas fa-user-plus"></i><a href="AddNewUser.php">ADD NEW USER</a></li>
                <li class="link_hover"><i class="fas fa-edit"></i><a href="EditAdmin.php">EDIT USER</a></li>
                <li><i class="fa-solid fa-map-location-dot"></i><a href="AddNewTour.php">ADD NEW TOUR</a></li>
            </ul>
            <button type="submit">LOGOUT</button>
        </section>

        <section class="panel_section">
            <div class="edit_panel">
            <h1>Edit User Information</h1>
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
                                $label = "Date of birth";
                            break;
                            case "email":
                                $type = "email";
                                $label = "Email";
                            break;
                            case "phone":
                                $type = "tel";
                            break;
                            case "pass":
                                $type = "password";
                                $label = "Password";
                            break;
                            default:
                                $type = "text";
                        }
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' required/>";
                       
                    }
                ?>
                <button type="submit">Update</button>
            </form>
            </div>
        </section>
    </main>
</body>
</html>