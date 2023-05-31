<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div id="previewGeneralInspeksi" class="card mb-4">
                <div class="card-header pb-4 bg-white">
                    <h5>Form tambah akun</h5>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control text-sm" id="nama" placeholder="Masukkan nama lengkap...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control text-sm" id="username" placeholder="Masukkan username...">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control text-sm" id="role">
                                    <option value="">Pilih role user</option>
                                    <option value="0">Superadmin</option>
                                    <option value="1">User</option>
                                    <option value="2">Spectator</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control text-sm" id="status">
                                    <option value="">Pilih status</option>
                                    <option value="0">FIC Assistant</option>
                                    <option value="1">FIC Commander</option>
                                    <option value="2">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control text-sm" id="password" placeholder="Masukkan password...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="konfirPassword">Konfirmasi password</label>
                                <input type="password" class="form-control text-sm" id="konfirPassword" placeholder="Masukkan konfirmasi password...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-primary mb-0 ms-2 float-end" type="button" id="btnsaveuser">
                <span class="btn-inner--icon text-white"><i class="ni ni-check-bold"></i></span>
                <span class="btn-inner--text text-white">Simpan</span>
            </button>
            <a href="<?= base_url('KelolaAkun') ?>" class="btn btn-icon btn-3 btn-danger mb-0 float-end" type="button" id="btnPrevPage2">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                <span class="btn-inner--text">Kembali</span>
            </a>
        </div>
    </div>