<?php
include '../koneksi.php';
$conn = $koneksi;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$nomerloket6 = $_GET['nomerloket6'];



$sql = "UPDATE loket_display SET nomer_loket6 = '".$nomerloket6."' where ID=0";

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
