<?php
/**
 * @var array $element
 * @var string $title
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="<?= base_url('update-category/' . $element['id']) ?>" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->categories->attributes->name ?>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->categories->attributes->name ?>" value="<?= $element['name'] ?>" required />
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('categories') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>