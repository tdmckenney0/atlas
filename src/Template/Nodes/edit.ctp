<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<ul class="nav nav-pills flex-column flex-lg-row">

    <li class="nav-item"><?= $this->Html->link(__('Overview'), ['action' => 'view', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit Node</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Add Node'), ['controller' => 'Nodes', 'action' => 'add'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [$node->id, __('Edit')]); ?>

<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __('Edit Node') ?></legend>
        <?php $this->Form->unlockField('parent_id'); ?>
        <?php echo $this->cell('NodePicker', ['parent_id', 'Parent', $node->parent_id, $node]); ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <div><?= $this->Form->button(__('Save')) ?></div>
    <?= $this->Form->end() ?>
</div>
