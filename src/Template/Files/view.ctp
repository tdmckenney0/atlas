<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active dont-think" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('Preview'); ?></a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Download File'), ['controller' => 'files', 'action' => 'get', $file->id], ['class' => 'flex-lg-fill text-sm-center nav-link dont-think', 'download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Edit File'), ['controller' => 'Files', 'action' => 'edit', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <?php if($file->isCompressed()): ?>
        <li class="nav-item"><?= $this->Html->link(__('Extract File'), ['controller' => 'Files', 'action' => 'extract', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <?php endif; ?>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'flex-lg-fill text-sm-center nav-link border border-danger text-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [ (!empty($node->id) ? $node->id : null), $file->name ]); ?>

<div class="file">
    <h1 class="overflow-hidden"><?= h($file->name) ?></h1>

    <?php echo $this->cell('File', [$file->id]); ?>

    <?php if (!empty($file->nodes)): ?>
        <h2><?php echo __('Nodes'); ?></h2>
        <div class="list-group">
            <?php foreach ($file->nodes as $parent): ?>
                <?php echo $this->element('browser_item', [
                    'url' => ['controller' => 'Nodes', 'action' => 'view', $parent->id],
                    'title' => $parent->name,
                    'body' => substr($parent->description, 0, 200),
                    'icon' => 'fas fa-folder',
                    'class' => ""
                ]); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
