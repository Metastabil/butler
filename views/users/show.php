<?php
/**
 * @var array $element
 * @var array $logs
 */
?>

<div class="options-wrapper">
    <a href="<?= base_url('update-user/' . $element['id']) ?>" class="btn btn-icon-update">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <a href="javascript:void(0)" class="btn btn-icon-delete">
        <i class="fa-solid fa-trash-can"></i>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="username">
            <?= LANG->users->attributes->username ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="username" id="username" placeholder="<?= LANG->users->attributes->username ?>" value="<?= $element['username'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <a href="<?= base_url('users') ?>" title="<?= LANG->actions->back ?>" class="btn btn-blue">
            <?= LANG->actions->back ?>
        </a>
    </div>
</form>

<!-- History -->
<h3 class="subtitle"><?= LANG->pages->titles->history ?></h3>

<p class="history">
    <?php foreach ($logs as $l) : ?>
        <?= "{$l['action']} | {$l['username']} | " . format_timestamp($l['created']) ?> <br />
    <?php endforeach ?>
</p>
