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

<a class="btn btn-primary mb-5" href="<?php echo base_url() ?>courses/create">Curso</a>

<div class="card">
	<div class="card-body">
		<h4><?= $title ?></h4>
		<p>Debes tomar el curso completo antes de poder tomar el examen.</p>
		<div class="m-t-25">
			<div class="table-responsive">
				<table id="data-table"  class="table mb-5 table-hover">
					<thead>
					<tr>
						<th scope="col">Clase</th>
						<th scope="col">Acciones</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($items as $item): ?>
						<tr>
							<th scope="row"><img class="img-fluid img-thumbnail" src="<?php echo base_url() . $item['thumbnail'] ?>" alt="<?php echo $item['title'] ?>" width="120"> &nbsp; <?php echo $item['title'] ?></th>
							<th style="font-weight: normal !important;">
								<a class="btn btn-dark" href="<?php echo base_url() ?>playlists/play/<?php echo $item['content_id'] ?>">Reproducir &nbsp; <i class="anticon anticon-play-circle"></i></a>
							</th>
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

