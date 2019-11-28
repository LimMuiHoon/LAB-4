<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];

$sql = "SELECT * FROM BARTER WHERE BARTERWORKER = '$email' ORDER BY BARTERID DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response["barter"] = array();
    while ($row = $result ->fetch_assoc()){
        $barterlist = array();
        $barterlist[barterid] = $row["BARTERID"];
        $barterlist[bartertitle] = $row["BARTERTITLE"];
        $barterlist[barterowner] = $row["BARTEROWNER"];
        $barterlist[barterprice] = $row["BARTERPRICE"];
        $barterlist[barterdesc] = $row["BARTERDESC"];
        $barterlist[bartertime] = date_format(date_create($row["pBARTERTIME"]), 'd/m/Y h:i:s');
        $barterlist[barterimage] = $row["BARTERIMAGE"];
        $barterlist[barterlatitude] = $row["LATITUDE"];
        $barterlist[barterlongitude] = $row["LONGITUDE"];
        $barterlist[barterrating] = $row["RATING"];
        array_push($response["barter"], $barterlist);    
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

?>