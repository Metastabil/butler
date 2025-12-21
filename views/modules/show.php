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
    <a href="<?= base_url('update-module/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="javascript:deleteModule(<?= $element['id'] ?>)" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->modules->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" value="<?= $element['name'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <a href="<?= base_url('modules') ?>" title="<?= LANG->actions->back ?>" class="btn btn-blue">
            <?= LANG->actions->back ?>
        </a>
    </div>
</form>

<script>
    function deleteModule(id) {
        const confirmation = confirm('Willst du das Modul wirklich löschen?');

        if (confirmation) {
            window.location.href = `${base_url}delete-module/${id}`;
        }
    }
</script>