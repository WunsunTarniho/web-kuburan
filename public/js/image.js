const uploadImage = () => {
    const image = document.getElementById('image');

    const btnImage = $('.btn-image');
    const previewImg = $('#previewImage');

    const reader = new FileReader();
    reader.readAsDataURL(image.files[0]);

    reader.onload = (readerEvent) => {
        previewImg[0].src = readerEvent.target.result;
    }

    btnImage[0].innerText = previewImg[0].src !== '' ? 'Ganti Foto' : 'Tambah Foto';
}