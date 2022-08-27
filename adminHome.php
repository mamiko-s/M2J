<?php
    include './config.php';
    if(isset($_GET['id']) && isset($_GET['action'])){
        session_start();
        $id = $_GET['id'];
        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
        if($dbcon->connect_error){
            die("Connection error");
        }else{
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
    <link rel="stylesheet" href="./css/AdminHome.css">
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
            <h1>Admin Dashboard</h1>
            <article>
                <h2>USER INFO</h2>
                <table border="1">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full name</th>
                        <th>email</th>
                        <th>Date of birth</th>
                        <th>Phone</th>
                        <th>User Type</th>

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
                                echo "<td>".$row['dob']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['phone']."</td>";
                                echo "<td>".$row['usertype']."</td>";
                                echo "</tr>";
                            }
                            $dbcon->close();
                        }
                    ?>
                </tbody>
            </table>
            </article>
            <article>
                <h2>DESTINATION</h2>
                <table border="1">
                <thead>
                    <tr>
                        <th>Destination Id</th>
                        <th>Destination</th>
                        <th>Image</th>
                        <th>Explanation</th>
                        <th>Duration</th>
                        <th>Price</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
                        if($dbcon->connect_error){
                            die("Connection error");
                        }else{
                            $selectCmd = "SELECT * FROM destination_tb";
                            $result = $dbcon->query($selectCmd);
                            $users = [];
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$row['des_id']."</td>";
                                echo "<td>".$row['des_name']."</td>";
                                echo "<td>".$row['des_img']."</td>";
                                echo "<td>".$row['des_exp']."</td>";
                                echo "<td>".$row['duration']."</td>";
                                echo "<td>".$row['price']."</td>";
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