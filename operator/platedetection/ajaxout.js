// Function untuk memperbarui gambar deteksi plat pada pintu keluar
function updateExitGateImage() {
    var detectedImage2 = document.getElementById("detectedImage2");
    detectedImage2.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
}
setInterval(updateExitGateImage, 80);

document.getElementById("enableButton2").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container2").style.display = "block";
    }, 10000)
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
                                // Kirim data ke tbl_vehicleentry
                                $.ajax({
                                    url: 'out/postvehicleentry.php',
                                    type: 'POST',
                                    data: {
                                        name: response.name,
                                        plate_number: response.plate_number,
                                    },
                                    success: function (response) {
                                        console.log(response);
                                        lastPostTime = new Date().getTime();
                                        $('#gateSwitch2').prop('checked', true);
                                        $('#gateStatus2').text('Gate Open');
                                        //Ganti sesuai ip yang tersedia nantinya
                                        fetch("http://192.168.137.72/servo?value=180"); // fetch control servo melalui API
                                        $('#exitToast').toast('show');
                                        setTimeout(function () {
                                            $('#exitToast').toast('hide');
                                        }, 5000);
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
            $('#gateStatus2').text('Gate Open');
            $('#exitToast').toast('show');
            //Ganti sesuai ip yang tersedia nantinya
            fetch("http://192.168.137.72/servo?value=180"); // fetch control servo melalui API
            setTimeout(function () {
                $('#exitToast').toast('hide');
            }, 5000);
        } else {
            //Ganti sesuai ip yang tersedia nantinya
            fetch("http://192.168.137.72/servo?value=0"); // fetch control servo melalui API
            $('#exitToast').toast('hide');
            $('#gateStatus2').text('Gate Closed');
            
        }
    });
});

//Fungsi auto close gate ketika ultrasonic mendeteksi objek
document.addEventListener("DOMContentLoaded", function() {
    let belowTenPreviously = false; // Variabel untuk melacak apakah ultrasonik telah menyentuh angka di bawah 10 sebelumnya
    let countBelowTen = 0; // Variabel untuk menghitung berapa kali ultrasonik menyentuh angka di bawah 10

    function loadData() {
        fetch('http://192.168.137.72/ultrasonic') // fetch data dari Ultrasonic lewat API
            .then(response => response.text()) 
            .then(data => {
                var ultrasonicValue = parseInt(data);
                if (!isNaN(ultrasonicValue)) {
                    if (ultrasonicValue < 10 && !belowTenPreviously) {
                        belowTenPreviously = true;
                        countBelowTen++;
                    } else if (ultrasonicValue >= 10 && belowTenPreviously) {
                        belowTenPreviously = false;
                        if (countBelowTen <= 3) { 
                            setTimeout(function() {
                                document.getElementById('gateSwitch2').checked = false;
                                document.getElementById('gateStatus2').innerText = 'Gate Closed';
                                fetch("http://192.168.137.72/servo?value=0"); // fetch control servo melalui API
                            }, 3000);
                        }
                        countBelowTen = 0; // Reset hitungan
                    }
                } else {
                    console.error('Invalid ultrasonic value:', data);
                }
            })
            .catch(error => console.error(error));
    }

    setInterval(loadData, 300); 
});

