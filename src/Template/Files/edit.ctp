<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-medical', 'text' => 'New File', 'link' => ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-download', 'text' => 'Download File', 'link' => ['controller' => 'Nodes', 'action' => 'add', $node->id], 'linkOptions' => ['download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit File', 'link' => ['controller' => 'Files', 'action' => 'edit', $file->id, (!empty($node->id) ? $node->id : null)]]); ?>
        <?php if($file->isCompressed()): ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Extract File', 'link' => ['controller' => 'Files', 'action' => 'extract', (!empty($node->id) ? $node->id : null)]]); ?>
        <?php endif; ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete File', 'postLink' => ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $file->name)]]); ?>
    </ul>
<?php $this->end(); ?>

<?php if (!empty($file->nodes)): ?>
    <?php $this->start('nodes'); ?>
        <ul class="menu-list">
            <?php foreach ($file->nodes as $child): ?>
                <?php echo $this->element('menulistitem', [
                    'icon' => 'fas fa-book',
                    'text' => $child->name,
                    'link' => ['controller' => 'nodes', 'action' => 'view', $child->id]
                ]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node, [
    $file->name => ['action' => 'view', $file->id, $node->id ?? null],
    __('Edit')
]]); ?>

<div class="container">
    <div class="box">
        <h1 class="title is-1"><?= h($file->name) ?></h1>
        <?php echo $this->cell('File', [$file]); ?>
    </div>

    <div class="box">
        <?= $this->Form->create($file, ['type' => 'file']) ?>
            <?php echo $this->Form->control('name'); ?>
            <?= $this->Form->submit(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
