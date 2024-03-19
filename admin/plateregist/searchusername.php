<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "limbujosua23";
$dbname = "db_upark";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// Ambil keyword pencarian dari POST
$keyword = $_POST['keyword'];

// Jika keyword kosong, tampilkan semua data
if (empty ($keyword)) {
    $sql = "SELECT * FROM tbl_account";
} else {
    // Query pencarian berdasarkan username
    $sql = "SELECT * FROM tbl_account WHERE username LIKE '%$keyword%'";
}

$result = $conn->query($sql);

// Tampilkan hasil pencarian
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tampilkan data dalam format yang diinginkan
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['role'] . '</td>
                <td>' . $row['create_at'] . '</td>
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
    // Tampilkan pesan jika tidak ada hasil pencarian
    echo '<tr><td colspan="5">No records found</td></tr>';
}

$conn->close();
?>