<?php
/**
 * @var string $title
 * @var array $elements
 */
?>

<h1 class="title"><?= $title ?></h1>

<a href="<?= base_url('create-recipe') ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue btn-create">
    <?= LANG->actions->create ?>
</a>

<table class="default-table">
    <?php foreach ($elements as $element) : ?>
        <tr onclick="window.location.href='<?= esc(base_url('show-recipe/' . $element['id'])) ?>'">
            <td class="icon">
                <i class="fa-solid fa-table-list"></i>
            </td>
            <td>
                <?= $element['name'] ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>