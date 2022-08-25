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
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Department = $_POST['Department'];
        $idx = $_GET['idx'];
        $filehandler = fopen('./files/employeeData.json','r');
        $employeeData = json_decode(fread($filehandler,filesize('./files/employeeData.json')));
        fclose($filehandler);
        $employeeData[$idx]->first_name = $fname;
        $employeeData[$idx]->last_name = $lname;
        $employeeData[$idx]->Department = $Department;
        $filehandler = fopen('./files/employeeData.json','w');
        $stringData = json_encode($employeeData);
        fwrite($filehandler,$stringData);
        fclose($filehandler);
        header("Location: http://localhost/PHP/M2J/EditUser.php");
    }
        if(isset($_GET['idx'])){
            $idx = $_GET['idx'];
            $filehandler = fopen('./files/employeeData.json','r');
            $employeeData = json_decode(fread($filehandler,filesize('./files/employeeData.json')));
            fclose($filehandler);
            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."?idx=$idx'>";
            echo "<input name='fname' value='".$employeeData[$idx]->first_name."'/>";
            echo "<input name='lname' value='".$employeeData[$idx]->last_name."'/>";
            echo "<input name='Department' value='".$employeeData[$idx]->Department."'/>";
            echo "<button type='submit'>Save</button>";
            echo "</form>";
        }
        
    ?>
</body>
</html>