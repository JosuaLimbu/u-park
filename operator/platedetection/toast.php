<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch2 {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch2 input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #04A6B5;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #04A6B5;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <p>Switch 1</p>
    <label class="switch">
        <input type="checkbox" id="gateSwitch1">
        <span class="slider round"></span>
    </label>
    <p id="gateStatus1">Gate Closed</p>
    <p>Switch 2</p>
    <label class="switch2">
        <input type="checkbox" id="gateSwitch2">
        <span class="slider round"></span>
    </label>
    <p id="gateStatus2">Gate Closed</p>

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

    <!-- Script untuk menampilkan toast saat halaman dimuat -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#gateSwitch1').change(function () {
                if ($(this).is(':checked')) {
                    $('#entranceToast').toast('show');
                    setTimeout(function () {
                        $('#entranceToast').toast('hide');
                    }, 5000);
                } else {
                    $('#entranceToast').toast('hide');
                }
            });

            $('#gateSwitch2').change(function () {
                if ($(this).is(':checked')) {
                    $('#exitToast').toast('show');
                    setTimeout(function () {
                        $('#exitToast').toast('hide');
                    }, 5000);
                } else {
                    $('#exitToast').toast('hide');
                }
            });

            $('.close').click(function () {
                $(this).closest('.toast').toast('hide');
            });

        });
    </script>
</body>

</html>