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
            <label for="cName">Destination</label>
            <input name="cName" required/>
            <label for="cName">Duration</label>
            <input name="length" type="number" max="127" required />
            <label for="cName">Destination Img</label>
            <input name="cImg" type="file" />
            <button type="submit">Register</button>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $cName = $_POST['cName'];
            $length = $_POST['length'];
            $sourceImg = $_FILES['cImg'];
            $imgExtension = pathinfo($sourceImg['name'])['extension'];
            $imgDest = "./files/cimg/".str_replace(" ","_",$cName)."img.".$imgExtension;
            if($imgExtension == "jpg" && getimagesize($sourceImg['tmp_name'])){
                if($sourceImg['size']<400000){
                    if(move_uploaded_file($sourceImg['tmp_name'],$imgDest)){
                        $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);
                        if($dbcon->connect_error){
                            echo "<h1>".$dbcon->connect_error."</h1>";
                        }else{
                            $insertCmd = "INSERT INTO course_tb (coursename,length,course_img) VALUES ('$cName',$length,'$imgDest')";
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
