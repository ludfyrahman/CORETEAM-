<script type="text/javascript">
    function showNotification(type, msg, desc) {
        toastr[type](desc, msg, {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
        });
    }

    $("#btn-login").on("click", function() {
        var username = $("#username").val();
        var password = $("#password").val();

        if (username == '') {
            showNotification('error', 'Gagal', 'Username tidak boleh kosong!');
            return false;
        }

        if (password == '') {
            showNotification('error', 'Gagal', 'Password tidak boleh kosong!');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('Auth/login') ?>",
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    setTimeout(() => {
                        location.href =
                            "<?= base_url("Dashboard") ?>";
                    }, 2000);
                    showNotification('success', 'Sukses', 'Selamat datang!');
                } else if (response == 0) {
                    showNotification('error', 'Gagal', 'Username atau password salah!');
                } else if (response == 2) {
                    showNotification('error', 'Gagal', 'Akun telah ditangguhkan!');
                } else {
                    showNotification('error', 'Gagal', 'Terjadi kesalahan pada sistem!');
                }
            }
        });
    });
</script>