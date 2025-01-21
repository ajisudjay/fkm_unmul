<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errortanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errortanggal').html('');
                        }
                        if (response.error.perihal) {
                            $('.perihal').addClass('is-invalid');
                            $('.errorperihal').html(response.error.perihal);
                        } else {
                            $('.perihal').removeClass('is-invalid');
                            $('.errorperihal').html('');
                        }
                        if (response.error.tujuan) {
                            $('.tujuan').addClass('is-invalid');
                            $('.errortujuan').html(response.error.tujuan);
                        } else {
                            $('.tujuan').removeClass('is-invalid');
                            $('.errortujuan').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorfile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorfile').html('');
                        }
                        if (response.error.bagian) {
                            $('.bagian').addClass('is-invalid');
                            $('.errorbagian').html(response.error.bagian);
                        } else {
                            $('.bagian').removeClass('is-invalid');
                            $('.errorbagian').html('');
                        }
                        if (response.error.keterangan) {
                            $('.keterangan').addClass('is-invalid');
                            $('.errorketerangan').html(response.error.keterangan);
                        } else {
                            $('.keterangan').removeClass('is-invalid');
                            $('.errorketerangan').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        //  function hapus
        $('.hapus').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data Akan Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });


        window.setTimeout(function() {
            $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>