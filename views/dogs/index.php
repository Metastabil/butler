<?php
/**
 * @var array $elements
 * @var string $title
 * @var string $search
 */
?>

<h1 class="title">
    <?= $title ?>
</h1>

<a href="<?= base_url('create-dog') ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue btn-create">
    <?= LANG->actions->create ?>
</a>

<div id="search-container">
    <form action="<?= base_url('dogs') ?>" method="post" id="search-form">
        <input type="search" name="search" id="search" placeholder="<?= LANG->actions->search ?>" value="<?= $search ?>" />
        <button type="submit" title="<?= LANG->actions->search ?>" class="btn btn-blue">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a href="<?= base_url('dogs') ?>" title="<?= LANG->actions->reload ?>" class="btn btn-blue">
            <i class="fa-solid fa-rotate"></i>
        </a>
    </form>
</div>

<table class="default-table">
    <?php foreach ($elements as $element) : ?>
        <tr onclick="window.location.href='<?= esc(base_url('show-dog/' . $element['id'])) ?>'">
            <td>
                <span class="table-icon-wrapper">
                    <i class="fa-solid fa-paw"></i>
                </span>
                <?= $element['name'] ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>