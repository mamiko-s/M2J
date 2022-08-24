<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/AddNewUser.css">
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
        <h1>Create New Account</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fname">First Name:</label> 
            <input type="text" name="fname" placeholder="Enter a First Name"/>
            <label for="lname">Last Name:</label> 
            <input type="text" name="lname" placeholder="Enter a Last Name"/>
            <label for="email">Email:</label> 
            <input type="email" name="email" placeholder="Enter a Email"/>
            <label for="password">Password:</label> 
            <input type="text" name="password" placeholder="Enter a Password"/>
            <label for="phone">Phone:</label> 
            <input type="text" name="phone" placeholder="Enter a Phone Number"/>
            <label for="UserType">Type of User:</label> 
            <select name="UserType">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <button type="submit">Sign Up</button>
        </form>
    </section>
</body>
</html>