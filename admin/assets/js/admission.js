document.querySelectorAll('a[href="#admissionForm"]').forEach(button => {

    button.addEventListener('click', function(e){

        e.preventDefault();

        document.getElementById('admissionForm').scrollIntoView({

            behavior:'smooth',

            block:'start'

        });

    });

});