<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div id="previewGeneralInspeksi" class="card mb-4">
                <div class="card-header pb-4 bg-white d-flex justify-content-between">
                    <h5 class="mb-0">Detail akun</h5>
                    <button class="btn btn-icon btn-3 btn-info mb-0 ms-2 float-end" type="button" id="resetPassword">
                        <span class="btn-inner--icon text-white"><i class="fa-solid fa-key"></i></span>
                        <span class="btn-inner--text text-white">Reset password</span>
                    </button>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <input type="hidden" id="id_user" value="<?= $detail['id_user'] ?>">
                        <table class="table" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="text-sm w-20">Nama</td>
                                    <td class="w-5">:</td>
                                    <td class="text-sm"><?= $detail['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Username</td>
                                    <td class="w-5">:</td>
                                    <td class="text-sm"><?= $detail['username'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Role</td>
                                    <td class="w-5">:</td>
                                    <td class="text-sm">
                                        <?php
                                        if ($detail['role'] == 0) {
                                            echo 'Superadmin';
                                        } else if ($detail['role'] == 1) {
                                            echo 'User';
                                        } else {
                                            echo 'Spectator';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Position</td>
                                    <td class="w-5">:</td>
                                    <td class="text-sm">
                                        <?php
                                        if ($detail['status'] == 0) {
                                            echo 'FIC Assistant';
                                        } else if ($detail['status'] == 1) {
                                            echo 'FIC Commander';
                                        } else if ($detail['status'] == 2) {
                                            echo 'Lainnya';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm w-20">Status</td>
                                    <td class="w-5">:</td>
                                    <td class="text-sm">
                                        <?php if ($detail['is_active'] == 0) { ?>
                                            <span class="badge bg-danger">Non-aktif</span>
                                        <?php } else if ($detail['is_active'] == 1) { ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-success mb-0 ms-2 float-end" type="button" id="btnenable">
                <span class="btn-inner--icon text-white"><i class="fa-solid fa-lock-open"></i></span>
                <span class="btn-inner--text text-white">Enable</span>
            </button>
            <button class="btn btn-icon btn-3 btn-danger mb-0 ms-2 float-end" type="button" id="btndisable">
                <span class="btn-inner--icon text-white"><i class="fa-solid fa-lock"></i></span>
                <span class="btn-inner--text text-white">Disable</span>
            </button>
            <a href="<?= base_url('KelolaAkun') ?>" class="btn btn-icon btn-3 btn-warning mb-0 float-end" type="button">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                <span class="btn-inner--text">Kembali</span>
            </a>
        </div>
    </div>