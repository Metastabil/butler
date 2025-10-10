<?php
/**
 * @var array $element
 */
?>

<div style="background-image: url('<?= $element['image'] ?>');" class="image"></div>

<h1 class="title"><?= $element['name'] ?></h1>

<h3 class="subtitle"><?= LANG->recipes->titles->ingredients ?></h3>
<span class="ingredients">
    <?= $element['ingredients'] ?>
</span>

<h3 class="subtitle"><?= LANG->recipes->titles->description ?></h3>
<span class="description">
    <?= $element['description'] ?>
</span>