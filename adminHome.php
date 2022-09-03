<?php
    include './config.php';
    session_start();
    if(isset($_GET['action'])){
        if($_GET['action']=="logout"){
            session_unset();
            session_destroy();
            header("Location: http://localhost/PHP/M2J/login.php");
        }
    }
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
        if($dbcon->connect_error){
            die("Connection error");
        }else{
            $dbcon->close();
        }
    }

    include './session_check.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/AdminHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h3>M2J Trip</h3>
        <div>
            <p>Welcome back <?php echo $_SESSION['user']['firstName'] ?>!</p>
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <button type="submit" name="action" value="logout">LOGOUT</button>
            </form>
        </div>
    </header>
    <main>
        <section class="nav_section">
            <div class="title_top">
                <span><i class="fas fa-user-circle"></i></span>
                <p><?php echo $_SESSION['user']['firstName'] ?></p>
            </div>
            <ul>
                <li class="link_hover"><i class="fas fa-home"></i><a href="adminHome.php">ADMIN HOME</a></li>
                <li><i class="fas fa-user-plus"></i><a href="AddNewUser.php">ADD NEW USER</a></li>
                <li><i class="fas fa-edit"></i><a href="EditAdmin.php">EDIT USER</a></li>
                <li><i class="fa-solid fa-map-location-dot"></i><a href="AddNewTour.php">ADD NEW TOUR</a></li>
            </ul>
        </section>

        <section class="panel_section">
            <h1>Admin Dashboard</h1>
            <h3>User Information</h3>
            <article>
                <table>
                    <thead>
                        <tr>
                            <th width="10%">User ID</th>
                            <th width="20%">Full name</th>
                            <th width="23%">Email</th>
                            <th width="16%">Date of birth</th>
                            <th width="16%">Phone</th>
                            <th width="15%">User Type</th>
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
                                echo "</tr>";
                            }
                            $dbcon->close();
                        }
                    ?>
                    </tbody>
                </table>
            </article>

            <h3 class="des-title">Destinations</h3>
            <article>
                <table>
                    <thead>
                        <tr>
                            <th width="7%">Id</th>
                            <th width="23%">Destination</th>
                            <th width="7%">Image</th>
                            <th width="35%">Explanation</th>
                            <th width="14%">Duration</th>
                            <th width="14%">Price</th>

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
                                echo "<td><img style='margin:12px 14px 10px 0; border-radius:12px; width:150px; height:100px;' src='".$row['des_img']."'></td>";
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