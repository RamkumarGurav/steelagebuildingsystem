<?php
$page_module_name = "Home Page Projects";
?>
<?
$record_action = "Update";
$project_id = 0;
// $project_gallery_image_id = 0;
// $name = $project_cover_image = $slug_url = "";
// $project_variant = 0;
// $status = 1;
$project_variant_data = [
  (object) ["project_variant" => 1, "project_variant_name" => "Ongoing Project"],
  (object) ["project_variant" => 2, "project_variant_name" => "Completed Project"],
];




?>
<script>
  $(document).ready(function () {
    $.ajax({
      type: "POST",

      url: '<? echo MAINSITE_Admin ?>catalog/Project-Module/get_project_list_for_home',
      //dataType : "json",
      data: { "is_home_display": 1, "project_variant": 1, "with_position": 1, 'sort_by_home_position': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
      success: function (result) {
        //   alert(result);
        $('#ongoing_project_list').html(result);
        //ArrangeTable();
        dragEvent();
      }
    });
    $.ajax({
      type: "POST",

      url: '<? echo MAINSITE_Admin ?>catalog/Project-Module/get_project_list_for_home',
      //dataType : "json",
      data: { "is_home_display": 1, "project_variant": 2, "with_position": 1, 'sort_by_home_position': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
      success: function (result) {
        //   alert(result);
        $('#completed_project_list').html(result);
        //ArrangeTable();
        dragEvent2();
      }
    });
  });
</script>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!--{{{{{{ Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <div class="content-header">
    <div class="container-fluid ">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-2 text-dark"><?= $page_module_name ?> <small>Positioning</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= MAINSITE_Admin . "wam" ?>">Home</a></li>
            <li class="breadcrumb-item"><a
                href="<?= MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name ?>"><?= $user_access->module_name ?>
                List</a></li>
            <li class="breadcrumb-item active">Positioning</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <!--{{{{{{ Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">

        <!-- {{{{{{ Main Card form with Header -->
        <div class="card">

          <!-- {{{{{form-header -->
          <div class="card-header">

          </div>
          <!-- }}}}}.form-header -->


          <!-- {{{{{ Main Form -->
          <!-- <?php
          if ($user_access->view_module == 1 || true) {
            ?> -->

            <!-- {{{{{ always echo the "alert_message" before the main "card-body"-->
            <? echo $this->session->flashdata('alert_message'); ?>
            <!-- }}}}} "alert_message" -->


            <div class="card-body">
              <?php echo form_open(
                MAINSITE_Admin . "$user_access->class_name/project_on_home_do_edit",
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
              <input type="hidden" name="redirect_type" id="redirect_type" value="" />

              <div class="form-group row">
                <div class="col-md-11 col-sm-11">
                  <label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Add Ongoing Projects to Home Page
                    (Maximum 5)
                    <span style="color:#f00;font-size: 22px;margin-top: 3px;"></span></label>
                  <div class="card-body py-0 px-2">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Ongoing Project</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="RFQDetailBody_oph">
                        <? $this->load->view('admin/catalog/Project_module/template/project_add_more_oph', $this->data); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="9"><button type="button" onclick="addNewRFQDeatilLine_oph(0)"
                              class="btn btn-block btn-default">Add New Line</button>
                          <td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>



              <?php if (!empty($ongoing_project_on_display_data)) { ?>
                <div class="form-group row">

                  <div class="col-sm-12">
                    <div class="row card">
                      <div class="col-md-12 card-body ">
                        <div class="box box-primary">
                          <div class="box-header with-border">

                          </div>
                          <div class="box-body">
                            <label for="slug_url" class="col-sm-12 label_content px-2 py-0 " style="color:black;">Added
                              Ongoing
                              Projects
                              on Home
                              Page</label>
                            <link rel="stylesheet" href="<?= _admin_files_ ?>css/tablednd.css" type="text/css" />
                            <div class="tableDemo">
                              <table class="table table-striped" id="table-2">
                                <thead>
                                  <tr>
                                    <th>Slno.</th>
                                    <th>Project Name</th>
                                    <th>Project Variant</th>
                                    <th>Home Position</th>
                                    <th>Status</th>
                                    <th>Remove from Home Page</th>
                                  </tr>
                                </thead>
                                <tbody id="ongoing_project_list">


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

                                    $('#ongoing_project_list').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" /></div></td></tr>');
                                    $.ajax({
                                      type: "POST",
                                      url: '<?= MAINSITE_Admin . 'catalog/Project-Module/get_project_list_for_home_new_pos' ?>',
                                      //dataType : "json",
                                      data: { 'podId': podId, "project_id": '<? echo $project_id; ?>', "is_home_display": 1, "project_variant": 1, "withPosition": 1, 'sort_by_home_position': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
                                      success: function (result) {
                                        // alert(result);
                                        $('#ongoing_project_list').html(result);
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
                <div class="col-md-11 col-sm-11">
                  <label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Add Completed Projects to Home Page
                    (Maximum 5)
                    <span style="color:#f00;font-size: 22px;margin-top: 3px;"></span></label>
                  <div class="card-body py-0 px-2">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Completed Project</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="RFQDetailBody_cph">
                        <? $this->load->view('admin/catalog/Project_module/template/project_add_more_cph', $this->data); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="9"><button type="button" onclick="addNewRFQDeatilLine_cph(0)"
                              class="btn btn-block btn-default">Add New Line</button>
                          <td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>



              <?php if (!empty($completed_project_on_display_data)) { ?>
                <div class="form-group row">

                  <div class="col-sm-12">
                    <div class="row card">
                      <div class="col-md-12 card-body ">
                        <div class="box box-primary">
                          <div class="box-header with-border">

                          </div>
                          <div class="box-body">
                            <label for="slug_url pl-4" class="col-sm-12 label_content px-2 py-0" style="color:black;">Added
                              Completed Projects on
                              Home
                              Page</label>
                            <link rel="stylesheet" href="<?= _admin_files_ ?>css/tablednd.css" type="text/css" />
                            <div class="tableDemo">
                              <table class="table table-striped" id="table-3">
                                <thead>
                                  <tr>
                                    <th>Slno.</th>
                                    <th>Project Name</th>
                                    <th>Project Variant</th>
                                    <th>Home Position</th>
                                    <th>Status</th>
                                    <th>Remove from Home Page</th>
                                  </tr>
                                </thead>
                                <tbody id="completed_project_list">


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



                            <script src="<?= _admin_files_ ?>js/jquery.tablednd.js" type="text/javascript"></script>

                            <script>



                              function dragEvent2() {
                                table_3 = $("#table-3");
                                table_3.find("tr:even").addClass("alt");

                                $("#table-3").tableDnD({
                                  onDragClass: "myDragClass",
                                  onDrop: function (table, row) {
                                    var rows = table.tBodies[0].rows;
                                    var podId = '';
                                    for (var i = 0; i < rows.length; i++) {
                                      podId += rows[i].id + ",";
                                    }

                                    $('#completed_project_list').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" /></div></td></tr>');
                                    $.ajax({
                                      type: "POST",
                                      url: '<?= MAINSITE_Admin . 'catalog/Project-Module/get_project_list_for_home_new_pos' ?>',
                                      //dataType : "json",
                                      data: {
                                        'podId': podId, "project_id": '<? echo $project_id; ?>', "is_home_display": 1,
                                        "project_variant": 2, "withPosition": 1, 'sort_by_home_position': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
                                      },
                                      success: function (result) {
                                        // alert(result);
                                        $('#completed_project_list').html(result);
                                        $(table).parent().find('.result').text("Order Changed Successfully");
                                        dragEvent2();
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


              <!-- /.card-body -->
              <div class="card-footer">
                <center>
                  <button type="submit" name="save" onclick=" redirect_type_func('');" value="1"
                    class="btn btn-info">Save</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <!-- <button type="submit" name="save-add-new" onclick=" redirect_type_func('save-add-new');" value="1"
                    class="btn btn-default ">Save And Add New</button> -->
                </center>
              </div>
              <!-- /.card-footer -->

              <?php echo form_close() ?>
              </table>
            </div>
            <!-- <? } else {
            $this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
            $this->load->view('admin/template/access_denied', $this->data);
          } ?> -->

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



<script>
  const MAX_ONGOING_PROJECTS = 5;  // Set this to your desired maximum
  const MAX_COMPLETED_PROJECTS = 5;  // Set this to your desired maximum

  $(document).ready(function () {
    $('#project_form').submit(function (event) {
      let ongoingCount = $('.RFQDetailBody_oph tr').length;
      let completedCount = $('.RFQDetailBody_cph tr').length;
      let added_ongoingCount = $('#ongoing_project_list tr').length;
      let added_completedCount = $('#completed_project_list tr').length;



      if (ongoingCount > (MAX_ONGOING_PROJECTS)) {
        toastrDefaultErrorFunc("You can't add more than " + MAX_ONGOING_PROJECTS + " ongoing projects.");
        event.preventDefault();
        return false;
      }


      if (completedCount > (MAX_COMPLETED_PROJECTS)) {
        toastrDefaultErrorFunc("You can't add more than " + MAX_COMPLETED_PROJECTS + " completed projects.");
        event.preventDefault();
        return false;
      }

    });
  });
</script>
<script>


  /*  >>> ADDING MORE tdate TEXT*/



  var append_id_oph = 1;

  function addNewRFQDeatilLine_oph(id_oph = 0) {
    append_id_oph++;

    Pace.restart();
    $.ajax({
      url: "<?= MAINSITE_Admin . $user_access->class_name . '/addNewLine_oph' ?>",
      type: 'post',
      dataType: "json",
      data: { 'id_oph': id_oph, 'append_id_oph': append_id_oph, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
      success: function (response) {
        $(".RFQDetailBody_oph").append(response.template);
        set_qe_sub_table_count_oph();
        set_qe_sub_table_remove_btn_oph();
        // calculate_qe_sub_table_price_oph();
        // set_input_element_functions_oph();
        // Initialize Summernote



        //$('.summernote').summernote();
        $('.summernote').summernote({ <?= _summernote_ ?> });




        $('.document_file_oph').on('change', function () {
          // $("#document_name_oph").attr('required', 'required');
          let fileName = Array.from(this.files).map(x => x.name).join(', ');
          $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });
      },
      error: function (request, error) {
        toastrDefaultErrorFunc("Unknown Error. Please Try Again");
      }
    });
  }



  function set_qe_sub_table_count_oph() {
    let count_oph = 0;
    $('.qe_sub_table_count_oph').each(function (index, value) {
      count_oph++;
      $(this).html(count_oph + '.');
    });
  }

  function set_qe_sub_table_remove_btn_oph() {
    $('.qe_sub_table_remove_td_oph').html('');
    let count_oph = 0;
    $('.qe_sub_table_remove_td_oph').each(function (index, value) {
      count_oph++;
    });
    if (count_oph > 1) {
      $('.qe_sub_table_remove_td_oph').html('<button class="btn btn-outline-danger btn-xs" onclick="remove_qe_sub_table_row_oph($(this))" title="remove"><i class="fas fa-trash"></i></button>');
    }
  }

  function remove_qe_sub_table_row_oph(row) {
    row.closest('tr').remove();
    set_qe_sub_table_remove_btn_oph();
    set_qe_sub_table_count_oph();
  }


  function remove_from_home($oph_id) {
    if (parseInt($oph_id) > 0) {
      var s = confirm('You want to Remove this project from Home Page?');
      if (s) {
        $.ajax({
          url: "<?= MAINSITE_Admin . 'Ajax/update_any_record_by_single_column' ?>",
          type: 'post',
          //dataType: "json",
          data: {
            "table_name": "project",
            "primary_column_name": "project_id",
            "primary_column_value": $oph_id,
            "update_column_name": "is_home_display",
            "update_column_value": 0,

            "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
          },
          success: function (response) {
            toastrDefaultSuccessFunc("Record Removed from Home Page Successfully");
            window.location.reload();
            //alert(response);
            // $("#quotation_enquiry_file_" + $oph_id).hide();
          },
          error: function (request, error) {
            toastrDefaultErrorFunc("Unknown Error. Please Try Again");
          }
        });
      }
    }

    return false;
  }

  /* <<<< ADDING MORE oph TEXT*/
</script>
<script>
  /*  >>> ADDING MORE tdate TEXT*/



  var append_id_cph = 1;

  function addNewRFQDeatilLine_cph(id_cph = 0) {
    append_id_cph++;

    Pace.restart();
    $.ajax({
      url: "<?= MAINSITE_Admin . $user_access->class_name . '/addNewLine_cph' ?>",
      type: 'post',
      dataType: "json",
      data: { 'id_cph': id_cph, 'append_id_cph': append_id_cph, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
      success: function (response) {
        $(".RFQDetailBody_cph").append(response.template);
        set_qe_sub_table_count_cph();
        set_qe_sub_table_remove_btn_cph();
        // calculate_qe_sub_table_price_cph();
        // set_input_element_functions_cph();
        // Initialize Summernote



        //$('.summernote').summernote();
        $('.summernote').summernote({ <?= _summernote_ ?> });




        $('.document_file_cph').on('change', function () {
          // $("#document_name_cph").attr('required', 'required');
          let fileName = Array.from(this.files).map(x => x.name).join(', ');
          $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });
      },
      error: function (request, error) {
        toastrDefaultErrorFunc("Unknown Error. Please Try Again");
      }
    });
  }



  function set_qe_sub_table_count_cph() {
    let count_cph = 0;
    $('.qe_sub_table_count_cph').each(function (index, value) {
      count_cph++;
      $(this).html(count_cph + '.');
    });
  }

  function set_qe_sub_table_remove_btn_cph() {
    $('.qe_sub_table_remove_td_cph').html('');
    let count_cph = 0;
    $('.qe_sub_table_remove_td_cph').each(function (index, value) {
      count_cph++;
    });
    if (count_cph > 1) {
      $('.qe_sub_table_remove_td_cph').html('<button class="btn btn-outline-danger btn-xs" onclick="remove_qe_sub_table_row_cph($(this))" title="remove"><i class="fas fa-trash"></i></button>');
    }
  }

  function remove_qe_sub_table_row_cph(row) {
    row.closest('tr').remove();
    set_qe_sub_table_remove_btn_cph();
    set_qe_sub_table_count_cph();
  }


  function remove_from_home($cph_id) {
    if (parseInt($cph_id) > 0) {
      var s = confirm('You want to Remove this project from Home Page?');
      if (s) {
        $.ajax({
          url: "<?= MAINSITE_Admin . 'Ajax/update_any_record_by_single_column' ?>",
          type: 'post',
          //dataType: "json",
          data: {
            "table_name": "project",
            "primary_column_name": "project_id",
            "primary_column_value": $cph_id,
            "update_column_name": "is_home_display",
            "update_column_value": 0,

            "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
          },
          success: function (response) {
            toastrDefaultSuccessFunc("Record Removed from Home Page Successfully");
            window.location.reload();
            //alert(response);
            // $("#quotation_enquiry_file_" + $cph_id).hide();
          },
          error: function (request, error) {
            toastrDefaultErrorFunc("Unknown Error. Please Try Again");
          }
        });
      }
    }

    return false;
  }

  /* <<<< ADDING MORE cph TEXT*/
</script>