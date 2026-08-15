document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('contactForm');

    if (!form) {
        return;
    }

    const submitButton = document.getElementById('contactSubmit');

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        submitButton.disabled = true;
        submitButton.innerHTML = 'Sending...';

          /*
        |--------------------------------------------------------------------------
        | Loading Popup
        |--------------------------------------------------------------------------
        */

        Swal.fire({

            title: 'Please Wait',

            html: `
                <div style="margin-top:10px;">
                    <strong>Your enquiry is being submitted.</strong>
                    <br><br>
                    Please wait while we send your enquiry to
                    <b>Sone Rising School.</b>
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

    title: 'Enquiry Submitted Thank You! 🎉',

     html: `

                        <h3 style="margin-bottom:10px;color:#8B0000;">
                            Enquiry Submitted Successfully
                        </h3>

                        <p style="line-height:28px;">

                        Thank you for contacting
                        <strong>Sone Rising School.</strong>

                        <br><br>

                        We have successfully received your enquiry.

                        <br>

                        Our team will contact you shortly.

                        <br><br>

                        <strong>Inquiry ID</strong>

                        <br>

                        <span style="
                            color:#8B0000;
                            font-size:20px;
                            font-weight:bold;
                        ">

                        ${result.inquiry_id}

                        </span>

                        </p>

                    `,

                    confirmButtonColor: '#8B0000',

                    confirmButtonText: 'Done'

                });


                form.reset();

            } else {

             Swal.fire({

    icon: 'warning',

    title: 'Validation Error',

    text: result.message,

    confirmButtonColor: '#8B0000'

});
            }

        } catch (error) {

          Swal.fire({

    icon: 'error',

    title: 'Oops...',

      text: 'Unable to submit your enquiry at the moment. Please try again later.',
      
    confirmButtonColor: '#8B0000'

});

            console.error(error);

        }

        submitButton.disabled = false;

        submitButton.innerHTML = 'Send Enquiry';

    });

});