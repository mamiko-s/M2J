<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
</head>
<body id="login">
    <section class="login_page">
        <div class="login_panel">
            <h3>
                Welcome to M2J Trip!
            </h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                    <label for="fname">User Name</label> 
                    <input type="email" name="username" placeholder="Enter your username"/>
                </div>
                <div>
                    <label for="password">Password</label> 
                    <input type="password" name="pass" placeholder="Enter your password"/>
                </div>
                <button type="submit">Sign in</button>
            </form>
        </div>
    </section>
</body>
</html>