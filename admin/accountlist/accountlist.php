<?php
//insert dg delete data qt da rubah so jadi mar yg delete masih ada bug, konng yang update blm jadi 
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    exit;
}
$page = 'accountlist'; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="accountlist.css">
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
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Account List</p>
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
            Insert Data
        </button>
        <div class="container tabel">
        <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Date time</th>
                        <th scope="col">Action</th>
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
                            $name = $row['username'];
                            $role = $row['role'];
                            
                            $create_date = $row['create_at'];

                            echo '
                            <tr>    
                                <td>'.$count.'</td>
                                <td>'.$name.'</td>
                                <td>'.$role.'</td>
                                <td>'.$create_date.'</td>
                                <td>
                                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $id; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $id; ?>">
                                    <li><a class="dropdown-item" href="UpdateUser.php" onclick="showUpdateButton(<?php echo $id; ?>)">Update</a></li>
                                    <li>
                                        <form action="deleteUser.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <button type="submit" class="dropdown-item" onclick="return confirm()">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            
                
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
                                    <option value="operator">Operator</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success" onclick="submitForm()">Insert</button>
                        </form>
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
    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
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


</body>
</html>
