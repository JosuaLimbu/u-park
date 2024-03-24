<?php
include 'connect.php';

if (isset ($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];
    $formattedDate = date('d F Y', strtotime($selectedDate));

    $sql = "SELECT * FROM `tbl_vehicleentry` WHERE `date` = '$formattedDate' ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    $output = '';
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr id="' . $row['id'] . '">';
            $output .= '<td>' . $row['name'] . '</td>';
            $output .= '<td>' . $row['plate_number'] . '</td>';
            $output .= '<td>' . $row['date'] . '</td>';
            $output .= '<td>' . $row['entry_time'] . '</td>';
            $output .= '<td>' . $row['exit_time'] . '</td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="5">No data found for selected date.</td></tr>';
    }

    echo $output;
} else {
    echo 'Error: No selected date received.';
}
