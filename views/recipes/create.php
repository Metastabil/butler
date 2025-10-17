<?php
/**
 * @var array $categories
 * @var string $title
 */
?>

<h1 class="title"><?= $title ?></h1>

<form action="<?= base_url('create-recipe') ?>" method="post" enctype="multipart/form-data" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->recipes->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->recipes->attributes->name ?>" required />
    </div>

    <div class="input-wrapper">
        <label for="image">
            <?= LANG->recipes->attributes->image ?>
        </label>

        <input type="file" name="image" id="image" />
    </div>

    <div class="input-wrapper">
        <label for="ingredients">
            <?= LANG->recipes->attributes->ingredients ?>
            <span class="required">*</span>
        </label>

        <textarea name="ingredients" id="ingredients" placeholder="<?= LANG->recipes->attributes->ingredients ?>" class="text-editor"></textarea>
    </div>

    <div class="input-wrapper">
        <label for="description">
            <?= LANG->recipes->attributes->description ?>
            <span class="required">*</span>
        </label>

        <textarea name="description" id="description" placeholder="<?= LANG->recipes->attributes->description ?>" class="text-editor"></textarea>
    </div>

    <div class="input-wrapper categories-wrapper">
        <?php foreach ($categories as $c) : ?>
            <div class="category-item">
                <input type="checkbox" name="categories[]" id="<?= $c['name'] ?>" value="<?= $c['id'] ?>" />
                <label for="<?= $c['name'] ?>">
                    <?= $c['name'] ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>

    <div class="input-wrapper">
        <button title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('recipes') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>

<script>
    $('.text-editor').trumbowyg({
        btns: [
            ['bold', 'italic', 'underline'],
            ['unorderedList', 'orderedList']
        ],
        lang: 'de'
    });

    $('.default-form').on('submit', function(e) {
        e.preventDefault();

        const fileInput = $('#image')[0];
        const maxSize = 2 * 1024 * 1024;

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            if (file.size > maxSize) {
                alert('Das Bild ist zu groß');

                return;
            }
        }

        this.submit();
    });
</script>