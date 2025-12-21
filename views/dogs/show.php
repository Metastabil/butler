<?php
/**
 * @var array $dog_annotation_types
 * @var array $dog_annotations
 * @var array $element
 * @var string $title
 * @var array $users
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<div class="action-container">
    <a href="<?= base_url('update-dog/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="javascript:deleteDog(<?= $element['id'] ?>)" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->dogs->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" value="<?= $element['name'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <label for="owner">
            <?= LANG->dogs->attributes->owner ?>
            <span class="required">*</span>
        </label>

        <select name="user" id="owner" disabled>
            <?php foreach ($users as $u) : ?>
                <option value="<?= $u['id'] ?>" <?= (int)$element['user_id'] === (int)$u['id'] ? 'selected' : '' ?>><?= $u['username'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
</form>

<?php foreach ($dog_annotation_types as $dat) : ?>
    <hr />

    <h3 class="subtitle">
        <a href="<?= base_url('create-dog-annotation/' . $element['id']) ?>" class="btn btn-blue">
            <i class="fa-solid fa-plus"></i>
        </a>

        <?= $dat['name'] ?>
    </h3>

    <?php foreach ($dog_annotations as $da) : ?>
        <?php if ($dat['id'] === $da['dog_annotation_type_id']) : ?>
            <?= $da['text'] ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endforeach ?>

<script>
    function deleteDog(id) {
        const confirmation = confirm('Willst du den Hund wirklich löschen?');

        if (confirmation) {
            window.location.href = `${base_url}delete-dog/${id}`;
        }
    }
</script>