<div class="app mt-5">
	<div class="container-fluid">
		<div class="d-flex full-height p-v-15 flex-column justify-content-between">

			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-12  col-lg-6 offset-lg-3">



						<?php echo validation_errors(); ?>

						<?php if($this->session->flashdata('login_success')): ?>

							<div class="alert alert_success">
								<strong class="uppercase"><bdi>Logged:</bdi></strong>
								Logged in.
								<button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
							</div>

						<?php endif; ?>

						<?php if($this->session->flashdata('login_failed')): ?>


							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<div class="d-flex align-items-center justify-content-start">
									<span class="alert-icon">
										<i class="anticon anticon-close-o"></i>
									</span>
									<span>Usuario o contraseña incorrectos, recuerda que <b>tu usuario es tu correo electronico de la empresa.</b></span>
								</div>

							</div>

						<?php endif; ?>








						<div class="card">
							<div class="card-body">
								<h2 class="m-t-20">Inicia Sesión</h2>
								<p class="m-b-30">Ingresa tus credenciales para acceder.</p>
								<?php echo form_open(base_url() . 'users/login') ?>
									<div class="form-group">
										<label class="font-weight-semibold" for="userName">Correo electronico:</label>
										<div class="input-affix">
											<i class="prefix-icon anticon anticon-user"></i>
											<input type="email" class="form-control" name="username" id="userName" placeholder="Username">
										</div>
									</div>
									<div class="form-group">
										<label class="font-weight-semibold" for="password">Contraseña:</label>
										<a class="float-right font-size-13 text-muted" href="">Olvidaste tu contraseña?</a>
										<div class="input-affix m-b-10">
											<i class="prefix-icon anticon anticon-lock"></i>
											<input type="password" class="form-control" name="password" id="password" placeholder="Password">
										</div>
									</div>
									<div class="form-group">
										<div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    No tienes una cuenta?
                                                    <a class="small" href=""> Registrate</a>
                                                </span>
											<button type="submit" class="btn btn-primary">Inicia Sesión</button>
										</div>
									</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
					<div class="offset-md-1 col-md-6 d-none d-md-block">
						<img class="img-fluid" src="assets/images/others/login-2.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


