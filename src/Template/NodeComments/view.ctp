<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Node Comment'), ['action' => 'edit', $nodeComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Node Comment'), ['action' => 'delete', $nodeComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Node Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Node Comments'), ['controller' => 'NodeComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Node Comment'), ['controller' => 'NodeComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Node Comments'), ['controller' => 'NodeComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Node Comment'), ['controller' => 'NodeComments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nodeComments view large-9 medium-8 columns content">
    <h3><?= h($nodeComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $nodeComment->has('user') ? $this->Html->link($nodeComment->user->id, ['controller' => 'Users', 'action' => 'view', $nodeComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Node') ?></th>
            <td><?= $nodeComment->has('node') ? $this->Html->link($nodeComment->node->name, ['controller' => 'Nodes', 'action' => 'view', $nodeComment->node->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Node Comment') ?></th>
            <td><?= $nodeComment->has('parent_node_comment') ? $this->Html->link($nodeComment->parent_node_comment->id, ['controller' => 'NodeComments', 'action' => 'view', $nodeComment->parent_node_comment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($nodeComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($nodeComment->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($nodeComment->rght) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($nodeComment->body)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Node Comments') ?></h4>
        <?php if (!empty($nodeComment->child_node_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Node Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($nodeComment->child_node_comments as $childNodeComments): ?>
            <tr>
                <td><?= h($childNodeComments->id) ?></td>
                <td><?= h($childNodeComments->user_id) ?></td>
                <td><?= h($childNodeComments->node_id) ?></td>
                <td><?= h($childNodeComments->parent_id) ?></td>
                <td><?= h($childNodeComments->lft) ?></td>
                <td><?= h($childNodeComments->rght) ?></td>
                <td><?= h($childNodeComments->body) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NodeComments', 'action' => 'view', $childNodeComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NodeComments', 'action' => 'edit', $childNodeComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NodeComments', 'action' => 'delete', $childNodeComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childNodeComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
