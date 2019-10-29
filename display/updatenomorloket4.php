<?php
include '../koneksi.php';
$conn = $koneksi;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$nomerloket4 = $_GET['nomerloket4'];



$sql = "UPDATE loket_display SET nomer_loket4 = '".$nomerloket4."' where ID=0";

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
