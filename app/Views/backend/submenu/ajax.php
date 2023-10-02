<!-- SCRIPT AJAX -->
<script>
    CKEDITOR.replace('isi');
</script>
<?php foreach ($submenu as $item_submenu) :
    $idx = 'isi' . $item_submenu['submenu_id'];
?>
    <script>
        CKEDITOR.replace('<?= $idx ?>');
    </script>
<?php endforeach
?>
<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function() {
            var judul = $('#judul').val();
            var tanggal = $('#tanggal').val();
            var tag = $('#tag').val();
            var isi = $('#isi').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('judul', judul);
            fd.append('tanggal', tanggal);
            fd.append('tag', tag);
            fd.append('isi', isi);
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
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorFile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorFile').html('');
                        }
                        if (response.error.tag) {
                            $('.tag').addClass('is-invalid');
                            $('.errorTag').html(response.error.tag);
                        } else {
                            $('.tag').removeClass('is-invalid');
                            $('.errorTag').html('');
                        }
                        if (response.error.isi) {
                            $('.isi').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('.isi').removeClass('is-invalid');
                            $('.errorIsi').html('');
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
            var judul = $('#judul').val();
            var tanggal = $('#tanggal').val();
            var tag = $('#tag').val();
            var isi = $('#isi').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('judul', judul);
            fd.append('tanggal', tanggal);
            fd.append('tag', tag);
            fd.append('isi', isi);
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
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorFile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorFile').html('');
                        }
                        if (response.error.tag) {
                            $('.tag').addClass('is-invalid');
                            $('.errorTag').html(response.error.tag);
                        } else {
                            $('.tag').removeClass('is-invalid');
                            $('.errorTag').html('');
                        }
                        if (response.error.isi) {
                            $('.isi').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('.isi').removeClass('is-invalid');
                            $('.errorIsi').html('');
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