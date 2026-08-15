function deleteRecord({

    selector,

    url,

    title,

    successTitle,

    confirmButtonColor = '#8B0000'

}) {

    document.querySelectorAll(selector).forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

            Swal.fire({

                title,

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor,

                confirmButtonText: 'Yes, Delete'

            }).then(async(result)=>{

                if(!result.isConfirmed){

                    return;

                }

                const formData=new FormData();

                formData.append('id',id);

                try{

                    const response=await fetch(url,{

                        method:'POST',

                        body:formData

                    });

                    const json=await response.json();

                    if(json.success){

                        Swal.fire({

                            icon:'success',

                            title:successTitle,

                            text:json.message,

                            confirmButtonColor

                        }).then(()=>{

                            location.reload();

                        });

                    }else{

                        Swal.fire({

                            icon:'error',

                            title:'Error',

                            text:json.message,

                            confirmButtonColor

                        });

                    }

                }catch(error){

                    Swal.fire({

                        icon:'error',

                        title:'Oops...',

                        text:'Something went wrong.',

                        confirmButtonColor

                    });

                }

            });

        });

    });

}