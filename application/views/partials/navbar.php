<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $mainurl ?></li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0"><?= $mainurl ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <div class="btn-group dropdown mt-2">
                        <button type="button" class="btn bg-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?= $this->session->userdata('username'); ?></span>
                        </button>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('KelolaAkun/profile') ?>">My Profile</a></li>
                            <li><button class="dropdown-item border-radius-md text-danger" data-bs-toggle="modal" data-bs-target="#modal-logout">Logout</button>
                            </li>
                </li>
            </ul>
        </div>
        </li>

        </ul>
    </div>
    </div>
</nav>

<!-- Modal konfirmasi inspeksi -->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="modal-logout" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-logout">Alert</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Warning!</h4>
                    <p>Apakah anda yakin ingin keluar?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Kembali</button>
                <a href="<?= base_url('Auth/logout') ?>" type="button" class="btn btn-primary ml-auto">Keluar</a>
            </div>
        </div>
    </div>
</div>