
const ajaxForms=document.querySelectorAll(".AjaxForm");

ajaxForms.forEach(forms => {

    forms.addEventListener("submit",function(e){
        
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Quieres realizar la acción solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed){

                let data = new FormData(this);
                let method=this.getAttribute("method");
                let action=this.getAttribute("action");

                let headers= new Headers();

                let config={
                    method: method,
                    headers: headers,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action,config)
                    .then(response => response.json())
                    .then(response =>{ 
                    return ajaxAlerts(response);
                });
            }
        });

    });

});

function ajaxAlerts(alert){
    if(alert.type=="simple"){
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        });
    }else if(alert.type=="reload"){

        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                location.reload();
            }
        });

    }else if(alert.type=="clean"){

        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector(".AjaxForm").reset();
            }
        });

    }else if(alert.type=="redirect"){
        window.location.href=alert.url;
    }
}


let btnCloseSession = document.getElementById("btnCloseSession");

btnCloseSession.addEventListener("click", function(e){

    e.preventDefault();
    
    Swal.fire({
        title: '¿Quieres salir del sistema?',
        text: "La sesión actual se cerrará y saldrás del sistema.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let url=this.getAttribute("href");
            window.location.href=url;
        }
    });

});