<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($webDetail['title'] ?? 'Login'); ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

   
</head>
<body>

<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="card border-light-subtle shadow-sm">
            <div class="row g-0">

                <!-- LEFT -->
                <div class="col-12 col-md-6 text-bg-primary d-flex align-items-center justify-content-center flex-column p-4">
                    <div class="image-container mb-3 text-center">
                        <img class="img-fluid rounded"
                             src="<?= base_url('assets/img/2.png') ?>"
                             alt="FastFood">
                    </div>
                    <h2 class="text-white text-center">Selamat datang di halaman login FastFood</h2>
                    <p class="text-white text-center">Jangan lupa pesan makanannya 🍔🥤</p>
                    <p class="text-white text-center">Belum punya akun? Daftar dulu ya.</p>
                </div>

                <!-- RIGHT -->
                <div class="col-12 col-md-6">
                    <div class="card-body p-4">

                        <h3 class="mb-4 text-center">Log in</h3>

                        <!-- ERROR -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-center">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- FORM -->
                        <form action="<?= base_url('/login') ?>" method="post">
                            <?= csrf_field() ?>

                            <!-- USERNAME -->
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text"
                                           name="user"
                                           class="form-control"
                                           value="<?= old('user') ?>"
                                           required>
                                </div>
                            </div>

                            <!-- PASSWORD -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password"
                                       name="pass"
                                       class="form-control"
                                       required>
                            </div>

                            <!-- CAPTCHA ONLINE -->
                             <div class="g-recaptcha" data-sitekey="6LeZQekqAAAAAPiNKQ3qaP5Rr-UrphqwjW894Am2"></div>

                            <!-- CAPTCHA OFFLINE -->
                            <div id="math-captcha" class="mt-3" style="display:none;">
                                <label class="form-label text-center d-block">
                                    Berapakah hasil dari <?= esc($soal_captcha ?? '') ?>?
                                </label>
                                <input type="text"
                                       name="captcha_jawaban"
                                       class="form-control text-center">
                            </div>

                            <input type="hidden" name="is_online" id="is_online" value="1">

                            <!-- BUTTON (SAMA KAYAK TEMPLATE PERTAMA) -->
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" type="submit">
                                    Log in now
                                </button>
                            </div>
                        </form>

                        <hr class="mt-4">

                        <!-- LINKS -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('/register') ?>" class="text-decoration-none">
                                Create new account
                            </a>
                            <a href="<?= base_url('/forgotpass') ?>" class="text-decoration-none">
                                Forgot password?
                            </a>
                        </div>

                        <!-- SOCIAL -->
                        <p class="mt-4 text-center">Or sign in with</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="#" class="btn btn-outline-primary">
                                <img src="<?= base_url('assets/img/google.png') ?>" width="20"> Google
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <img src="<?= base_url('assets/img/feb.png') ?>" width="20"> Facebook
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <img src="<?= base_url('assets/img/twi.png') ?>" width="20"> Twitter
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- JS -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('load', () => {
        const online = navigator.onLine;
        document.getElementById('is_online').value = online ? '1' : '0';

        document.querySelector('.g-recaptcha').style.display = online ? 'flex' : 'none';
        document.getElementById('math-captcha').style.display = online ? 'none' : 'block';
    });
</script>

</body>
</html>
