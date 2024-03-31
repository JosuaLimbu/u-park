//Exit Gate Function
function updateExitGateImage() {
    var detectedImage2 = document.getElementById("detectedImage2");
    detectedImage2.src = "http://localhost:5000/image_feed?timestamp=" + new Date().getTime();
}
setInterval(updateExitGateImage, 80);

document.getElementById("enableButton2").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container2").style.display = "flex";
    }, 10)
    fetch("http://localhost:5000/opencam");
});

document.getElementById("disableButton2").addEventListener("click", function () {
    document.querySelector(".gate-content-container2").style.display = "none";
    fetch("http://localhost:5000/closecam");

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
    $('#gateSwitch2').prop('checked', true);
    $('#gateStatus2').text('Gate Open');
    showToastWithCountdown('Gate opened successfully');
    // Setelah 5 detik, sembunyikan toast
    setTimeout(function () {
        $('.toast').toast('hide');
    }, 5000);
}

$(document).ready(function () {
    // Memperbarui gate status dan menampilkan toast saat berhasil POST data ke tbl_vehicleentry
    $('#gateSwitch2').on('change', function () {
        if ($(this).is(':checked')) {
            updateGateStatusAndShowToast();
        }
    });
});
