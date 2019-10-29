<?php

include '../koneksi.php';
$conn = $koneksi;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$namaloket2 = $_GET['namaloket2'];


$sql = "UPDATE loket_display SET nama_loket2 = '".$namaloket2."' where ID=0";

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
