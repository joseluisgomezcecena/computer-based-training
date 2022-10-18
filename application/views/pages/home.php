				<div class="container mt-5">
					<div class="row">
						<div class="col-lg-8 mb-4 order-0">

							<div style="background-image: url('<?php echo base_url() ?>assets/img/elements/bg4.jpg'); background-size: cover; background-position: top center" class="card">
								<div class="d-flex align-items-end row">
									<div class="col-sm-7">
										<div class="card-body">
											<h5 class="card-title text-white">Bienvenido a Slice! 🍕</h5>
											<p class="mb-4">Aqui podras administrar tu pizzeria. Haz click en administrar y configura tu menu y precios.</p>

											<a href="<?php echo base_url() ?>admins" class="btn btn-sm btn-danger">Administrar</a>
										</div>
									</div>
									<div class="col-sm-5 text-center text-sm-left">
										<div class="card-body pb-0 px-0 px-md-4">
											<!--
											<img src="<?php echo base_url() ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
											-->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4 mb-4 order-1">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
										<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
											<div class="card-title">
												<h5 class="text-nowrap mb-2">Login</h5>
												<small class="text-success text-nowrap fw-semibold">Inicie sesión para acceder.</small>
											</div>
											<div class="mt-sm-auto">
												<h3 class="mb-0">
													<a href="<?php echo base_url() ?>users/login" class="btn btn-dark">Inicio de Sesión</a>
												</h3>
											</div>
										</div>
										<div id="profileReportChart"></div>
									</div>
								</div>
							</div>
						</div>






						<!-- Total Revenue -->
						<div class="col-lg-8 col-md-8 mb-4 order-2">
							<div class="card">
								<div class="row row-bordered g-0">
									<div class="col-md-8">
										<h5 class="card-header mt-3">Acciones</h5>
										<div id="totalRevenueChart" class="px-2"></div>
									</div>
									<div class="col-12">
										<div class="card-body">
											<div class="">
												<a href="<?php echo base_url() ?>admins" class="btn btn-dark">Administrador</a>
												<a href="<?php echo base_url() ?>operations" class="btn btn-dark">Operaciones</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>



						<div class="col-4 mb-4 order-3">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
										<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
											<div class="card-title">
												<h3 class="text-nowrap mb-3 "><b>Fecha y Hora</b></h3>
												<h4>
													<span class=""><?php echo date("d/m/Y") ?></span>
													<span id="txt"></span>
												</h4>
											</div>
											<div class="mt-sm-auto">

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>



					</div>


				</div>
				<!-- / Content -->


				<div id="txt"></div>

				<script>
					function startTime() {
						const today = new Date();
						let h = today.getHours();
						let m = today.getMinutes();
						let s = today.getSeconds();
						m = checkTime(m);
						s = checkTime(s);
						document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
						setTimeout(startTime, 1000);
					}

					function checkTime(i) {
						if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
						return i;
					}

					startTime();
				</script>










