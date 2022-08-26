<?php
    include './config.php';
    if(isset($_GET['id']) && isset($_GET['action'])){
        session_start();
        $id = $_GET['id'];
        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
        if($dbcon->connect_error){
            die("Connection error");
        }else{
            switch($_GET['action']){
                case "del":
                    $delcmd = "DELETE FROM user_tb WHERE user_id=$id";
                    if($dbcon->query($delcmd) === true){
                        echo "<h1>Data deleted</h1>";
                    }else{
                        echo "<h1>Action failed</h1>";
                    }
                break;
                case "edit":
                    $selectuser = "SELECT * FROM user_tb WHERE user_id=$id";
                    $result = $dbcon->query($selectuser);
                    $_SESSION['userData'] = $result->fetch_assoc();
                    $dbcon->close();
                    header("Location:http://localhost/PHP/M2J/EditUser.php");
                break;
            }
            $dbcon->close();
        }
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
            <table border="1">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full name</th>
                        <th>email</th>
                        <th>Date of birth</th>
                        <th>Phone</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
                        if($dbcon->connect_error){
                            die("Connection error");
                        }else{
                            $selectCmd = "SELECT * FROM user_tb";
                            $result = $dbcon->query($selectCmd);
                            $users = [];
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$row['user_id']."</td>";
                                echo "<td>".$row['firstName']." ".$row['lastName']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['dob']."</td>";
                                echo "<td>".$row['phone']."</td>";
                                echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=edit'>Edit</a></td>";
                                echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=del'>Delete</a></td>";
                                echo "</tr>";
                            }
                            $dbcon->close();
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>