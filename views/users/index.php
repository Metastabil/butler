<?php
/**
 * @var array $elements
 * @var string $title
 */
?>

<h1 class="title"><?= $title ?></h1>

<a href="<?= base_url('create-user') ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue btn-create">
    <?= LANG->actions->create ?>
</a>

<table class="default-table">
    <?php foreach ($elements as $element) : ?>
        <tr onclick="window.location.href='<?= esc(base_url('show-user/' . $element['id'])) ?>'">
            <td class="icon">
                <i class="fa-solid fa-user"></i>
            </td>
            <td>
                <?= $element['username'] ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>