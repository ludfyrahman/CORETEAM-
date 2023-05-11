<script type="text/javascript">
    $("#btn-login").on("click", function() {
        var username = $("#username").val();
        var password = $("#password").val();

        if (username == '') {
            alert('Username tidak boleh kosong!');
            return false;
        }

        if (password == '') {
            alert('Password tidak boleh kosong!');
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
                    alert('Selamat datang!');
                } else if (response == 0) {
                    alert('Username atau password salah!');
                } else if (response == 2) {
                    alert('Akun telah di Non-aktifkan!');
                } else {
                    alert('Terjadi kesalahan pada sistem!');
                }
            }
        });
    });
</script>