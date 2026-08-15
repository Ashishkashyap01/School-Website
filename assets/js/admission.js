console.log("Admission JS Loaded");
document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Smooth Scroll
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('a[href="#admissionForm"]').forEach(button => {

        button.addEventListener('click', function (e) {

            e.preventDefault();

            document.getElementById('admissionForm').scrollIntoView({

                behavior: 'smooth',

                block: 'start'

            });

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Admission Form AJAX
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('admissionFormElement');

    if (!form) {

        return;

    }

    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        Swal.fire({

            title: 'Submitting...',

            text: 'Please wait.',

            allowOutsideClick: false,

            didOpen: () => {

                Swal.showLoading();

            }

        });

        try {

            const response = await fetch(form.action, {

                method: 'POST',

                body: new FormData(form)

            });

            const data = await response.json();

            Swal.close();

            if (data.success) {

                Swal.fire({

                    icon: 'success',

                    title: 'Success',

                    text: data.message,

                    confirmButtonColor: '#8B0000'

                });

                form.reset();

            } else {

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

            Swal.close();

            Swal.fire({

                icon: 'error',

                title: 'Oops...',

                text: 'Something went wrong.',

                confirmButtonColor: '#8B0000'

            });

        }

    });

});

document.addEventListener("DOMContentLoaded", () => {

    const whatsappBtn = document.getElementById("whatsappBtn");

    console.log("Button :", whatsappBtn);

    if (!whatsappBtn) return;

    whatsappBtn.addEventListener("click", () => {

        console.log("WhatsApp Clicked");

        const student = document.querySelector('[name="student_name"]').value.trim();
        const parent = document.querySelector('[name="parent_name"]').value.trim();
        const phone = document.querySelector('[name="phone"]').value.trim();
        const email = document.querySelector('[name="email"]').value.trim();
        const applyingClass = document.querySelector('[name="applying_class"]').value;
        const message = document.querySelector('[name="message"]').value.trim();

        if (
            student === "" ||
            parent === "" ||
            phone === "" ||
            applyingClass === ""
        ) {

            alert("Please fill all required fields.");

            return;

        }

        // 👇 School WhatsApp Number
        const whatsappNumber = "919308002335";

        const text =
`🏫 *Sone Rising School*

🎓 *Admission Enquiry*

👦 Student : ${student}

👨 Parent : ${parent}

📞 Mobile : ${phone}

📧 Email : ${email}

🏫 Class : ${applyingClass}

📝 Message :

${message}`;

        location.href =
`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(text)}`;

    });

});