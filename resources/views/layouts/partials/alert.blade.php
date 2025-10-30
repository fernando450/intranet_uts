<script>
    // Obtener el mensaje y el tipo de la sesión de Laravel
    let message = "{{ session('success') ?? session('info') ?? session('warning') ?? session('danger') }}";
    let type = "{{ session()->has('success') ? 'success' : (session()->has('info') ? 'info' : (session()->has('warning') ? 'warning' : (session()->has('danger') ? 'danger' : ''))) }}";
    console.log(type, message);
    if (message) {
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
                icon = 'error'; // Cambiar a 'error' para mostrar un ícono de error para el tipo 'danger'
                break;
            default:
                icon = '';
        }

        Toast.fire({
            icon: icon,
            title: message
        })
    }
</script>
