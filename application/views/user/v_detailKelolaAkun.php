<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div id="previewGeneralInspeksi" class="card mb-4">
                <div class="card-header pb-4 bg-white">
                    <h5>Detail akun</h5>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <table class="table" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="text-sm w-20">Nama</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Username</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Position</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Status</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-success mb-0 ms-2 float-end" type="button" id="btnsaveinspeksi">
                <span class="btn-inner--icon text-white"><i class="fa-solid fa-lock-open"></i></span>
                <span class="btn-inner--text text-white">Enable</span>
            </button>
            <button class="btn btn-icon btn-3 btn-danger mb-0 ms-2 float-end" type="button" id="btnsaveinspeksi">
                <span class="btn-inner--icon text-white"><i class="fa-solid fa-lock"></i></span>
                <span class="btn-inner--text text-white">Disable</span>
            </button>
            <a href="<?= base_url('KelolaAkun') ?>" class="btn btn-icon btn-3 btn-warning mb-0 float-end" type="button" id="btnPrevPage2">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                <span class="btn-inner--text">Kembali</span>
            </a>
        </div>
    </div>