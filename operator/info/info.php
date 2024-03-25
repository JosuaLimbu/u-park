<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: http://localhost/u-park");
}
$page = 'info'; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<style>
    :root {
        --blue: #04A6B5;
    }

    a {
        text-decoration: none;
    }
</style>

<body style="background-color: #eee;">
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Info</p>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>U-Park</h3>
                    </div>
                    <span class="text">
                        <p>U-Park, which stands for "Unklab Parking", is an application system born out of an innovative
                            collaboration between Limbu, Josua and Korengkeng, Vito Julio, in response to the demands of
                            their Research Project. Adapting cutting-edge technologies such as Deep Learning and
                            Internet Of Things and combining them with the practical needs of users, U-Park emerged as a
                            revolutionary solution in parking management at the Klabat University complex. <br>
                            As an innovation that utilizes advanced technology, U-Park is designed to address parking
                            challenges on campus with an efficient and structured approach. By integrating Number Plate
                            Recognition (NPR) technology, U-Park makes it easier for parking managers to register
                            eligible vehicles and access parking data quickly. Through this platform, users can not only
                            track the entry and exit of vehicles in real-time, but can also solve the problem of
                            irregular parking. <br>
                            <img src="../../img/park.jpg" alt="Image" style="width:50%"><br>
                            In addition to its basic features, U-Park is also equipped with various other advanced
                            features. From monitoring vehicle parking status in real-time to optimizing surveillance
                            through cameras, the app also enables automatic access to parking portals. In addition to
                            contributing to improving the efficiency and regularity of parking on campus, U-Park also
                            specifically addresses the parking needs of lecturers so that their dedicated parking spaces
                            can be optimally utilized. <br>
                            With an intuitive and easy-to-use interface, U-Park not only provides operational
                            convenience for users, but also a reliable solution to parking problems on campus. With
                            U-Park, users can save time, reduce the frustration of finding a parking space, and increase
                            their productivity. Thus, U-Park is not just a parking app, but a reliable partner in
                            addressing parking needs on campus. <br>
                            For information, assistance, or how to use, please contact <a
                                href="https://wa.me/6285756958367">+62857 5695 8367</a>. <br><br>
                        <p style="text-align: center;">©2024 Limbu, Josua and Korengkeng, Vito Julio. All rights
                            reserved.</p>
                        </p>
                    </span>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
</body>

</html>