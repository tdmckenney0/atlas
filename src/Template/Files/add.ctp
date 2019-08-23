<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('actions'); ?>
        <ul class="menu-list">
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['controller' => 'Nodes', 'action' => 'add', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['controller' => 'Nodes', 'action' => 'edit', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['controller' => 'Nodes', 'action' => 'delete', $node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $node->name)]]); ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb', [!empty($node->id) ? $node->id : null, __('Add File')]); ?>
<div class="container box">
    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <h1><?= __('Add File') ?></h1>
        <?php echo $this->Form->control('file', ['type' => 'file']); ?>
        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
