<!-- SCRIPT AJAX -->
<script>
    CKEDITOR.replace('isi');
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var data = new FormData(form);
            var formData = new FormData(this);
            formData.append('isi', CKEDITOR.instances.isi.getData());
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
                        if (response.error.urutan) {
                            $('.urutan').addClass('is-invalid');
                            $('.errorurutan').html(response.error.urutan);
                        } else {
                            $('.urutan').removeClass('is-invalid');
                            $('.errorurutan').html('');
                        }
                        if (response.error.mainmenu) {
                            $('.mainmenu').addClass('is-invalid');
                            $('.errormainmenu').html(response.error.mainmenu);
                        } else {
                            $('.mainmenu').removeClass('is-invalid');
                            $('.errormainmenu').html('');
                        }
                        if (response.error.submenu) {
                            $('.submenu').addClass('is-invalid');
                            $('.errorsubmenu').html(response.error.submenu);
                        } else {
                            $('.submenu').removeClass('is-invalid');
                            $('.errorsubmenu').html('');
                        }
                    } else {
                        if (response.status == 'gagal') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.sukses,
                            })
                        } else if (response.status == 'berhasil') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                        }
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
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
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.urutan) {
                            $('.urutan').addClass('is-invalid');
                            $('.errorurutan').html(response.error.urutan);
                        } else {
                            $('.urutan').removeClass('is-invalid');
                            $('.errorurutan').html('');
                        }
                        if (response.error.mainmenu) {
                            $('.mainmenu').addClass('is-invalid');
                            $('.errormainmenu').html(response.error.mainmenu);
                        } else {
                            $('.mainmenu').removeClass('is-invalid');
                            $('.errormainmenu').html('');
                        }
                        if (response.error.submenu) {
                            $('.submenu').addClass('is-invalid');
                            $('.errorsubmenu').html(response.error.submenu);
                        } else {
                            $('.submenu').removeClass('is-invalid');
                            $('.errorsubmenu').html('');
                        }
                    } else {
                        if (response.status == 'gagal') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.sukses,
                            })
                        } else if (response.status == 'berhasil') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                        }
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
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