<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: http://localhost/u-park");
    exit;
}
$page = 'vehicleentry'; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Entry</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="vehicleentry.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="jam.css">
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
                    <p>Vehicle Entry</p>
                </div>
            </div>
            <div class="box-top">
                <div class="box">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" name="search" id="search" placeholder="Search by name">
                </div>
                <i class='bx bx-filter'> </i>
                <input type="date" class="form-control" id="date" name="date"
                    style="background-color: rgba(255, 255, 255, 0); margin-left: 15px; width: 140px;  ">
            </div>

            <div class="box-container">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Plate Number</th>
                        <th scope="col">Date</th>
                        <th scope="col">Entry Time</th>
                        <th scope="col">Exit Time</th>
                    </tr>
                </thead>
                <tbody id="searchResult">
                    <?php
                    include 'connect.php';

                    $sql = "SELECT * FROM `tbl_vehicleentry` ORDER BY id DESC";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $plate_number = $row['plate_number'];
                            $date = $row['date'];
                            $entry_time = $row['entry_time'];
                            $exit_time = $row['exit_time'];

                            echo '
                            <tr id = ' . $row['id'] . '>
                                <td>' . $name . '</td>
                                <td>' . $plate_number . '</td>
                                <td>' . $date . '</td>
                                <td>' . $entry_time . '</td>
                                <td>' . $exit_time . '</td>
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
                            <h5 class="modal-title" id="updateModalLabel">Update Plate Regist</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm">
                                <div class="mb-3">
                                    <label for="update_name" class="form-label">New Name</label>
                                    <input type="text" class="form-control" id="newname" name="newname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="update_platenumber" class="form-label">New Plate Number</label>
                                    <input type="text" class="form-control" id="newplatenumber" name="newplatenumber"
                                        required>
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
                            <h5 class="modal-title" id="insertModalLabel">Create New Plate Regist</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- Form menggunakan AJAX -->
                            <form id="insertForm">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Plate Number</label>
                                    <input type="text" class="form-control" id="plate_number" name="plate_number"
                                        required>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
    <script src="script.js"></script>
    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
    <script>
        $(document).ready(function () {
            $('#role').val('admin');
        });

        $(document).ready(function () {
            $('#search').on('keyup', function () {
                searchByName();
            });
        });

        $(document).ready(function () {
            $('#date').hide();

            $('.bx-filter').click(function () {
                $('#date').toggle();
            });

        });

        $('#date').change(function () {
            var selectedDate = $('#date').val();
            if (selectedDate.trim() === '') {
                $('#searchResult').load('vehicleentry.php #searchResult > *');
            } else {
                $.ajax({
                    url: 'filterbydate.php',
                    type: 'POST',
                    data: { selectedDate: selectedDate },
                    success: function (response) {
                        $('#searchResult').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#searchResult').html('<tr><td colspan="5">An error occurred while processing your request.</td></tr>');
                    }
                });
            }
        });

        function submitForm() {
            var name = $('#name').val();
            var plate_number = $('#plate_number').val();

            // Validasi input
            if (name.trim() === '' || plate_number.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return; // Hentikan proses jika ada kolom yang kosong
            }

            // Kirim data ke server menggunakan Ajax
            $.ajax({
                type: "POST",
                url: "addnumberplate.php",
                data: {
                    name: name,
                    plate_number: plate_number,
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'New Plate Number added successfully!',
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
                url: 'deletenumberplate.php',
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
            var newname = $("#newname").val();
            var newplatenumber = $("#newplatenumber").val();

            if (newname.trim() === '' || newplatenumber.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }
            $.ajax({
                url: "updatenumberplate.php",
                type: "POST",
                data: {
                    id: id,
                    newname: newname,
                    newplatenumber: newplatenumber
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Updated Successfully!',
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }

        function searchByName() {
            var keyword = $('#search').val().trim();
            if (keyword === '') {
                $('#searchResult').load('vehicleentry.php #searchResult > *');
            } else {
                $.ajax({
                    url: 'searchname.php',
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