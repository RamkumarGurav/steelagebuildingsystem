<?php
// Initialize $id to 1
$id_oph = 1;
$action = "update";
// Check if $append_id is not empty
if (!empty($append_id_oph)) {
  // If $append_id is not empty, assign its value to $id
  $id_oph = $append_id_oph;
}

?>

<!-- Start of a new table row -->
<tr class="qe_sub_table_tr_oph">
  <td class="qe_sub_table_count_oph">1.</td>

  <td>
    <select type="text" class="form-control form-control-sm custom-select ongoing_project_id_oph"
      name="project_id_arr_oph[]" id="project_id_arr_oph_<?= $id_oph ?>">
      <option value="">Select Ongoing Project to Display On Home Page </option>
      <?php foreach ($ongoing_project_data as $item) {

        ?>
        <option value="<?php echo $item->project_id ?>">
          <?php echo $item->name ?>

        </option>
      <?php } ?>
    </select>
  </td>




  <!-- Table cell for the file input -->


  <!-- Table cell for the remove button (this will be updated dynamically) -->
  <td class="qe_sub_table_remove_td_oph"></td>
</tr>

<!-- <script>
  $("#document_file_oph_<?= $id_oph ?>").on('change', function () {
    $("#document_name_oph_<?= $id_oph ?>").attr('required', 'required');
  });






</script> -->