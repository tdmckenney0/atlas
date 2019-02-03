<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<ul class="nav nav-pills">
    <li class="nav-item"><?= $this->Html->link(__('List Nodes'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New Node</a>
    </li>

    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [$parent_id, __('Add')]); ?>

<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __('Add Node') ?></legend>
        <?php
            echo $this->Form->control('parent_id', ['options' => $parentNodes, 'value' => $parent_id, 'empty' => " - Top Level - "]);
            echo $this->Form->control('name');
            echo $this->Form->control('description', ['required' => false]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
