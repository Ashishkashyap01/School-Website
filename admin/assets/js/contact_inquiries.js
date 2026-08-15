document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.delete-enquiry').forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

            Swal.fire({

                title: 'Delete Enquiry?',

                text: 'This enquiry will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#8B0000',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, Delete'

            }).then(async (result) => {

                if (!result.isConfirmed) {

                    return;

                }

                try {

                    const formData = new FormData();

                    formData.append('id', id);

                    const response = await fetch(

                        '/srs/admin/contact_inquiries/delete.php',

                        {

                            method: 'POST',

                            body: formData

                        }

                    );

                    const data = await response.json();

                    if (data.success) {

                        Swal.fire({

                            icon: 'success',

                            title: 'Deleted',

                            text: data.message,

                            confirmButtonColor: '#8B0000'

                        }).then(() => {

                            location.reload();

                        });

                    } else {

                        Swal.fire({

                            icon: 'error',

                            title: 'Error',

                            text: data.message,

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

            });

        });

    });

});