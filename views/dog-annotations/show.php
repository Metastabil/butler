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
    <a href="<?= base_url('update-dog-annotation/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="javascript:deleteDogAnnotation(<?= $element['id'] ?>)" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">

</form>

<script>
    function deleteDogAnnotation(id) {
        const confirmation = confirm('Willst du die Hundeanmerkung wirklich löschen?');

        if (confirmation) {
            window.location.href = `${base_url}delete-dog-annotation/${id}`;
        }
    }
</script>