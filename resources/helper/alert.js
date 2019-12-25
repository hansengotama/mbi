import Swal from 'sweetalert2'

export default {
    loading() {
        Swal.showLoading()
        $('.swal2-html-container').show()
        $('.swal2-html-container').text('Mohon Tunggu')
    },
    success() {
        Swal.hideLoading()

        return Swal.fire({
            title: 'Success!',
            icon: 'success',
            confirmButtonText: 'Ok',
            allowOutsideClick: false
        })
    },
    error(message = null) {
        Swal.hideLoading()

        return Swal.fire({
            title: 'Error!',
            icon: 'error',
            text: message,
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
