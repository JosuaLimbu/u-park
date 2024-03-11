<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root";
    $password = "limbujosua23"; 
    $dbname = "db_upark"; 
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM tbl_account WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if ($role == 'admin') {
            header("Location: $role/home/home.php");
        } elseif ($role == 'operator') {
            header("Location: $role/home/home.php");
        }
    } else {
        $error_message = "Incorrect username or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Park</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="img/U-Park.png">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign In</h1> <br>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
                <div class="input-container">
                    <img src="img/usericon.svg" alt="Username Icon">
                    <input type="username" name="username" placeholder="Username" required />
                </div>
                <div class="input-container">
                    <img src="img/passicon.svg" alt="Password Icon">
                    <input type="password" name="password" id="password" placeholder="Password" required />
                    <i class="far fa-eye-slash" id="togglePassword"></i>
                </div>
                <?php if(isset($error_message)) { ?>
                    <p class="err"><?php echo $error_message; ?></p>
                <?php } ?>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="img/U-Park.png" alt="">
                    <p class="textright">U - P A R K</p>
                </div>
            </div>
        </div>
    </div>
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        if (type === 'password') {
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
    </script>


</body>
</html>
