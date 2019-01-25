<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Object $object
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Object'), ['action' => 'edit', $object->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Object'), ['action' => 'delete', $object->id], ['confirm' => __('Are you sure you want to delete # {0}?', $object->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Objects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Object'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="objects view large-9 medium-8 columns content">
    <h3><?= h($object->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($object->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($object->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Extension') ?></th>
            <td><?= h($object->file_extension) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mime Type') ?></th>
            <td><?= h($object->mime_type) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Nodes') ?></h4>
        <?php if (!empty($object->nodes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($object->nodes as $nodes): ?>
            <tr>
                <td><?= h($nodes->id) ?></td>
                <td><?= h($nodes->parent_id) ?></td>
                <td><?= h($nodes->name) ?></td>
                <td><?= h($nodes->description) ?></td>
                <td><?= h($nodes->created) ?></td>
                <td><?= h($nodes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Nodes', 'action' => 'view', $nodes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Nodes', 'action' => 'edit', $nodes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Nodes', 'action' => 'delete', $nodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
