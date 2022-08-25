<?php
    if(isset($_GET['idx'])){
        $idx = $_GET['idx'];
        $filehandler = fopen('./files/employeeData.json','r');
        $employeeData = json_decode(fread($filehandler,filesize('./files/employeeData.json')));
        fclose($filehandler);

        unset($employeeData[$idx]);
        $employeeData = array_values($employeeData);

        $filehandler = fopen('./files/employeeData.json','w');
        $stringData = json_encode($employeeData);
        fwrite($filehandler,$stringData);
        fclose($filehandler);
        header("Location: http://localhost/PHP/M2J/EditUser.php");
    }
?>