<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nodeComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nodeComment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Node Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parent Node Comments'), ['controller' => 'NodeComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Node Comment'), ['controller' => 'NodeComments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nodeComments form large-9 medium-8 columns content">
    <?= $this->Form->create($nodeComment) ?>
    <fieldset>
        <legend><?= __('Edit Node Comment') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('node_id', ['options' => $nodes]);
            echo $this->Form->control('parent_id', ['options' => $parentNodeComments, 'empty' => true]);
            echo $this->Form->control('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
