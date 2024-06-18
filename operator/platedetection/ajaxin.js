// Function untuk memperbarui gambar deteksi plat pada pintu masuk
function updateImage() {
    var detectedImage = document.getElementById("detectedImage");
    detectedImage.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
}
setInterval(updateImage, 10);

// Function untuk mengaktifkan kamera pintu masuk
document.getElementById("enableButton1").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container1").style.display = "block";
    }, 10000);
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
                                $('#gateSwitch1').prop('checked', true);
                                $('#gateStatus1').text('Gate Open');

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
                                        if ($('#gateSwitch1').is(':checked')) {
                                            $('#entranceToast').toast('show');
                                            fetch("http://192.168.137.211/servo?value=180"); // fetch control servo melalui API
                                            setTimeout(function () {
                                                $('#entranceToast').toast('hide');
                                            }, 5000);
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
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    setInterval(loadData, 10);
});


$(document).ready(function () {
    $('#gateSwitch1').on('change', function () {
        var gateStatusText = $('#gateStatus1');
        if ($(this).is(':checked')) {
            gateStatusText.text('Gate Open');
            //Ganti sesuai ip yang tersedia nantinya
            fetch("http://192.168.137.212/servo?value=180"); // fetch control servo melalui API
            $('#entranceToast').toast('show');
            setTimeout(function () {
                $('#entranceToast').toast('hide');
            }, 5000);
        } else {
            //Ganti sesuai ip yang tersedia nantinya
            fetch("http://192.168.137.212/servo?value=0"); // fetch control servo melalui API
            gateStatusText.text('Gate Closed');
            $('#entranceToast').toast('hide');
        }
        if ($(this).is(':checked')) {
            updateGateStatus(1);
        }
    });
});

//Fungsi auto close gate ketika ultrasonic mendeteksi objek
document.addEventListener("DOMContentLoaded", function() {
    let belowTenPreviously = false; // Variabel untuk melacak apakah ultrasonik telah menyentuh angka di bawah 10 sebelumnya
    let countBelowTen = 0; // Variabel untuk menghitung berapa kali ultrasonik menyentuh angka di bawah 10

    function loadData() {
        fetch('http://192.168.137.212/ultrasonic') // fetch data dari Ultrasonic lewat API
            .then(response => response.text()) 
            .then(data => {
                var ultrasonicValue = parseInt(data);
                if (!isNaN(ultrasonicValue)) {
                    if (ultrasonicValue < 20 && !belowTenPreviously) {
                        belowTenPreviously = true;
                        countBelowTen++;
                    } else if (ultrasonicValue >= 20 && belowTenPreviously) {
                        belowTenPreviously = false;
                        if (countBelowTen <= 3) { 
                            setTimeout(function() {
                                document.getElementById('gateSwitch1').checked = false;
                                document.getElementById('gateStatus1').innerText = 'Gate Closed';
                                fetch("http://192.168.137.212/servo?value=0"); // fetch control servo melalui API
                            }, 100);
                        }
                        countBelowTen = 0; // Reset hitungan
                    }
                } else {
                    console.error('Invalid ultrasonic value:', data);
                }
            })
            .catch(error => console.error(error));
    }

    setInterval(loadData, 1000); 
});







