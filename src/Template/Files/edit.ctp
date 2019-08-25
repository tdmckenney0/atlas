<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li><?= $this->Html->link(__('Preview'), ['controller' => 'Files', 'action' => 'view', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => '']) ?></li>
        <li><?= $this->Html->link(__('Download File'), ['controller' => 'files', 'action' => 'get', $file->id], ['class' => ' dont-think', 'download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]) ?></li>
        <li>
            <a class=" active dont-think" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('Edit File'); ?></a>
        </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => '']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)], ['class' => '']) ?></li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => ' border border-danger text-danger']) ?></li>
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
    <div class="overflow-hidden">
        <h1 class="overflow-hidden"><?= __('Edit {0}', $file->name) ?></h1>
    </div>

    <?php echo $this->cell('File', [$file->id]); ?>

    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <?php echo $this->Form->control('name'); ?>
        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
