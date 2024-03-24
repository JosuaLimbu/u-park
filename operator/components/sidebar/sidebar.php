<section id="sidebar" style="z-index: 1040;">
    <a href="#" class="brand" style="text-decoration : none;">
        <img src="../../img/U-Park.png" alt="" srcset="">
        <span class="text">U-PARK</span>
    </a>
    <ul class="side-menu top">
        <li <?php if ($page == 'home')
            echo 'class="active"'; ?>>
            <a href="../home/home.php" style="text-decoration : none;">
                <i class='bx bx-home'></i>
                <span class="text">Home</span>
            </a>
        </li>
        <li <?php if ($page == 'platedetection')
            echo 'class="active"'; ?>>
            <a href="../platedetection/platedetection.php" style="text-decoration : none;">
                <i class='bx bx-camera'></i>
                <span class="text">Plate Detection</span>
            </a>
        </li>
        <li <?php if ($page == 'vehicleentry')
            echo 'class="active"'; ?>>
            <a href="../vehicleentry/vehicleentry.php" style="text-decoration : none;">
                <i class='bx bx-car'></i>
                <span class="text">Vehicle Entry</span>
            </a>
        </li>
        <li <?php if ($page == 'info')
            echo 'class="active"'; ?>>
            <a href="../info/info.php" style="text-decoration : none;">
                <i class='bx bx-info-circle'></i>
                <span class="text">Info</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="../../logout.php" class="logout" style="text-decoration : none;">
                <i class='bx bx-log-out'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>