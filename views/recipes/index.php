<?php
/**
 * @var string $title
 * @var string $search
 * @var array $elements
 */
?>

<h1 class="title"><?= $title ?></h1>

<a href="<?= base_url('create-recipe') ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue btn-create">
    <?= LANG->actions->create ?>
</a>

<div id="search-container">
    <form action="<?= base_url('recipes') ?>" method="post" id="search-form">
        <input type="search" name="search" id="search" placeholder="<?= LANG->actions->search ?>" value="<?= $search ?>" />
        <button type="submit" title="<?= LANG->actions->search ?>" class="btn btn-blue">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a href="<?= base_url('recipes') ?>" title="<?= LANG->actions->reload ?>" class="btn btn-blue">
            <i class="fa-solid fa-rotate"></i>
        </a>
    </form>
</div>

<div class="recipes-container">
    <?php foreach ($elements as $e) : ?>
        <div style="background-image: url('<?= $e['image'] ?>');" class="image" onclick="window.location.href='<?= esc(base_url('show-recipe/' . $e['id'])) ?>'">
            <h1 class="recipe-title"><?= $e['name'] ?></h1>
        </div>
    <?php endforeach ?>
</div>