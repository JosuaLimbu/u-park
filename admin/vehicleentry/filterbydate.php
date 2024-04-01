<?php
include 'connect.php';

if (isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];

    $dateParts = explode('-', $selectedDate);
    $day = intval($dateParts[2]);
    $month = intval($dateParts[1]);
    $year = intval($dateParts[0]);

    $months = array(
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    );

    $formattedDate = $day . ' ' . $months[$month] . ' ' . $year;

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
?>