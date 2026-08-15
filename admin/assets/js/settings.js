document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('settingsForm');

    if (!form) {

        return;

    }

    const submitButton = document.getElementById('settingsSubmit');

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Saving...
        `;

        Swal.fire({

            title: 'Please Wait',

            html: `
                <div style="margin-top:10px;">
                    <strong>Website settings are being updated.</strong>
                    <br><br>
                    Please wait...
                </div>
            `,

            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,

            didOpen: () => {

                Swal.showLoading();

            }

        });

        const formData = new FormData(form);

        try {

            const response = await fetch(form.action, {

                method: 'POST',

                body: formData

            });

            const result = await response.json();

            if (result.success) {

                Swal.fire({

                    icon: 'success',

                    title: 'Settings Updated',

                    text: result.message,

                    confirmButtonColor: '#8B0000'

                }).then(() => {

                    location.reload();

                });

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

                title: 'Oops...',

                text: 'Something went wrong.',

                confirmButtonColor: '#8B0000'

            });

        }

        submitButton.disabled = false;

        submitButton.innerHTML = `
            💾 Save Settings
        `;

    });

});