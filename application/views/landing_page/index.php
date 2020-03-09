<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("landing_page/_partials/header.php") ?>
      
<body id="page-top">

<?php $this->load->view("landing_page/_partials/topbar.php") ?>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Selamat Datang di Rembesin!</div>
        <div class="intro-heading text-uppercase">Gantiin donggg</div><br>  
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger mr-3" href="<?= site_url('auth/login') ?>">Login</a>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="<?= site_url('auth/registrasi') ?>">Registrasi</a>
      </div>
    </div>
  </header>

  <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Langkah-langkah Rembesin</h2>
          <h3 class="section-subheading text-muted">Ikutin langkahnya yuk !</h3>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-mobile-alt fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Foto Nota</h4>
          <p class="text-muted">Foto nota yang akan kamu klaim sebagai bukti bahwa seluruh pembelanjaan perusahaan menggunakan uang pribadi</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Klaim Nota</h4>
          <p class="text-muted">Tunggu proses klaim nota rembes dari pihak perusahaan</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x"> 
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-hand-holding-usd fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Terima Uang</h4>
          <p class="text-muted">Uang akan diterima jika perusahaan sudah menyetujui tau klaim semua nota yang dilampirkan karyawan</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Jenis-jenis Nota</h2>
          <h3 class="section-subheading text-muted">Nota yang dapat di klaim</h3>
        </div>
      </div>

      <div class="card-deck">
        <?php foreach($getJenisNota->result() as $jenis): ?>
          <div class="col-md-3 mb-4 mx-auto">
            <div class="card card-image" style="background-image: url(<?= site_url('assets/document/admin/images/'.$jenis->gambar_nota.'') ?>)">
              <div class=" card-body text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                <div class="text-center">
                  <h3 class="card-title"><strong><?= $jenis->jenis_nota ?></strong></h3>
                  <p class="card-text"><?= $jenis->deskripsi_nota ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
  </div>
  </section>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Informasi Rembesin</h2>
          <h3 class="section-subheading text-muted">Sistem guna mengklaim dana yang digunakan oleh karyawan untuk keperluan atau kepentingan perusahaan</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="timeline">
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="<?= base_url('assets/img/informasi/tentang.jpg') ?>" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Tentang</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Dalam menjalankan bisnis, terkadang perusahaan tidak dapat membayarkannya secara langung untuk apapun yang berkaitan dengan pelaksanaan proses bisnis. Oleh karena itu, terkadang karyawan harus merelakan untuk membayar terlebih dahulu. Namun jangan khawatir, kita dapat menuntut penggantian biaya yang keluar dengan cara mengajukan klaim reimbursement kepada perusahaan. Namun yang perlu diketahui, ada beberapa hal yang harus dicermati oleh karyawan sebelum mengajukan klaim reimburse.</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="<?= base_url('assets/img/company_avatar.png') ?>" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Fitur Website</h4>
                  <h6>Halaman perusahaan</h6>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Perusahaan dapat menggunakan website rembesin dengan mendaftar dihalaman register kemudian tunggu proses approve dari admin website, halaman perusahaan terdapat dashboard / informasi singkat mengenai data data / aktifitas akun perusahaan, terdapat data karyawan untuk pengelolaan karyawan mereka, terdapat data rembes yang memiliki sub rembes belum diklaim, sudah diklaim, dan urgent klaim (melebihi batas jadwal klaim)<br>
                  </p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="<?= base_url('assets/img/karyawan_avatar.png') ?>" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Fitur Website</h4>
                  <h6>Halaman karyawan</h6>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Karyawan ditambahkan jika perusahaan sudah didaftarkan pada website rembesin, halaman karyawan terdapat pengajuan kegiatan untuk rembes nota, pengelolaan data rembes, sub data rembes yang sudah diklaim maupun belum diklaim, terdapat pula kategori untuk pengajuan nota / pengajuan pembayaran pinjaman<br>
                  </p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="<?= base_url('assets/img/other_fitur.png') ?>" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Fitur Lainya</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Pengelolaan profile, lupa password, aktivity log, kontak email ke admin, registrasi perusahaan, login user<br>
                  </p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <h4>Pasti
                  <br>Diganti
                  <br>Kokkk!</h4>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Rembesin's Team</h2>
          <h3 class="section-subheading text-muted"></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="<?= base_url('assets/img/team/6.jpeg') ?>" alt="">
            <h4>Anisa Pandu</h4>
            <p class="text-muted">Lead Designer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="<?= base_url('assets/img/team/4.jpg') ?>" alt="">
            <h4>Ismi Nururizqi</h4>
            <p class="text-muted">Manager</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="<?= base_url('assets/img/team/5.jpeg') ?>" alt="">
            <h4>Ianatul Khoeriyah</h4>
            <p class="text-muted"> Lead Developer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="<?= base_url('assets/img/team/7.jpeg') ?>" alt="">
            <h4>Rizqi Putpitasari</h4>
            <p class="text-muted">Lead Marketer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contact Us</h2>
          <h3 class="section-subheading text-muted">Silahkan hubungi kami jika ada pertanyaan mengenai REMBESIN</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form action="<?= site_url('contact_us/send') ?>" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name." value="<?= set_value('name'); ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address." value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number." value="<?= set_value('phone'); ?>">
                  <?= form_error('phone', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."><?= set_value('message'); ?></textarea>
                  <?= form_error('message', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <?= $this->session->flashdata('success'); ?>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <span class="copyright">Copyright &copy; <?= SITE_NAME ?> 2019</span>
        </div>
      </div>
    </div>
  </footer>

<?php $this->load->view("landing_page/_partials/modal.php") ?>

<?php $this->load->view("landing_page/_partials/footer.php") ?>

</body>
</html>