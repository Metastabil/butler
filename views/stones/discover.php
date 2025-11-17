<?php
/**
 * @var string $title
 */
?>

<h1 class="title"><?= $title ?></h1>

<form action="<?= base_url('adventskalender') ?>" method="post" class="advent-calendar-form">
    <div class="input-wrapper">
        <label for="number">
            <?= LANG->stones->attributes->number ?>
            <span class="required">*</span>
        </label>

        <input type="number" name="number" id="number" placeholder="<?= LANG->stones->attributes->number ?>" required />
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->send ?>" class="btn btn-blue">
            <?= LANG->actions->send ?>
        </button>
    </div>
</form>