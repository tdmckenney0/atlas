<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<div class="nodes view large-9 medium-8 columns content">

    <ul class="nav nav-pills flex-column flex-lg-row">
        <li class="nav-item">
            <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Add Node'), ['action' => 'add', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
    </ul>

    <hr />

    <?php echo $this->cell('Breadcrumb', [$node->id]); ?>

    <h1><?= h($node->name) ?></h1>

    <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
    <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>

    <div class="text-justify">
        <?php echo $this->cell('Markdown', [$node->description]); ?>
    </div>

    <?php if (!empty($node->files) || !empty($node->child_nodes)): ?>
        <h2>Nodes & Files</h2>
        <div class="card">
            <?php foreach ($node->child_nodes as $child): ?>
                <div class="media p-3 border-bottom">
                    <i class="mr-3 fas fa-folder " style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body">
                        <h5 class="mt-0"><?= $this->Html->link($child->name, ['action' => 'view', $child->id]) ?></h5>
                        <div class="text-muted"><?php echo h(substr($child->description, 0, 200)); ?>...</div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php foreach ($node->files as $file): ?>
                <div class="media p-3 border-bottom">
                    <i class="mr-3 fas fa-file-alt" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body">
                        <h5 class="mt-0"><?= $this->Html->link($file->name, ['controller' => 'files', 'action' => 'view', $file->id]) ?></h5>
                        <div class="text-muted"><?php echo __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php echo $this->cell('Comments', [$node->id]); ?>
</div>
