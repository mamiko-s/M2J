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
            <h2>User Information</h2>
            <article>
                <table>
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="18%">Full name</th>
                            <th width="20%">Email</th>
                            <th width="14%">Date of birth</th>
                            <th width="14%">Phone</th>
                            <th width="13%">User Type</th>
                            <th width="15%" colspan="2">Actions</th>
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
                                echo "<td>".$row['usertype']."</td>";
                                echo "<td><a class='btn_edit' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=edit'><i class='fas fa-edit'></i></a></td>";
                                echo "<td><a class='btn_delete' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=del'><i class='fas fa-trash-alt'></i></a></td>";
                                echo "</tr>";
                            }
                            $dbcon->close();
                        }
                    ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>
</body>
</html>