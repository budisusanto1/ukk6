<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($webDetail['title'] ?? 'Login'); ?></title>
    <link rel="icon" type="image/png"
        href="<?= base_url('images/' . ($webDetail['logo'] ?? 'default-logo.png')); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #A41F13, #85231b, #85150b);
        }

        .main {
            width: 350px;
            height: 520px;
            background: #A41F13;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }

        /* ===== COMMON ===== */
        .title-btn {
            color: #fff;
            font-size: 2em;
            display: flex;
            justify-content: center;
            margin: 20px 0 30px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        input {
            width: 60%;
            background: #e0dede;
            display: block;
            margin: 20px auto;
            padding: 12px;
            border: none;
            outline: none;
            border-radius: 5px;
        }

        button {
            width: 60%;
            height: 40px;
            margin: 25px auto;
            display: block;
            color: #fff;
            background: #A41F13;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #bd281c;
        }

        .form-extras {
            width: 80%;
            margin: 0 auto;
            font-size: 0.85em;
            display: flex;
            justify-content: space-between;
        }

        .form-extras a {
            color: #A41F13;
            text-decoration: none;
        }

        .error {
            background: #ffdddd;
            color: #900;
            padding: 8px;
            width: 80%;
            margin: 0 auto 10px;
            border-radius: 5px;
            font-size: .85em;
            text-align: center;
        }

        /* ===== GUEST ===== */
        .guest {
            padding-top: -5px;
        }

        /* ===== LOGIN ===== */
        .login {
            height: 480px;
            background: #eee;
            border-radius: 60% / 10%;
            margin-top: 20px;
            padding-top: 10px;
        }

        .login .title-btn {
            color: #A41F13;
            margin-top: 20px;
        }

        .g-recaptcha {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="main">

        <!-- ===== GUEST ===== -->
        <div class="guest">
            <a href="<?= base_url('/') ?>" class="title-btn">
                Login
            </a>
        </div>

        <!-- ===== LOGIN ===== -->
        <div class="login">
            <form action="<?= base_url('/register') ?>" method="post">
                <?= csrf_field() ?>

                <span class="title-btn">Sign In</span>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <input type="text" name="user" placeholder="Username"
                    value="<?= old('user') ?>" required>

                <input type="password" name="pass" placeholder="Password" required>

                <div class="form-extras">
                    <a href="<?= base_url('/forgotpass') ?>">Forgot password?</a>
                </div>

                <!-- CAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LeZQekqAAAAAPiNKQ3qaP5Rr-UrphqwjW894Am2"></div>

                <div id="math-captcha" style="display:none;">
                    <label class="form-extras">
                        Berapakah hasil dari <?= esc($soal_captcha ?? '') ?>?
                    </label>
                    <input type="text" name="captcha_jawaban">
                </div>

                <input type="hidden" name="is_online" id="is_online" value="1">

                <button type="submit">Login</button>
            </form>
        </div>

    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
