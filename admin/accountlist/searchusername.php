<?php
include 'connect.php';

if (isset ($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    // Lakukan pencarian berdasarkan username
    $sql = "SELECT * FROM `tbl_account` WHERE `username` LIKE '%$keyword%'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <td>' . $count . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['role'] . '</td>
                <td>' . $row['create_at'] . '</td>
                <td>
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $id; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $id; ?>">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['id'] . '" onclick="iddata(' . $row['id'] . ')" data-role="update">Update</a></li>
                    <li><a class="dropdown-item delete-account" href="#" data-id="' . $row['id'] . '" ; onclick = "deletedata(' . $row['id'] . ')"> Delete</a></li>
                </ul>
                    </div>
                    <button id="updateButton_<?php echo $id; ?>"" class="btn btn-primary mt-1" style="display: none;" onclick="iddata(' . $row['id'] . ')" >Update</button>
                    <button id="deleteButton_ <?php echo $id; ?>" class="btn btn-danger mt-1" style="display: none; onclick = "deletedata(' . $row['id'] . ')">Delete</button>
                </td>
            </tr>';
            $count++;
        }
    } else {
        echo '<tr><td colspan="5">No records found.</td></tr>';
    }
} else {
    echo '<tr><td colspan="5">Invalid request.</td></tr>';
}
?>