<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var data = new FormData(form);
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
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner text-light"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.jenis) {
                            $('.jenis').addClass('is-invalid');
                            $('.errorjenis').html(response.error.jenis);
                        } else {
                            $('.jenis').removeClass('is-invalid');
                            $('.errorjenis').html('');
                        }
                        if (response.error.nomor) {
                            $('.nomor').addClass('is-invalid');
                            $('.errornomor').html(response.error.nomor);
                        } else {
                            $('.nomor').removeClass('is-invalid');
                            $('.errornomor').html('');
                        }
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errortanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errortanggal').html('');
                        }
                        if (response.error.sasaran) {
                            $('.sasaran').addClass('is-invalid');
                            $('.errorsasaran').html(response.error.sasaran);
                        } else {
                            $('.sasaran').removeClass('is-invalid');
                            $('.errorsasaran').html('');
                        }
                        if (response.error.perihal) {
                            $('.perihal').addClass('is-invalid');
                            $('.errorperihal').html(response.error.perihal);
                        } else {
                            $('.perihal').removeClass('is-invalid');
                            $('.errorperihal').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('body').removeClass('modal-open');
                        //modal-open class is added on body so it has to be removed
                        $('.modal-backdrop').remove();
                        //need to remove div with modal-backdrop class
                        $("#result").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        $('.edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnEdit').attr('disable', 'disabled');
                    $('.btnEdit').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnEdit').removeAttr('disable', 'disabled');
                    $('.btnEdit').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.urutan) {
                            $('.urutan').addClass('is-invalid');
                            $('.errorUrutan').html(response.error.urutan);
                        } else {
                            $('.urutan').removeClass('is-invalid');
                            $('.errorUrutan').html('');
                        }
                        if (response.error.mainmenu) {
                            $('.mainmenu').addClass('is-invalid');
                            $('.errorMainmenu').html(response.error.mainmenu);
                        } else {
                            $('.mainmenu').removeClass('is-invalid');
                            $('.errorMainmenu').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('body').removeClass('modal-open');
                        //modal-open class is added on body so it has to be removed
                        $('.modal-backdrop').remove();
                        //need to remove div with modal-backdrop class
                        $("#result").html(response.data);
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