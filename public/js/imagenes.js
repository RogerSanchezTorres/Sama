function changeImage(newImageSrc) {
    const mainImage = document.getElementById('currentImage');
    console.log('Nueva imagen seleccionada:', newImageSrc); // Verifica que la ruta es correcta
    if (newImageSrc) {
        mainImage.src = newImageSrc;
    } else {
        console.error('La ruta de la imagen no es válida.');
    }
}
