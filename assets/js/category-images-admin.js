// Js for adding image to category in the wordpress admin panel

document.addEventListener('DOMContentLoaded', function () {
    let mediaUploader;

    const uploadButton = document.getElementById('upload_category_image');
    const removeButton = document.getElementById('remove_category_image');
    const categoryImageInput = document.getElementById('category_image');
    const imagePreview = document.getElementById('category_image_preview');

    if (!uploadButton || !removeButton || !categoryImageInput || !imagePreview) {
        return;
    }

    uploadButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media({
            title: 'Choose Category Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            const attachment = mediaUploader.state().get('selection').first().toJSON();

            categoryImageInput.value = attachment.url;

            const imageElement = document.createElement('img');
            imageElement.src = attachment.url;
            imageElement.style.maxWidth = '150px';
            imageElement.style.height = 'auto';

            imagePreview.innerHTML = '';
            imagePreview.appendChild(imageElement);

            removeButton.style.display = 'inline-block';
        });

        mediaUploader.open();
    });

    removeButton.addEventListener('click', function (e) {
        e.preventDefault();

        categoryImageInput.value = '';
        imagePreview.innerHTML = '';

        removeButton.style.display = 'none';
    });
});