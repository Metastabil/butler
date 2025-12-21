<?php
/**
 * @var array $dog_annotation_types
 * @var string $title
 * @var array $dogs
 * @var int $dog_id
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="<?= base_url('create-dog-annotation') ?>" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="dog">
            <?= LANG->dog_annotations->attributes->dog ?>
            <span class="required">*</span>
        </label>

        <select name="dog" required>
            <?php foreach ($dogs as $d) : ?>
                <option value="<?= $d['id'] ?>" <?= $dog_id > 0 && $dog_id === $d['id'] ? 'selected' : '' ?>><?= $d['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="input-wrapper">
        <label for="dog-annotation-type">
            <?= LANG->dog_annotations->attributes->dog_annotation_type ?>
            <span class="required">*</span>
        </label>

        <select name="dog-annotation-type" required>
            <?php foreach ($dog_annotation_types as $dat) : ?>
                <option value="<?= $dat['id'] ?>"><?= $dat['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="input-wrapper">
        <label for="text">
            <?= LANG->dog_annotations->attributes->text ?>
            <span class="required">*</span>
        </label>

        <textarea name="text" placeholder="<?= LANG->dog_annotations->attributes->text ?>" required></textarea>
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('show-dog/' . $dog_id) ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>