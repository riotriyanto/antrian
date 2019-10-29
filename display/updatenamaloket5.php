<?php
include '../koneksi.php';
$conn = $koneksi;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$namaloket5 = $_GET['namaloket5'];




$sql = "UPDATE loket_display SET nama_loket5 = '".$namaloket5."' where ID=0";

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
