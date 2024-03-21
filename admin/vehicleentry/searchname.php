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

if (empty ($keyword)) {
    $sql = "SELECT * FROM tbl_plateregist";
} else {
    $sql = "SELECT * FROM tbl_plateregist WHERE name LIKE '%$keyword%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['plate_number'] . '</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_' . $row['id'] . '" data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_' . $row['id'] . '">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['id'] . '" onclick="iddata(' . $row['id'] . ')" data-role="update">Update</a></li>
                            <li><a class="dropdown-item delete-account" href="#" data-id="' . $row['id'] . '" onclick="deletedata(' . $row['id'] . ')"> Delete</a></li>
                        </ul>
                    </div>
                    <button id="updateButton_' . $row['id'] . '" class="btn btn-primary mt-1" style="display: none;" onclick="iddata(' . $row['id'] . ')">Update</button>
                    <button id="deleteButton_' . $row['id'] . '" class="btn btn-danger mt-1" style="display: none;" onclick="deletedata(' . $row['id'] . ')">Delete</button>
                </td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="5">No records found</td></tr>';
}

$conn->close();
