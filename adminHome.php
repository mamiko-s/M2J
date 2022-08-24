<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
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
                <?php
                    echo "<table><tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>User Type</th></tr>";
                    echo "<tr><td>1234</td><td>Jay</td><td>Lee</td><td>test@test.com</td><td>7781234567</td><td>Admin</td></tr>";
                    echo "<tr><td>1234</td><td>Jay</td><td>Lee</td><td>test@test.com</td><td>7781234567</td><td>Admin</td></tr>";
                    echo "<tr><td>1234</td><td>Jay</td><td>Lee</td><td>test@test.com</td><td>7781234567</td><td>Admin</td></tr></table>";
                ?>
            </article>
            <article>
                <h2>DESTINATION</h2>
                <?php
                    echo "<table><tr><th>ID</th><th>Destination</th><th>Type</th><th>Content</th><th>Duration</th><th>Price</th></tr>";
                    echo "<tr><td>0123</td><td><img src='./img/Aquarium.jpeg'></td><td>Type</td><td>Content</td><td>Duration</td><td>Price</td></tr>";
                    echo "<tr><td>0123</td><td><img src='./img/Aquarium.jpeg'></td><td>Type</td><td>Content</td><td>Duration</td><td>Price</td></tr>";
                    echo "<tr><td>0123</td><td><img src='./img/Aquarium.jpeg'></td><td>Type</td><td>Content</td><td>Duration</td><td>Price</td></tr></table>";
                ?>
            </article>
        </section>
</main>    
</body>
</html>