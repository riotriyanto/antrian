<?php
$servername = "localhost";
$username = "root";
$password = "klaten@!?";
$dbname = "antrian";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$namaloket4 = $_GET['namaloket4'];




$sql = "UPDATE loket_display SET nama_loket4 = '".$namaloket4."' where ID=0";

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
