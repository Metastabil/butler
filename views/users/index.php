<?php
/**
 * @var array $elements
 */
?>

<a href="<?= base_url('create-user') ?>" title="<?= LANG->actions->create ?>" class="btn btn-blue">
    <?= LANG->actions->create ?>
</a>

<table class="default-table">
    <?php foreach ($elements as $element) : ?>
        <tr onclick="window.location.href='<?= esc(base_url('show-user/' . $element['id'])) ?>'">
            <td><?= $element['username'] ?></td>
        </tr>
    <?php endforeach ?>
</table>