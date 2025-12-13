<?php
/**
 * @var array $medical_dog_data
 * @var array $element
 * @var string $title
 * @var array $users
 */
?>

<h1 class="title">
    <?= $element['name'] ?>
</h1>

<h3 class="subtitle">
    <?= LANG->dogs->titles->medical_dog_data ?>
    <a href="<?= base_url('create-medical-dog-data/' . $element['id']) ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue btn-create">
        <i class="fa-solid fa-plus"></i>
    </a>
</h3>

<div class="medical-dog-data-container">
    <ul class="default-list">
        <?php foreach ($medical_dog_data as $mda) : ?>
            <li>
                <?= $mda['name'] ?>
                <?= !empty($mda['date']) ? '(' . format_timestamp($mda['date']) . ')' : '' ?>
            </li>
        <?php endforeach ?>
    </ul>
</div>