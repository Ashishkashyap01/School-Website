/*document.addEventListener('DOMContentLoaded', () => {

    const button = document.getElementById('menuToggle');

    const sidebar = document.querySelector('.sidebar');

    if (button && sidebar) {

        button.addEventListener('click', () => {

            sidebar.classList.toggle('show');

        });

    }

});*/

document.addEventListener('DOMContentLoaded', () => {

    /*
    =====================================
    SIDEBAR TOGGLE
    =====================================
    */

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');

    if (menuToggle && sidebar) {

        menuToggle.addEventListener('click', () => {

            sidebar.classList.toggle('show');

        });

    }

    /*
    =====================================
    IMAGE PREVIEW
    =====================================
    */

    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');

    if (imageInput && previewImage) {

       imageInput.addEventListener('change', function () {

    const file = this.files[0];

    if (!file) {

        previewImage.style.display = 'none';
        return;

    }

    previewImage.src = URL.createObjectURL(file);

    previewImage.style.display = 'block';

});

    }

    /*
    =====================================
    AJAX FORM SUBMIT
    =====================================
    */

   const form = document.querySelector('#sliderForm, #galleryForm');

if (form) {

    form.addEventListener('submit', async function (e) {
        
            e.preventDefault();

            const formData = new FormData(this);

            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            submitButton.disabled = true;
            submitButton.innerHTML = 'Saving...';

            try {

                const response = await fetch(this.action, {

                    method: 'POST',
                    body: formData

                });

                const result = await response.json();
            /*if (result.success) {

                alert(result.message);

                const action = this.action;

                if (action.includes('/gallery/')) {

                    window.location.href = '/admin/gallery';

                } else if (action.includes('/slider/')) {

                    window.location.href = '/admin/slider';

                }

            } */
         if (result.success) {

    alert(result.message);

  const currentModule = this.action.split('/')[5];
 
 /*const url = new URL(this.action);

const parts = url.pathname.split('/').filter(Boolean);

const currentModule = parts[parts.length - 2];

window.location.href = `/admin/${currentModule}`;

    window.location.href = `/admin/${currentModule}`;*/

}else {

                    alert(result.message);

                }

            } catch (error) {

                console.error(error);

                alert('Unexpected server error.');

            } finally {

                //submitButton.disabled = false;
                //submitButton.innerHTML =
                //submitButton.textContent.includes('Update')
                //? 'Update Slider'
                //: 'Save Slider';
              
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;

            }

        });

    }

});
/*
=====================================
SWEET ALERT DELETE
=====================================
*/

document.querySelectorAll('.delete-slider').forEach(button => {

    button.addEventListener('click', function (e) {

        e.preventDefault();

        const url = this.href;

        Swal.fire({

            title: 'Delete Slider?',
            text: 'This action cannot be undone.',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',

            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'

        }).then((result) => {

            if (result.isConfirmed) {

                window.location.href = url;

            }

        });

    });

});
/*
=====================================
STATUS TOGGLE
=====================================
*/

document.querySelectorAll('.toggle-status').forEach(function (badge) {

    badge.addEventListener('click', async function () {

        const id = this.dataset.id;

        try {

            const formData = new FormData();
            formData.append('id', id);

            const response = await fetch('/admin/slider/toggle-status.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (!result.success) {
                alert(result.message);
                return;
            }

            this.classList.remove('active', 'inactive');

            if (result.status === 'active') {

                this.classList.add('active');
                this.innerHTML = '🟢 Active';

            } else {

                this.classList.add('inactive');
                this.innerHTML = '🔴 Inactive';

            }

        } catch (error) {

            console.error(error);
            alert('Unable to update status.');

        }

    });

});
/*
==================================
IMAGE PREVIEW
==================================
*/

const modal = document.getElementById('imagePreviewModal');
const preview = document.getElementById('previewImage');
const closeBtn = document.querySelector('.image-preview-close');

document.querySelectorAll('.preview-image').forEach(function (image) {

    image.addEventListener('click', function () {

        preview.src = this.dataset.image;

        modal.style.display = 'flex';

    });

});

closeBtn.addEventListener('click', function () {

    modal.style.display = 'none';

    preview.src = '';

});

modal.addEventListener('click', function (e) {

    if (e.target === modal) {

        modal.style.display = 'none';

        preview.src = '';

    }

});

document.addEventListener('keydown', function (e) {

    if (e.key === 'Escape') {

        modal.style.display = 'none';

        preview.src = '';

    }

});