<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $section ?>/</span> <?= $title ?></h4>

<?php if($this->session->flashdata('created')): ?>
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


<?php echo validation_errors(); ?>


<div class="row">
	<!-- Basic Layout -->
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5 class="mb-0"><?php echo $title ?></h5> <small class="text-muted float-end">Cursos</small>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url() . 'courses/create'); ?>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-name">Nombre del curso</label>
						<div class="col-sm-10">
							<input type="text" name="course_name" class="form-control" id="basic-default-name" placeholder="Nombre del curso." />
						</div>
					</div>


					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-name">Departamentos</label>
						<div class="col-sm-10">
							<select style="width: 100%" class="js-example-basic-multiple" name="departments[]" multiple="multiple">
								<?php foreach ($departments as $department): ?>
									<option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>


					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-name">Usuarios especificos</label>
						<div class="col-sm-10">
							<select style="width: 100%" class="js-example-basic-multiple" name="users[]" multiple="multiple">
								<?php foreach ($users as $user): ?>
									<option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_email']; ?>| <?php echo $user['user_name']; ?> <?php echo $user['user_lastname']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>


					<div class="row justify-content-end">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
