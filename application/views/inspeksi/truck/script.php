<script type="text/javascript">
    $(document).ready(function() {

        $('#ficAssistant').select2();

        // jika id tabel ada
        if ($('#truckInspeksiTable')) {
            getInspeksi();
        }
    });

    function getInspeksi() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('Inspeksi/InspeksiTruck/getInspeksi') ?>",
            dataType: "JSON",
            success: function(response) {
                if ($.fn.DataTable.isDataTable('#truckInspeksiTable')) {
                    $('#truckInspeksiTable').DataTable().clear();
                    $('#truckInspeksiTable').DataTable().destroy();
                }

                $('#truckInspeksiTable > tbody').empty();

                if (response.length != 0) {
                    var no = 1;
                    $.each(response, function(i, v) {
                        var roleUser = <?= $this->session->userdata('role'); ?>;

                        var button = '';
                        if (roleUser == 2) {
                            button = '<a href="<?= base_url('Inspeksi/InspeksiTruck/exportLaporanInspeksi/') ?>' +
                                v.id_inspeksi + '" class="btn btn-icon btn-3 btn-success w-30" type="button" title="Export Inspeksi">' +
                                '<span class="btn-inner--icon text-white"><i class="fa-solid fa-file-excel"></i></span></a>'
                        } else {
                            button = '<a href="<?= base_url('Inspeksi/InspeksiTruck/editInspeksi/') ?>' +
                                v.id_inspeksi + '" class="btn btn-icon btn-3 btn-warning w-30" type="button" title="Edit Inspeksi">' +
                                '<span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span></a> ' +
                                '<a href="<?= base_url('Inspeksi/InspeksiTruck/exportLaporanInspeksi/') ?>' +
                                v.id_inspeksi + '" class="btn btn-icon btn-3 btn-success w-30" type="button" title="Export Inspeksi">' +
                                '<span class="btn-inner--icon text-white"><i class="fa-solid fa-file-excel"></i></span></a> '
                        }

                        $('#truckInspeksiTable > tbody').append(`
                            <tr>
                            <td class="text-sm">${no++}</td>
                            <td class="text-sm">${v.kode_inspeksi}</td>
                            <td class="text-sm">${v.tgl_inspeksi}</td>
                            <td class="text-sm">${v.nama}</td>
                            <td class="text-sm"> 
                            ${button}</td>
                            </tr>
                        `)
                    });

                    $('#truckInspeksiTable').DataTable();

                } else {
                    $('#truckInspeksiTable > tbody').append(`
                            <tr>
                            <td colspan="5" class="text-sm text-danger">Data Kosong</td>
                            </tr>
                        `)
                }
            }
        })
    }

    function checkAllItem(e, id1, id2, id3) {
        var checkboxes = $("input[id='" + id1 + "']");
        var checkboxes2 = $("input[id='" + id2 + "']");
        var checkboxes3 = $("input[id='" + id3 + "']");

        if (e.checked) {
            checkboxes.prop('checked', true);
            checkboxes2.prop('checked', false);
            checkboxes3.prop('checked', false);
        } else {
            checkboxes.prop('checked', false);
        }
    }

    //hanya bisa memilih 1 checkbox
    $('input[type="checkbox"]').on('change', function() {
        // Mendapatkan baris (tr/th) dari checkbox yang dipilih
        var row = $(this).closest('tbody > tr');
        var rowTH = $(this).closest('thead > tr');

        // Menonaktifkan semua checkbox pada baris yang sama
        row.find('input[type="checkbox"]').not(this).prop('checked', false);
        rowTH.find('input[type="checkbox"]').not(this).prop('checked', false);
    });

    $("#btnNextPage").on('click', function() {
        var tglWaktuInspeksi = $('#tglWaktuInspeksi').val();
        var shift = $('#shift').val();
        var fireIncidentCommander = $('#fireIncidentCommander').val();
        var ficAssistantArray = $('#ficAssistant').val();
        var fuelLevel = $('#fuelLevel').val();

        if (tglWaktuInspeksi == '' || shift == '' || fireIncidentCommander == '' || ficAssistantArray == '' || fuelLevel == '') {
            showNotification('warning', 'Warning', 'Form Inspeksi ada yang kosong');
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
            showNotification('warning', 'Warning', 'Ada item yang belum dipilih');
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
        $("#updatebtnsaveinspeksi").show('slow');
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
        $("#updatebtnsaveinspeksi").hide('slow');
        $("#btnNextPage").hide('slow');
    })

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
                showNotification('warning', 'Warning', 'Hanya dapat menampilkan preview tipe gambar. Harap simpan perubahan untuk melihat dan merubah gambar.');
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

        // ambil input type checkbox dengan ketentuan checked
        var checkbox = $("tbody > tr input[type='checkbox']:checked");

        // memasukkan data checkbox checked ke dalam array()
        var arr_item = [];
        $(checkbox).each(function() {
            var value = $(this).val();
            var item = $(this).attr('data-item');

            arr_item.push({
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

        confirmAlert('Apakah anda yakin?', 'Pastikan data yang anda input benar!', 'warning', 'Ya, simpan', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Inspeksi/InspeksiTruck/saveInspeksi') ?>",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status == 0) {
                            showNotification(response.type, response.msg, response.desc);
                            setTimeout(() => {
                                window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                            }, 2000);
                        } else if (response.status == 2) {
                            showNotification(response.type, response.msg, response.desc);
                        } else {
                            showNotification(response.type, response.msg, response.desc);
                            setTimeout(() => {
                                window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                            }, 2000);
                        }
                    }
                })
            }
        })
    });

    $('#updatebtnsaveinspeksi').on('click', function() {
        var form_data = new FormData();

        // form pertama
        var tglWaktuInspeksi = $('#tglWaktuInspeksi').val();
        var tglWaktuInspeksiFormatted = tglWaktuInspeksi.replace(/T/, ' ').replace(/\..+/, '');
        var shift = $('#shift').val();
        var fireIncidentCommander = $('#fireIncidentCommander').val();
        var ficAssistantArray = $('#ficAssistant').val();
        var fuelLevel = $('#fuelLevel').val();
        var id_inspeksi = $('#idInspeksi').val();

        //form ketiga
        var file = $('#attachment').prop('files')[0];
        var remark = $('#remark').val();
        var filePertama = $('#attachment_pertama').val();
        if (file == undefined) {
            file = '';
        }

        //form kedua
        // ambil input type checkbox dengan ketentuan checked
        var checkbox = $("tbody > tr input[type='checkbox']:checked");

        // memasukkan data checkbox checked ke dalam array()
        var arr_item = [];
        $(checkbox).each(function() {
            var value = $(this).val();
            var item = $(this).attr('data-item');
            var idInspeksiDetail = $(this).attr('data-id-inspeksi-detail');

            arr_item.push({
                id_inspeksi_detail: idInspeksiDetail,
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
        form_data.append('filePertama', filePertama);
        form_data.append('remark', remark);
        form_data.append('arrItem', json_arr);
        form_data.append('idInspeksi', id_inspeksi);

        confirmAlert('Apakah anda yakin?', 'Pastikan data yang anda input benar!', 'warning', 'Ya, simpan', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Inspeksi/InspeksiTruck/updateInspeksi') ?>",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status == 0) {
                            showNotification(response.type, response.msg, response.desc);
                            setTimeout(() => {
                                window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                            }, 2000);
                        } else if (response.status == 2) {
                            showNotification(response.type, response.msg, response.desc);
                        } else {
                            showNotification(response.type, response.msg, response.desc);
                            setTimeout(() => {
                                window.location.href = "<?= base_url('Inspeksi/InspeksiTruck') ?>"
                            }, 2000);
                        }
                    }
                })
            }
        })
    })
</script>