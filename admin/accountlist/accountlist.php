<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: http://localhost/upark");
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
                    <p>Account List</p>
                </div>
            </div>
            <div class="container tabel">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#insertModal">
                    Insert Data
                </button>
                <br>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connect.php';

                        $sql = "SELECT * FROM `tbl_account`";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $role = $row['role'];
                                $name = $row['username'];
                                $create_date = $row['create_at'];

                                echo '
                            <tr>
                                <td>' . $count . '</td>
                                <td>' . $name . '</td>
                                <td>' . $role . '</td>
                                <td>' . $create_date . '</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $id; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Options
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $id; ?>">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $id . '" data-username= "' . $name . '";>Update</a></li>
                                            <li><a class="dropdown-item delete-account" href="#" data-id="' . $id . '" data-username= "' . $name . '";> Delete</a></li>
                                        </ul>
                                    </div>
                                    <button id="updateButton_<?php echo $id; ?>" class="btn btn-primary mt-1" style="display: none;">Update</button>
                                    <button id="deleteButton_<?php echo $id; ?>" class="btn btn-danger mt-1" style="display: none;">Delete</button>
                                </td>
                            </tr>';
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php include 'modalupdate.php'; ?>

            <div class="modal fade" id="insertModal" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel">Insert Users</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Operator">Operator</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-info" onclick="submitForm()"
                                    name="submit">Insert</button>
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
        $(document).ready(function () {
            // Set default value for Role dropdown
            $('#role').val('admin');
        });

        function submitForm() {
            var username = $('#username').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var role = $('#exampleFormControlSelect1').val();

            // Validasi input
            if (username.trim() === '' || password.trim() === '' || confirm_password.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return; // Hentikan proses jika ada kolom yang kosong
            }

            // Validasi password
            if (password !== confirm_password) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and Confirm Password do not match!',
                });
                return;
            }

            // Kirim data ke server menggunakan Ajax
            $.ajax({
                type: "POST",
                url: "addUser.php",
                data: {
                    username: username,
                    password: password,
                    role: role
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Account added successfully!',
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later.',
                    });
                }
            });
        }


        function showUpdateButton(id) {
            $.ajax({
                url: 'modalupdate.php',
                type: 'GET',
                success: function (response) {
                    $('#updateModalContainer').html(response);
                    $('#updateModal').modal('show');

                    var username = $('#username_' + id).text();
                    $('#update_username').val(username);
                }
            });
        }
        $(document).ready(function () {
            $('.delete-account').click(function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var username = $(this).data('username');

                var confirmation = confirm("Are you sure you want to delete the account.ID : " + id + ' Username : ' + username + "?");
                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "deleteUser.php",
                        data: {
                            id: id
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Account deleted successfully!',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later.',
                            });
                        }
                    });
                }
            });
        });




    </script>




</body>

</html>