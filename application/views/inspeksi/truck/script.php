<script type="text/javascript">
    $(document).ready(function() {
        $('#truckInspeksiTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5'
            ]
        });

        $('#ficAssistant').select2();

    });

    function checkAllItem(e, string) {
        var checkboxes = $("input[id='" + string + "']");

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
        var tglWaktuInspeksi = $('#tglWaktuInspeksi').val();
        var shift = $('#shift').val();
        var fireIncidentCommander = $('#fireIncidentCommander').val();
        var ficAssistantArray = $('#ficAssistant').val();
        var fuelLevel = $('#fuelLevel').val();

        if (tglWaktuInspeksi == '' || shift == '' || fireIncidentCommander == '' || ficAssistantArray == '' || fuelLevel == '') {
            alert('Form Inspeksi ada yang kosong');
            return false;
        }


        $("#previewGeneralInspeksi").hide('slow');
        $("#btnNextPage").hide('slow');
        $("#previewChecklistItem").show('slow');
        $("#previewChecklistItem2").show('slow');
        $("#previewChecklistItem3").show('slow');
        $("#previewChecklistItem4").show('slow');
        $("#previewChecklistItem5").show('slow');
        $("#previewChecklistItem6").show('slow');
        $("#btnNextPage2").show('slow');
        $("#btnPrevPage").show('slow');

    })

    $("#btnPrevPage").on('click', function() {
        $("#previewGeneralInspeksi").show('slow');
        $("#previewChecklistItem").hide('slow');
        $("#previewChecklistItem2").hide('slow');
        $("#previewChecklistItem3").hide('slow');
        $("#previewChecklistItem4").hide('slow');
        $("#previewChecklistItem5").hide('slow');
        $("#previewChecklistItem6").hide('slow');
        $("#btnNextPage").show('slow');
        $("#btnNextPage2").hide('slow');
        $("#btnPrevPage").hide('slow');
    })

    $("#btnNextPage2").on('click', function() {
        // ambil input type checkbox dengan ketentuan checked
        var checkbox = $("tbody > tr input[type='checkbox']:checked");

        // memasukkan data checkbox checked ke dalam array()
        var arr_item = [];
        $(checkbox).each(function() {
            var value = $(this).val();
            var subcategory = $(this).attr('data-subcategory');
            var item = $(this).attr('data-item');

            arr_item.push({
                subcategory: subcategory,
                id_item: item,
                conditions: value
            });
        })

        // cek apa ada data kosong pada setiap subcategory, jika ada maka muncul alert
        var boolean = true;
        $('.subCat').each(function() {
            var jumlahItemSubCategory = $(this).val();
            var subcategory = $(this).attr('data-subcategory');

            var count = arr_item.filter(row => row.subcategory === subcategory).length

            if (count != jumlahItemSubCategory) {
                boolean = false;
                return false;
            }
        });

        if (boolean == false) {
            alert('Ada Item yang belum dipilih');
            return false;
        }

        $("#previewChecklistItem").hide('slow');
        $("#previewChecklistItem2").hide('slow');
        $("#previewChecklistItem3").hide('slow');
        $("#previewChecklistItem4").hide('slow');
        $("#previewChecklistItem5").hide('slow');
        $("#previewChecklistItem6").hide('slow');
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
        $("#previewChecklistItem5").show('slow');
        $("#previewChecklistItem6").show('slow');
        $("#btnNextPage").hide('slow');
        $("#btnNextPage2").show('slow');
        $("#btnPrevPage").show('slow');
        $("#btnPrevPage2").hide('slow');
        $("#btnsaveinspeksi").hide('slow');
        $("#btnNextPage").hide('slow');
    })

    //hanya bisa memilih 1 checkbox
    $('input[type="checkbox"]').on('change', function() {
        // Mendapatkan baris (tr/th) dari checkbox yang dipilih
        var row = $(this).closest('tbody > tr');
        var rowTH = $(this).closest('thead > tr');
        // Menonaktifkan semua checkbox pada baris yang sama
        row.find('input[type="checkbox"]').not(this).prop('checked', false);
        rowTH.find('input[type="checkbox"]').not(this).prop('checked', false);
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

    $('#btnsaveinspeksi').on('click', function() {
        var form_data = new FormData();

        // form pertama
        var tglWaktuInspeksi = $('#tglWaktuInspeksi').val();
        var tglWaktuInspeksiFormatted = tglWaktuInspeksi.replace(/T/, ' ').replace(/\..+/, '');
        var shift = $('#shift').val();
        var fireIncidentCommander = $('#fireIncidentCommander').val();
        var ficAssistantArray = $('#ficAssistant').val();
        var fuelLevel = $('#fuelLevel').val();

        //form ketiga
        var file = $('#attachment').prop('files')[0];
        var remark = $('#remark').val();

        if (file == '' || remark == '') {
            alert('Form Attachment ada yang kosong');
            return false;
        }

        // ambil input type checkbox dengan ketentuan checked
        var checkbox = $("tbody > tr input[type='checkbox']:checked");

        // memasukkan data checkbox checked ke dalam array()
        var arr_item = [];
        $(checkbox).each(function() {
            var value = $(this).val();
            var subcategory = $(this).attr('data-subcategory');
            var item = $(this).attr('data-item');

            arr_item.push({
                subcategory: subcategory,
                id_item: item,
                conditions: value
            });
        })

        var json_arr = JSON.stringify(arr_item);
        var json_arr_assistant = JSON.stringify(ficAssistantArray);
        form_data.append('tglWaktu', tglWaktuInspeksiFormatted);
        form_data.append('shift', shift);
        form_data.append('commander', fireIncidentCommander);
        form_data.append('assistant', json_arr_assistant);
        form_data.append('fuelLevel', fuelLevel);
        form_data.append('file', file);
        form_data.append('remark', remark);
        form_data.append('arrItem', json_arr);

        $.ajax({
            type: "POST",
            url: "<?= base_url('Inspeksi/InspeksiTruck/saveInspeksi') ?>",
            data: form_data,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(response) {
                if (response.status == false) {
                    alert(response.message);
                    setTimeout(() => {
                        window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                    }, 1000);
                } else if (response.status == 'error') {
                    alert(response.message);
                } else {
                    alert(response.message);
                    setTimeout(() => {
                        window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                    }, 1000);
                }
            }
        })


    })
</script>