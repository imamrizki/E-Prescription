var removeSizeModal = function () {
    $("#myModal .modal-dialog").removeClass("modal-full");
    $("#myModal .modal-dialog").removeClass("modal-lg");
    $("#myModal .modal-dialog").removeClass("modal-xl");
    $("#myModal .modal-dialog").removeClass("modal-sm");
}

function showLoading() {
    $("body").LoadingOverlay("show", {
        image       : 'assets/img/icons/common/loader.svg',
        maxSize     : 150,
        minSize     : 150
    });
}

function hideLoading() {
    $("body").LoadingOverlay("hide", true);
}

function alertSuccess(msg) {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 1500
    })
}