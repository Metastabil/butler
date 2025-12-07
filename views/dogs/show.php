<?php
/**
 * @var array $users
 * @var array $element
 * @var string $title
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="javascript:void(0)" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->dogs->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->dogs->attributes->name ?>" value="<?= $element['name'] ?>" disabled />
    </div>

    <div class="input-wrapper">
        <label for="owner">
            <?= LANG->dogs->attributes->owner ?>
            <span class="required">*</span>
        </label>

        <select name="user-id" id="owner" disabled>
            <?php foreach ($users as $u) : ?>
                <option value="<?= $u['id'] ?>" <?= (int)$element['user_id'] === (int)$u['id'] ? 'selected' : '' ?>><?= $u['username'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="input-wrapper">
        <a href="<?= base_url('dogs') ?>" title="<?= LANG->actions->back ?>" class="btn btn-blue">
            <?= LANG->actions->back ?>
        </a>
    </div>
</form>