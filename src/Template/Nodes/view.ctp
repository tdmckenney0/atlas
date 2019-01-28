<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<div class="nodes view large-9 medium-8 columns content">

    <?php if($node->has('parent_node')): ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?= $this->Html->link($node->parent_node->name, ['controller' => 'Nodes', 'action' => 'view', $node->parent_node->id]) ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?= h($node->name) ?></li>
            </ol>
        </nav>
    <?php endif; ?>

    <h1 class="display-3"><?= h($node->name) ?></h1>

    <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
    <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>

    <div class="text-justify">
        <?= $this->Text->autoParagraph(h($node->description)); ?>
    </div>

    <nav class="nav nav-pills nav-fill bg-light rounded">
        <?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id], ['class' => 'nav-item btn btn-warning m-2']) ?>
        <?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'nav-item btn btn-outline-primary m-2']) ?>
        <?= $this->Html->link(__('New Child Node'), ['controller' => 'Nodes', 'action' => 'add'], ['class' => 'nav-item btn btn-outline-secondary m-2']) ?>
        <?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'nav-item btn btn-outline-secondary m-2']) ?>
        <?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'nav-item btn btn-danger m-2']) ?>
    </nav>

    <div class="related">
        <h4><?= __('Attachments') ?></h4>
        <?php if (!empty($node->files)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-sm table-striped table-hover">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($node->files as $files): ?>
            <tr>
                <td><?= h($files->name) ?></td>
                <td class="btn-group">
                    <?= $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $files->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $files->id], ['class' => 'btn btn-warning']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ['confirm' => __('Are you sure you want to delete # {0}?', $files->id), 'class' => 'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Nodes') ?></h4>
        <?php if (!empty($node->child_nodes)): ?>
        <table cellpadding="0" cellspacing="0"  class="table table-sm table-striped table-hover">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($node->child_nodes as $childNodes): ?>
            <tr>
                <td><?= h($childNodes->name) ?></td>
                <td class="btn-group">
                    <?= $this->Html->link(__('View'), ['controller' => 'Nodes', 'action' => 'view', $childNodes->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Nodes', 'action' => 'edit', $childNodes->id], ['class' => 'btn btn-warning']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Nodes', 'action' => 'delete', $childNodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childNodes->id), 'class' => 'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>

</div>
