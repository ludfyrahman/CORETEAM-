<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div id="previewGeneralInspeksi" class="card mb-4">
                <div class="card-header pb-4 bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-1" style="width: 5%;">
                            <a href="<?= base_url('Inspeksi/InspeksiBoat/') ?>" class="btn btn-icon btn-3 btn-secondary rounded-circle mt-2" type="button">
                                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h5>Form Inspeksi</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tglInspeksi">Tanggal</label>
                                <input type="datetime-local" class="form-control text-sm" id="tglWaktuInspeksi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shift">Pilih Shift</label>
                                <select class="form-control text-sm" id="shift">
                                    <option value="">Pilih Shift</option>
                                    <option value="0">Pagi</option>
                                    <option value="1">Sore</option>
                                    <option value="2">Malam</option>
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
                                    <?php foreach ($commander as $data) { ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ficAssistant">FIC Assistant</label>
                                <select class="form-control text-sm" id="ficAssistant" aria-placeholder="true" multiple>
                                    <option value="">Pilih FIC Assistant</option>
                                    <?php foreach ($assistant as $data) { ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fuelLevel">Fuel Level</label>
                                <div class="input-group input-group-alternative mb-4">
                                    <input class="form-control" placeholder="Fuel level..." type="number" id="fuelLevel">
                                    <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-info mb-0 float-end" type="button" id="btnNextPage">
                <span class="btn-inner--icon text-white"><i class="ni ni-bold-right"></i></span>
                <span class="btn-inner--text text-white">Selanjutnya</span>
            </button>
        </div>

        <div class="col-lg-12 col-md-12">
            <div id="previewChecklistItem" class="card mb-4" style="display: none;">
                <div class="card-header pb-3 bg-white">
                    <h6>List Item Rescue Boat</h6>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="table1" class="table table-stripped" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                <th class="text-xs font-weight-bolder">Item</th>
                                    <th class="text-xs font-weight-bolder ps-2 pb-1"><input id="good-cat1" type="checkbox" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-good-cat1[]', 'chk-all-damage-cat1[]', 'chk-all-none-cat1[]')"> <label for="good-cat1">Good</label></th>
                                    <th class="text-center text-xs font-weight-bolder ps-2 pb-1"><input type="checkbox" id="damage-cat1" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-damage-cat1[]', 'chk-all-good-cat1[]', 'chk-all-none-cat1[]')"> <label for="damage-cat1">Damage</label> </th>
                                    <th class="text-center text-xs font-weight-bolder ps-2 pb-1"><input type="checkbox" id="none-cat1" class="form-check-input me-2" onchange="checkAllItem(this, 'chk-all-none-cat1[]', 'chk-all-good-cat1[]', 'chk-all-damage-cat1[]' )"> <label for="none-cat1">N/A</label></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($item as $data) { ?>
                                    <tr>
                                    <td class="text-sm"><?= $data['item'] ?></td>
                                        <td><input type="checkbox" class="form-check-input" data-subcategory="<?= $data['subcategory'] ?>" data-item="<?= $data['id_item'] ?>" id="chk-all-good-cat1[]" value="2"></td>
                                        <td><input type="checkbox" class="form-check-input" data-subcategory="<?= $data['subcategory'] ?>" data-item="<?= $data['id_item'] ?>" id="chk-all-damage-cat1[]" value="1"></td>
                                        <td><input type="checkbox" class="form-check-input" data-subcategory="<?= $data['subcategory'] ?>" data-item="<?= $data['id_item'] ?>" id="chk-all-none-cat1[]" value="0"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- total item by subcategory  -->
        <?php foreach ($countsub as $value) { ?>
            <input type="hidden" class="subCat" data-subcategory="<?= $value['subcategory'] ?>" value="<?= $value['total'] ?>">
        <?php }  ?>
        
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