<?
$page_module_name = "Ongoing Projects";
$project_id = 0;
$project_variant = 1;
$status = 1;
// $project_for = 1;
/*echo "<pre>";
print_r($category_detail);
echo "</pre>";*/

?>
<script>
  <?php if ($user_access->view_module == 1) { ?>
    $(document).ready(function () {
      $.ajax({
        type: "POST",

        url: '<? echo MAINSITE_Admin ?>catalog/Project-Module/GetCompleteProjectList',
        //dataType : "json",
        data: { "project_id": '<? echo $project_id; ?>', "project_variant": '<? echo $project_variant; ?>', "withPosition": 1, 'sortByPosition': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
        success: function (result) {
          //   alert(result);
          $('#projectList').html(result);
          //ArrangeTable();
          dragEvent();
        }
      });
    });
  <? } ?>
</script>
<style>
  body {
    overflow-x: hidden;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->

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



  <!-- Main content -->
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
                    <th>Project Name</th>
                    <th>Project Variant</th>
                    <th>Position</th>
                    <th>Published</th>
                    <th>Added On</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody id="projectList">


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

                  $('#projectList').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" /></div></td></tr>');
                  $.ajax({
                    type: "POST",
                    url: '<?= MAINSITE_Admin . 'catalog/Project-Module/GetCompleteProjectListNewPos' ?>',
                    //dataType : "json",
                    data: { "project_id": '<? echo $project_id; ?>', "project_variant": '<? echo $project_variant; ?>', 'podId': podId, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
                    success: function (result) {
                      // alert(result);
                      $('#projectList').html(result);
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
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->