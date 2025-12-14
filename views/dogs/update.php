<?php
/**
 * @var array $element
 * @var string $title
 * @var array $users
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<form action="<?= base_url('update-dog/' . $element['id']) ?>" method="post" class="default-form">
    <div class="input-wrapper">
        <label for="name">
            <?= LANG->dogs->attributes->name ?>
            <span class="required">*</span>
        </label>

        <input type="text" name="name" id="name" placeholder="<?= LANG->dogs->attributes->name ?>" value="<?= $element['name'] ?>" required />
    </div>

    <div class="input-wrapper">
        <label for="owner">
            <?= LANG->dogs->attributes->owner ?>
            <span class="required">*</span>
        </label>

        <select name="user" id="owner" required>
            <?php foreach ($users as $u) : ?>
                <option value="<?= $u['id'] ?>" <?= (int)$element['user_id'] === (int)$u['id'] ? 'selected' : '' ?>><?= $u['username'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="input-wrapper">
        <button type="submit" title="<?= LANG->actions->save ?>" class="btn btn-blue">
            <?= LANG->actions->save ?>
        </button>

        <a href="<?= base_url('dogs') ?>" title="<?= LANG->actions->cancel ?>" class="btn btn-red">
            <?= LANG->actions->cancel ?>
        </a>
    </div>
</form>