<?php
$servername = "localhost";
$username = "root";
$password = "klaten@!?";
$dbname = "antrian";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$nomerloket5 = $_GET['nomerloket5'];



$sql = "UPDATE loket_display SET nomer_loket5 = '".$nomerloket5."' where ID=0";

$result = $conn->query($sql);
if($result)
{
$return = array("OK");
}
else
{
$return = array("pesan" => "gagal");
}
echo json_encode($return);
$conn->close();

?>
