<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
</head>
<body id="userHome">
    <main>
        <section class="nav_section">
            <div class="title_top">
                <h2>M2J Trip</h2>
                <span><i class="fas fa-user-circle"></i></span>
                <p>User Name</p>
            </div>
            <ul>
                <li class="link_userHome"><i class="fas fa-home"></i><a href="#userHome.php">USER HOME</a></li>
                <li class="link_editProf"><i class="fas fa-user-edit"></i><a href="#editProfile.php">EDIT PROFILE</a></li>
                <li class="link_editBook"><i class="fas fa-bus-alt"></i><a href="#editBooking.php">EDIT BOOKING</a></li>
            </ul>
            <button type="submit">LOGOUT</button>
        </section>
        <section class="user_dashboard">
            <h3>Booked Trip</h3>
            <div class="user_panel">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destination</th>
                            <th>Person</th>
                            <th>Explanation</th>
                            <th>Days</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0123</td>
                            <td><img src="" alt=""></td>
                            <td>2 adults</td>
                            <td>Experience the everlasting beauty of our capital city, with visits to some of its famous gardens. </td>
                            <td>1 day</td>
                            <td>$ 500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>