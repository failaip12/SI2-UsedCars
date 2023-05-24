
function handleFileSelection(event) {
  var fileInput = event.target;
  var fileChosenSpan = document.getElementById("file-chosen");
  
  if (fileInput.files.length > 0) {
      fileChosenSpan.textContent = fileInput.files.length + " file(s) selected";
  } else {
      fileChosenSpan.textContent = "";
  }
}