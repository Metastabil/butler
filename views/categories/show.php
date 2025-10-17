<?php
/**
 * @var array $element
 * @var string $title
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<div class="action-container">
    <a href="<?= base_url('update-category/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="javascript:deleteCategory(<?= $element['id'] ?>)" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->categories->attributes->name ?>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->categories->attributes->name ?>" value="<?= $element['name'] ?>" disabled />
    </div>
</form>

<script>
    function deleteCategory(id) {
        const confirmation = confirm('Willst du die Kategorie wirklich löschen?');

        if (confirmation) {
            window.location.href = `${base_url}delete-category/${id}`;
        }
    }
</script>