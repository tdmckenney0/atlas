<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<ul class="nav nav-pills flex-column flex-sm-row">
    <li class="nav-item"><?= $this->Html->link(__('Overview'), ['action' => 'view', $node->id], ['class' => 'flex-sm-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Add Node'), ['controller' => 'Nodes', 'action' => 'add'], ['class' => 'flex-sm-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item">
        <a class="flex-sm-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit Node</a>
    </li>
</ul>

<hr />
<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __('Add Node') ?></legend>
        <?php
            echo $this->Form->control('parent_id', ['options' => $parentNodes, 'empty' => " - Top Level - "]);
            echo $this->Form->control('name');
            echo $this->Form->control('description', ['required' => false]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
