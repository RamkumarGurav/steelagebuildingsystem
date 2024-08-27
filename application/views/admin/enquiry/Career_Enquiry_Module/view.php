<?php

$page_module_name = "Career Enquiry";

?>
<?
$name="";
$career_enquiry_id=0;
$status=1;
$record_action = "Add New Record";
if(!empty($career_enquiry_data))
{
	// $record_action = "Update";
	// $enquiry_id = $career_enquiry_data->enquiry_id;
	// $name = $career_enquiry_data->name;
	// $status = $career_enquiry_data->status;
	
}
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
                    <h1 class="m-0 text-dark"><?=$page_module_name?> <small>Details</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=MAINSITE_Admin."wam"?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?=MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name?>"><?=$user_access->module_name?> List</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?  ?>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card ">

                    <div class="card-header">
                        <h3 class="card-title"><?=$career_enquiry_data->name?></h3>
                        <div class="float-right">
                            <?php 
								if($user_access->add_module==1 && false)	{
								?>
								<a href="<?=MAINSITE_Admin.$user_access->class_name?>/edit"> 
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                                New</button></a>
                            <? } ?>
                            <?php 
							if($user_access->update_module==1 && false)	{
							?>
							<a href="<?=MAINSITE_Admin.$user_access->class_name?>/edit/<?=$career_enquiry_data->career_enquiry_id?>"> 
                            <button type="button" class="btn btn-success btn-sm" ><i
                                    class="fas fa-edit"></i> Update</button>
                            </a>
                            <? } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <?php 
						if($user_access->view_module==1)	{
					?>
                    <div class="card-body card-primary card-outline">
                        
                            <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doUpdateStatus", array('method' => 'post', 'id' => 'ptype_list_form' , "name"=>"ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                            <input type="hidden" name="task" id="task" value="" />
                            <? echo $this->session->flashdata('alert_message'); ?>
                            
                            
                            <table id="" class="table table-bordered table-hover myviewtable responsiveTableNewDesign"  >
                                <tbody>
								<tr>
                                
										
									</tr>

									<tr>
                                    <td >
										<strong class="full">Data Base Id</strong>
										<?=$career_enquiry_data->career_enquiry_id?></td>
								
                                        <td >
                                        	<strong class="full">Enquiry Date</strong>
                                            <?=date("d-m-Y h:i:s A" , strtotime($career_enquiry_data->added_on))?>
										</td>
										

                                        <td >
										<strong class="full">Name</strong>
										<?=$career_enquiry_data->name?></td>
                                        
                                        <td >
                                        <strong  class="full">Email</strong>
                                        <?=$career_enquiry_data->email?></td>

                                        <td><strong class="full">Contact No</strong><?=$career_enquiry_data->contactno?></td>
                                       
                                        <td><strong class="full">Qualification</strong><?=$career_enquiry_data->qualification?></td>
                                       
									</tr>
                                    <tr>
                                 
                                    <td><strong class="full">Experience in Years</strong><?=$career_enquiry_data->experience?></td>
                                    <td><strong class="full">Resume File</strong>
                                    
                                    <?php if(!empty($career_enquiry_data->resume_file)): ?>
                                        <a target="_blank" class="btn btn-outline-primary btn-sm"
                                                        href="<?= _uploaded_files_ . 'career_resume/' . $career_enquiry_data->resume_file ?>">
                                                        view
                                                    </a>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                   </td>
                                        <td colspan="1">
                                        <strong class="full"> Applied For</strong>
                                         <?=$career_enquiry_data->appliedfor?></td>
                                         <td colspan="1">
                                        <strong class="full"> IP Address </strong>
                                         <?=$career_enquiry_data->page_link?></td>
                                         <td colspan="">
                                        <strong class="full"> Page Link <?= $career_enquiry_data->page_link ?></strong>
                                        
                                        <?php if($career_enquiry_data->page_link=="home_page"): ?>
                                            <a
                                            href="<?= MAINSITE ?>"><?= $career_enquiry_data->page_link ?></a>
                                        <?php else: ?>
                                            <a
                                            href="<?= MAINSITE.$career_enquiry_data->page_link ?>"><?= $career_enquiry_data->page_link ?></a>
                                        <?php endif; ?>
                                    </tr>
									<tr>
                                        
                                    </tr>
									
                                    
                                    <tr>
                                    <td >
										<strong class="full">Added On</strong>
										<?=date("d-m-Y h:i:s A" , strtotime($career_enquiry_data->added_on))?></td>
                                        <td><strong class="full">Added By</strong>
										<? if(!empty($career_enquiry_data->added_by_name)){echo $career_enquiry_data->added_by_name;}else{echo "-";}?></td>
                                        <td ><strong class="full">Updated On</strong>
										<? if(!empty($career_enquiry_data->updated_on)){echo date("d-m-Y h:i:s A" , strtotime($career_enquiry_data->updated_on));}else{echo "-";}?></td>
										<td >
										<strong  class="full">Updated By</strong>
										<? if(!empty($career_enquiry_data->updated_by_name)){echo $career_enquiry_data->updated_by_name;}else{echo "-";}?></td>
										<td colspan="3">
										<strong class="full">Status</strong>
										<? if($career_enquiry_data->status==1){ ?> Active <i class="fas fa-check btn-success btn-sm "></i>
                                                <?}else{ ?> Block <i class="fas fa-ban btn-danger btn-sm "></i>
                                                <? }?></td>
									</tr>
                                    
                                </tbody>
                                
						</table>
						<?php echo form_close() ?>
                    </div>
                    <? }else{ 
						$this->data['no_access_flash_message']="You Dont Have Access To View ".$page_module_name;
						$this->load->view('admin/template/access_denied' , $this->data); 
					} ?>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>


    </section>
    <?  ?>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>

<script type="application/javascript">
function check_uncheck_All_records() // done
{
    var mainCheckBoxObj = document.getElementById("main_check");
    var checkBoxObj = document.getElementsByName("sel_recds[]");

    for (var i = 0; i < checkBoxObj.length; i++) {
        if (mainCheckBoxObj.checked)
            checkBoxObj[i].checked = true;
        else
            checkBoxObj[i].checked = false;
    }
}

function validateCheckedRecordsArray() // done
{
    var checkBoxObj = document.getElementsByName("sel_recds[]");
    var count = true;

    for (var i = 0; i < checkBoxObj.length; i++) {
        if (checkBoxObj[i].checked) {
            count = false;
            break;
        }
    }

    return count;
}

function validateRecordsActivate() // done
{
    if (validateCheckedRecordsArray()) {
        //alert("Please select any record to activate.");
        toastrDefaultErrorFunc("Please select any record to activate.");
        document.getElementById("sel_recds1").focus();
        return false;
    } else {
        document.ptype_list_form.task.value = 'active';
        document.ptype_list_form.submit();
    }
}

function validateRecordsBlock() // done
{
    if (validateCheckedRecordsArray()) {
        //alert("Please select any record to block.");
        toastrDefaultErrorFunc("Please select any record to block.");
        document.getElementById("sel_recds1").focus();
        return false;
    } else {
        document.ptype_list_form.task.value = 'block';
        document.ptype_list_form.submit();
    }
}
</script>
