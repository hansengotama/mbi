import Swal from 'sweetalert2'

export default {
    loading() {
        return Swal.loading()
    },
    success() {
        return Swal.fire({
            title: 'Success!',
            icon: 'success',
            confirmButtonText: 'Ok'
        })
    },
    error() {
        return Swal.fire({
            title: 'Error!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    },
    confirmation(title, confirmText, cancelText) {
        return Swal.fire({
            title: title,
            icon: 'warning',
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            showCancelButton: true,
            showCloseButton: true
        })
    }
}
