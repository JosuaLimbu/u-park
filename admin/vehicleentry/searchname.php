<?php
$servername = "localhost";
$username = "root";
$password = "limbujosua23";
$dbname = "db_upark";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

$keyword = $_POST['keyword'];

if ($keyword == "") {
    $sql = "SELECT * FROM tbl_vehicleentry";
} else {
    $sql = "SELECT * FROM tbl_vehicleentry WHERE name LIKE '%$keyword%' || plate_number LIKE '%$keyword%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $plate_number = $row['plate_number'];
        $date = $row['date'];
        $entry_time = $row['entry_time'];
        $exit_time = $row['exit_time'];

        echo '<tr>
                <td>' . $name . '</td>
                <td>' . $plate_number . '</td>
                <td>' . $date . '</td>
                <td>' . $entry_time . '</td>
                <td>' . $exit_time . '</td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="6">No records found</td></tr>';
}


$conn->close();
