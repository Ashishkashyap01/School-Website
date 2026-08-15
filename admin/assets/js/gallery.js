document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('galleryForm');

    if (!form) {
        return;
    }

    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        const formData = new FormData(form);

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Saving...
        `;

        Swal.fire({

            title: 'Please Wait',

            html: `
                <div style="margin-top:10px;">
                    <strong>Uploading Gallery Image...</strong>
                    <br><br>
                    Please wait while we upload the image.
                </div>
            `,

            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,

            didOpen: () => {

                Swal.showLoading();

            }

        });

        try {

            const response = await fetch(form.action, {

                method: 'POST',

                body: formData

            });

            const result = await response.json();

            if (result.success) {

                await Swal.fire({

                    icon: 'success',

                    title: 'Success',

                    text: result.message,

                    confirmButtonColor: '#8B0000'

                });

                window.location.href = '/admin/gallery';

            } else {

                Swal.fire({

                    icon: 'warning',

                    title: 'Validation Error',

                    text: result.message,

                    confirmButtonColor: '#8B0000'

                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({

                icon: 'error',

                title: 'Error',

                text: 'Something went wrong. Please try again.',

                confirmButtonColor: '#8B0000'

            });

        }

        submitButton.disabled = false;

        submitButton.innerHTML = 'Save Gallery';

    });

});
document.querySelectorAll('.delete-gallery').forEach(button => {

    button.addEventListener('click', function (e) {

        e.preventDefault();

        const url = this.href;

        Swal.fire({

            title: 'Delete Image?',

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