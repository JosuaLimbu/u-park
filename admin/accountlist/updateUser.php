<?php
include 'connect.php';
    
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $id = $_GET['updateid'];
    $id = $_POST['id'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //$create_at = $_POST('create_at');

    $sql = "UPDATE `tbl_account` SET role='$role', username='$username', password='$password' WHERE id='$id'";
    $result = mysqli_query($con, $sql); // Perbaikan: menambahkan tanda '='
    
    if ($result) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>


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
    <link rel="stylesheet" href="accountlist.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	
    
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
    			<img class="profile-img" src="../img/Profile.svg">
    			<img class="dropdown" src="../img/Dropdown.svg">
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
		<h2>Insert Data Account</h2>
        <div class="container mt-5">
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
            Insert Data
        </button>
<div class="container tabel">
    <table class="table">
        <thead>
            <tr>
              <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Date time</th>
            </tr>
        </thead>
        <tbody>
        <?php
                    include 'connect.php';

                        $sql = "SELECT * FROM `tbl_account`";
                        $result = mysqli_query($con, $sql);
                        if($result){
                            $count = 1;
                            while ($row=mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $role = $row['role'];
                                $name = $row['username'];
                                $create_date = $row['create_at'];

                                echo '
                                <tr>
                                    <td>'.$count.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$role.'</td>
                                    <td>'.$create_date.'</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_'.$id.'" data-bs-toggle="dropdown" aria-expanded="false">
                                                Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_'.$id.'">
                                                <li><a class="dropdown-item" href="UpdateUser.php" onclick="showUpdateButton('.$id.')">Update</a></li>
                                                <li><a class="dropdown-item" href="deleleteUser.php" onclick="showDeleteButton('.$id.')">Delete</a></li>
                                            </ul>
                                        </div>
                                        <button id="updateButton_'.$id.'" class="btn btn-primary mt-1" style="display: none;">Update</button>
                                        <button id="deleteButton_'.$id.'" class="btn btn-danger mt-1" style="display: none;">Delete</button>
                                    </td>
                                </tr>';
                                $count++;
                            }
                        }
                    ?>
        </tbody>
    </table> 
</div> 
        <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertModalLabel">Insert Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form menggunakan AJAX -->
                        <form id="insertForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">Operator</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success" onclick="submitForm()">Insert</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function submitForm() {
                var username = $('#username').val();
                var password = $('#password').val();
                var role = $('#role').val();

                if (username.trim() == '' || password.trim() == '' || role.trim() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Kolom data tidak boleh kosong!',
                    });
                    return;
                }

                var formData = $('#insertForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: 'addUser.php',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#insertModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: response,
                        });
                        // Clear form fields after successful insertion
                        $('#username').val('');
                        $('#password').val('');
                        $('#role').val('');
                        loadTable();
                    },
                    error: function(error) {
                        console.error('Gagal menambahkan data:', error);
                    }
                });
            }
        </script>
    

	<script src="script.js"></script>
	<script src="datetime.js"></script>
	<script src="dropdown.js"></script>

</body>
</html>