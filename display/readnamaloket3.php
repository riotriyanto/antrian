<?php
$servername = "localhost";
$username = "root";
$password = "klaten@!?";
$dbname = "antrian";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $sql = "SELECT nama_loket3 FROM loket_display";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         $status = $row["nama_loket3"];
//     }
//     echo $status;
// } else {
//     echo "0";
// }
// $conn->close();
$sql = "SELECT nomor_loket FROM loket where id_loket=3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $status = $row["nomor_loket"];
    }
    echo "Loket ".$status;
} else {
    echo "0";
}
$conn->close();
?>
