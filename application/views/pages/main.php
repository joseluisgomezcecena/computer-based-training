<div class="col-lg-12 mb-4 order-0">

	<div style="background-image: url('<?php echo base_url() ?>assets/img/elements/background3.jpg'); background-size: cover; background-position: center center;" class="card">
		<div class="d-flex align-items-end row">
			<div class="col-sm-7">
				<div class="card-body">
					<h5 style="font-weight: bold;" class="card-title text-white">Computer Based Training V2.0 💻🧠</h5>

					<?php if(isset($this->session->userdata['logged_in'])): ?>
						<h5 style="font-weight: bold; margin-top: -10px;" class="card-title text-white">Bienvenido <?php echo $this->session->userdata['user_id']['user_name']; ?> !</h5>
					<?php endif; ?>

					<p class="mb-4 text-white">Explora todos los entrenamientos que tenemos para ti, Por el momento tienes: <b style="font-weight: bolder; font-size: 24px;"><?php echo $pending_number ?></b> Entrenamientos pendientes.</p>
					<br><br><br>
					<a href="<?php echo base_url() ?>main#pendingdiv" class="btn btn-secondary">
						<i class="fa fa-arrow-circle-down"></i>&nbsp;Ver Entrenamientos Pendientes
					</a>
				</div>
			</div>
			<div class="col-sm-5 text-center text-sm-left">
				<div class="card-body pb-0 px-0 px-md-4">

						<img src="<?php echo base_url() ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">

				</div>
			</div>
		</div>
	</div>
</div>


<div class="">
	<!-- Basic Layout -->
	<div class="col-lg-12 mb-4 order-0">
		<h4 style="font-weight: " class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mis Entrenamientos Por Terminar (<?php echo $pending_number ?>)</h4>
	</div>

	<div id="pendingdiv" class="card-container mt-5 row">

			<?php foreach ($courses as $course): ?>

			<div class="col-lg-4">


			<div class="card ">
				<img src="<?php  echo base_url() . $course['thumbnail'] ?>" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title"><?php echo $course['course_name'] ?> <?php echo $course['course_id'] ?></h5>
					<p class="card-text">
						Contenido: <b><?php echo $course['number'] ?></b> Videos o Documentos. <br>
						Creado: <?php echo date_format(date_create($course['created_at']),"M/d/Y")  ?> A las <?php echo date_format(date_create($course['created_at']),"H:i")  ?>
					</p>
					<a href="<?php echo base_url() ?>playlists/<?php echo $course['course_id'] ?>" class="btn btn-primary">Tomar Entrenamiento</a>
				</div>
			</div>

			</div>
			<?php endforeach; ?>

	</div>



</div>





