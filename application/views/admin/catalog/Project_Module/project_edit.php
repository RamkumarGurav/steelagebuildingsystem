<?php
$page_module_name = "Projects";
?>
<?
$record_action = "Add New Record";
$project_id = 0;
$project_gallery_image_id = 0;
$name = $project_cover_image = $description = $slug_url = "";
$project_variant = 0;
$status = 1;
$project_variant_data = [
	(object) ["project_variant" => 1, "project_variant_name" => "Ongoing Project"],
	(object) ["project_variant" => 2, "project_variant_name" => "Completed Project"],
];

if (!empty($project_data)) {

	$record_action = "Update";
	$project_id = $project_data->project_id;
	$project_variant = $project_data->project_variant;
	$slug_url = $project_data->slug_url;
	$name = $project_data->name;
	$description = $project_data->description;
	$project_cover_image = $project_data->project_cover_image;
	$status = $project_data->status;


}



?>
<script>
	<?php if ($user_access->view_module == 1) { ?>
		$(document).ready(function () {
			$.ajax({
				type: "POST",

				url: '<? echo MAINSITE_Admin ?>catalog/Project-Module/GetCompleteProjectGalleryImageList',
				//dataType : "json",
				data: { "project_gallery_image_id": '<? echo $project_gallery_image_id; ?>', "project_id": '<? echo $project_id; ?>', "withPosition": 1, 'sortByPosition': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
				success: function (result) {
					//   alert(result);
					$('#projectGalleryImageList').html(result);
					//ArrangeTable();
					dragEvent();
				}
			});
		});
	<? } ?>
</script>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!--{{{{{{ Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!--{{{{{{ Page Module Header with breadcrumb -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">

				<div class="col-sm-6">
					<h1 class="m-0 text-dark">
						<?= $page_module_name ?> </small>
					</h1>
				</div><!-- /.col -->

				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= MAINSITE_Admin . "wam" ?>">Home</a></li>
						<li class="breadcrumb-item"><a
								href="<?= MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name ?>">
								<?= $user_access->module_name ?>
								List
							</a></li>
						<? if (!empty($project_data)) { ?>
							<li class="breadcrumb-item"><a
									href="<?= MAINSITE_Admin . $user_access->class_name . "/project-view/" . $project_id ?>">View</a>
							</li>
						<? } ?>
						<li class="breadcrumb-item">
							<?= $record_action ?>
						</li>
					</ol>
				</div><!-- /.col -->

			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- }}}}}} Page Module Header with breadcrumb -->

	<!--{{{{{{ Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">

				<!-- {{{{{{ Main Card form with Header -->
				<div class="card">

					<!-- {{{{{form-header -->
					<div class="card-header">
						<h3 class="card-title">
							<?= $name ?> <small>
								<?= $record_action ?>
							</small>
						</h3>
					</div>
					<!-- }}}}}.form-header -->


					<!-- {{{{{ Main Form -->
					<?php
					if ($user_access->view_module == 1 || true) {
						?>

						<!-- {{{{{ always echo the "alert_message" before the main "card-body"-->
						<? echo $this->session->flashdata('alert_message'); ?>
						<!-- }}}}} "alert_message" -->


						<div class="card-body">
							<?php echo form_open(
								MAINSITE_Admin . "$user_access->class_name/projectDoEdit",
								array(
									'method' => 'post',
									'id' => 'project_form',
									"name" => "project_form",
									'style' => '',
									'class' => 'form-horizontal',
									'role' => 'form',
									'enctype' => 'multipart/form-data'
								)
							); ?>
							<input type="hidden" name="project_id" id="project_id" value="<?= $project_id ?>" />
							<input type="hidden" name="redirect_type" id="redirect_type" value="" />



							<div class="form-group row">
								<div class=" col-md-3 col-sm-6">
									<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Project Variant <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
									<div class="col-sm-12">
										<select type="text" class="form-control form-control-sm" required id="project_variant"
											name="project_variant">
											<option value="">Select Project Variant</option>
											<? foreach ($project_variant_data as $item) {
												$selected = "";
												if ($item->project_variant == $project_variant) {
													$selected = "selected";
												}
												?>
												<option value="<?= $item->project_variant ?>" <?= $selected ?>> <?= $item->project_variant_name ?>

												</option>
											<? } ?>
										</select>

									</div>
								</div>

								<div class="col-md-5 col-sm-6">
									<label for="name" class="col-sm-12 label_content px-2 py-0">Project Name <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
									<div class="col-sm-12">
										<input type="text" class="form-control form-control-sm" required id="name" name="name"
											value="<?= $name ?>" placeholder="Project Name">
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<label for="location" class="col-sm-12 label_content px-2 py-0">Upload Cover Image <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

									<div class="col-sm-12 d-flex">
										<div class="input-group" style="width:90%">
											<div class="custom-file">
												<input type="file" accept="image/*" name="project_cover_image" class="custom-file-input"
													id="project_cover_image" <? if (empty($project_data->project_cover_image)) { ?> required <? } ?>>
												<label class="custom-file-label form-control-sm" for="project_cover_image"></label>

											</div>

										</div>
										<div class="custom-file-display custom-file-display0">
											<? if (!empty($project_cover_image)) { ?>
												<span class="pip pip0">
													<a target="_blank"
														href="<?= _uploaded_files_ . 'project_cover_image/' . $project_data->project_cover_image ?>">
														<img class="imageThumb imageThumb0"
															src="<?= _uploaded_files_ . 'project_cover_image/' . $project_data->project_cover_image ?>" />
													</a>
												</span>
											<? } else { ?>
												<span class="pip pip0">
													<img class="imageThumb imageThumb0" src="<?= _uploaded_files_ ?>no-img.png" />
												</span>
											<? } ?>
										</div>
									</div>
								</div>

							</div>

							<div class="form-group">

								<div class="col-md-12">
									<label for="description" class="col-sm-12 label_content px-2 py-0">Project Description <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

									<textarea required name="description" id="description" required class="form-control"
										rows="5"><? echo $description; ?></textarea>


								</div>

							</div>


							<div class="form-group row">

								<div class="col-md-4 col-sm-6">
									<label for="slug_url" class="col-sm-12 label_content px-2 py-0">Slug URL <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
									<div class="col-sm-12">
										<input type="text" class="form-control form-control-sm" required id="slug_url" name="slug_url"
											value="<?= $slug_url ?>" placeholder="Slug URL">
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<label for="location" class="col-sm-12 label_content px-2 py-0">Upload Bulk Project Images <span
											style="color:#f00;font-size: 22px;margin-top: 3px;"></span></label>

									<div class="col-sm-12 d-flex">
										<div class="input-group" style="width:90%">
											<div class="custom-file">
												<input type="file" accept="image/*" multiple name="image[]" class="custom-file-input" id="image">
												<label class="custom-file-label form-control-sm" for="image"></label>

											</div>

										</div>

									</div>

								</div>



								<div class="col-md-4  col-sm-6">
									<table class="table table-sm ">

										<tbody id="image_preview_table_body">
											<!-- Image previews will be added here by JavaScript -->
										</tbody>
									</table>
								</div>


							</div>
							<?php if (!empty($project_data->project_gallery_image)) { ?>
								<div class="form-group row">
									<label for="slug_url" class="col-sm-12 label_content px-2 py-0">Uploaded Project Images </label>
									<div class="col-sm-12">
										<div class="row card">
											<div class="col-md-12 card-body ">
												<div class="box box-primary">
													<div class="box-header with-border">

													</div>
													<div class="box-body">
														<?php if ($user_access->view_module == 1) { ?>

															<link rel="stylesheet" href="<?= _admin_files_ ?>css/tablednd.css" type="text/css" />
															<div class="tableDemo">
																<table class="table table-striped" id="table-2">
																	<thead>
																		<tr>
																			<th>Slno.</th>
																			<th>Image</th>
																			<th>Position</th>
																			<th>Published</th>
																			<th>Added On</th>
																			<th>Delete</th>
																		</tr>
																	</thead>
																	<tbody id="projectGalleryImageList">


																		<tr>
																			<td colspan="10">
																				<div class="clearfix text-center">
																					<img src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" />
																				</div>
																			</td>
																		</tr>


																	</tbody>

																</table>
																<div class="result"></div>
															</div>

														<? } else {
															//$this->data['no_access_flash_message']="You Dont Have Access To View ".$page_module_name;
															$this->load->view('admin/template/access_denied', $this->data);
														} ?>

														<script src="<?= _admin_files_ ?>js/jquery.tablednd.js" type="text/javascript"></script>

														<script>



															function dragEvent() {
																table_2 = $("#table-2");
																table_2.find("tr:even").addClass("alt");

																$("#table-2").tableDnD({
																	onDragClass: "myDragClass",
																	onDrop: function (table, row) {
																		var rows = table.tBodies[0].rows;
																		var podId = '';
																		for (var i = 0; i < rows.length; i++) {
																			podId += rows[i].id + ",";
																		}

																		$('#projectGalleryImageList').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" /></div></td></tr>');
																		$.ajax({
																			type: "POST",
																			url: '<?= MAINSITE_Admin . 'catalog/Project-Module/GetCompleteProjectGalleryImageListNewPos' ?>',
																			//dataType : "json",
																			data: { "project_gallery_image_id": '<? echo $project_gallery_image_id; ?>', "project_id": '<? echo $project_id; ?>', 'podId': podId, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
																			success: function (result) {
																				// alert(result);
																				$('#projectGalleryImageList').html(result);
																				$(table).parent().find('.result').text("Order Changed Successfully");
																				dragEvent();
																			}
																		});

																	},
																	onDragStart: function (table, row) {
																		$(table).parent().find('.result').text("Started dragging row id " + row.id);

																	},

																});

															}


														</script>
													</div>
												</div>
											</div>
										</div>
									</div>


								</div>

							<?php } ?>


							<div class="form-group row">
								<div class="col-md-4  col-sm-6">
									<label for="radioSuccess1" class="col-sm-12 label_content px-2 py-0">Status <span
											style="color:#f00;font-size: 22px;margin-top: 3px;"> </span></label>
									<div class="col-sm-12">
										<div class="form-check" style="margin-top:12px">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="status" <? if ($status == 1) {
														echo "checked";
													} ?> value="1"
														id="radioSuccess1">
													<label for="radioSuccess1"> Active
													</label>
												</div>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="icheck-danger d-inline">
													<input type="radio" name="status" <? if ($status != 1) {
														echo "checked";
													} ?> value="0"
														id="radioSuccess2">
													<label for="radioSuccess2"> Block
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



							<!-- /.card-body -->
							<div class="card-footer">
								<center>
									<button type="submit" name="save" onclick=" redirect_type_func('');" value="1"
										class="btn btn-info">Save</button>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="submit" name="save-add-new" onclick=" redirect_type_func('save-add-new');" value="1"
										class="btn btn-default ">Save And Add New</button>
								</center>
							</div>
							<!-- /.card-footer -->

							<?php echo form_close() ?>
							</table>
						</div>
					<? } else {
						$this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
						$this->load->view('admin/template/access_denied', $this->data);
					} ?>

					<!-- }}}}} Main Form -->
				</div>
				<!--   }}}}}} Main Card form with Header -->
			</div>
		</div>


	</section>
	<!-- }}}}} Main content -->
</div>
<!--}}}}}} Content Wrapper. Contains page content -->


<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>


<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script>
	window.addEventListener('load', function () {
		//add validation for description
		document.getElementById('project_form').addEventListener('submit', function (event) {
			var description = document.getElementById('description').value.trim();

			if (description === "") {
				toastrDefaultErrorFunc("Project description is required");
				event.preventDefault(); // Prevent form from submitting
			}
		});
	});
</script>
<script>
	function validateForm() {
		event.preventDefault();
		//user_role user_role_id

		$(".error_span").html("");
		var user_role_id_arr = document.getElementsByName("user_role_id[]");
		var i = 0;
		var user_role_check = true;
		for (i = 0; i < user_role_id_arr.length; i++) {
			if (user_role_id_arr[i].value != '') {
				user_role_check = false;
			}
		}
		if (user_role_check) {
			toastrDefaultErrorFunc("You Did Not Assign The Role To The User.");
			$("#user_role_error").html("You Did Not Assign The Role To The User.");
		}
		else {
			$('#employee_form').attr('onsubmit', '');
			$("#employee_form").submit();
		}
	}

	function redirect_type_func(data) {
		document.getElementById("redirect_type").value = data;
		return true;
	}

	window.addEventListener('load', function () {
		if (window.File && window.FileList && window.FileReader) {
			$("#project_cover_image").on("change", function (e) {
				var files = e.target.files,
					filesLength = files.length;
				for (var i = 0; i < filesLength; i++) {
					var f = files[i]
					var fileReader = new FileReader();
					fileReader.onload = (function (e) {
						var file = e.target;
						//customized code 
						$(".pip0").remove();
						$(".custom-file-display0").html("<span class=\"pip pip0\">" +
							"<img class=\"imageThumb imageThumb0\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "</span>");
					});
					fileReader.readAsDataURL(f);
				}
			});
		} else {
			alert("Your browser doesn't support to File API")
		}

	});






	window.addEventListener('load', function () {
		if (window.File && window.FileList && window.FileReader) {
			$("#image").on("change", function (e) {
				var files = e.target.files;
				var filesLength = files.length;
				$("#image_preview_table_body").html(""); // Clear previous thumbnails

				for (var i = 0; i < filesLength; i++) {
					var f = files[i];
					var fileReader = new FileReader();

					fileReader.onload = (function (file) {
						return function (e) {
							// Append new image preview in table format
							$("#image_preview_table_body").append(
								"<tr>" + "<td>" + file.name + "</td>" +
								"<td><img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" style=\"max-width: 100px; max-height: 100px;\"/></td>" +
								"</tr>"
							);
						};
					})(f); // Pass the file object as a parameter

					fileReader.readAsDataURL(f);
				}
			});
		} else {
			alert("Your browser doesn't support the File API");
		}
	});






	/*  >>> ADDING MORE GALLERY FILES*/

	function del_pgi($project_gallery_image_id) {
		if (parseInt($project_gallery_image_id) > 0) {
			var s = confirm('You want to delete this file?');
			if (s) {
				$.ajax({
					url: "<?= MAINSITE_Admin . 'Ajax/del_any_file' ?>",
					type: 'post',
					//dataType: "json",
					data: {
						"table_name": "project_gallery_image",
						"id_column": "project_gallery_image_id",
						'id': $project_gallery_image_id,
						"folder_name": "project_gallery_image",
						"<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
					},
					success: function (response) {
						toastrDefaultSuccessFunc("Record Deleted Successfully");
						window.location.reload();
						//alert(response);
						$("#quotation_enquiry_file_" + $project_gallery_image_id).hide();
					},
					error: function (request, error) {
						toastrDefaultErrorFunc("Unknown Error. Please Try Again");
					}
				});
			}
		}

		return false;
	}
	/* <<<< ADDING MORE GALLERY FILES*/




</script>
<script>
	function generateSlug(input) {
		return input
			.toString()
			.toLowerCase()
			.replace(/\s+/g, '-')           // Replace spaces with -
			.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
			.replace(/\-\-+/g, '-')         // Replace multiple - with single -
			.replace(/^-+/, '')             // Trim - from start of text
			.replace(/-+$/, '');            // Trim - from end of text
	}

	document.addEventListener('DOMContentLoaded', function () {
		const nameInput = document.getElementById('name');
		const slugInput = document.getElementById('slug_url');

		nameInput.addEventListener('input', function () {
			slugInput.value = generateSlug(nameInput.value);
		});
	});
</script>