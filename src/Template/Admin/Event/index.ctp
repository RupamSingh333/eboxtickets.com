<style>
	.btn-default {
		background-color: #4075fb;
		color: #fff;
	}

	.card-title {
		padding-right: 5px
	}


	#myUL {
		position: relative;
		z-index: 999;
	}

	#myUL ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		max-height: 100px;
		position: absolute;
		background-color: #fff;

	}

	#myUL li {
		font: 30px/ Helvetica, Verdana, sans-serif;
		border-bottom: 1px solid #ccc;
		background-color: #fff;
	}

	#myUL li li:last-child {
		border: none;
	}

	#myUL li a {
		text-decoration: none;
		color: #000;
		display: block;
		width: 258px;
	}

	.feature .fa-star {
		font-size: 25px;
	}


	.feature.y .fa-star {
		color: #21b354;
	}


	#orgUL {
		position: relative;
		z-index: 999;
	}

	#orgUL ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		max-height: 100px;
		position: absolute;
		background-color: #fff;

	}

	#orgUL li {
		font: 30px/ Helvetica, Verdana, sans-serif;
		border-bottom: 1px solid #ccc;
		background-color: #fff;
	}

	#orgUL li li:last-child {
		border: none;
	}

	#orgUL li a {
		text-decoration: none;
		color: #000;
		display: block;
		width: 258px;
	}
</style>

<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="<?php echo SITE_URL; ?>admin/dashboard ">Dashboard</a></li>
					<li><a href="<?php echo ADMIN_URL; ?>event/index ">Event Manager</a></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- <?php //echo $this->Paginator->limitControl([10 => 10, 15 => 15,20=>20,25=>25,30=>30]);
		?> -->
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="row">
			<?php echo $this->Flash->render(); ?>
			<div class="col-md-12">

				<div class="card">

					<div class="card-header">
						<strong class="card-title">Event Manager</strong>
						<!-- <a href="<?php //echo SITE_URL; 
										?>admin/event/add"><strong class="mr-1 btn btn-info card-title pull-right">Add</strong>
						</a> -->
						<!-- <button type="button" class="btn btn-info card-title mr-1 pull-right" data-toggle="modal" data-target="#exampleModal">
							Approval Settings
						</button> -->

					</div>

					<div class="row" style="padding: 10px;">

						<script>
							$(document).ready(function() {

								$("#Mysubscriptionevent").bind("submit", function(event) {
									var query = $(this).find('#query').val();
									$.ajax({
										async: true,
										data: $("#Mysubscriptionevent").serialize(),
										dataType: "html",
										type: "POST",
										url: "<?php echo ADMIN_URL; ?>event/search",
										success: function(data) {
											$("#mypage").html(data);
										},
									});
									return false;
								});
							});

							$(document).on('click', '.pagination a', function(e) {
								var target = $(this).attr('href');
								var res = target.replace("/event/search", "/event");
								window.location = res;
								return false;
							});
						</script>
						<?php echo $this->Form->create('Mysubscription', array('type' => 'file', 'inputDefaults' => array('div' => false, 'label' => false), 'id' => 'Mysubscriptionevent', 'class' => 'form-horizontal')); ?>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Event Name</label> <input type="hidden" id="location_ids">
								<?php echo $this->Form->input('eventname', array('class' => 'longinput form-control input-medium secrh-loc', 'placeholder' => 'Event Name', 'autocomplete' => 'off', 'type' => 'search', 'label' => false, 'value' => $eventname)); ?>
								<div id="myUL">
									<ul></ul>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label>Organiser</label>
								<input type="hidden" id="organiser_search">
								<?php echo $this->Form->input('orgasiger', array('class' => 'form-control input-medium organiser_search', 'placeholder' => 'Organiger Name', 'autocomplete' => 'off', 'type' => 'search', 'label' => false, 'value' => $Organiser)); ?>
								<div id="orgUL">
									<ul></ul>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label for="company" class=" form-control-label">From Date</label>
								<?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Date From', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'id' => 'datetimepicker1')); ?>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label for="company" class=" form-control-label">To Date</label>
								<?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Date To', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'id' => 'datetimepicker2')); ?>
							</div>
						</div>


						<div class="col-sm-3">
							<?php if (isset($ticket['id'])) {
								echo $this->Form->submit('Update', array(
									'title' => 'Update', 'div' => false,
									'class' => array('btn btn-primary btn-sm')
								));
							} else {  ?>
								<button type="submit" class="btn btn-success" id="Mysubscriptionevent">Search</button>
							<?php  } ?>

							<?php echo $this->Form->end(); ?>
							<a href="<?php echo SITE_URL; ?>admin/event/export" style="padding-top: 25px;"><strong class=" btn btn-info card-title pull-right" style="margin-right: 10px;">Export CSV</strong></a>
						</div>
					</div>

					<div id="mypage" class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 2%;" scope="col">S.No</th>
									<th style="width: 8%;" scope="col">Organiser</th>
									<th style="width: 14%;" scope="col">Event Name</th>
									<th style="width: 18%;" scope="col">Date and Time</th>
									<th style="width: 8%;" scope="col">Venue</th>
									<th style="width: 15%;" scope="col">Ticket Types</th>
									<th style="width: 10%;" scope="col">Total Sales</th>
									<th style="width: 9%;" scope="col">Comm(<?php echo $admin_info['feeassignment']; ?>%)</th>
									<th style="width: 0%;" scope="col">Featured</th>
									<th style="width: 8%;" scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($event as $value) :
									// pr($value);exit;
									$complete_sale = $this->Comman->calculatepayment($value->id);
								?>
									<tr>
										<td><?php echo $i; ?></td>

										<td><?php echo ucfirst($value->user->name) ?></td>

										<td><a style="text-decoration: underline;line-height: 21px;" href="<?php echo SITE_URL . 'event/' . $value->slug; ?>" target="_blank">
												<?php echo ucfirst($value->name); ?></a>
										</td>

										<td><b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['date_from'])); ?><br>
											<b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['date_to'])); ?>
										</td>

										<td><?php echo $value->location; ?></td>

										<td class="">

											<?php if (!empty($value['eventdetail'])) {

												foreach ($value['eventdetail'] as $key => $tickettype) {

													if ($value['is_free'] == 'Y') { ?>
														<a><?php echo $tickettype['title']; ?> - <Span>Invitation</Span></a>
													<?php  } else { ?>

														<a><?php echo $tickettype['title']; ?> - <Span><?php echo ($tickettype['type'] == 'open_sales') ? 'Online' : 'Committee'; ?></Span></a><br>
													<?php } ?>


												<?php }
											} else { ?>
												<a>Tickets not created</a>
											<?php } ?>

										</td>

										<td><a style="color: black;" href="<?php echo SITE_URL; ?>admin/event/eventdetail/<?php echo $value['id']; ?>">
												<?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
												<?php echo number_format($complete_sale, 2); ?>
												<?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?></strong>
											</a>
										</td>

										<td>
											<a style="color: black;">
												<?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
												<?php echo number_format($complete_sale * $admin_info['feeassignment'] / 100, 2); ?>
												<?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?>
											</a>
										</td>

										<td>
											<?php if ($value['featured'] == 'Y') {  ?>

												<a class="feature y" href="event/featuredstatus/<?php echo $value['id'] . '/N'; ?>"><i class="fa fa-star" style="font-size: 18px !important; margin-right: 5px; color:green;" aria-hidden="true"></i></a>
											<?php  } else { ?>

												<a class="feature n" href="event/featuredstatus/<?php echo $value['id'] . '/Y'; ?>"><i class="fa fa-star" style="font-size: 18px !important; margin-right: 5px;" aria-hidden="true"></i></a>

											<?php } ?>

											<!-- Get staff  -->
											<a href="<?php echo ADMIN_URL . 'event/getstaff/' . $value['event_org_id']; ?>" class="get_staff" title="View Staff"><i class="fa fa-eye" aria-hidden="true"></i></a>

										</td>


										<td class="actions">
											<?php if ($value['admineventstatus'] == 'Y') {  ?>
												<a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/N'; ?>" title="Click to Inactive"><i class="fa fa-toggle-on" style="font-size: 20px !important; margin-left: 1px; color:green;" aria-hidden="true"></i></a>

											<?php  } else { ?>
												<a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/Y'; ?>" title="Click to Active"><i class="fa fa-toggle-off" style="font-size: 20px !important; margin-left: 1px;" aria-hidden="true"></i></a>
											<?php } ?>

											<?= $this->Form->postLink(
												__(''),
												['action' => 'delete', $value->id, 'Y'],
												array('class' => 'fa fa-trash', 'title' => 'Delete', 'style' => 'font-size:17px; margin-right: 1px; color:red'),
												['onclick' => 'return confirm("Are you sure you want to delete application")']
											)

											?>

										</td>

									</tr>
								<?php $i++;
								endforeach; ?>
							</tbody>
						</table>
						<?php echo $this->element('admin/pagination'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="langcatmodal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>


<script>
	$(document).on("click", ".get_staff", function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		// console.log(href);
		$('#globalModalkoi .modal-content').load(href, function() {
			$('#globalModalkoi').modal({
				show: true
			});
		});
	});
</script>

<div class="modal" id="globalModalkoi" tabindex="-1" role="dialog" aria-labelledby="esModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content personal">

		</div>
	</div>
</div>
<!-- /.modal -->

<!-- Modal for setting -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Events Settings</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" enctype="multipart/form-data" class="needs-validation">
				<div class="modal-body">
					<div class="row g-3 text-start">
						<div class="col-md-12">
							<label for="inputName" class="form-label">Required for Event Approvals</label><br>
							<input type="checkbox" id="forFreeEvent" name="forFreeEvent" <?php //echo ($admin_info['forFreeEvent'] == 'Y') ? 'checked' : ''; 
																							?> value="Y">
							<label for="vehicle1"> For Free Event</label>
							<input type="checkbox" id="forPaidEvent" name="forPaidEvent" <?php //echo ($admin_info['forPaidEvent'] == 'Y') ? 'checked' : ''; 
																							?> value="Y">
							<label for="forPaidEvent"> For Paid Event</label><br>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>

		</div>
	</div>
</div> -->
<!-- Modal Closed -->

<div class="modal" id="langcatinfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<span class="modal-title" style="color: #fff;">Post New Report</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>


<script>
	$('.addlangcat').click(function(e) {
		e.preventDefault();
		$('#langcatmodal').modal('show').find('.modal-body').load($(this).attr('href'));
	});
</script>

<script>
	$('.infolangcat').click(function(e) {
		e.preventDefault();
		$('#langcatinfo').modal('show').find('.modal-body').load($(this).attr('href'));
	});
</script>

<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
	$(function() {
		$("#datetimepicker1").datepicker();
		$("#datetimepicker2").datepicker();
	});
</script>
<!-----------------------key search-------------------------------------------->
<script type="text/javascript">
	function cllbck(id, cid) {
		$('.secrh-loc').val(id);
		$('#location_ids').val(cid);
		$('#myUL').hide();
	}

	$(function() {
		$('.secrh-loc').bind('keyup', function() {
			var pos = $(this).val();

			$('#myUL').show();
			$('#location_ids').val('');
			var count = pos.length;

			if (count > 0) {
				$.ajax({
					type: 'POST',
					url: '<?php echo SITE_URL; ?>admin/ticket/loction',
					data: {
						'fetch': pos
					},
					success: function(data) {
						// console.log(data);
						$('#myUL ul').html(data);
					},
				});
			} else {
				$('#myUL').hide();
			}
		});

		// search organiser
		$('.organiser_search').bind('keyup', function() {
			var pos = $(this).val();

			$('#orgUL').show();
			$('#organiser_search').val('');
			var count = pos.length;

			if (count > 0) {
				$.ajax({
					type: 'POST',
					url: '<?php echo SITE_URL; ?>admin/event/organiser_search',
					data: {
						'fetch': pos
					},
					success: function(data) {
						// console.log(data);
						$('#orgUL ul').html(data);
					},
				});
			} else {
				$('#orgUL').hide();
			}
		});

	});

	function searchbck(id, cid) {
		$('.organiser_search').val(id);
		$('#organiser_search').val(cid);
		$('#orgUL').hide();
	}
</script>