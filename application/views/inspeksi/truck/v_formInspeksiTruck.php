<!-- Header -->
<?php $this->load->view('partials/header'); ?>
<!-- End Header -->

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <!-- Sidebar -->
    <?php $this->load->view('partials/sidebar'); ?>
    <!-- End Sidebar -->

    <main class="main-content position-relative border-radius-lg ">

        <!-- Navbar -->
        <?php $this->load->view('partials/navbar'); ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div id="previewGeneralInspeksi" class="card mb-4">
                        <div class="card-header pb-4 bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-1" style="width: 5%;">
                                    <a href="<?= base_url('Inspeksi/InspeksiTruck/') ?>" class="btn btn-icon btn-3 btn-secondary rounded-circle mt-2" type="button">
                                        <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <h5>Form Inspeksi</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tglInspeksi">Tanggal</label>
                                            <input type="date" class="form-control text-sm" id="tglInspeksi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shift">Pilih Shift</label>
                                            <select class="form-control text-sm" id="shift">
                                                <option value="">Pilih Shift</option>
                                                <option value="1">Pagi</option>
                                                <option value="2">Sore</option>
                                                <option value="3">Malam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fireIncidentCommander">Fire Incident Commander</label>
                                            <select class="form-control text-sm" id="fireIncidentCommander">
                                                <option value="">Pilih Fire Incident Commander</option>
                                                <option value="1">Andre</option>
                                                <option value="2">Ludfi</option>
                                                <option value="3">Nafis</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ficAssistant">FIC Assistant</label>
                                            <select class="form-control text-sm" id="ficAssistant">
                                                <option value="">Pilih FIC Assistant</option>
                                                <option value="1">Andre</option>
                                                <option value="2">Ludfi</option>
                                                <option value="3">Nafis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fuelLevel">Email address</label>
                                            <textarea name="fuelLevel" id="fuelLevel" class="form-control text-sm" placeholder="Isi fuel text..." rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="btn btn-icon btn-3 btn-info mb-0 float-end" type="button" id="btnNextPage">
                        <span class="btn-inner--icon text-white"><i class="ni ni-bold-right"></i></span>
                        <span class="btn-inner--text text-white">Selanjutnya</span>
                    </button>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div id="previewChecklistItem" class="card mb-4" style="display: none;">
                        <div class="card-header pb-3 bg-white">
                            <h6>1. Man Chasis / Engine</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="table1" class="table table-stripped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-xs font-weight-bolder">
                                                Item</th>
                                            <th class="text-xs font-weight-bolder ps-2">
                                                Good</th>
                                            <th class="text-center text-xs font-weight-bolder">
                                                Damage</th>
                                            <th class="text-center text-xs font-weight-bolder">
                                                N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="text-sm">Engine Oil Level</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Coolant Level</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Brake Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Brake Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div id="previewChecklistItem2" class="card mb-4" style="display: none;">
                        <div class="card-header pb-3 bg-white">
                            <h6>2. Man Cabin</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="table1" class="table table-stripped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-xs font-weight-bolder">Item</th>
                                            <th class="text-xs font-weight-bolder ps-2">Good</th>
                                            <th class="text-center text-xs font-weight-bolder">Damage</th>
                                            <th class="text-center text-xs font-weight-bolder">N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="text-sm">Engine Oil Level</td>
                                            <td><input type="checkbox" id="engine"></td>
                                            <td><input type="checkbox" id="engine"></td>
                                            <td><input type="checkbox" id="engine"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Coolant Level</td>
                                            <td><input type="checkbox" id="coolant"></td>
                                            <td><input type="checkbox" id="coolant"></td>
                                            <td><input type="checkbox" id="coolant"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Brake Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div id="previewChecklistItem3" class="card mb-4" style="display: none;">
                        <div class="card-header pb-3 bg-white">
                            <h6>3. Running Test</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="table1" class="table table-stripped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-xs font-weight-bolder">
                                                Item</th>
                                            <th class="text-xs font-weight-bolder ps-2">
                                                Good</th>
                                            <th class="text-center text-xs font-weight-bolder">
                                                Damage</th>
                                            <th class="text-center text-xs font-weight-bolder">
                                                N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="text-sm">Engine Oil Level</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Coolant Level</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Brake Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div id="previewChecklistItem4" class="card mb-4" style="display: none;">
                        <div class="card-header pb-3 bg-white">
                            <h6>4. Man Tools</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="table1" class="table table-stripped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-xs font-weight-bolder">Item</th>
                                            <th class="text-xs font-weight-bolder ps-2">Good</th>
                                            <th class="text-center text-xs font-weight-bolder">Damage</th>
                                            <th class="text-center text-xs font-weight-bolder">N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="text-sm">Engine Oil Level</td>
                                            <td><input type="checkbox" id="engine"></td>
                                            <td><input type="checkbox" id="engine"></td>
                                            <td><input type="checkbox" id="engine"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Coolant Level</td>
                                            <td><input type="checkbox" id="coolant"></td>
                                            <td><input type="checkbox" id="coolant"></td>
                                            <td><input type="checkbox" id="coolant"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Brake Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">Power Steering Fluid</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-icon btn-3 btn-danger mb-0" type="button" id="btnPrevPage" style="display: none;">
                        <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                        <span class="btn-inner--text">Kembali</span>
                    </button>
                    <button class="btn btn-icon btn-3 btn-info mb-0 float-end" type="button" id="btnNextPage2" style="display: none;">
                        <span class="btn-inner--icon text-white"><i class="ni ni-bold-right"></i></span>
                        <span class="btn-inner--text text-white">Selanjutnya</span>
                    </button>
                </div>

                <div class="col-lg-12">
                    <div id="previewAttachment" class="card mb-4" style="display: none;">
                        <div class="card-header pb-4 bg-white">
                            <h6>7. Attachment</h6>
                        </div>
                        <div class="card-body p-4">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tglInspeksi">Attachment</label>
                                            <input type="file" class="form-control text-sm" id="attachment" accept="image/*" onchange="tampilkanPreview(this,'preview')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <img id="preview" style="border-radius: 5px;" src="" alt="" width="200px" /> <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fuelLevel">Remark</label>
                                            <textarea name="remark" id="remark" class="form-control text-sm" placeholder="Catatan..." rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-icon btn-3 btn-danger mb-0" type="button" id="btnPrevPage2" style="display: none;">
                        <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                        <span class="btn-inner--text">Kembali</span>
                    </button>
                    <button class="btn btn-icon btn-3 btn-primary mb-0 float-end" type="button" id="btnsaveinspeksi" style="display: none;" data-bs-toggle="modal" data-bs-target="#modal-notification">
                        <span class="btn-inner--icon text-white"><i class="ni ni-check-bold"></i></span>
                        <span class="btn-inner--text text-white">Simpan</span>
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <?php $this->load->view('partials/footer'); ?>
            <!-- End Footer -->