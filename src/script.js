
const input = document.getElementById('fileInput');
input.addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const base64Data = e.target.result.split(',')[1];
      console.log(base64Data); // Aqui está o arquivo em Base64
    };
    reader.readAsDataURL(file);
  }
}