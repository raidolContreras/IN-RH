const input = document.querySelector('#image-upload');
const previewImg = document.querySelector('#preview-img');

input.addEventListener('change', () => {
  const file = input.files[0];
  const reader = new FileReader();

  reader.addEventListener('load', () => {
    previewImg.src = reader.result;
  });

  if (file) {
    reader.readAsDataURL(file);
  }
});
