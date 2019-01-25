<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Objects'), ['controller' => 'Objects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Object'), ['controller' => 'Objects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nodes view large-9 medium-8 columns content">
    <h3><?= h($node->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Parent Node') ?></th>
            <td><?= $node->has('parent_node') ? $this->Html->link($node->parent_node->name, ['controller' => 'Nodes', 'action' => 'view', $node->parent_node->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($node->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($node->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($node->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($node->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($node->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Objects') ?></h4>
        <?php if (!empty($node->objects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('File Extension') ?></th>
                <th scope="col"><?= __('Mime Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($node->objects as $objects): ?>
            <tr>
                <td><?= h($objects->id) ?></td>
                <td><?= h($objects->name) ?></td>
                <td><?= h($objects->file_extension) ?></td>
                <td><?= h($objects->mime_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Objects', 'action' => 'view', $objects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Objects', 'action' => 'edit', $objects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Objects', 'action' => 'delete', $objects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $objects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Nodes') ?></h4>
        <?php if (!empty($node->child_nodes)): ?>
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
            <?php foreach ($node->child_nodes as $childNodes): ?>
            <tr>
                <td><?= h($childNodes->id) ?></td>
                <td><?= h($childNodes->parent_id) ?></td>
                <td><?= h($childNodes->name) ?></td>
                <td><?= h($childNodes->description) ?></td>
                <td><?= h($childNodes->created) ?></td>
                <td><?= h($childNodes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Nodes', 'action' => 'view', $childNodes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Nodes', 'action' => 'edit', $childNodes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Nodes', 'action' => 'delete', $childNodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childNodes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
