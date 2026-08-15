document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Delete Enquiry
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.delete-enquiry').forEach(button => {

        button.addEventListener('click', async function () {

            const id = this.dataset.id;

            const result = await Swal.fire({

                title: 'Delete Admission Enquiry?',

                text: 'This enquiry will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#8B0000',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel'

            });

            if (!result.isConfirmed) {

                return;

            }

            try {

                const formData = new FormData();

                formData.append('id', id);

                const response = await fetch(

                    '/srs/admin/enquiries/delete.php',

                    {

                        method: 'POST',

                        body: formData

                    }

                );

                const data = await response.json();

                if (data.success) {

                    await Swal.fire({

                        icon: 'success',

                        title: 'Deleted',

                        text: data.message,

                        confirmButtonColor: '#8B0000'

                    });

                    location.reload();

                }

                else {

                    Swal.fire({

                        icon: 'error',

                        title: 'Error',

                        text: data.message,

                        confirmButtonColor: '#8B0000'

                    });

                }

            }

            catch (error) {

                console.error(error);

                Swal.fire({

                    icon: 'error',

                    title: 'Oops...',

                    text: 'Something went wrong.',

                    confirmButtonColor: '#8B0000'

                });

            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.status-select').forEach(select => {

        select.addEventListener('change', async function () {

            const id = this.dataset.id;

            const status = this.value;

            try {

                const formData = new FormData();

                formData.append('id', id);

                formData.append('status', status);

                const response = await fetch(

                    '/srs/admin/enquiries/update-status.php',

                    {

                        method: 'POST',

                        body: formData

                    }

                );

                const data = await response.json();

                if (data.success) {

                    Swal.fire({

                        icon: 'success',

                        title: 'Updated',

                        text: data.message,

                        timer: 1500,

                        showConfirmButton: false

                    });

                }

                else {

                    Swal.fire({

                        icon: 'error',

                        title: 'Error',

                        text: data.message,

                        confirmButtonColor: '#8B0000'

                    });

                }

            }

            catch (error) {

                console.error(error);

                Swal.fire({

                    icon: 'error',

                    title: 'Oops...',

                    text: 'Something went wrong.',

                    confirmButtonColor: '#8B0000'

                });

            }

        });

    });

});