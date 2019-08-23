<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li><?= $this->Html->link(__('Download File'), ['controller' => 'files', 'action' => 'get', $file->id], ['class' => ' dont-think', 'download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]) ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['controller' => 'Files', 'action' => 'edit', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => '']) ?></li>
        <?php if($file->isCompressed()): ?>
            <li><?= $this->Html->link(__('Extract File'), ['controller' => 'Files', 'action' => 'extract', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => '']) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => '']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)], ['class' => '']) ?></li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => ' border border-danger text-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<?php $this->start('nodes'); ?>
    <ul class="menu-list">
        <?php if (!empty($file->nodes)): ?>
            <?php foreach ($file->nodes as $child): ?>
                <li><a href="<?php echo $this->Url->build(['controller' => 'nodes', 'action' => 'view', $child->id]); ?>"><i class="fas fa-book"></i>&nbsp;<?php echo h($child->name); ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php $this->end(); ?>

<?php echo $this->cell('Breadcrumb', [ (!empty($node->id) ? $node->id : null), $file->name ]); ?>

<div class="content">
    <h1 class="title is-1"><?= h($file->name) ?></h1>
    <?php echo $this->cell('File', [$file->id]); ?>
</div>
