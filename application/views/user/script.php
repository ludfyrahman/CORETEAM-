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
</script>