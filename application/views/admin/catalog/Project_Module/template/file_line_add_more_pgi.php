<?php
// Initialize $id to 1
$id_pgi = 1;

// Check if $append_id is not empty
if (!empty($append_id_pgi)) {
  // If $append_id is not empty, assign its value to $id
  $id_pgi = $append_id_pgi;
}
?>

<!-- Start of a new table row -->
<tr class="  qe_sub_table_tr_pgi">
  <!-- Table cell for the row count (this will be updated dynamically) -->
  <td class=" qe_sub_table_count_pgi">1.</td>

  <!-- Table cell for the file title input -->
  <td>
    <!-- Input field for the file title with a dynamic ID -->
    <input type="number" min="1" step="1" value="1" name="position_pgi[]" id="position_pgi_<?= $id_pgi ?>"
      placeholder="Image Position" class="form-control search-code form-control-sm" />
    <!-- Hidden input field for the quotation enquiry detail ID with a dynamic ID -->
    <!-- <input type="hidden" name="quotation_enquiry_detail_id[]" id="quotation_enquiry_detail_id<?= $id_pgi ?>" value="" /> -->
  </td>

  <!-- Table cell for the file input -->
  <td>
    <div class="input-group">
      <div class="custom-file">
        <!-- Hidden input field to store the file name (initially empty) -->
        <!-- <input type="hidden" name="file_name[]" value="" /> -->
        <!-- File input field for selecting a file -->
        <input type="file" accept="image/*" name="file_pgi[]" class="custom-file-input"
          id="file_input_pgi_<?= $id_pgi ?>" onchange="previewImage_pgi(<?= $id_pgi ?>)">
        <!-- Label for the file input, initially empty -->
        <label class="custom-file-label form-control-sm" for="files">Choose file</label>
      </div>
      <!-- Image preview -->
      <img id="image_preview_pgi_<?= $id_pgi ?>" src="" alt="Image Preview" class="imageThumb" style="display:none;">
    </div>
  </td>

  <!-- Table cell for the remove button (this will be updated dynamically) -->
  <td class=" qe_sub_table_remove_td_pgi"></td>
</tr>

<script>
  function previewImage_pgi(id) {
    var input = document.getElementById('file_input_pgi_' + id);
    var preview = document.getElementById('image_preview_pgi_' + id);

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      }

      reader.readAsDataURL(input.files[0]);
    } else {
      preview.src = '';
      preview.style.display = 'none';
    }
  }
</script>