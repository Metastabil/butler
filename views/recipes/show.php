<?php
/**
 * @var array $element
 * @var string $title
 */
?>

<div style="background-image: url('<?= $element['image'] ?>');" class="image"></div>

<div class="action-container">
    <a href="<?= base_url('update-recipe/' . $element['id']) ?>" class="btn btn-blue">
        <i class="fa-solid fa-pen-to-square"></i>
        <?= LANG->actions->update ?>
    </a>

    <a href="<?= base_url('update-recipe/' . $element['id']) ?>" class="btn btn-red">
        <i class="fa-solid fa-trash-can"></i>
        <?= LANG->actions->delete ?>
    </a>
</div>

<h1 class="title"><?= $element['name'] ?></h1>

<h3 class="subtitle"><?= LANG->recipes->titles->ingredients ?></h3>
<span class="ingredients">
    <?= $element['ingredients'] ?>
</span>

<h3 class="subtitle"><?= LANG->recipes->titles->description ?></h3>
<span class="description">
    <?= $element['description'] ?>
</span>