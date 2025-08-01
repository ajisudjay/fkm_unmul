<!-- SCRIPT AJAX -->

<script>
    $(document).ready(function() {
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
                        if (response.error.visi) {
                            $('.visi').addClass('is-invalid');
                            $('.errorVisi').html(response.error.visi);
                        } else {
                            $('.visi').removeClass('is-invalid');
                            $('.errorVisi').html('');
                        }
                        if (response.error.misi) {
                            $('.misi').addClass('is-invalid');
                            $('.errorMisi').html(response.error.misi);
                        } else {
                            $('.misi').removeClass('is-invalid');
                            $('.errorMisi').html('');
                        }
                        if (response.error.email) {
                            $('.email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('.email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }
                        if (response.error.telepon) {
                            $('.telepon').addClass('is-invalid');
                            $('.errorTelepon').html(response.error.telepon);
                        } else {
                            $('.telepon').removeClass('is-invalid');
                            $('.errorTelepon').html('');
                        }
                        if (response.error.alamat) {
                            $('.alamat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            $('.alamat').removeClass('is-invalid');
                            $('.errorAlamat').html('');
                        }
                        if (response.error.ig) {
                            $('.ig').addClass('is-invalid');
                            $('.errorIg').html(response.error.ig);
                        } else {
                            $('.ig').removeClass('is-invalid');
                            $('.errorIg').html('');
                        }
                        if (response.error.fb) {
                            $('.fb').addClass('is-invalid');
                            $('.errorFb').html(response.error.fb);
                        } else {
                            $('.fb').removeClass('is-invalid');
                            $('.errorFb').html('');
                        }
                        if (response.error.yt) {
                            $('.yt').addClass('is-invalid');
                            $('.errorYt').html(response.error.yt);
                        } else {
                            $('.yt').removeClass('is-invalid');
                            $('.errorYt').html('');
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

        $('.editfoto').submit(function(e) {
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
                    $('.btnEditfoto').attr('disable', 'disabled');
                    $('.btnEditfoto').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnEditfoto').removeAttr('disable', 'disabled');
                    $('.btnEditfoto').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.foto) {
                            $('.foto').addClass('is-invalid');
                            $('.errorfoto').html(response.error.foto);
                        } else {
                            $('.foto').removeClass('is-invalid');
                            $('.errorfoto').html('');
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

        window.setTimeout(function() {
            $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>