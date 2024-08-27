var formCounter = 0;
function submitForm(event) {
   formCounter++;
   if (formCounter > 1) {
      event.preventDefault();
      return false;
   }
}

function onSubmit(token) {
   //contactvalidateForm();
   if (!$("#Contact-us").parsley().isValid()) {
      $("#Contact-us").parsley().validate();
      return false;
   }
   else {
      $("#Contact-us").submit();
      return true;
   }
}
