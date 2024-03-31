// Function untuk memperbarui gambar deteksi plat pada pintu masuk
function updateImage() {
    var detectedImage = document.getElementById("detectedImage");
    detectedImage.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
}
setInterval(updateImage, 100);

// Function untuk mengaktifkan kamera pintu masuk
document.getElementById("enableButton1").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container1").style.display = "flex";
    }, 10);
    fetch("http://localhost:5000/opencam");
});

// Function untuk menonaktifkan kamera pintu masuk
document.getElementById("disableButton1").addEventListener("click", function () {
    document.querySelector(".gate-content-container1").style.display = "none";
    fetch("http://localhost:5000/closecam");

    // AJAX untuk membersihkan data plat terbaru
    $.ajax({
        url: 'in/clearplatein.php',
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

// Function untuk memeriksa deteksi plat dengan plateregist
$(document).ready(function () {
    var plateChecked = {};

    function loadData() {
        $.ajax({
            url: 'in/getnewplatein.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('.platedetect').text(response.plate_number);
                if (!(response.plate_number in plateChecked)) {
                    plateChecked[response.plate_number] = true;
                    $.ajax({
                        url: 'in/checkplateregist.php',
                        type: 'POST',
                        data: { platedetect: response.plate_number },
                        dataType: 'json',
                        success: function (response) {
                            if (Object.keys(response).length > 0) {
                                // Aktifkan switch
                                $('#gateSwitch').prop('checked', true);
                                $('#gateStatus').text('Gate Open');

                                // Kirim data ke tbl_vehicleentry
                                $.ajax({
                                    url: 'in/postvehicleentry.php',
                                    type: 'POST',
                                    data: {
                                        name: response.name,
                                        plate_number: response.plate_number,
                                    },
                                    success: function (response) {
                                        console.log(response);
                                        // Tampilkan toast
                                        updateGateStatusAndShowToast();
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

// Function untuk menampilkan toast dengan hitungan mundur
function showToastWithCountdown(message) {
    $('.toast-body').text(message);
    $('.toast').toast('show');
    var count = 5;
    var countDownInterval = setInterval(function () {
        $('.toast .text-muted').html('<small class="text-muted">' + count + ' Second</small>');
        count--;
        if (count < 0) {
            clearInterval(countDownInterval);
            $('.toast').toast('hide');
        }
    }, 1000);
}

// Function untuk mengaktifkan switch dan menampilkan toast message saat berhasil POST data ke tbl_vehicleentry
function updateGateStatusAndShowToast() {
    $('#gateSwitch').prop('checked', true);
    $('#gateStatus').text('Gate Open');
    showToastWithCountdown('Gate opened successfully');
    // Setelah 5 detik, sembunyikan toast
    setTimeout(function () {
        $('.toast').toast('hide');
    }, 5000);
}

$(document).ready(function () {
    // Memperbarui gate status dan menampilkan toast saat berhasil POST data ke tbl_vehicleentry
    $('#gateSwitch').on('change', function () {
        if ($(this).is(':checked')) {
            updateGateStatusAndShowToast();
        }
    });
});
