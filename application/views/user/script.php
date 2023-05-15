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

        confirmAlert('Apakah anda yakin?', 'Tekan ya untuk mengaktifkan akun dan tidak untuk kembali', 'warning', 'Ya, aktifkan', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('KelolaAkun/setEnable') ?>",
                    data: {
                        id_user: id_user
                    },
                    success: function(response) {
                        if (response == 1) {
                            showNotification('success', 'Sukses', 'Akun berhasil diaktifkan!');
                            setTimeout(() => {
                                location.href = '<?= base_url('KelolaAkun') ?>';
                            }, 2000);
                        }
                    }
                })
            }
        })
    })

    function deleteAccount(id_user) {
        confirmAlert('Apakah anda yakin?', 'Tekan ya untuk menghapus akun dan tidak untuk kembali', 'warning', 'Ya, hapus', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('KelolaAkun/deleteAccount') ?>",
                    data: {
                        id: id_user
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response == 1) {
                            setTimeout(() => {
                                location.href =
                                    "<?= base_url("KelolaAkun") ?>";
                            }, 2000);
                            showNotification('success', 'Sukses', 'Akun berhasil dihapus!');
                        } else {
                            showNotification('error', 'Error', 'Akun gagal berhasil dihapus!');
                        }
                    }
                });
            }
        })
    }

    $("#btndisable").on('click', function() {
        var id_user = $("#id_user").val();

        confirmAlert('Apakah anda yakin?', 'Tekan ya untuk menangguhkan akun dan tidak untuk kembali', 'warning', 'Ya, tangguhkan', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('KelolaAkun/setDisable') ?>",
                    data: {
                        id_user: id_user
                    },
                    success: function(response) {
                        if (response == 1) {
                            showNotification('success', 'Sukses', 'Akun berhasil ditangguhkan!');
                            setTimeout(() => {
                                location.href = '<?= base_url('KelolaAkun') ?>';
                            }, 2000);
                        }
                    }
                })
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
            showNotification('warning', 'Warning', 'Nama tidak boleh kosong!');
            return false;
        }

        if (username == '') {
            showNotification('warning', 'Warning', 'Username tidak boleh kosong!');
            return false;
        }

        if (role == '') {
            showNotification('warning', 'Warning', 'Role tidak boleh kosong!');
            return false;
        }

        if (role == 1) {
            if (status == '') {
                showNotification('warning', 'Warning', 'Status tidak boleh kosong!');
                return false;
            }
        }
        
        if (password == '') {
            showNotification('warning', 'Warning', 'Nama tidak boleh kosong!');
            return false;
        }

        if (konfirPassword == '') {
            showNotification('warning', 'Warning', 'Password tidak boleh kosong!');
            return false;
        }

        if (password != konfirPassword) {
            showNotification('warning', 'Warning', 'Konfirmasi password tidak sesuai!');
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
                    showNotification('success', 'Success', 'Akun baru berhasil dibuat!');
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
            showNotification('warning', 'Warning', 'Nama tidak boleh kosong!');
            return false;
        }

        if (username == '') {
            showNotification('warning', 'Warning', 'Username tidak boleh kosong!');
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
                    showNotification('success', 'Success', 'Profil berhasil diperbaharui!');
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

        if (pwLama == '') {
            showNotification('warning', 'Warning', 'Password lama tidak boleh kosong!');
            return false;
        }

        if (pwBaru == '') {
            showNotification('warning', 'Warning', 'Password baru tidak boleh kosong!');
            return false;
        }
        
        if (pwKonfir == '') {
            showNotification('warning', 'Warning', 'Konfirmasi password tidak boleh kosong!');
            return false;
        }

        if (pwBaru != pwKonfir) {
            showNotification('warning', 'Warning', 'Konfirmasi password tidak sesuai!');
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
                    showNotification('success', 'Success', 'Password baru berhasil disimpan!');
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