<?php

include '../koneksi.php';
$conn = $koneksi;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT nomer_loket6 FROM loket_display";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $status = $row["nomer_loket6"];
    }
    echo $status;
} else {
    echo "0";
}
$conn->close();
?>
