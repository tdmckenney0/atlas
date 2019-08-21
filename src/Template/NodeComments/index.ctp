<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment[]|\Cake\Collection\CollectionInterface $nodeComments
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-folder"></i>
                </span>&nbsp;<?php echo __('List Nodes'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-file-alt"></i>
                </span>&nbsp;<?php echo __('List Files'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-user"></i>
                </span>&nbsp;<?php echo __('List Users'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeRevisions', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-clock"></i>
                </span>&nbsp;<?php echo __('List Revisions'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-comments"></i>
                </span>&nbsp;<?php echo __('List Comments'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<div class="container-fluid">
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
    <?php echo $this->element('pager'); ?>
</div>
