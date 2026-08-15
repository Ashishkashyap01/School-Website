document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('imageViewerModal');
    const preview = document.getElementById('imageViewerPreview');
    const closeBtn = document.querySelector('.image-viewer-close');

    if (!modal || !preview || !closeBtn) {
        return;
    }

    /*
    =====================================
    OPEN IMAGE
    =====================================
    */

    document.querySelectorAll('.image-viewer').forEach(image => {

        image.addEventListener('click', function () {

            preview.src = this.dataset.image || this.src;

            modal.style.display = 'flex';

            document.body.style.overflow = 'hidden';

        });

    });

    /*
    =====================================
    CLOSE BUTTON
    =====================================
    */

    closeBtn.addEventListener('click', closeViewer);

    /*
    =====================================
    CLICK OUTSIDE
    =====================================
    */

    modal.addEventListener('click', function (e) {

        if (e.target === modal) {

            closeViewer();

        }

    });

    /*
    =====================================
    ESC KEY
    =====================================
    */

    document.addEventListener('keydown', function (e) {

        if (e.key === 'Escape') {

            closeViewer();

        }

    });

    /*
    =====================================
    CLOSE FUNCTION
    =====================================
    */

    function closeViewer() {

        modal.style.display = 'none';

        preview.src = '';

        document.body.style.overflow = '';

    }

});