<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item"><?= $this->Html->link(__('List Nodes'), ['action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New Node</a>
    </li>

    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [$parent_id, __('Add')]); ?>



<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>

        <div class="overflow-hidden">
            <h1 class="overflow-hidden"><?= __('Add Node') ?></h1>
        </div>

        <?php $this->Form->unlockField('parent_id'); ?>
        <?php echo $this->cell('NodePicker', [null, ['label' => 'Parent', 'name' => 'parent_id', 'value' => $parent_id]]); ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description', ['required' => false]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>

        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
