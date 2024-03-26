<?php
include 'db_connection.php';

$plateNumber = $_POST['plateNumber'];

$sql = "SELECT * FROM tbl_plateregist WHERE plate_number = '$plateNumber'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'name' => $row['name'],
        'date' => date('Y-m-d'),
        'entry_time' => date('H:i:s')
    );
    echo json_encode($data);
} else {
    echo "not_found";
}
$conn->close();
?>