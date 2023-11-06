const input = document.querySelector('#fileInput');
const preview = document.querySelector('#preview');
const btnDownload = document.querySelector('#download');

input.addEventListener('change', function(){
 console.log(this.files);
})