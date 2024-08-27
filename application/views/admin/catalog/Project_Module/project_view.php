<?php

$page_module_name = "Projects";

?>
<?php
$name = "";
$admin_user_id = 0;
$status = 1;
$record_action = "Add New Record";





?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?= $page_module_name ?> <small>Details</small>
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
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <? ?>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card ">

                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $project_data->name ?>
                        </h3>
                        <div class="float-right">
                            <?php
                            if ($user_access->add_module == 1 && false) {
                                ?>
                                <a href="<?= MAINSITE_Admin . $user_access->class_name ?>/project-edit">
                                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                                        New</button></a>
                            <? } ?>
                            <?php
                            if ($user_access->update_module == 1) {
                                ?>
                                <a
                                    href="<?= MAINSITE_Admin . $user_access->class_name ?>/project-edit/<?= $project_data->project_id ?>">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                        Update</button>
                                </a>
                            <? } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <?php
                    if ($user_access->view_module == 1) {
                        ?>
                        <div class="card-body card-primary card-outline">
                            <?php echo form_open(MAINSITE_Admin . "$user_access->class_name/project-doUpdateStatus", array('method' => 'post', 'id' => 'ptype_list_form', "name" => "ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

                            <table id="" class="table table-bordered table-hover myviewtable responsiveTableNewDesign">
                                <tbody>
                                    <tr>

                                        <td>
                                            <strong class="full">Data Base Id</strong>
                                            <?= $project_data->project_id ?>
                                        </td>
                                        <td>
                                        <strong class="full">Project Variant</strong>
                                        <span class="text-danger text-bold">
                                        <?php if ($project_data->project_variant == 1): ?>
														Ongoing Project
													<?php elseif ($project_data->project_variant == 2): ?>
														Completed Project
													<?php else: ?>
														-
													<?php endif; ?>
                                        </span>
                                       
                                        </td>

                                        <td colspan="3">
                                            <strong class="full">Project Name</strong>
                                            <?= $project_data->name ?>
                                        </td>

                                       
                                       
                                    </tr>
                                    <tr>

                                        <td colspan="2">
                                            <strong class="full">Project Description</strong>
                                           <?php if(!empty($project_data->description)): ?>
                                            <?= $project_data->description ?>
                                           <?php endif; ?>
                                        </td>
                                        <td colspan="2">
                                            <strong class="full">Slug URL</strong>
                                            <?= $project_data->slug_url ?>
                                        </td>
                                       

                                        <td>
                                            <strong class="full">Cover Image</strong>
                                            <? if (!empty($project_data->project_cover_image)) { ?>
                                                <span class="pip">
                                                    <a target="_blank"
                                                        href="<?= _uploaded_files_ . 'project_cover_image/' . $project_data->project_cover_image ?>">
                                                        <img class="imageThumb"
                                                            src="<?= _uploaded_files_ . 'project_cover_image/' . $project_data->project_cover_image ?>" />
                                                    </a>
                                                </span>
                                            <? } else { ?>
                                                <span class="pip">
                                                    <img class="imageThumb" src="<?= MAINSITE ?>assets/images/no_image.jpg" />
                                                </span>
                                            <? } ?>
                                        </td>
                                       
                                    </tr>

                                  

                                  

                                    <tr>
                        <td>
                            <strong class="full">Added On</strong>
                            <?= date("d-m-Y h:i:s A", strtotime($project_data->added_on)) ?>
                        </td>
                        <td>
                            <strong class="full">Added By</strong>
                            <?= $project_data->added_by_name ?>
                        </td>
                        <td>
                            <strong class="full">Updated On</strong>
                            <? if (!empty($project_data->updated_on)) {
                                echo date("d-m-Y h:i:s A", strtotime($project_data->updated_on));
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <strong class="full">Updated By</strong>
                            <? if (!empty($project_data->updated_by_name)) {
                                echo $project_data->updated_by_name;
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <strong class="full">Status</strong>
                            <? if ($project_data->status == 1) { ?> Active <i
                                    class="fas fa-check btn-success btn-sm "></i>
                            <? } else { ?> Block <i class="fas fa-ban btn-danger btn-sm "></i>
                            <? } ?>
                        </td>
                    </tr>
                                    
                        <tr>
                            <td colspan="5">
                                <div class="row" style="width:100%;">

                                    <?php if (!empty($project_data->project_gallery_image)): ?>
                                        <div class="card card-primary" style="width:100%;">

                                            <div class=" d-flex justify-content-between p-2 " style="width:100%;">
                                                <strong class="full">Project Images</strong>
                                                <h6 class="">Total Images:


                                                    <?= count($project_data->project_gallery_image) ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="filter-container p-0 row">
                                                    <?php foreach ($project_data->project_gallery_image as $project_gallery_image): ?>


                                                        <div class="filtr-item col-sm-3 mb-1" data-category="<?= "1 ,4" ?>"
                                                            data-sort="white sample" style="width:100%;height:180px;">
                                                            <a href="<?= _uploaded_files_ . 'project_gallery_image/' . $project_gallery_image->file ?>"
                                                            target="_blank"    data-toggle="lightbox" data-title=""
                                                                style="height:100%;width:100%;">
                                                                <img src="<?= _uploaded_files_ . 'project_gallery_image/' . $project_gallery_image->file ?>"
                                                                    class="img-fluid mb-2" alt="" aria-label=""
                                                                    style="height:100%;width:100%;object-fit:cover;" />
                                                            </a>


                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php else: ?>
                                    <div class=" d-flex justify-content-between p-2 " style="width:100%;">
                                        <strong class="full">Gallery Images</strong>

                                    </div>
                                    <p class="text-center pl-2">-</p>
                                <?php endif; ?>

                    </div>
                    </td>
                    </tr>
                    <tr>

                    </tr>

                 

                    </tbody>
                    </table>



                </div>

                <?php echo form_close() ?>
            </div>
        <? } else {
                        $this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
                        $this->load->view('admin/template/access_denied', $this->data);
                    } ?>
        <!-- /.card-body -->
</div>
</div>
</div>


</section>
<? ?>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>