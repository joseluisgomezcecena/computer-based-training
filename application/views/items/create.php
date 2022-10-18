<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Platillos/</span> Agregar Ingredientes</h4>

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
				<h5 class="mb-0">Agregar Platillo</h5> <small class="text-muted float-end">Platillos</small>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url() . 'items/create'); ?>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label" for="basic-default-name">Nombre del platillo</label>
						<div class="col-sm-10">
							<input type="text" name="item_name" class="form-control" id="basic-default-name" placeholder="Ej. Tomate, Salsa, etc." />
						</div>
					</div>

					<div class="row mb-3">
						<?php foreach ($ingredients as $ingredient): ?>
						<div class="checkbox col-lg-3">
							<input id="ingredient-<?php echo $ingredient['ingredient_id'] ?>" name="ingredients[]" value="<?php echo $ingredient['ingredient_id'] ?>" type="checkbox">
							<label for="ingredient-<?php echo $ingredient['ingredient_id'] ?>"><?php echo $ingredient['ingredient_name'] ?></label>
						</div>
						<?php endforeach; ?>
					</div>


					<div class="row mb-3 ">
						<?php foreach ($sizes as $size): ?>
							<div class="col-lg-4 mb-5">
								<label class="col-sm-12 col-form-label" for="basic-default-name">Precio de <?php echo $size['size_name']; ?></label>
								<div class="col-sm-12">
									<input type="number" min="0" name="price_<?php echo $size['size_id'] ?>" class="form-control" id="basic-default-name" placeholder="Precio de <?php echo $size['size_name'] ?>" />
									<small>Dejar vacio el campo si no se considera el precio.</small>
								</div>
							</div>
						<?php endforeach; ?>
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
