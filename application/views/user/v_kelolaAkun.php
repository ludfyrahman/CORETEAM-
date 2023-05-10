<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-2 bg-white">
                    <a href="<?= base_url('KelolaAkun/createAccount/') ?>" class="btn btn-icon btn-3 btn-info" type="button">
                        <span class="btn-inner--icon text-white"><i class="ni ni-fat-add"></i></span>
                        <span class="btn-inner--text text-white">Buat akun baru</span>
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="kelolaAkunTable" class="table table-stripped pb-2" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-sm font-weight-bolder">No</th>
                                    <th class="text-sm font-weight-bolder">Nama</th>
                                    <th class="text-sm font-weight-bolder">Username</th>
                                    <th class="text-sm font-weight-bolder">Role</th>
                                    <th class="text-sm font-weight-bolder">Position</th>
                                    <th class="text-sm font-weight-bolder">Status</th>
                                    <th class="text-sm font-weight-bolder">Created at</th>
                                    <th class="text-sm font-weight-bolder">Updated at</th>
                                    <th class="text-sm font-weight-bolder">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td class="text-sm">1</td>
                                    <td class="text-sm">Nafis</td>
                                    <td class="text-sm">schatzy</td>
                                    <td class="text-sm">User</td>
                                    <td class="text-sm">FIC Assistant</td>
                                    <td class="text-sm"><span class="badge bg-success">Aktif</span></td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-icon btn-3 btn-warning w-40" type="button" title="Edit User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span>
                                        </a> -->
                                        <a href="<?= base_url('KelolaAkun/detailAccount') ?>" class="btn btn-icon btn-3 btn-warning w-50" type="button" title="Detail User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-search-plus"></i></span>
                                        </a>
                                        <button class="btn btn-icon btn-3 btn-danger w-50" type="button" title="Delete User" data-bs-toggle="modal" data-bs-target="#modal-notification">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-trash"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">2</td>
                                    <td class="text-sm">Ludfi</td>
                                    <td class="text-sm">ludfyrhmn</td>
                                    <td class="text-sm">Spectator</td>
                                    <td class="text-sm">FIC Assistant</td>
                                    <td class="text-sm"><span class="badge bg-danger">Non-aktif</span></td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-icon btn-3 btn-warning w-40" type="button" title="Edit User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span>
                                        </a> -->
                                        <a href="#" class="btn btn-icon btn-3 btn-warning w-50" type="button" title="Detail User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-search-plus"></i></span>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-3 btn-danger w-50" type="button" title="Delete User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">3</td>
                                    <td class="text-sm">Andre</td>
                                    <td class="text-sm">sterben</td>
                                    <td class="text-sm">Superadmin</td>
                                    <td class="text-sm">FIC Commander</td>
                                    <td class="text-sm"><span class="badge bg-success">Aktif</span></td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-icon btn-3 btn-warning w-40" type="button" title="Edit User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span>
                                        </a> -->
                                        <a href="#" class="btn btn-icon btn-3 btn-warning w-50" type="button" title="Detail User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-search-plus"></i></span>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-3 btn-danger w-50" type="button" title="Delete User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>