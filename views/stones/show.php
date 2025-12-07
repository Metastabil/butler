<?php
/**
 * @var array $element
 */
?>

<h1 class="title">
    <?= $element['name'] ?>
</h1>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="number">
            <?= LANG->stones->attributes->number ?>
            <span class="required">*</span>
        </label>

        <input type="number" name="number" id="number" placeholder="<?= LANG->stones->attributes->number ?>" value="<?= $element['number'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <label for="rarity">
            <?= LANG->stones->attributes->rarity ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="rarity" id="rarity" placeholder="<?= LANG->stones->attributes->rarity ?>" value="<?= $element['rarity'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <label for="description">
            <?= LANG->stones->attributes->description ?>
            <span class="required">*</span>
        </label>

        <textarea name="description" id="description" placeholder="<?= LANG->stones->attributes->description ?>" disabled><?= $element['description'] ?></textarea>
    </div>
</form>