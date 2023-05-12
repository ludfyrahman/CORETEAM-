<!-- Modal konfirmasi inspeksi -->
<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Alert</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Warning!</h4>
                    <p>Apakah anda yakin inspeksi sudah diisi dengan benar?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary ml-auto">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal konfirmasi delete akun -->
<div class="modal fade" id="modal-delete-akun" tabindex="-1" role="dialog" aria-labelledby="modal-delete-akun" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete-akun">Alert</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Warning!</h4>
                    <p>Apakah anda yakin ingin menghapus akun ini?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Batal</button>
                <button onclick="deleteAccount()"id="delete_link" type="button" class="btn btn-primary ml-auto">Hapus</button>
            </div>
        </div>
    </div>
</div>