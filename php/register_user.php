<?php
//error_reporting(0);
include_once ("dbconnect.php");
$email = $_POST['EMAIL'];
$password = sha1($_POST['PASSWORD']);
$phone = $_POST['PHONE'];
$name = $_POST['NAME'];
$encoded_string = $_POST["encoded_string"];
$decoded_string = base64_decode($encoded_string);
$sqlinsert = "INSERT INTO USER(NAME,EMAIL,PASSWORD,PHONE,VERIFY) VALUES ('$name','$email','$password','$phone','0')";

if($conn->query($sqlinsert) === TRUE) {
    $path = '../profile/'.$email.'.jpg';
    file_put_contents($path, $decoded_string);
    sendEmail($email);
    echo "success";
} else {
    echo "failed";
}

function sendEmail($useremail) {
    $to         = $useremail;
    $subject    = 'Verification for MyTradeBarterUser';
    $message    = 'https://tradebarterflutter.com/mytradebarter(user)%20/php/verify.php?email='.$useremail;
    $headers    = 'From: noreply@MyTradeBarterUser.com.my' . "\r\n" .
    'Reply-To: '.$useremail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}

?>