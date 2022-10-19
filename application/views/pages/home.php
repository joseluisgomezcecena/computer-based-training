				<div class="container mt-5">
					<div class="row">
						<div class="col-lg-8 mb-4 order-0">

							<div style="background-image: url('<?php echo base_url() ?>assets/img/elements/background3.jpg'); background-size: cover; background-position: center center; height: 420px" class="card">
								<div class="d-flex align-items-end row">
									<div class="col-sm-7">
										<div class="card-body">
											<h5 style="font-weight: bold;" class="card-title text-white">Computer Based Training V2.0 💻🧠</h5>

											<?php if(isset($this->session->userdata['logged_in'])): ?>
												<h5 style="font-weight: bold; margin-top: -10px;" class="card-title text-white">Bienvenido <?php echo $this->session->userdata['user_id']['user_name']; ?> !</h5>
											<?php endif; ?>

											<p class="mb-4 text-white">Ingresa tu usuario y contraseña para accesar a los entrenamientos que te corresponden.</p>
											<br><br><br>
											<a href="<?php echo base_url() ?>users/login" class="btn btn-secondary">
												<?php if(isset($this->session->userdata['logged_in'])): ?>
													Ver Los Entrenamientos De <?php echo $this->session->userdata['user_id']['user_name']; ?>
												<?php else: ?>
													Ingresar
												<?php endif; ?>
											</a>
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
						<div class="col-lg-4 col-sm-12 col-md-12 mb-4 order-1">
							<div style="height: 420px;" class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
										<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
											<div class="card-title">
												<h5 style="font-weight: bolder;" class="text-nowrap mb-2">Registro y Login</h5>
												<small class="text-dark fw-semibold mb-5">Debe tener una cuenta de Software de Martech Medical para ingresar.</small>
												<div>
													<br><br><br><br/>
													<!--
													<a href="<?php echo base_url() ?>users/login" class="btn btn-dark mt-2">Inicio de Sesión</a>
													<br><br>
													-->
													<a href="http://mxmtsvrandon1/authentication/index.php/home/register" target="_blank" class="mt-5">Obtener cuenta ></a>
													<br><br>
													<a href="http://mxmtsvrandon1/authentication/index.php/reset-password" target="_blank" class="mt-5">Olvide mi contraseña ></a>
												</div>

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








