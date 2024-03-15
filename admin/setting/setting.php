<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: http://localhost/upark");
}
$page = ''; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="setting.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="container">
        <h2>Change Password</h2>
        
        <form action="changePas.php" method="POST">
            <label for="old_password">Current Password:</label><br>
            <input type="password" id="old_password" name="old_password" required><br>

<<<<<<< HEAD
            <ul class="box-info">
                <li>
                    <span class="text">
                        <h3>Welcome</h3>
                        <p>
                            <?php echo $_SESSION["username"]; ?>
                        </p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-car'></i>
                    <span class="text">
                        <h3>100 Vehicle</h3>
                        <p>Today</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-time-five'></i>
                    <span class="text">
                        <h3 id="current-time"></h3>
                        <p id="current-date"></p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>About U-Park</h3>
                    </div>
                    <span class="text">
                        <p>U-Park is a parking management system that uses Number Plate Recognition (NPR)
                            technology to manage parking at Klabat University. The U-Park application
                            utilizes NPR technology to detect and record vehicle license plates as they
                            enter the campus parking area. With U-Park, parking managers can monitor and
                            manage parking capacity, and optimize the use of parking spaces. In addition,
                            admins and operators can easily register vehicles, access information about the
                            availability of parking spaces. Thus, U-Park provides an effective and efficient
                            solution in managing the parking system on the Klabat University campus.</p>
                    </span>
                </div>
            </div>
=======
            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br>

            <label for="confirm_new_password">Confirm New Password:</label><br>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required><br>
            <br>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
>>>>>>> c220c0ea72addbb28de70b814bcfde9cdc25f952
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
</body>

</html>