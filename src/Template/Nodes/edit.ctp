<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li class=""><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-clock']) . '&nbsp;' . __('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['escape' => false]) ?></li>
        <li class=""><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-edit']) . '&nbsp;' . __('Edit Node'), ['action' => 'edit', $node->id], ['escape' => false]) ?></li>
        <li class=""><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-pdf']) . '&nbsp;' . __('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['escape' => false, 'download' => 'download']) ?></li>
        <li class=""><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-archive']) . '&nbsp;' . __('Export to Zip'), ['action' => 'view', $node->id, '_ext' => 'zip'], ['escape' => false, 'download' => 'download']) ?></li>
        <li class=""><?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fas fa-trash']) . '&nbsp;' . __('Delete Node'), ['action' => 'delete', $node->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<?php echo $this->cell('Breadcrumb', [$node->id, __('Edit')]); ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container">
    <h1 class="title is-1"><?= __('Edit {0}', $node->name) ?></h1>
    <?= $this->Form->create($node) ?>
        <?php $this->Form->unlockField('parent_id'); ?>
        <?php echo $this->cell('NodePicker', ['parent_id', 'Parent', $node->parent_id, $node]); ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
            echo $this->Form->control('print');
            echo $this->Form->control('description');
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    <div><?= $this->Form->button(__('Save')) ?></div>
    <?= $this->Form->end() ?>
</div>
