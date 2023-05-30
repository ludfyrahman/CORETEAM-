<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Inspeksi Hari ini</p>
                                <h5 class="font-weight-bolder">
                                    <?= number_format($data[0]) ?>
                                </h5>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <a href="<?= base_url('Inspeksi/InspeksiCar') ?>">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold text-black">Rescue Car</p>
									<h5 class="font-weight-bolder d-none">
										<?= number_format($data[1]) ?>
									</h5>

								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
									<i class="fa-solid fa-car text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
			<a href="<?= base_url('Inspeksi/InspeksiTruck') ?>">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold text-black">Fire Truck</p>
									<h5 class="font-weight-bolder d-none">
										<?= number_format($data[2]) ?>
									</h5>

								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
									<i class="fa-solid fa-truck text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
        </div>
        <div class="col-xl-4 col-sm-6">
			<a href="<?= base_url('Inspeksi/InspeksiBoat') ?>">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold text-black">Rescue Boat</p>
									<h5 class="font-weight-bolder d-none">
										<?= number_format($data[3]) ?>
									</h5>

								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
									<i class="fa-solid fa-ship text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 mb-4" style="height:750px">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100"  data-bs-interval="5000" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <?php
                        for ($i = 0; $i < 10; $i++) {
                        ?>
                            <div class="carousel-item h-100 <?= $i == 0 ? 'active' : '' ?>" style="background-image: url('<?= base_url('assets/img/sliders/slide' . ($i + 1) . '.jpeg') ?>'); background-size: auto;background-repeat: no-repeat;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                     <h5 class="title position-relative text-white mb-1" style="z-index:2"><?= APP_TITLE ?></h5>
                                    <p class='desc position-relative text-white typing' style="z-index:2;" id='desc-<?= $i ?>'></p>
                                    <script>
                                      window.ityped.init(document.querySelector('#desc-<?= $i ?>'),{
                                        strings: ['<?=APP_DESC?>'],
                                        loop: true
                                      })
                                    </script>
                                </div>
                            </div>
                            <div class='overlay'></div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 ">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Inspeksi</h6>

                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="bar-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
