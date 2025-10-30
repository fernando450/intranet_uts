function alertT(message,type){
    console.log('legando');
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    let icon = '';
    switch(type) {
        case 'success':
            icon = 'success';
            break;
        case 'info':
            icon = 'info';
            break;
        case 'warning':
            icon = 'warning';
            break;
        case 'danger':
            icon = 'error'; // Cambiar a 'error' para mostrar un ícono de error para el type 'danger'
            break;
        default:
            icon = '';
    }

    Toast.fire({
        icon: icon,
        title: message
    })
}
