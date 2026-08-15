document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('sliderForm');

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
                    <strong>Uploading Slider...</strong>
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

                window.location.href = '/admin/slider';

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

        submitButton.innerHTML = 'Save Slider';

    });

});


/*
=====================================
DELETE SLIDER
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
SLIDER STATUS TOGGLE
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

                Swal.fire({

                    icon: 'error',

                    title: 'Error',

                    text: result.message,

                    confirmButtonColor: '#8B0000'

                });

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

            Swal.fire({

                icon: 'error',

                title: 'Error',

                text: 'Unable to update status.',

                confirmButtonColor: '#8B0000'

            });

        }

    });

});