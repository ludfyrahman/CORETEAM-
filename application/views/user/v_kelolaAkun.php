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
                                <?php $no = 1;
                                foreach ($user as $data) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $no ?></td>
                                        <td class="text-sm"><?= $data['nama'] ?></td>
                                        <td class="text-sm"><?= $data['username'] ?></td>
                                        <td class="text-sm">
                                            <?php
                                            if ($data['role'] == '0') {
                                                echo 'Superadmin';
                                            } else if ($data['role'] == '1') {
                                                echo 'User';
                                            } else {
                                                echo 'Spectator';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-sm">
                                            <?php
                                            if ($data['status'] == '0') {
                                                echo 'FIC Assistant';
                                            } else {
                                                echo 'FIC Commander';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-sm">
                                            <?php
                                            if ($data['is_active'] == '0') { ?>
                                                <span class="badge bg-danger">Non-Aktif</span>
                                            <?php } else { ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php }
                                            ?>
                                        </td>
                                        <td class="text-sm"><?= date('d-m-Y (H:i:s)', strtotime($data['created_at'])) ?></td>
                                        <td class="text-sm"><?= date('d-m-Y (H:i:s)', strtotime($data['updated_at'])) ?></td>
                                        <td>
                                            <!-- <a href="#" class="btn btn-icon btn-3 btn-warning w-40" type="button" title="Edit User">
                                            <span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span>
                                        </a> -->
                                            <a href="<?= base_url('KelolaAkun/detailAccount/' . $data['id_user']) ?>" class="btn btn-icon btn-3 btn-warning w-50" type="button" title="Detail User">
                                                <span class="btn-inner--icon text-white"><i class="fa-solid fa-search-plus"></i></span>
                                            </a>
                                            <button class="btn btn-icon btn-3 btn-danger w-50" type="button" onclick="showModalConfirm('<?= $data['id_user'] ?>')" title="Delete User">
                                                <span class="btn-inner--icon text-white"><i class="fa-solid fa-trash"></i></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>