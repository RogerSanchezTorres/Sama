function changeImage(newImageSrc) {
    const mainImage = document.getElementById('currentImage');
    if (!mainImage) return;

    console.log('Nueva imagen seleccionada:', newImageSrc);

    if (newImageSrc && typeof newImageSrc === 'string') {
        mainImage.src = newImageSrc;
    } else {
        console.error('La ruta de la imagen no es válida:', newImageSrc);
    }
}
