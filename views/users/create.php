<?php
/**
 * @var string $title
 */
?>

<h1 class="title"><?= $title ?></h1>

<form action="<?= base_url('create-user') ?>" method="post" class="default-form">
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
        <label for="administrator">
            <?= LANG->users->attributes->administrator ?>
        </label>

        <select name="administrator" id="administrator">
            <option value="0"><?= LANG->general->no ?></option>
            <option value="1"><?= LANG->general->yes ?></option>
        </select>
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('users') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>