function spinner(event, button){
    let spinner = document.getElementById('spinner');
    if(spinner){
        accion(event, button, spinner)
    }
}

function spinnerM(event, button , numero){
    let spinner = document.getElementById('spinner'+numero);
    if(spinner){
        accion(event, button, spinner)
    }
}

function accion(event,button,spinner){
    event.preventDefault(); // Prevenir el envío del formulario

    var form = button.closest('form');//obtener el formulario mas cercano

    if (form.checkValidity()) { // Verificar si el formulario es válido
        // Verifica si el elemento existe
        if (spinner) {
            // Quita el atributo
            spinner.removeAttribute('hidden');
            // Deshabilitar el botón de envío
            button.disabled = true;

            //Autorizar envio
            form.submit();
        }
    }else{
        form.reportValidity(); // Mostrar los mensajes de error del formulario
    }
}
