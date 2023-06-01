<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © Copyright <?= '<b>' . SITE_NAME . '</b>' . ' ' . date('Y') ?>. All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</main>
<!--   Core JS Files   -->
<script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
<script>

var data = {
            labels: <?php echo json_encode($data[5])?>,
            datasets: [
				<?php 
					foreach ($data[4] as $key => $d) {
				?>
                {
                    label: '<?= $d['label'] ?>',
                    backgroundColor: '<?= $d['color'] ?>',
                    data: <?= json_encode($d['data']) ?>
                },
				<?php } ?>
            ]
        };

        // Chart configuration
        var config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: false
                    },
                    y: {
                        stacked: false,
						ticks: {
							stepSize: 1, // Set the step size to 1 for integer values
						},
                    }
                }
            }
        };

        // Create the chart
        var ctx = document.getElementById('bar-chart').getContext('2d');
        new Chart(ctx, config);


</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url('assets/js/argon-dashboard.min.js') ?>"></script>

<script src="<?= base_url('assets/'); ?>vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">
    $('#btnLogOut').on('click', function() {
        confirmAlert('Apakah anda yakin ingin keluar?', 'Tekan ya untuk keluar dan tidak untuk kembali', 'warning', 'Ya, keluar', 'Tidak').then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Auth/logout') ?>';
            }
        })
    })

    function showNotification(type, msg, desc) {
        toastr[type](desc, msg, {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "2000",
        });
    }

    function confirmAlert(title, text, icon, btnYes, btnNo) {
        return Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: btnYes,
            cancelButtonText: btnNo
        })
    }
</script>
</body>

</html>
