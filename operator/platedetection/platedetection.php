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
                    <button class="btn btn-info" id="enableButton1"><i class='bx bx-camera'></i> Enable</button>
                    <button class="btn btn-info" id="disableButton1"><i class='bx bx-camera-off'></i> Disable</button>
                </div>
                <div class="gate">
                    <h5>Exit Gate</h5>
                    <button class="btn btn-info" id="enableButton2"><i class='bx bx-camera'></i> Enable</button>
                    <button class="btn btn-info" id="disableButton2"><i class='bx bx-camera-off'></i> Disable</button>
                </div>
            </div>
            <br>
            <div class="gate-content-container1" style="display: none;">
                <div class=" gate-content-left">
                    <div>
                        <p>Entrance Gate Cam</p>
                        <img id="detectedImage" src="../../yolov5/videostream/0_detected.jpg" alt="Entrance Gate"
                            style="width: 85%">
                    </div>
                </div>
                <div class="gate-content-right">
                    <div>
                        <div>
                            <p class="platedetect"></p>
                            <p>Number Plate Detect</p>
                        </div>
                    </div>
                    <br><br><br>
                    <div>
                        <label class="switch">
                            <input type="checkbox" id="gateSwitch">
                            <span class="slider round"></span>
                        </label>
                        <p id="gateStatus">Gate Closed</p>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function updateImage() {
            var detectedImage = document.getElementById("detectedImage");
            detectedImage.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
        }
        setInterval(updateImage, 100);

        document.getElementById("enableButton1").addEventListener("click", function () {
            document.querySelector(".gate-content-container1").style.display = "flex";
            fetch("http://localhost:5000/opencam");
        });

        document.getElementById("disableButton1").addEventListener("click", function () {
            document.querySelector(".gate-content-container1").style.display = "none";
            fetch("http://localhost:5000/closecam");

            $.ajax({
                url: 'clearplatein.php',
                type: 'POST',
                data: { action: 'delete_latest_plate' },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        document.getElementById("gateSwitch").addEventListener("change", function () {
            var gateStatusText = document.getElementById("gateStatus");
            if (this.checked) {
                gateStatusText.textContent = "Gate Open";
            } else {
                gateStatusText.textContent = "Gate Closed";
            }
        });

        $(document).ready(function () {
            function loadData() {
                $.ajax({
                    url: 'getnewplatein.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('.platedetect').text(response.plate_number);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            setInterval(loadData, 100);
        });

        //function mengecek deteksi dengan plateregist
        $(document).ready(function () {
            function loadData() {
                $.ajax({
                    url: 'getnewplatein.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var plateNumber = response.plate_number;
                        $('.platedetect').text(plateNumber);

                        $.ajax({
                            url: 'check_plateregist.php',
                            type: 'POST',
                            data: { plateNumber: plateNumber },
                            success: function (response) {
                                if (response == 'found') {
                                    // Aktifkan switch
                                    $('#gateSwitch').prop('checked', true);
                                    $('#gateStatus').text('Gate Open');

                                    // Kirim data ke tbl_vehicleentry
                                    $.ajax({
                                        url: 'post_vehicleentry.php',
                                        type: 'POST',
                                        data: {
                                            name: response.name,
                                            plateNumber: plateNumber,
                                            date: response.date,
                                            entryTime: response.entry_time
                                        },
                                        success: function (response) {
                                            console.log(response);
                                        },
                                        error: function (xhr, status, error) {
                                            console.error(xhr.responseText);
                                        }
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            setInterval(loadData, 100);
        });
    </script>


</body>

</html>