<?php
// Initialize $id to 1
$id_cph = 1;
$action = "update";
// Check if $append_id is not empty
if (!empty($append_id_cph)) {
  // If $append_id is not empty, assign its value to $id
  $id_cph = $append_id_cph;
}
?>

<!-- Start of a new table row -->
<tr class="qe_sub_table_tr_cph">
  <td class="qe_sub_table_count_cph">1.</td>

  <td colspan="3">
    <select type="text" class="form-control form-control-sm custom-select ongoing_project_id_cph"
      name="project_id_arr_cph[]" id="project_id_arr_cph_<?= $id_cph ?>">
      <option value="">Select Completed Project to Display On Home Page</option>
      <?php foreach ($completed_project_data as $item) {

        ?>
        <option value="<?php echo $item->project_id ?>">
          <?php echo $item->name ?>

        </option>
      <?php } ?>
    </select>
  </td>




  <!-- Table cell for the file input -->


  <!-- Table cell for the remove button (this will be updated dynamically) -->
  <td class="qe_sub_table_remove_td_cph"></td>
</tr>

<!-- <script>
  $("#document_file_cph_<?= $id_cph ?>").on('change', function () {
    $("#document_name_cph_<?= $id_cph ?>").attr('required', 'required');
  });






</script> -->