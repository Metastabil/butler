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
    <a href="<?= base_url('update-dog-annotation-type/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="javascript:deleteDogAnnotationType(<?= $element['id'] ?>)" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->dog_annotation_types->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->dog_annotation_types->attributes->name ?>" value="<?= $element['name'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <a href="<?= base_url('dog-annotation-types') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-blue">
            <?= LANG->actions->back ?>
        </a>
    </div>
</form>

<script>
    function deleteDogAnnotationType(id) {
        const confirmation = confirm('Willst du den Hunde-Anmerkungstyp wirklich löschen?');

        if (confirmation) {
            window.location.href = `${base_url}delete-dog-annotation-type/${id}`;
        }
    }
</script>