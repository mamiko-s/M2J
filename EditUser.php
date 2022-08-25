<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/EditUser.css">
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
            <h1>Edit User</h1>
            <?php
                function loadData($employeeData){
                    echo "<table><tr><th>EmployeeID</th><th>FirstName</th><th>LastName</th><th>Department</th></tr>";
                    foreach($employeeData as $idx=>$employee){
                        echo "<tr><td>$employee->EmployeeID</td><td>$employee->first_name</td><td>$employee->last_name</td><td>$employee->Department</td><td><a href='./editEmployee.php?idx=$idx'>Edit</a></td><td><a href='./deleteEmployee.php?idx=$idx'>Delete</a></td></tr>";
                    }
                    echo "</table>";
                }
                $fileHandler = fopen('./files/employeeData.json','r');
                $data = fread($fileHandler,filesize('./files/employeeData.json'));
                fclose($fileHandler);
                $employeeData = json_decode($data);
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $tmpEmployee['first_name'] = $_POST['fname'];
                    $tmpEmployee['last_name'] = $_POST['lname'];
                    $tmpEmployee['Department'] = $_POST['Department'];
                    array_push($employeeData,$tmpEmployee);
                    $newData = json_encode($employeeData);
                    $fileHandler = fopen('./files/employeeData.json','w');
                    fwrite($fileHandler,$newData);
                    fclose($fileHandler);
                    loadData(json_decode($newData));
                }else{
                    loadData($employeeData);
                }
            ?>
        </section>
    </main>
</body>
</html>