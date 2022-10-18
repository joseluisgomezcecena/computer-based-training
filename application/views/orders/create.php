<?php # print_r($items); ?>

<div class="row">

	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">



				<div class="d-flex">
					<ul class="nav nav-tabs flex-column" id="myTabVertical" role="tablist">


						<?php foreach ($items as $item): ?>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab-<?php echo $item['item_id'] ?>" data-toggle="tab" data-identifier="<?php echo $item['item_id'] ?>" href="#profile-vertical-<?php echo $item['item_id'] ?>" role="tab" aria-controls="profile-vertical-<?php echo $item['item_id'] ?>" aria-selected="false">
								<?php echo $item['item_name'] ?>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>

					<div class="tab-content m-l-15" id="myTabContentVertical">

						<?php foreach ($items as $item): ?>

						<div class="tab-pane fade" id="profile-vertical-<?php echo $item['item_id'] ?>" role="tabpanel" aria-labelledby="profile-tab-vertical">
							<?php // echo $item['item_name'] ?>
						</div>

						<?php endforeach; ?>

						<div class="" style="width: 500px;" id="site_id"></div>
						<div class="row">
							<div class="col-lg-6" id="site2_id"></div>
							<div class="col-lg-6" id="sitew2_id">rere</div>
						</div>


					</div>
				</div>




			</div>
		</div>
	</div>

	<div class=" col-lg-4">
		<div class="card">
			<div class="card-body">

			</div>
		</div>
	</div>


</div>



<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
		$('#myTabVertical a').on('click', function(e) {
			e.preventDefault();
			$(this).tab('show');
			var this_id = $(this).attr('data-identifier');
			//alert('test:' + this_id);

			$.ajax({
				url: '<?php echo base_url(); ?>orders/get_item_data',
				type: 'POST',
				data: {
					item_id: this_id
				},
				dataType: 'json',
				success: function(response) {
					$("#site2_id").empty();
					$.each(response, function (index, data) {
						/*
						$('#site_id').append(
							'<div>' + index['item'] + data['item_name']  + '</div>'
						);
						*/

						for(var i = 0; i < data.length; i++) {
							$('#site2_id').append(
								'<div>' + data[i]['size_name'] +': '+ data[i]['price'] +'</div>'
							);
						}

					});

				}
			});




			$.ajax({
				url: '<?php echo base_url(); ?>orders/get_item',
				type: 'POST',
				data: {
					item_id: this_id
				},
				dataType: 'json',
				success: function(response) {
					$("#site_id").empty();
					$.each(response, function (index, data) {
						$('#site_id').append(
							'<div><h2 style="color: #2c2c2c; font-weight: bolder;" class="text-center">' + data['item_name']  + '</h2></div>'
						);
					});

				}
			});



		});
	});
</script>
