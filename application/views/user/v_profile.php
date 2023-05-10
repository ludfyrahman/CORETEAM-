<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header pb-4 bg-white">
                    <div class="d-flex align-items-center">
                        <h5>My Profile</h5>
                        <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" id="profile" role="tab" aria-selected="true">
                                            <i class="ni ni-single-02 text-sm"></i>
                                            <span class="ms-2 text-sm">My Profile</span>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" id="editProfile" role="tab" aria-selected="false">
                                            <i class="ni ni-settings-gear-65 text-sm"></i>
                                            <span class="ms-2 text-sm">Edit profile</span>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" id="changePassword" role="tab" aria-selected="false">
                                            <i class="ni ni-key-25 text-sm"></i>
                                            <span class="ms-2 text-sm">Change password</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="previewProfile" class="card-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Lengkap</label>
                                        <input id="nama" class="form-control" type="text" value="lucky.jesse" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input id="username" class="form-control" type="text" value="jesse@example.com" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Position</label>
                                        <input id="status" class="form-control" type="text" value="Jesse" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="previewEditProfile" class="card-body p-4" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-uppercase text-sm">Edit User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Lengkap</label>
                                        <input id="nama" class="form-control" type="text" value="lucky.jesse">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input id="username" class="form-control" type="text" value="jesse@example.com">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Position</label>
                                        <input id="status" class="form-control" type="text" value="Jesse">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="previewChangePassword" class="card-body p-4" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-uppercase text-sm">Change Password</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password lama</label>
                                        <input id="pwLama" class="form-control" type="password" value="lucky.jesse">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password baru</label>
                                        <input id="pwBaru" class="form-control" type="password" value="jesse@example.com">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Konfirmasi password baru</label>
                                        <input id="konfirPW" class="form-control" type="password" value="Jesse">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-primary mb-0 ms-2 float-end" style="display: none;" type="button" id="btnupdateprofile" data-bs-toggle="modal" data-bs-target="#modal-notification">
                <span class="btn-inner--icon text-white"><i class="ni ni-check-bold"></i></span>
                <span class="btn-inner--text text-white">Update profile</span>
            </button>
            <button class="btn btn-icon btn-3 btn-primary mb-0 ms-2 float-end" style="display: none;" type="button" id="btnupdatepassword" data-bs-toggle="modal" data-bs-target="#modal-notification">
                <span class="btn-inner--icon text-white"><i class="ni ni-check-bold"></i></span>
                <span class="btn-inner--text text-white">Update password</span>
            </button>
        </div>
    </div>