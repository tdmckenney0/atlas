<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List Nodes</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('List Objects'), ['controller' => 'Objects', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New Object'), ['controller' => 'Objects', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
</ul>

<div class="nodes index large-9 medium-8 columns content">
    <h3><?= __('Nodes') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nodes as $node): ?>
            <tr>
                <td><?= $this->Number->format($node->id) ?></td>
                <td><?= $node->has('parent_node') ? $this->Html->link($node->parent_node->name, ['controller' => 'Nodes', 'action' => 'view', $node->parent_node->id]) : '' ?></td>
                <td><?= h($node->name) ?></td>
                <td><?= h($node->created) ?></td>
                <td><?= h($node->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $node->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $node->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
