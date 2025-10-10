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
    </head>
    <body>
        <header>
            <nav>
                <a href="<?= base_url('recipes') ?>" title="<?= LANG->navigation->recipes ?>" class="btn">
                    <?= LANG->navigation->recipes ?>
                </a>

                <a href="<?= base_url('users') ?>" title="<?= LANG->navigation->users ?>" class="btn">
                    <?= LANG->navigation->users ?>
                </a>

                <a href="<?= base_url('logout') ?>" title="<?= LANG->actions->logout ?>" class="btn logout">
                    <?= LANG->actions->logout ?>
                </a>
            </nav>
        </header>
        <main>
            <h1 class="title"><?= $title ?></h1>