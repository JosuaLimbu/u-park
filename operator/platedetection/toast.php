<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div id="enterStatus">
        Enter Close
    </div>
    <button id="changeEnterBtn">Change Enter</button>
    <div id="exitStatus">
        Exit Close
    </div>
    <button id="changeExitBtn">Change Exit</button>
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

    <!-- Script untuk menutup toast saat tombol close ditekan -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.close').click(function () {
                $(this).closest('.toast').toast('hide');
            });

            // Function untuk menyembunyikan toast setelah 5 detik
            function hideToast(toastId) {
                setTimeout(function () {
                    $(toastId).toast('hide');
                }, 5000);
            }

            // Function untuk menampilkan toast
            function showToast(toastId, message) {
                $(toastId).find('.toast-body').text(message);
                $(toastId).toast('show');
                hideToast(toastId);
            }

            // Menampilkan toast pertama saat halaman dimuat
            showToast('#entranceToast', 'Entrance Gate opened successfully');
            showToast('#exitToast', 'Exit Gate opened successfully');

            // Membuat MutationObserver untuk memantau perubahan pada teks enterStatus dan exitStatus
            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.target.id === 'enterStatus') {
                        var newText = mutation.target.textContent.trim();
                        var oldText = mutation.oldValue.trim();
                        // Memastikan bahwa teks telah kembali ke "Close" sebelum berubah menjadi "Open" lagi
                        if (oldText === 'Enter Open' && newText === 'Enter Close') {
                            showToast('#entranceToast', 'Entrance Gate opened successfully');
                        }
                    } else if (mutation.target.id === 'exitStatus') {
                        var newText = mutation.target.textContent.trim();
                        var oldText = mutation.oldValue.trim();
                        // Memastikan bahwa teks telah kembali ke "Close" sebelum berubah menjadi "Open" lagi
                        if (oldText === 'Exit Open' && newText === 'Exit Close') {
                            showToast('#exitToast', 'Exit Gate opened successfully');
                        }
                    }
                });
            });

            // Memulai pemantauan pada teks enterStatus dan exitStatus
            observer.observe(document.getElementById('enterStatus'), { subtree: true, characterData: true, oldValue: true });
            observer.observe(document.getElementById('exitStatus'), { subtree: true, characterData: true, oldValue: true });

            // Function untuk mengubah teks EnterStatus
            function changeEnterStatus() {
                if ($('#enterStatus').text() === 'Enter Close') {
                    $('#enterStatus').text('Enter Open');
                } else {
                    $('#enterStatus').text('Enter Close');
                }
            }

            // Function untuk mengubah teks ExitStatus
            function changeExitStatus() {
                if ($('#exitStatus').text() === 'Exit Close') {
                    $('#exitStatus').text('Exit Open');
                } else {
                    $('#exitStatus').text('Exit Close');
                }
            }

            // Event listener untuk tombol Change Enter
            $('#changeEnterBtn').click(function () {
                changeEnterStatus();
            });

            // Event listener untuk tombol Change Exit
            $('#changeExitBtn').click(function () {
                changeExitStatus();
            });
        });


    </script>
</body>

</html>