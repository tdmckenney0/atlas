<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['action' => 'add', $node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['action' => 'edit', $node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['action' => 'view', $node->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['action' => 'view', $node->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['action' => 'delete', $node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $node->name)]]); ?>
    </ul>
<?php $this->end(); ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Edit')]]); ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container box">
    <h1 class="title is-1"><?= __('Edit {0}', $node->name) ?></h1>
    <?= $this->Form->create($node) ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
            echo $this->Form->control('print', ['type' => 'select', 'options' => ['No', 'Yes']]);
            echo $this->Form->control('description');
        ?>
    <div><?= $this->Form->button(__('Save')) ?></div>
    <?= $this->Form->end() ?>
</div>
