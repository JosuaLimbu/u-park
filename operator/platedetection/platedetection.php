<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "operator") {
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
            <br>

            <div class="gate-container">
                <div class="gate">
                    <h5>Entrance Gate</h5>
                    <button class="btn btn-info" id="enableButton1"><i class='bx bx-camera'></i> Enable</button>
                    <button class="btn btn-info" id="disableButton1"><i class='bx bx-camera-off'></i>
                        Disable</button>
                    <br><br>
                    <!-- untuk entry gate -->
                    <div class="gate-content-container1" style="display: none;">
                        <div class=" gate-content-left">
                            <div>
                                <p>Entrance Gate Cam</p>
                                <img id="detectedImage" src="../../yolov5/videostream/0_detected.jpg"
                                    alt="Entrance Gate" style="width: 85%; border-radius: 10px;">
                            </div>
                        </div>
                        <div class="gate-content-right">
                            <div>
                                <div>
                                    <p class="platedetect"></p>
                                    <p>Number Plate Detect</p>
                                </div>
                            </div>
                            <div>
                                <label class="switch">
                                    <input type="checkbox" id="gateSwitch1">
                                    <span class="slider round"></span>
                                </label>
                                <p id="gateStatus1">Gate Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gate">
                    <h5>Exit Gate</h5>
                    <button class="btn btn-info" id="enableButton2"><i class='bx bx-camera'></i> Enable</button>
                    <button class="btn btn-info" id="disableButton2"><i class='bx bx-camera-off'></i>
                        Disable</button>
                    <br><br>
                    <!-- Untuk exit gate -->
                    <div class="gate-content-container2" style="display: none;">
                        <div class="gate-content-left">
                            <div>
                                <p>Exit Gate Cam</p>
                                <img id="detectedImage2" src="../../yolov5/videostream/0_detected.jpg"
                                    alt="Exit Gate Cam" style="width: 85%;border-radius: 10px;">
                            </div>
                        </div>
                        <div class="gate-content-right">
                            <div>
                                <div>
                                    <p class="platedetect2"></p>
                                    <p>Number Plate Detect</p>
                                </div>
                            </div>
                            <div>
                                <label class="switch2">
                                    <input type="checkbox" id="gateSwitch2">
                                    <span class="slider round"></span>
                                </label>
                                <p id="gateStatus2">Gate Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </main>
        <!-- MAIN -->
    </section>
    <div aria-live="polite" aria-atomic="true" style="position: absolute; top: 50px; right: 10px; z-index: 1050;">
        <div style="position: relative;">

            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false"
                id="entranceToast">
                <div class="toast-header">
                    <strong class="mr-auto">Success</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Entrance Gate opened successfully
                </div>
            </div>

            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false"
                id="exitToast">
                <div class="toast-header">
                    <strong class="mr-auto">Success</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Exit Gate opened successfully
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="ajaxin.js"></script>
    <!-- <script src="ajaxout.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>




        $('.close').click(function () {
            $(this).closest('.toast').toast('hide');
        });


    </script>
</body>

</html>