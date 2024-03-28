<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: http://localhost/u-park");
}
$page = ''; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="setting.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    :root {
        --ijo: #04A6B5;
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
                    <p>Setting</p>
                </div>
            </div>
            <div class="container">

                <form action="changePas.php" method="POST">
                    <label for="old_password">Current Password:</label><br>
                    <div class="input-container">
                        <input type="password" id="old_password" name="old_password" required><br>
                        <i class="far fa-eye-slash" id="togglePassword"></i>
                    </div>
                    <label for="new_password">New Password:</label><br>
                    <div class="input-container">
                        <input type="password" id="new_password" name="new_password" required><br>
                        <i class="far fa-eye-slash" id="togglePassword2"></i>
                    </div>
                    <label for="confirm_new_password">Confirm New Password:</label><br>
                    <div class="input-container">
                        <input type="password" id="confirm_new_password" name="confirm_new_password" required><br>
                        <i class="far fa-eye-slash" id="togglePassword3"></i>
                    </div>
                    <br>
                    <button type="button" class="btn btn-info" onclick="submitForm()">Change Password</button>
                </form>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function submitForm() {
            var oldPassword = $('#old_password').val().trim();
            var newPassword = $('#new_password').val().trim();
            var confirmNewPassword = $('#confirm_new_password').val().trim();

            // Memeriksa apakah ada field yang kosong
            if (oldPassword === '' || newPassword === '' || confirmNewPassword === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }

            if (newPassword !== confirmNewPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'New Password and Confirm New Password do not match!',
                });
                return;
            }

            // Mengirim data form dengan AJAX
            $.ajax({
                type: 'POST',
                url: 'changePas.php',
                data: {
                    old_password: oldPassword,
                    new_password: newPassword,
                    confirm_new_password: confirmNewPassword
                },
                success: function (response) {
                    if (response === "Old Password Incorrect") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Old Password Incorrect',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while changing password! Please try again later.',
                    });
                }
            });
        }

        const togglePassword = document.getElementById('togglePassword');
        const togglePassword2 = document.getElementById('togglePassword2');
        const togglePassword3 = document.getElementById('togglePassword3');
        const oldPasswordInput = document.getElementById('old_password');
        const newPasswordInput = document.getElementById('new_password');
        const confirmNewPasswordInput = document.getElementById('confirm_new_password');

        togglePassword.addEventListener('click', function () {
            const type = oldPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            oldPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        togglePassword2.addEventListener('click', function () {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        togglePassword3.addEventListener('click', function () {
            const type = confirmNewPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmNewPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>


</body>

</html>