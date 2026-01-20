<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= esc($pengaturan->judul ?? 'Home') ?></title>
  <meta content="<?= esc($pengaturan->owner ?? 'Owner Aplikasi') ?>" name="author">
  <meta content="<?= esc($pengaturan->nama_app ?? 'Spedito - All in one place') ?>" name="description">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">
  
  <!-- UIKit CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
  <link id="dm-dark" rel="stylesheet" href="<?= base_url('assets/css/dark.css') ?>">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="page-home dm-dark">
  <div class="page-wrapper">
    <header class="page-header">
      <!-- Top Header -->
      <div class="page-header__top">
        <div class="uk-container">
          <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
            <div class="uk-navbar-left">
              <button class="uk-button" type="button" data-uk-toggle="target: #offcanvas" data-uk-icon="menu"></button>
              <ul class="uk-navbar-nav">
                <li><div id="google_translate_element"></div></li>
                
                <?php if (in_array(session()->get('level'), [1, 2, 3])): ?>
                  <li><a href="<?= base_url('/home') ?>"><i class="fas fa-home"></i> Home</a></li>
                  <li><a href="<?= base_url('/jadwal') ?>"><i class="fas fa-calendar"></i> Jadwal Ekskul</a></li>
                  <li><a href="<?= base_url('/daftar') ?>"><i class="fas fa-book"></i> Daftar Ekskul</a></li>
                  <li><a href="<?= base_url('/penilaian') ?>"><i class="fas fa-star"></i> Nilai Ekskul</a></li>
                  <li><a href="<?= base_url('/absensi') ?>"><i class="fas fa-list-check"></i> Absensi Ekskul</a></li>
                  
                  <?php if (session()->get('level') == 1): ?>
                    <li><a href="<?= base_url('/tampildata') ?>"><i class="fas fa-table"></i> List Data</a></li>
                    <li><a href="<?= base_url('/formdata') ?>"><i class="fas fa-plus-square"></i> Input Data</a></li>
                  <?php endif; ?>
                <?php endif; ?>

                <li><a href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>

      <!-- Bottom Header -->
      <div class="page-header__bottom">
        <div class="uk-container">
          <div class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
            <div class="uk-navbar-left">
              <div class="block-with-phone">
                <img src="<?= base_url('assets/img/icons/delivery.svg') ?>" alt="delivery" data-uk-svg>
                <div>
                  <span>For Delivery, Call us</span>
                  <a href="tel:13205448749">1-320-544-8749</a>
                </div>
              </div>
            </div>
            <div class="uk-navbar-right">
              <div class="other-links">
                <ul class="other-links-list">
                  <li><a href="#modal-full" data-uk-toggle><span data-uk-icon="search"></span></a></li>
                  <li><a href="#!"><span data-uk-icon="user"></span></a></li>
                  <li><a href="<?= base_url('home/lihat_keranjang') ?>"><span data-uk-icon="cart"></span></a></li>
                </ul>
                <a class="uk-button" href="<?= base_url('page-pizza-builder.html') ?>">
                  <span>Make Your Pizza</span>
                  <img class="uk-margin-small-left" src="<?= base_url('assets/img/icons/pizza.png') ?>" alt="pizza">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Offcanvas Menu -->
    <div id="offcanvas" data-uk-offcanvas="overlay: true">
      <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" data-uk-close=""></button>
        <div class="uk-margin-top">
          <ul class="uk-nav">
            <?php if (in_array(session()->get('level'), [1, 2, 3])): ?>
              <li><a href="<?= base_url('/home') ?>"><i class="fas fa-home"></i> Home</a></li>
              <li><a href="<?= base_url('/jadwal') ?>"><i class="fas fa-calendar"></i> Jadwal Ekskul</a></li>
              <li><a href="<?= base_url('/daftar') ?>"><i class="fas fa-book"></i> Daftar Ekskul</a></li>
              <li><a href="<?= base_url('/penilaian') ?>"><i class="fas fa-star"></i> Nilai Ekskul</a></li>
              <li><a href="<?= base_url('/absensi') ?>"><i class="fas fa-list-check"></i> Absensi Ekskul</a></li>
              
              <?php if (session()->get('level') == 1): ?>
                <li><a href="<?= base_url('/tampildata') ?>"><i class="fas fa-table"></i> List Data</a></li>
                <li><a href="<?= base_url('/formdata') ?>"><i class="fas fa-plus-square"></i> Input Data</a></li>
              <?php endif; ?>
            <?php endif; ?>
          </ul>
        </div>
        <hr class="uk-margin">
        <div class="uk-margin-bottom">
          <div class="block-with-phone">
            <img src="<?= base_url('assets/img/icons/delivery.svg') ?>" alt="delivery" data-uk-svg>
            <div>
              <span>For Delivery, Call us</span>
              <a href="tel:13205448749">1-320-544-8749</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Modal -->
    <div class="uk-modal-full uk-modal" id="modal-full" data-uk-modal>
      <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport>
        <button class="uk-modal-close-full" type="button" data-uk-close></button>
        <form class="uk-search uk-search-large">
          <input class="uk-search-input uk-text-center" type="search" placeholder="Search..." autofocus>
        </form>
      </div>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'id',
          includedLanguages: 'en,id',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    <!-- Auto Logout Script -->
    <script>
      var timeout = 1000; // Waktu dalam detik (5 menit)
      var logoutUrl = "<?= site_url('home/logout') ?>";
      var resetTime = timeout * 1000; // Konversi ke milidetik

      function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(function() {
          window.location.href = logoutUrl;
        }, resetTime);
      }

      var timer = setTimeout(function() {
        window.location.href = logoutUrl;
      }, resetTime);

      document.addEventListener("mousemove", resetTimer);
      document.addEventListener("keypress", resetTimer);
      document.addEventListener("click", resetTimer);
    </script>

    <!-- UIKit JS -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
  </div>
</body>
</html>