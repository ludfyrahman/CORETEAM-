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
                                    <label for="tglInspeksi">Tanggal dan Waktu</label>
                                    <input type="datetime-local" class="form-control text-sm" id="tglWaktuInspeksi">
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
                                        <?php
                                        foreach ($commander as $value) { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ficAssistant">FIC Assistant</label>
                                    <select class="form-control text-sm" id="ficAssistant" aria-placeholder="true" multiple>
                                        <option value="">Pilih FIC Assistant</option>
                                        <?php
                                        foreach ($assistant as $value) { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fuelLevel">Fuel Level</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <input class="form-control" id="fuelLevel" placeholder="Fuel level..." type="number" min="0">
                                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                                    </div>
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
                                    <th class="text-xs font-weight-bolder">Item</th>
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat1[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat1[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat1[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat1 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat1[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat1[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat1[]"></td>
                                    </tr>
                                <?php }  ?>
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
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat2[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat2[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat2[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat2 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat2[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat2[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat2[]"></td>
                                    </tr>
                                <?php }  ?>
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
                                    <th class="text-xs font-weight-bolder">Item</th>
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat3[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat3[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat3[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat3 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat3[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat3[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat3[]"></td>
                                    </tr>
                                <?php }  ?>
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
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat4[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat4[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat4[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat4 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat4[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat4[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat4[]"></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div id="previewChecklistItem5" class="card mb-4" style="display: none;">
                <div class="card-header pb-3 bg-white">
                    <h6>5. Ziegler Superstucture (Pump Compartment)</h6>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="table1" class="table table-stripped" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-xs font-weight-bolder">Item</th>
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat5[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat5[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat5[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat5 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat5[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat5[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat5[]"></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div id="previewChecklistItem6" class="card mb-4" style="display: none;">
                <div class="card-header pb-3 bg-white">
                    <h6>6. FIREMAN TOOLS & EQUIPMENTS</h6>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="table1" class="table table-stripped" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-xs font-weight-bolder">Item</th>
                                    <th class="text-xs font-weight-bolder ps-2"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat6[]')"> Good</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat6[]')"> Damage</th>
                                    <th class="text-center text-xs font-weight-bolder"><input type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat6[]')"> N/A</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($subcat6 as $value) { ?>
                                    <tr>
                                        <td class="text-sm"><?= $value['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-good-cat6[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-damage-cat6[]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="chk-all-none-cat6[]"></td>
                                    </tr>
                                <?php }  ?>
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
                                        <img id="preview" style="border-radius: 5px;" src="" alt="" width="200px" />
                                        <br>
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
            <button class="btn btn-icon btn-3 btn-primary mb-0 float-end" type="button" id="btnsaveinspeksi" style="display: none;">
                <span class="btn-inner--icon text-white"><i class="ni ni-check-bold"></i></span>
                <span class="btn-inner--text text-white">Simpan</span>
            </button>
        </div>
    </div>