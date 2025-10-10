<?php
/**
 * @var string $title
 */
?>

<!DOCTYPE HTML>
<html lang="de">
    <head>
        <title><?= $title . ' | ' . LANG->project ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>" />
        <script src="https://kit.fontawesome.com/cba80a8d38.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="login-container">
            <h1 class="title">
                <?= $title ?>
                <span class="dark-blue"> | <?=  LANG->project ?></span>
            </h1>

            <form action="<?= base_url('login') ?>" method="post" id="login-form">
                <div class="input-wrapper">
                    <label for="username">
                        <?= LANG->users->attributes->username ?>
                        <span class="required">*</span>
                    </label>

                    <input type="text" name="username" id="username" placeholder="<?= LANG->users->attributes->username ?>" required />
                </div>

                <div class="input-wrapper">
                    <label for="password">
                        <?= LANG->users->attributes->password ?>
                        <span class="required">*</span>
                    </label>

                    <input type="password" name="password" id="password" placeholder="<?= LANG->users->attributes->password ?>" required />
                </div>

                <div class="input-wrapper">
                    <button type="submit" title="<?= LANG->actions->login ?>" class="btn btn-blue">
                        <?= LANG->actions->login ?>
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>