<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?= $this->include('backend/layouts/header') ?>
<!-- BEGIN: Body-->

<body>

    <!-- BEGIN: Content-->
    <div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <a href="/" class="btn btn-danger fa fa-chevron-circle-left" align="center"> Kembali</a>
                            <div class=" containter-fluid">
                                <div class="card-header">
                                    <h2 class="mb-0">Surat Keputusan</h2>
                                </div>

                                <div class="card" style="padding: 25px;">
                                    <form action="<?= base_url('sk_view/view'); ?>" method="post" class="semesterx">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <select name="semesterx" class="form-control semesterx">
                                                    <?php foreach ($semester as $item_semester) : ?>
                                                        <option value="<?= $item_semester['id'] ?>"><?= $item_semester['semester'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-primary btnTampilkan" type="submit">Tampilkan</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="bg-transparent border-0" id="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- Dashboard Analytics end -->
        </div>
    </div>
    <!-- END: Content-->
    <script>
        $(document).ready(function() {
            $(".semesterx").submit(function(e) {
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btnTampilkan').attr('disable', 'disabled');
                        $('.btnTampilkan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnTampilkan').removeAttr('disable', 'disabled');
                        $('.btnTampilkan').html('Tampilkan');
                    },
                    success: function(response) {
                        $("#result").html(response.data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
                e.preventDefault(); //Prevent Default action.
            });
        });
    </script>
    <?= $this->include('backend/layouts/js') ?>
</body>
<!-- END: Body-->

</html>