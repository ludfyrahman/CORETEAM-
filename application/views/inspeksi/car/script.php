<script type="text/javascript">
    $(document).ready(function() {
        $('#carInspeksiTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5'
            ]
        });

        $('#ficAssistant').select2();

    });

    function checkAllItem(e) {
        var checkboxes = $("input[id='chk-all-good-cat1[]']");

        if (e.checked) {
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    $("#btnNextPage").on('click', function() {
        $("#previewGeneralInspeksi").hide('slow');
        $("#btnNextPage").hide('slow');
        $("#previewChecklistItem").show('slow');
        $("#previewChecklistItem2").show('slow');
        $("#previewChecklistItem3").show('slow');
        $("#previewChecklistItem4").show('slow');
        $("#btnNextPage2").show('slow');
        $("#btnPrevPage").show('slow');
    })

    $("#btnPrevPage").on('click', function() {
        $("#previewGeneralInspeksi").show('slow');
        $("#previewChecklistItem").hide('slow');
        $("#previewChecklistItem2").hide('slow');
        $("#previewChecklistItem3").hide('slow');
        $("#previewChecklistItem4").hide('slow');
        $("#btnNextPage").show('slow');
        $("#btnNextPage2").hide('slow');
        $("#btnPrevPage").hide('slow');
    })

    $("#btnNextPage2").on('click', function() {
        $("#previewChecklistItem").hide('slow');
        $("#previewChecklistItem2").hide('slow');
        $("#previewChecklistItem3").hide('slow');
        $("#previewChecklistItem4").hide('slow');
        $("#btnNextPage2").hide('slow');
        $("#btnPrevPage").hide('slow');
        $("#btnPrevPage2").show('slow');
        $("#btnsaveinspeksi").show('slow');
        $("#previewAttachment").show('slow');
    })

    $("#btnPrevPage2").on('click', function() {
        $("#previewAttachment").hide('slow');
        $("#previewChecklistItem").show('slow');
        $("#previewChecklistItem2").show('slow');
        $("#previewChecklistItem3").show('slow');
        $("#previewChecklistItem4").show('slow');
        $("#btnNextPage").hide('slow');
        $("#btnNextPage2").show('slow');
        $("#btnPrevPage").show('slow');
        $("#btnPrevPage2").hide('slow');
        $("#btnsaveinspeksi").hide('slow');
        $("#btnNextPage").hide('slow');
    })

    //hanya bisa memilih 1 checkbox
    $('input[type="checkbox"]').on('change', function() {
        // Mendapatkan baris (tr) dari checkbox yang dipilih
        var row = $(this).closest('tr');
        // Menonaktifkan semua checkbox pada baris yang sama
        row.find('input[type="checkbox"]').not(this).prop('checked', false);
    });

    function tampilkanPreview(gambar, idpreview) {
        //membuat objek gambar
        var gb = gambar.files;
        //loop untuk merender gambFar
        for (var i = 0; i < gb.length; i++) {
            //bikin variabel
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                //jika tipe data sesuai
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                //membaca data URL gambar
                reader.readAsDataURL(gbPreview);
            } else {
                //jika tipe data tidak sesuai
                alert(
                    "Hanya dapat menampilkan preview tipe gambar. Harap simpan perubahan untuk melihat dan merubah gambar."
                );
            }
        }
    }
</script>