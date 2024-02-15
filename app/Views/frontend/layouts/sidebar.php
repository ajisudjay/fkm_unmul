<div class="col-lg-3">
    <div class="blog_right_sidebar">

        <!-- Kategori -->
        <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title">Terbaru</h4>
            <ul class="list cat-list" style="margin-bottom: 0px;">
                <?php foreach ($terbaru as $item) : ?>
                    <li style="margin-bottom: -10px;margin-top: -10px;">
                        <a href="<?= base_url('informasi-detail/' . $item['slug']); ?>">
                            <div align="center">
                                <img src="<?= base_url('/writable/uploads/content/berita/thumb/' . $item['banner'] . ''); ?>" width="150px">
                            </div>
                        </a>
                        <?php
                        if (strlen($item['judul']) < 45) {
                            $judul = $item['judul'];
                        } else {
                            $judul = substr($item['judul'], 0, 45) . ' .  .  .';
                        }

                        ?>
                        <p align="justify" style="font-size: small;color:#360A5B;line-height:22px;"><?= $judul ?></p>
                    </li>
                <?php endforeach ?>
            </ul>

            <!-- Kategori -->
            <h4 class="widget_title">Kategori</h4>
            <ul class="list cat-list" style="margin-bottom: -10px;">
                <li style="margin-bottom: -10px;margin-top: -30px;">
                    <a href="<?= base_url('informasi-kategori/Berita'); ?>" class="d-flex">
                        <p>Berita</p>
                    </a>
                </li>
                <li style="margin-bottom: -10px;margin-top: -10px;">
                    <a href="<?= base_url('informasi-kategori/Pengumuman'); ?>" class="d-flex">
                        <p>Pengumuman</p>
                    </a>
                </li>
                <li style="margin-bottom: -10px;margin-top: -10px;">
                    <a href="<?= base_url('informasi-kategori/Kegiatan'); ?>" class="d-flex">
                        <p>Kegiatan</p>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
</div>