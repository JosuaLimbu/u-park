<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
	<link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="home.css">
	
    
</head>
<body>
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="../../img/U-Park.png" alt="" srcset="">
			<span class="text">U-PARK</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="home.php">
					<i class='bx bx-home' ></i>
					<span class="text">Home</span>
				</a>
			</li>
			<li>
				<a href="../vehicleentry/vehicleentry.php">
					<i class='bx bx-car' ></i>
					<span class="text">Vehicle Entry</span>
				</a>
			</li>
			<li>
				<a href="../plateregist/plateregist.php">
					<i class='bx bx-plus-circle'></i>
					<span class="text">Plate Regist</span>
				</a>
			</li>
			<li>
				<a href="../accountlist/accountlist.php">
					<i class='bx bx-user-circle' ></i>
					<span class="text">Account List</span>
				</a>
			</li>
			<li>
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
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
    		<i class='bx bx-menu'></i>
    		<input type="checkbox" id="switch-mode" hidden>
    		<div class="profile">
    			<p><?php echo $_SESSION["username"]; ?></p>
    			<img class="profile-img" src="../../img/Profile.svg">
    			<img class="dropdown" src="../../img/Dropdown.svg">
    			<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        			<li><a class="dropdown-item" href="home.php">Home <i class='bx bx-home' ></i></a></li>
        			<li><a class="dropdown-item" href="../profile/profile.php">Profile <i class='bx bx-user-circle' ></i></a></li>
        			<li><a class="dropdown-item" href="../setting/setting.php">Setting <i class='bx bx-cog' ></i></a></li>
    			</ul>
			</div>

</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
			<div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
    			<p>Home</p>
			</div>

				
			</div>

			<ul class="box-info">
				<li>
					<span class="text">
						<h3>Welcome</h3>
						<p><?php echo $_SESSION["username"]; ?></p>
					</span>
				</li>
				<li>
					<i class='bx bx-car' ></i>
					<span class="text">
						<h3>100 Vehicle</h3>
						<p>Today</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-time-five' ></i>
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
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
	<script src="datetime.js"></script>
	<script src="dropdown.js"></script>

</body>
</html>