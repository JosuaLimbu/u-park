// Function untuk memperbarui gambar deteksi plat pada pintu keluar
function updateExitGateImage() {
    var detectedImage2 = document.getElementById("detectedImage2");
    detectedImage2.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
}
setInterval(updateExitGateImage, 80);

document.getElementById("enableButton2").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container2").style.display = "block";
    }, 10)
    fetch("http://localhost:5000/opencam2");
});

document.getElementById("disableButton2").addEventListener("click", function () {
    document.querySelector(".gate-content-container2").style.display = "none";
    fetch("http://localhost:5000/closecam2");

    $.ajax({
        url: 'out/clearplateout.php',
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


$(document).ready(function () {
    function loadData() {
        $.ajax({
            url: 'out/getnewplateout.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('.platedetect2').text(response.plate_number2);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    setInterval(loadData, 100);
});

document.getElementById("gateSwitch2").addEventListener("change", function () {
    var gateStatusText = document.getElementById("gateStatus2");
    if (this.checked) {
        gateStatusText.textContent = "Gate Open";
    } else {
        gateStatusText.textContent = "Gate Closed";
    }
});

// Function untuk memeriksa deteksi plat dengan plateregist
$(document).ready(function () {
    var lastPostTime = 0;
    var plateChecked = {};

    function loadData() {
        $.ajax({
            url: 'out/getnewplateout.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('.platedetect2').text(response.plate_number2);
                if (!(response.plate_number2 in plateChecked)) {
                    plateChecked[response.plate_number2] = true;
                    $.ajax({
                        url: 'out/checkplateregist.php',
                        type: 'POST',
                        data: { platedetect2: response.plate_number2 },
                        dataType: 'json',
                        success: function (response) {
                            if (Object.keys(response).length > 0) {
                                // Aktifkan switch
                                $('#gateSwitch').prop('checked', true);
                                $('#gateStatus').text('Gate Open');

                                // Kirim data ke tbl_vehicleentry
                                $.ajax({
                                    url: 'out/postvehicleentry.php',
                                    type: 'POST',
                                    data: {
                                        name: response.name,
                                        plate_number: response.plate_number, // Perbaiki nama parameter plate_number
                                    },
                                    success: function (response) {
                                        console.log(response);
                                        lastPostTime = new Date().getTime(); // Perbaiki currentTime menjadi new Date().getTime()
                                        // Aktifkan switch jika berhasil
                                        $('#gateSwitch2').prop('checked', true);
                                        $('#gateStatus2').text('Gate Open');
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
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    setInterval(loadData, 100);
});

$(document).ready(function () {
    $('#gateSwitch2').on('change', function () {
        if ($(this).is(':checked')) {
            updateGateStatus(2);
        }
    });
});
