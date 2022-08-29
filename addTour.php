<?php include './config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/addTour.css">
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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <label for="category">Category</label>
            <select name="category">
                <option>GUIDED TOURS</option>
                <option>ATTRACTIONS + ACTIVITIES</option>
                <option>FEATURED - PRODUCTS</option>
            </select>
            <label for="des_name">Destination</label>
            <input name="des_name" required/>
            <label for="des_img">Destination Img</label>
            <input name="des_img" type="file" />
            <label for="des_exp">Explanation</label>
            <input name="des_exp" required/>
            <label for="duration">Duration</label>
            <input name="duration" required/>
            <label for="price">Price</label>
            <input name="price" required/>
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