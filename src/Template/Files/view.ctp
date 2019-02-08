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
    <li class="nav-item"><?= $this->Html->link(__('Edit File'), ['controller' => 'Files', 'action' => 'edit', $file->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'flex-lg-fill text-sm-center nav-link border border-danger text-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [null, $file->name]); ?>

<div class="file">
    <h1 class="overflow-hidden"><?= h($file->name) ?></h1>

    <?php echo $this->cell('File', [$file->id]); ?>

    <?php if (!empty($file->nodes)): ?>
        <h2><?php echo __('Nodes'); ?></h2>
        <div class="card">
            <?php foreach ($file->nodes as $node): ?>
                <div class="media p-3 border-bottom">
                    <i class="mr-3 fas fa-folder " style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body overflow-hidden">
                        <h5 class="mt-0"><?= $this->Html->link($node->name, ['controller' => 'Nodes', 'action' => 'view', $node->id]) ?></h5>
                        <div class="text-muted"><?php echo h(substr($node->description, 0, 200)); ?>...</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
