$("body").on("click", ".btn-delete", function () {
    event.preventDefault();
    let me = $(this),
        url = me.attr("href"),
        csrf_token = $("meta[name=csrf-token]").attr("content");
    Swal.fire({
        text: "Setelah dihapus, Anda tidak akan dapat memulihkannya!?",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Tidak!",
        confirmButtonColor: "#28A745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _method: "DELETE",
                    _token: csrf_token,
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Proses',
                        text: 'Mohon tunggu sebentar...',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    Swal.close()

                    Swal.fire({
                        icon: "success",
                        title: "Sukses!",
                        timer: 5000,
                        text: response.message,
                    }).then((result) => {
                        $("#datatable").DataTable().ajax.reload();
                    });
                },
                error: function (xhr) {
                    Swal.close()

                    let error = xhr.responseJSON;
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        timer: 5000,
                        text: error.message,
                    });
                },
            });
        }
    });
});

jQuery.extend(jQuery.validator.messages, {
    required: "Formulir ini wajib diisi.",
    email: "Isi dengan email yang valid.",
    url: "Isi dengan URL yang valid.",
    date: "Isi dengan tanggal yang valid",
    dateISO: "Please enter a valid date (ISO).",
    number: "Isi dengan angka yang valid",
    digits: "Hanya boleh memasukkan angka.",
    creditcard: "Harap masukkan nomor kartu kredit yang benar.",
    equalTo: "Harap masukkan kembali nilai yang sama.",
    accept: "Harap masukkan nilai dengan ekstensi yang valid.",
    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
    rangelength: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1} karakter."),
    range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
})

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'Ukuran maksimal 500 KB')

function makeid(length) {
    let result           = '';
    let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
