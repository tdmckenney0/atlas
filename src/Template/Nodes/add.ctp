<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Nodes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Node'), ['controller' => 'Nodes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __('Add Node') ?></legend>
        <?php
            echo $this->Form->control('parent_id', ['options' => $parentNodes]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
