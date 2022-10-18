


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



		<div class="m-t-25">

			<a href="javascript:void(0);" class="reorder_link btn btn-primary mb-5" id="saveReorder">Reordenar Contenido</a>


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
								<span class="badge bg-primary rounded-pill text-white"><?php echo $row['order'] ?></span>
							</li>




						<?php }  ?>
				</ul>
			</div>

		</div>
	</div>
</div>



