<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $parent
 */
?>
<?php if(!empty($parent)): ?>
    <?php $this->start('actions'); ?>
        <ul class="menu-list">
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['action' => 'add', $parent->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $parent->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $parent->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['action' => 'edit', $parent->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['action' => 'view', $parent->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['action' => 'view', $parent->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['action' => 'delete', $parent->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $parent->name)]]); ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$parent, [__('Add')]]); ?>

<div class="container box">
    <?= $this->Form->create($node) ?>

        <div class="overflow-hidden">
            <h1 class="overflow-hidden"><?= __('Add Node') ?></h1>
        </div>

        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
            echo $this->Form->control('print', ['type' => 'select', 'options' => ['No', 'Yes']]);
            echo $this->Form->control('description');
        ?>

        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
