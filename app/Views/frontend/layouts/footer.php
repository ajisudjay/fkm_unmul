 <footer class="footer">
     <div class="footer_top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3">
                     <div class="footer_widget">
                         <h3 class="text-white">
                             FKM UNMUL
                         </h3>
                         <ul class="contact">
                             <?php foreach ($konf as $item) : ?>
                                 <div class="info_button">
                                     <a target="_blank" href="https://maps.app.goo.gl/1T9T9Cv1F1jqvNJe9" class="boxed-btn3-white">Buka Maps</a>
                                 </div>
                                 <li>
                                     <p><i class="fa fa-map-marker"></i> <strong>Alamat : </strong><?= $item['alamat'] ?></p>
                                 </li>
                                 <li>
                                     <p><i class="fa fa-phone"></i> <strong>Telepon : </strong><?= $item['telepon'] ?></p>
                                 </li>
                                 <li>
                                     <p><i class="fa fa-envelope"></i> <strong>Email : </strong> <a href="mailto: <?= $item['email'] ?>"> <?= $item['email'] ?></a></p>
                                 </li>
                             <?php endforeach ?>
                         </ul>
                         <div class="socail_links">
                             <?php foreach ($konf as $item) : ?>
                                 <ul>
                                     <li>
                                         <a href="<?= $item['fb'] ?>">
                                             <i class="ti-facebook"></i>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="<?= $item['yt'] ?>">
                                             <i class="fa fa-youtube-play"></i>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="<?= $item['ig'] ?>">
                                             <i class="fa fa-instagram"></i>
                                         </a>
                                     </li>
                                 </ul>
                             <?php endforeach ?>
                         </div>

                     </div>
                 </div>

                 <div class="col-lg-3">
                     <div class="footer_widget">
                         <h4 class="text-white">
                             Link Partner
                         </h4>
                         <ul>
                             <?php foreach ($link_partner as $lp) : ?>
                                 <li><a href="<?= base_url($lp['link']); ?>"><?= $lp['judul'] ?></a></li>
                             <?php endforeach ?>
                         </ul>
                     </div>
                 </div>

                 <div class="col-lg-3">
                     <div class="footer_widget">
                         <h4 class="text-white">
                             e-Jurnal
                         </h4>
                         <ul>
                             <?php foreach ($link_jurnal as $lj) : ?>
                                 <li><a href="<?= base_url($lj['link']); ?>"><?= $lj['judul'] ?></a></li>
                             <?php endforeach ?>
                         </ul>
                     </div>
                 </div>

                 <div class="col-lg-3">
                     <div class="footer_widget">
                         <h4 class="text-white">
                             e-Library
                         </h4>
                         <ul>
                             <?php foreach ($link_library as $lb) : ?>
                                 <li><a href="<?= base_url($lb['link']); ?>"><?= $lb['judul'] ?></a></li>
                             <?php endforeach ?>
                         </ul>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <div class="copy-right_text">
         <div class="container">
             <div class="footer_border"></div>
             <div class="row">
                 <div class="col-xl-12">
                     <p class="copy_right text-purple text-center">
                         2023 Fakultas Kesehatan Masyarakat | Universitas Mulawarman
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </footer>