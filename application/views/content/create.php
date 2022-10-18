<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $section ?>/</span> <?= $title ?></h4>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-primary alert-dismissible fade show">

		<div class="d-flex justify-content-start">
        <span class="alert-icon m-r-20 font-size-30">
            <i class="anticon anticon-check-circle"></i>
        </span>
			<div>
				<h5 class="alert-heading">Guardado Exitosamente</h5>
				<p><?php echo $this->session->flashdata('created'); ?></p>
			</div>
		</div>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>


<?php if($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show">

		<div class="d-flex justify-content-start">
        <span class="alert-icon m-r-20 font-size-30">
            <i class="anticon anticon-alert"></i>
        </span>
			<div>
				<h5 class="alert-heading">Error al subir archivo</h5>
				<p><?php echo $this->session->flashdata('error'); ?></p>
			</div>
		</div>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>


<?php echo validation_errors(); ?>


<div class="row">
	<!-- Basic Layout -->
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5 class="mb-0"><?php echo $title ?></h5> <small class="text-muted float-end">Cursos</small>
			</div>
			<div class="card-body">
				<?php echo form_open_multipart(base_url() . 'content/create/'.$course['course_id']); ?>

				<input type="hidden" name="course_id" value="<?php echo $course['course_id'] ?>">

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label" for="basic-default-name">Titulo</label>
					<div class="col-sm-10">
						<input type="text" name="title" class="form-control" id="basic-default-name" placeholder="Titulo del video o Archivo." />
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label" for="basic-default-name">Descripción</label>
					<div class="col-sm-10">
						<textarea name="description" class="form-control" id="basic-default-name" placeholder="Descripción video o Archivo." rows="8" ></textarea>
					</div>
				</div>


				<div class="row mb-3">
					<label for="formFile" class="col-sm-2 col-form-label">Contenido</label>
					<div class="col-sm-10">
						<input class="form-control" type="file" name="userfile" id="formFile">
						<small class="text-danger">*Campo requerido, Solo archivos de video .mp4 o Presentaciones PowerPoint.</small>
					</div>
				</div>


				<!--
				<div class="row justify-content-end">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
				-->

				<button id="trigger-loading-1" class="btn btn-primary m-r-5">
					<i class="anticon anticon-loading m-r-5"></i>
					<i class="anticon anticon-save m-r-5"></i>
					<span>Guardar</span>
				</button>


				<?php echo form_close(); ?>
			</div>
		</div>
	</div>



