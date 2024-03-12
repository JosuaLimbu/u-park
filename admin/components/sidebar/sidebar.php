<section id="sidebar">
    <a href="#" class="brand">
        <img src="../../img/U-Park.png" alt="" srcset="">
        <span class="text">U-PARK</span>
    </a>
    <ul class="side-menu top">
        <li <?php if ($page == 'home') echo 'class="active"'; ?>>
            <a href="../home/home.php">
                <i class='bx bx-home' ></i>
                <span class="text">Home</span>
            </a>
        </li>
        <li <?php if ($page == 'vehicleentry') echo 'class="active"'; ?>>
            <a href="../vehicleentry/vehicleentry.php">
                <i class='bx bx-car' ></i>
                <span class="text">Vehicle Entry</span>
            </a>
        </li>
        <li <?php if ($page == 'plateregist') echo 'class="active"'; ?>>
            <a href="../plateregist/plateregist.php">
                <i class='bx bx-plus-circle'></i>
                <span class="text">Plate Regist</span>
            </a>
        </li>
        <li <?php if ($page == 'accountlist') echo 'class="active"'; ?>>
            <a href="../accountlist/accountlist.php">
                <i class='bx bx-user-circle' ></i>
                <span class="text">Account List</span>
            </a>
        </li>
        <li <?php if ($page == 'info') echo 'class="active"'; ?>>
            <a href="../info/info.php">
                <i class='bx bx-info-circle'></i>
                <span class="text">Info</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="../../logout.php" class="logout"> 
                <i class='bx bx-log-out'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
