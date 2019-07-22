<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment[]|\Cake\Collection\CollectionInterface $nodeComments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Node Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nodeComments index large-9 medium-8 columns content">
    <h3><?= __('Node Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('node_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nodeComments as $nodeComment): ?>
            <tr>
                <td><?= $this->Number->format($nodeComment->id) ?></td>
                <td><?= $nodeComment->has('user') ? $this->Html->link($nodeComment->user->id, ['controller' => 'Users', 'action' => 'view', $nodeComment->user->id]) : '' ?></td>
                <td><?= $nodeComment->has('node') ? $this->Html->link($nodeComment->node->name, ['controller' => 'Nodes', 'action' => 'view', $nodeComment->node->id]) : '' ?></td>
                <td><?= $nodeComment->has('parent_node_comment') ? $this->Html->link($nodeComment->parent_node_comment->id, ['controller' => 'NodeComments', 'action' => 'view', $nodeComment->parent_node_comment->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $nodeComment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nodeComment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nodeComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeComment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination-list">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
