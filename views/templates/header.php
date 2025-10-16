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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/ui/trumbowyg.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/application.css') ?>" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/trumbowyg.min.js"></script>
        <script src="https://kit.fontawesome.com/cba80a8d38.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/js/navigation.js') ?>"></script>
        <script>
            const base_url = '<?= base_url() ?>';
        </script>
    </head>
    <body>
        <header>
            <a href="javascript:toggleNavigation()" id="nav-bars">
                <i class="fa-solid fa-bars"></i>
            </a>

            <nav>
                <div class="nav-wrapper">
                    <a href="<?= base_url('recipes') ?>" title="<?= LANG->navigation->recipes ?>">
                    <span class="nav-icon">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </span>
                        <?= LANG->navigation->recipes ?>
                    </a>
                </div>

                <div class="nav-wrapper">
                    <a href="<?= base_url('categories') ?>" title="<?= LANG->navigation->categories ?>">
                    <span class="nav-icon">
                        <i class="fa-solid fa-tags"></i>
                    </span>
                        <?= LANG->navigation->categories ?>
                    </a>
                </div>

                <?php if (is_administrator()) : ?>
                    <div class="nav-wrapper">
                        <a href="<?= base_url('users') ?>" title="<?= LANG->navigation->users ?>">
                        <span class="nav-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                            <?= LANG->navigation->users ?>
                        </a>
                    </div>
                <?php endif ?>

                <div class="nav-wrapper">
                    <a href="<?= base_url('logout') ?>" title="<?= LANG->actions->logout ?>" class="logout">
                        <span class="nav-icon">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        <?= LANG->actions->logout ?>
                    </a>
                </div>
            </nav>
        </header>
        <main>