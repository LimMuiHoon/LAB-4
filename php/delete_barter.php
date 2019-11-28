<?php
error_reporting(0);
include_once("dbconnect.php");
$jobid = $_POST['barterid'];
$sql     = "DELETE FROM BARTER WHERE barterid = $barterid";
    if ($conn->query($sql) === TRUE){
        echo "success";
    }else {
        echo "failed";
    }

$conn->close();
?>