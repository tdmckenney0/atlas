<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Object $object
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $object->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $object->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Objects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="objects form large-9 medium-8 columns content">
    <?= $this->Form->create($object) ?>
    <fieldset>
        <legend><?= __('Edit Object') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('file_extension');
            echo $this->Form->control('mime_type');
            echo $this->Form->control('nodes._ids', ['options' => $nodes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
