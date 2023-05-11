<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-2 bg-white">
                    <?php if ($this->session->userdata('role') != 2) { ?>
                        <a href="<?= base_url('Inspeksi/InspeksiBoat/createInspeksi/') ?>" class="btn btn-icon btn-3 btn-info" type="button">
                            <span class="btn-inner--icon text-white"><i class="ni ni-fat-add"></i></span>
                            <span class="btn-inner--text text-white">Buat Inspeksi</span>
                        </a>
                    <?php } ?>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="boatInspeksiTable" class="table table-stripped pb-2" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-sm font-weight-bolder">No</th>
                                    <th class="text-sm font-weight-bolder">No. Doc</th>
                                    <th class="text-sm font-weight-bolder">Inspected at</th>
                                    <th class="text-sm font-weight-bolder">Inspected by</th>
                                    <?php if ($this->session->userdata('role') != 2) { ?>
                                        <th class="text-sm font-weight-bolder">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td class="text-sm">1</td>
                                    <td class="text-sm">FT-001</td>
                                    <td class="text-sm">04-05-2023</td>
                                    <td class="text-sm">Nafis</td>
                                    <?php if ($this->session->userdata('role') != 2) { ?>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-3 btn-warning w-30" type="button" title="Edit Inspeksi">
                                                <span class="btn-inner--icon text-white"><i class="fa-solid fa-pencil-alt"></i></span>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-3 btn-success w-30" type="button" title="Export Inspeksi">
                                                <span class="btn-inner--icon text-white"><i class="fa-solid fa-file-excel"></i></span>
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>