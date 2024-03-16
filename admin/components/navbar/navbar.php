<nav>
    <i class='bx bx-menu'></i>
    <input type="checkbox" id="switch-mode" hidden>
    <div class="profile">
        <p>
            <?php echo $_SESSION["username"]; ?>
        </p>
        <img class="profile-img" src="../../img/Profile.svg">
        <img class="dropdown" src="../../img/Dropdown.svg">
        <ul class="dropdown-menu" style="left: auto; " aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" style="display: flex;" href="../home/home.php">Home <i
                        class='bx bx-home'></i></a></li>
            <li><a class="dropdown-item" style="display: flex;" href="../profile/profile.php">Profile <i
                        class='bx bx-user-circle'></i></a>
            </li>
            <li><a class="dropdown-item" style="display: flex;" href="../setting/setting.php">Setting <i
                        class='bx bx-cog'></i></a></li>
        </ul>
    </div>
</nav>