<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: http://localhost/u-park");
}
$page = 'platedetection'; //buat page aktif di sidebar
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plate Detection</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="platedetection.css">
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
                    <p>Plate Detection</p>
                </div>
            </div>
            <div class="gate-container">
                <div class="gate">
                    <h5>Entrance Gate</h5>
                    <button class="btn btn-info" id="enableButton"><i class='bx bx-camera'></i> Enable</button>
                    <button class="btn btn-info" id="disableButton"><i class='bx bx-camera-off'></i> Disable</button>
                </div>
            </div>
            <br>
            <div class="gate-content-container" style="display: none;">
                <div class=" gate-content-left">
                    <div>
                        <p>Entrance Gate</p>
                        <img id="detectedImage" src="../../yolov5/videostream/0_detected.jpg" alt="Image Description">
                    </div>
                </div>
                <div class="gate-content-right">
                    <div>
                        <label class="switch">
                            <input type="checkbox" id="gateSwitch">
                            <span class="slider round"></span>
                        </label>
                        <p id="gateStatus">Close Gate</p>
                    </div>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
    <script>
        function updateImage() {
            var detectedImage = document.getElementById("detectedImage");
            detectedImage.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
        }
        setInterval(updateImage, 100);

        document.getElementById("enableButton").addEventListener("click", function () {
            document.querySelector(".gate-content-container").style.display = "flex";
            fetch("http://localhost:5000/opencam");
        });

        document.getElementById("disableButton").addEventListener("click", function () {
            document.querySelector(".gate-content-container").style.display = "none";
            fetch("http://localhost:5000/closecam");
        });


        document.getElementById("gateSwitch").addEventListener("change", function () {
            var gateStatusText = document.getElementById("gateStatus");
            if (this.checked) {
                gateStatusText.textContent = "Open Gate";
            } else {
                gateStatusText.textContent = "Close Gate";
            }
        });
    </script>

</body>

</html>