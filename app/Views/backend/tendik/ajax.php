<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function() {
            var nama = $('#nama').val();
            var nip = $('#nip').val();
            var jabatan = $('#jabatan').val();
            var ruangan = $('#ruangan').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('nip', nip);
            fd.append('nama', nama);
            fd.append('jabatan', jabatan);
            fd.append('ruangan', ruangan);
            $.ajax({
                type: "post",
                data: fd,
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
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.jabatan) {
                            $('.jabatan').addClass('is-invalid');
                            $('.errorJabatan').html(response.error.jabatan);
                        } else {
                            $('.jabatan').removeClass('is-invalid');
                            $('.errorJabatan').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorFile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorFile').html('');
                        }
                        if (response.error.nip) {
                            $('.nip').addClass('is-invalid');
                            $('.errorUrutan').html(response.error.nip);
                        } else {
                            $('.nip').removeClass('is-invalid');
                            $('.errorUrutan').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'berhasil',
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

        //  function edit
        $('.edit').submit(function() {
            var nama = $('#nama').val();
            var nip = $('#nip').val();
            var jabatan = $('#jabatan').val();
            var ruangan = $('#ruangan').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('nip', nip);
            fd.append('nama', nama);
            fd.append('jabatan', jabatan);
            fd.append('ruangan', ruangan);
            $.ajax({
                type: "post",
                data: fd,
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
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.jabatan) {
                            $('.jabatan').addClass('is-invalid');
                            $('.errorJabatan').html(response.error.jabatan);
                        } else {
                            $('.jabatan').removeClass('is-invalid');
                            $('.errorJabatan').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorFile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorFile').html('');
                        }
                        if (response.error.nip) {
                            $('.nip').addClass('is-invalid');
                            $('.errorUrutan').html(response.error.nip);
                        } else {
                            $('.nip').removeClass('is-invalid');
                            $('.errorUrutan').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'berhasil',
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