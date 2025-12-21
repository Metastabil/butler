<?php
/**
 * @var string $title
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="<?= base_url('create-module') ?>" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->modules->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->modules->attributes->name ?>" required />
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('dogs') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>
