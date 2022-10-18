<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span><?= $title ?></h4>

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

<a class="btn btn-primary mb-5" href="<?php echo base_url() ?>courses/create">Nuevo Curso</a>

<div class="card">
	<div class="card-body">
		<h4><?= $title ?></h4>
		<p>Aqui presentamos el listado de cursos, puedes editar el contenido de los cursos o generar una nueva revisión</p>
		<div class="m-t-25">
			<div class="table-responsive">
				<table id="data-table"  class="table mb-5 table-hover">
					<thead>
					<tr>
						<th scope="col">Curso</th>
						<th scope="col">Revision</th>
						<th scope="col">Fecha</th>
						<th scope="col">Acciones</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($courses as $course): ?>
					<tr>
						<th scope="row"><?php echo $course['course_name'] ?></th>
						<th style="font-weight: normal !important;"><?php echo $course['revision'] ?></th>
						<th style="font-weight: normal !important;" ><?php echo date_format(date_create($course['created_at']),'M/d/Y') ?></th>
						<td  class="">
							<div class="dropdown dropdown-animated">
								<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span>Acciones</span>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="<?php echo base_url() ?>courses/<?php echo $course['course_id'] ?>">Administrar Contenido Del Curso</a>
									<a class="dropdown-item" href="<?php echo base_url() ?>courses/edit/<?php echo $course['course_id'] ?>">Editar Curso</a>
									<a class="dropdown-item text-danger" href="<?php echo base_url() ?>courses/delete/<?php echo $course['course_id'] ?>">Eliminar Curso</a>
									<a class="dropdown-item" href="<?php echo base_url() ?>courses/rev/<?php echo $course['course_id'] ?>"> Agregar Nueva Revisión</a>
								</div>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>

				</table>
				<div class="mt-5 mb-4">
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="card">
	<div class="card-body">
		<h4>Basic Usage</h4>
		<p>Using the most basic table markup, here’s how <code>.table</code>-based tables look in Bootstrap.</p>
		<div class="m-t-25">
			<div class="table-responsive ">
				<table class="table table-hover">
					<thead>
					<tr>
						<th>Tamaño</th>
						<th>Notas</th>
						<th>Acciones</th>
					</tr>
					</thead>
					<tbody class="">

					<?php foreach($sizes as $size): ?>

						<tr>
							<td><i class="fas fa-pizza-slice fa-lg text-dark me-3"></i> <strong><?php echo $size['size_name'] ?></strong></td>
							<td><?php echo $size['notes'] ?></td>
							<td>

								<div class="dropdown dropdown-animated">
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span>Animated Dropdown</span>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="<?php echo base_url() ?>sizes/edit/<?php echo $size['size_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Editar</a>
										<a class="dropdown-item" href="<?php echo base_url() ?>sizes/delete/<?php echo $size['size_id'] ?>"><i class="bx bx-trash me-1"></i> Eliminar</a>
									</div>
								</div>
							</td>
						</tr>

					<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
-->
