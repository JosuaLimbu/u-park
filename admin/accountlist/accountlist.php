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
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <div class="box-top">
                <div class="box">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" name="search" id="search" placeholder="Search by username">
                </div>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#insertModal">
                    Insert Data
                </button>
            </div>

            <div class="box-container">
            </div>
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
                <tbody id="searchResult">
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
                            <tr id = ' . $row['id'] . '>
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
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['id'] . '" onclick="iddata(' . $row['id'] . ')" data-role="update">Update</a></li>
                                            <li><a class="dropdown-item delete-account" href="#" data-id="' . $row['id'] . '" ; onclick = "deletedata(' . $row['id'] . ')"> Delete</a></li>
                                        </ul>
                                    </div>
                                    <button id="updateButton_<?php echo $id; ?>"" class="btn btn-primary mt-1" style="display: none;" onclick="iddata(' . $row['id'] . ')" >Update</button>
                                    <button id="deleteButton_ <?php echo $id; ?>" class="btn btn-danger mt-1" style="display: none; onclick = "deletedata(' . $row['id'] . ')">Delete</button>
                                </td>
                            </tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>

            <div class="modal fade" id="updateModal" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm">
                                <div class="mb-3">
                                    <label for="update_username" class="form-label">New Username</label>
                                    <input type="text" class="form-control" id="newUsername" name="newUsername"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="confirmPassword" required>
                                </div>
                                <button class="btn btn-info" id="result" name="submit" onclick="updatedata(this.id)"
                                    name="submit">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="insertModal" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel">Create New Account</h5>
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
                                <button type="button" class="btn btn-info" onclick="submitForm()" name="submit">Insert
                                </button>
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
            $('#role').val('admin');
        });
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                searchByUsername();
            });
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
                dataType: "json", // Menggunakan JSON sebagai tipe data respons
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Account added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
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


        function deletedata(id) {
            $.ajax({
                url: 'deleteUser.php',
                type: 'POST',
                data: {
                    id: id,
                    action: "delete"
                },

                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Account delete successfully!',
                        }).then(() => {
                            location.reload();
                        });
                        $('#row_' + id).remove();
                    } else if (response == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Data Cannot Be Deleted',
                        }).then(() => {
                            location.reload();
                        });

                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Something went wrong! Please try again later.");
                }
            });
        }

        //ambil nilai id di atas
        function iddata(id) {
            document.getElementById("result").setAttribute("onclick", "updatedata(" + id + ")");//rubah id result
        }

        //baru tampung. 
        function updatedata(id) {
            event.preventDefault();
            var newUsername = $("#newUsername").val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();

            if (newUsername.trim() === '' || newPassword.trim() === '' || confirmPassword.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }

            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'New password and confirm password do not match.',
                });

                return;
            }
            $.ajax({
                url: "updateUser.php",
                type: "POST",
                data: {
                    id: id,
                    newUsername: newUsername,
                    newPassword: newPassword
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Account Updated Successfully!',
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
        function searchByUsername() {
            var keyword = $('#search').val().trim();
            if (keyword === '') {
                $('#searchResult').load('accountlist.php #searchResult > *');
            } else {
                $.ajax({
                    url: 'searchusername.php',
                    type: 'POST',
                    data: { keyword: keyword },
                    success: function (response) {
                        $('#searchResult').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#searchResult').html('<tr><td colspan="5">An error occurred while processing your request.</td></tr>');
                    }
                });
            }
        }


    </script>




</body>

</html>