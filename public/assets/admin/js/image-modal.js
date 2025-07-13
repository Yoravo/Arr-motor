document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input.previewable');

    const modal = document.getElementById('myMimageModal');
    const modalImg = document.getElementById('modalImageContent');
    const closeModalSpan = document.getElementById('closeModal');

    if (fileInputs.length && modal && modalImg && closeModalSpan) {
        fileInputs.forEach(input => {
            input.addEventListener('change', function (event) {
                const inputId = input.id;
                const previewContainer = document.querySelector(`.preview-container[data-preview="${inputId}"]`);

                if (!previewContainer) {
                    console.warn(`Preview container tidak ditemukan untuk: ${inputId}`);
                    return;
                }

                previewContainer.innerHTML = '';

                Array.from(event.target.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = file.name;
                            img.classList.add('img-thumbnail');
                            img.style.maxWidth = '100px';
                            img.style.maxHeight = '100px';
                            img.style.objectFit = 'cover';
                            img.style.margin = '5px';

                            img.addEventListener('click', () => {
                                modal.classList.add('show');
                                modal.style.display = 'flex';
                                modalImg.src = img.src;
                            });

                            previewContainer.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    }
                });
            });
        });

        // Modal handlers
        function closeModal() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modalImg.classList.remove('zoomed');
        }

        closeModalSpan.onclick = closeModal;

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        modalImg.addEventListener('click', (e) => {
            e.stopPropagation();
            modalImg.classList.toggle('zoomed');
        });

    } else {
        console.error('Elemen penting tidak ditemukan.');
    }
});
