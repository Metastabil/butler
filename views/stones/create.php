<?php
/**
 * @var string $title
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="<?= base_url('create-stone') ?>" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="number">
            <?= LANG->stones->attributes->number ?>
            <span class="required">*</span>
        </label>

        <input type="number" name="number" id="number" placeholder="<?= LANG->stones->attributes->number ?>" required />
    </div>

    <div class="input-wrapper">
        <label for="name">
            <?= LANG->stones->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->stones->attributes->name ?>" required />
    </div>

    <div class="input-wrapper">
        <label for="rarity">
            <?= LANG->stones->attributes->rarity ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="rarity" id="rarity" placeholder="<?= LANG->stones->attributes->rarity ?>" required />
    </div>

    <div class="input-wrapper">
        <label for="description">
            <?= LANG->stones->attributes->description ?>
            <span class="required">*</span>
        </label>

        <textarea name="description" id="description" placeholder="<?= LANG->stones->attributes->description ?>" required></textarea>
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('stones') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>

<script>
    $(() => {
        const randomNumber = Math.floor(1000 + Math.random() * 9000);

        $('#number').val(randomNumber);
    });
</script>