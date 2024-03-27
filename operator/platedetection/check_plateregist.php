<?php
include 'db_connection.php';

$platedetect = $_POST['platedetect'];

$sql = "SELECT * FROM tbl_plateregist WHERE plate_number = '$platedetect'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'name' => $row['name'],
        'plate_number' => $row['plate_number'],
        'date' => date('Y-m-d'),
        'entry_time' => date('h:i:s A')
    );
    echo json_encode($data);
} else {
    echo "not_found";
}
$conn->close();
?>