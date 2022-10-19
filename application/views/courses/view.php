


<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $section ?> / </span><?= $title ?></h4>

<?php if($this->session->flashdata('deleted')): ?>
	<div class="alert alert-primary alert-dismissible fade show">

		<div class="d-flex justify-content-start">
        <span class="alert-icon m-r-20 font-size-30">
            <i class="anticon anticon-check-circle"></i>
        </span>
			<div>
				<h5 class="alert-heading">Elemento eliminado</h5>
				<p><?php echo $this->session->flashdata('deleted'); ?></p>
			</div>
		</div>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>


<?php echo validation_errors(); ?>

<a class="btn btn-primary mb-5" href="<?php echo base_url() ?>content/create/<?php echo $course_item['course_id'] ?>">Agregar Contenido</a>

<div class="card">
	<div class="card-body">
		<h4><?= $title ?></h4>


		<div class="my-form-container mb-5">
			<?php echo form_open(base_url() . 'courses/update/' . $course_item['course_id']); ?>
			<div class="row mb-3">
				<label class="col-sm-2 col-form-label" for="basic-default-name">Nombre del curso</label>
				<div class="col-sm-10">
					<input type="text" name="course_name" class="form-control" id="basic-default-name" value="<?php echo $course_item['course_name'] ?>" placeholder="Nombre del curso." />
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



		<div class="m-t-25">

			<a href="javascript:void(0);" class="reorder_link btn btn-primary mb-5 mt-5" id="saveReorder">Reordenar Contenido</a>


			<div id="reorderHelper" class="light_box mb-5" style="display:none;">1. Arrastra los cursos para reordenar.<br>2. Haz Click en 'Guardar Cambios' cuando hayas terminado.</div>

			<div class="gallery">
				<ul class="reorder_ul reorder-photos-list list-group list-group-numbered">
					<?php
						foreach($contents as $row)
						{
							?>
							<li id="image_li_<?php echo $row['content_id']; ?>" class="ui-sortable-handle list-group-item d-flex justify-content-between align-items-start">
								<a href="javascript:void(0);" style="float:none;" class="image_link">
									<img src="<?php echo base_url($row["thumbnail"]); ?>" width="100"  class="img-fluid img-thumbnail shadow-lg"/>
								</a>
								<div style="width: 100%; margin-left: 20px;" class="ms-2 me-auto">

									<a href="javascript:void(0);" style="float:none;" class="image_link">
										<div class="fw-bold bold text-left"> <h4 style="font-weight: bold;"><?php echo $row['title'] ?></h4> </div>
										<!--
										<img src="<?php echo base_url($row["thumbnail"]); ?>" width="200" height="100%"/>
										-->
									</a>
								</div>
								<div class="dropdown dropdown-animated mr-5">
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span>Acciones</span>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="<?php echo base_url() ?>content/<?php echo $row['course_id'] ?>">Editar</a>
										<a class="dropdown-item" href="<?php echo base_url() ?>content/update/<?php echo $row['course_id'] ?>">Eliminar</a>
									</div>
								</div>
								<span class="badge bg-primary rounded-pill text-white">Orden: <?php echo $row['order'] ?></span>
							</li>




						<?php }  ?>
				</ul>
			</div>

		</div>
	</div>
</div>



