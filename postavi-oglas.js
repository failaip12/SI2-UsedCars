const actualBtn = document.getElementById('actual-btn');

const fileChosen = document.getElementById('file-chosen');

actualBtn.addEventListener('change', function(){
  console.log(this.files)
  fileChosen.textContent = [...this.files].map(file => file.name).join(', ')
})