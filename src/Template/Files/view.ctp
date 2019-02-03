<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">View File</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Edit File'), ['controller' => 'Files', 'action' => 'edit', $file->id], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'nav-link border border-danger text-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [null, $file->name]); ?>

<div class="file">
    <h1><?= h($file->name) ?></h1>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($file->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Extension') ?></th>
            <td><?= h($file->file_extension) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mime Type') ?></th>
            <td><?= h($file->mime_type) ?></td>
        </tr>
    </table>

    <?php if (!empty($file->nodes)): ?>
        <h2><?php echo __('Nodes'); ?></h2>
        <div class="card">
            <?php foreach ($file->nodes as $node): ?>
                <div class="media p-3 border-bottom">
                    <i class="mr-3 fas fa-folder " style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body">
                        <h5 class="mt-0"><?= $this->Html->link($node->name, ['action' => 'view', $node->id]) ?></h5>
                        <div class="text-muted"><?php echo h(substr($node->description, 0, 128)); ?>...</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
