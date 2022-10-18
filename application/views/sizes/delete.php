<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tamaños/</span> Eliminar Tamaños</h4>

<?php echo validation_errors(); ?>


<div class="row">
	<!-- Basic Layout -->
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5 class="mb-0">Eliminar Tamaño</h5> <small class="text-muted float-end">Tamaños</small>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url() . 'sizes/delete/' . $size['size_id'] ); ?>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-name">Nombre del tamaño</label>
						<div class="col-sm-10">
							<input type="text" name="size_name" value="<?php echo $size['size_name'] ?>" class="form-control" id="basic-default-name" placeholder="Ej. Grande, Mediano" readonly />
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-message">Notas</label>
						<div class="col-sm-10">
							<textarea id="basic-default-message" class="form-control" placeholder="Notas pertinentes" readonly><?php echo $size['notes'] ?></textarea>
						</div>
					</div>
					<div class="row justify-content-end">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-danger">Eliminar</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
