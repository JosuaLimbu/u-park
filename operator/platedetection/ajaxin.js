function updateImage() {
    var detectedImage = document.getElementById("detectedImage");
    detectedImage.src = "../../yolov5/videostream/0_detected.jpg?timestamp=" + new Date().getTime();
}
setInterval(updateImage, 100);

//Entrance Gate Function
document.getElementById("enableButton1").addEventListener("click", function () {
    setTimeout(function () {
        document.querySelector(".gate-content-container1").style.display = "flex";
    }, 10)
    fetch("http://localhost:5000/opencam");
});

document.getElementById("disableButton1").addEventListener("click", function () {
    document.querySelector(".gate-content-container1").style.display = "none";
    fetch("http://localhost:5000/closecam");

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

$(document).ready(function () {
    function loadData() {
        $.ajax({
            url: 'in/getnewplatein.php',
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

document.getElementById("gateSwitch").addEventListener("change", function () {
    var gateStatusText = document.getElementById("gateStatus");
    if (this.checked) {
        gateStatusText.textContent = "Gate Open";
    } else {
        gateStatusText.textContent = "Gate Closed";
    }
});

//function mengecek deteksi dengan plateregist
$(document).ready(function () {
    var lastPostTime = 0;
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
                                        lastPostTime = currentTime;
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

