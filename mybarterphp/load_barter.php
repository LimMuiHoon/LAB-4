<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$radius = $_POST['radius'];

$sql = "SELECT * FROM BARTER WHERE BARTERWORKER IS NULL ORDER BY BARTERID DESC";

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
        $barterlist[bartertime] = date_format(date_create($row["BARTERTIME"]), 'd/m/Y h:i:s');
        $barterlist[barterimage] = $row["BARTERIMAGE"];
        $barterlist[barterlatitude] = $row["LATITUDE"];
        $barterlist[barterlongitude] = $row["LONGITUDE"];
        $barterlist[km] = distance($latitude,$longitude,$row["LATITUDE"],$row["LONGITUDE"]);
        $barterlist[barterrating] = $row["RATING"];
        //$joblist[radius] = $row["LATITUDE"];
        if (distance($latitude,$longitude,$row["LATITUDE"],$row["LONGITUDE"])<$radius){
            array_push($response["barter"], $barterlist);    
        }
    }
    echo json_encode($response);
}else{
    echo "nodata";
}

function distance($lat1, $lon1, $lat2, $lon2) {
   $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;

    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;

    //echo '<br/>'.$km;
    return $km;
}

?>