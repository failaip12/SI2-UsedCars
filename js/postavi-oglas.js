
function handleFileSelection(event) {
  const fileInput = event.target;
  const fileChosenSpan = document.getElementById("file-chosen");
  
  if (fileInput.files.length > 0) {
      fileChosenSpan.textContent = fileInput.files.length + " file(s) selected";
  } else {
      fileChosenSpan.textContent = "";
  }
}