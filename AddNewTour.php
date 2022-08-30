<?php include './config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/AddNewTour.css">
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
                <li><i class="fas fa-edit"></i><a href="EditUser.php">EDIT USER</a></li>
                <li class="link_hover"><i class="fa-solid fa-map-location-dot"></i><a href="AddNewTour.php">ADD NEW TOUR</a></li>
            </ul>
            <button type="submit">LOGOUT</button>
    </section>

    <section class="panel_section">
        <h1>Add New Tour</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div>
                <label for="category">Category</label>
                    <select class="category" name="category">
                        <option>GUIDED TOURS</option>
                        <option>ATTRACTIONS + ACTIVITIES</option>
                        <option>FEATURED - PRODUCTS</option>
                    </select>
            </div>
            <div>
                <label for="des_name">Destination</label>
                <input class="des_name" name="des_name" required/>
            </div>
            <div>
                <label for="des_img">Destination Img</label>
                <input class="des_img" name="des_img" type="file" />
            </div>
            <div>
                <label for="des_exp">Explanation</label>
                <textarea class="des_exp" name="des_exp" required/></textarea>
            </div>
            <div>
                <label for="duration">Duration</label>
                <input class="duration" name="duration" required/>
            </div>
            <div>
                <label for="price">Price</label>
                <input class="price" name="price" required/>
            </div>
                <button type="submit">Register</button>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $category = $_POST['category'];
            $des_name = $_POST['des_name'];
            $des_exp = $_POST['des_exp'];
            $duration = $_POST['duration'];
            $price = $_POST['price'];
            $sourceImg = $_FILES['des_img'];
            $imgExtension = pathinfo($sourceImg['name'])['extension'];
            $imgDest = "./files/des_img/".str_replace(" ","_",$des_name)."img.".$imgExtension;
            if($imgExtension == "jpg" && getimagesize($sourceImg['tmp_name'])){
                if($sourceImg['size']<400000){
                    if(move_uploaded_file($sourceImg['tmp_name'],$imgDest)){
                        $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);
                        if($dbcon->connect_error){
                            echo "<h1>".$dbcon->connect_error."</h1>";
                        }else{
                            $insertCmd = "INSERT INTO destination_tb (category,des_name,des_img,des_exp,duration,price) VALUES ('$category','$des_name','$imgDest','$des_exp','$duration','$price')";
                            if($dbcon->query($insertCmd)===TRUE){
                                echo "<h1>New Tour is registered</h1>";
                            }else{
                                echo "<h1>Tour is not registered</h1>".$dbcon->error;
                            }
                        }
                    }else{
                        echo "<h1>Can't upload the image</h1>";
                    }
                }
            }
            
            
        }
    ?>
</body>
</html>
