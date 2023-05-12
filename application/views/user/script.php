<script type="text/javascript">
    $(document).ready(function() {
        $('#kelolaAkunTable').DataTable({
            "language": {
                "info": '<span class="text-sm">Menampilkan _START_ hingga _END_ dari _TOTAL_ baris</span>',
                "paginate": {
                    "previous": '<i class="fa-solid fa-chevron-left"></i>',
                    "next": '<i class="fa-solid fa-chevron-right"></i>'
                },
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
    });

    $("#profile").on('click', function() {
        $("#previewProfile").show('slow');
        $("#previewEditProfile").hide('slow');
        $("#previewChangePassword").hide('slow');
        $("#btnupdateprofile").hide('slow');
        $("#btnupdatepassword").hide('slow');
    })

    $("#editProfile").on('click', function() {
        $("#previewProfile").hide('slow');
        $("#previewEditProfile").show('slow');
        $("#previewChangePassword").hide('slow');
        $("#btnupdatepassword").hide('slow');
        $("#btnupdateprofile").show('slow');
    })

    $("#changePassword").on('click', function() {
        $("#previewProfile").hide('slow');
        $("#previewEditProfile").hide('slow');
        $("#previewChangePassword").show('slow');
        $("#btnupdatepassword").show('slow');
        $("#btnupdateprofile").hide('slow');
    })

    $("#btnenable").on('click', function() {
        var id_user = $("#id_user").val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/setEnable') ?>",
            data: {
                id_user: id_user
            },
            success: function(response) {
                if (response == 1) {
                    alert('Akun berhasil diaktifkan!');
                    setTimeout(() => {
                        location.href = '<?= base_url('KelolaAkun') ?>';
                    }, 2000);
                }
            }
        })
    })

    function showModalConfirm(id_user) {
        $("#modal-delete-akun").modal('show');
        $("#delete_link").attr('data-id', id_user);
    }

    function deleteAccount() {
        var id_hapus = $("#delete_link").attr("data-id");
        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/deleteAccount') ?>",
            data: {
                id: id_hapus
            },
            dataType: "JSON",
            success: function(response) {
                if (response == 1) {
                    setTimeout(() => {
                        location.href =
                            "<?= base_url("KelolaAkun") ?>";
                    }, 1000);
                    alert('Akun berhasil dihapus!');
                } else {
                    alert('Akun gagal berhasil dihapus!');
                }
                $("#modal-delete-akun").modal('hide');
            }
        });
    }

    $("#btndisable").on('click', function() {
        var id_user = $("#id_user").val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/setDisable') ?>",
            data: {
                id_user: id_user
            },
            success: function(response) {
                if (response == 1) {
                    alert('Akun berhasil ditangguhkan!');
                    setTimeout(() => {
                        location.href = '<?= base_url('KelolaAkun') ?>';
                    }, 2000);
                }
            }
        })
    })

    $("#btnsaveuser").on('click', function() {
        var nama = $("#nama").val();
        var username = $("#username").val();
        var role = $("#role").val();
        var status = $("#status").val();
        var password = $("#password").val();
        var konfirPassword = $("#konfirPassword").val();

        if (nama == '') {
            alert('Nama tidak boleh kosong!');
            return false;
        }

        if (username == '') {
            alert('Username tidak boleh kosong!');
            return false;
        }

        if (role == '') {
            alert('Role tidak boleh kosong!');
            return false;
        }

        if (status == '') {
            alert('Status tidak boleh kosong!');
            return false;
        }

        if (password == '') {
            alert('Password tidak boleh kosong!');
            return false;
        }

        if (konfirPassword == '') {
            alert('Password tidak boleh kosong!');
            return false;
        }

        if (password != konfirPassword) {
            alert('Konfirmasi password tidak sesuai!');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/saveAccount') ?>",
            data: {
                nama: nama,
                username: username,
                role: role,
                status: status,
                password: password
            },
            dataType: "JSON",
            success: function(response) {
                if (response == 1) {
                    alert('Akun baru berhasil didaftarkan!');
                    setTimeout(() => {
                        location.href = '<?= base_url('KelolaAkun') ?>';
                    }, 2000);
                }
            }
        })
    })

    $("#btnupdateprofile").on('click', function() {
        var nama = $("#nama").val();
        var username = $("#username").val();

        if (nama == '') {
            alert('Nama tidak boleh kosong!');
            return false;
        }

        if (username == '') {
            alert('Username tidak boleh kosong!');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/saveUpdateProfile') ?>",
            data: {
                nama: nama,
                username: username
            },
            dataType: "JSON",
            success: function(response) {
                if (response == 1) {
                    alert('Profile berhasil diperbaharui!');
                    setTimeout(() => {
                        location.href = '<?= base_url('KelolaAkun/profile') ?>';
                    }, 2000);
                }
            }
        })
    })

    $("#btnupdatepassword").on('click', () => {
        var pwLama = $("#pwLama").val();
        var pwBaru = $("#pwBaru").val();
        var pwKonfir = $("#konfirPW").val();

        if (pwBaru != pwKonfir) {
            alert('Konfirmasi password tidak sesuai!');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('KelolaAkun/saveUpdatePassword') ?>",
            data: {
                pwLama: pwLama,
                pwBaru: pwBaru
            },
            dataType: "JSON",
            success: function(response) {
                if (response == 1) {
                    alert('Password baru berhasil disimpan!');
                    setTimeout(() => {
                        location.href = '<?= base_url('KelolaAkun/profile') ?>';
                    }, 2000);
                } else {
                    alert(response);
                }
            }
        })
    });
</script>