<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function input
        $('.input').submit(function(e) {
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
                        if (response.error.nip) {
                            $('.nip').addClass('is-invalid');
                            $('.errornip').html(response.error.nip);
                        } else {
                            $('.nip').removeClass('is-invalid');
                            $('.errornip').html('');
                        }
                        if (response.error.nidn) {
                            $('.nidn').addClass('is-invalid');
                            $('.errornidn').html(response.error.nidn);
                        } else {
                            $('.nidn').removeClass('is-invalid');
                            $('.errornidn').html('');
                        }
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }
                        if (response.error.bidang) {
                            $('.bidang').addClass('is-invalid');
                            $('.errorbidang').html(response.error.bidang);
                        } else {
                            $('.bidang').removeClass('is-invalid');
                            $('.errorbidang').html('');
                        }
                        if (response.error.homebase) {
                            $('.homebase').addClass('is-invalid');
                            $('.errorhomebase').html(response.error.homebase);
                        } else {
                            $('.homebase').removeClass('is-invalid');
                            $('.errorhomebase').html('');
                        }
                        if (response.error.s1) {
                            $('.s1').addClass('is-invalid');
                            $('.errors1').html(response.error.s1);
                        } else {
                            $('.s1').removeClass('is-invalid');
                            $('.errors1').html('');
                        }
                        if (response.error.sp) {
                            $('.sp').addClass('is-invalid');
                            $('.errorsp').html(response.error.sp);
                        } else {
                            $('.sp').removeClass('is-invalid');
                            $('.errorsp').html('');
                        }
                        if (response.error.s2) {
                            $('.s2').addClass('is-invalid');
                            $('.errors2').html(response.error.s2);
                        } else {
                            $('.s2').removeClass('is-invalid');
                            $('.errors2').html('');
                        }
                        if (response.error.s3) {
                            $('.s3').addClass('is-invalid');
                            $('.errors3').html(response.error.s3);
                        } else {
                            $('.s3').removeClass('is-invalid');
                            $('.errors3').html('');
                        }
                        if (response.error.tempat_lahir) {
                            $('.tempat_lahir').addClass('is-invalid');
                            $('.errortempat_lahir').html(response.error.tempat_lahir);
                        } else {
                            $('.tempat_lahir').removeClass('is-invalid');
                            $('.errortempat_lahir').html('');
                        }
                        if (response.error.tanggal_lahir) {
                            $('.tanggal_lahir').addClass('is-invalid');
                            $('.errortanggal_lahir').html(response.error.tanggal_lahir);
                        } else {
                            $('.tanggal_lahir').removeClass('is-invalid');
                            $('.errortanggal_lahir').html('');
                        }
                        if (response.error.alamat) {
                            $('.alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        } else {
                            $('.alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
                        }
                        if (response.error.telp) {
                            $('.telp').addClass('is-invalid');
                            $('.errortelp').html(response.error.telp);
                        } else {
                            $('.telp').removeClass('is-invalid');
                            $('.errortelp').html('');
                        }
                        if (response.error.email) {
                            $('.email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('.email').removeClass('is-invalid');
                            $('.erroremail').html('');
                        }
                        if (response.error.sinta) {
                            $('.sinta').addClass('is-invalid');
                            $('.errorsinta').html(response.error.sinta);
                        } else {
                            $('.sinta').removeClass('is-invalid');
                            $('.errorsinta').html('');
                        }
                        if (response.error.gs) {
                            $('.gs').addClass('is-invalid');
                            $('.errorgs').html(response.error.gs);
                        } else {
                            $('.gs').removeClass('is-invalid');
                            $('.errorgs').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorfile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorfile').html('');
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