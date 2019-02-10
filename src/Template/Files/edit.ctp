<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item"><?= $this->Html->link(__('Preview'), ['controller' => 'Files', 'action' => 'view', $file->id, (!empty($node->id) ? $node->id : null)], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Download File'), ['controller' => 'files', 'action' => 'get', $file->id], ['class' => 'flex-lg-fill text-sm-center nav-link dont-think', 'download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]) ?></li>
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active dont-think" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('Edit File'); ?></a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'flex-lg-fill text-sm-center nav-link border border-danger text-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [!empty($node->id) ? $node->id : null, __('Edit {0}', $file->name)]); ?>
<div class="files overflow-hidden">
    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <div class="overflow-hidden">
            <h1 class="overflow-hidden"><?= __('Edit {0}', $file->name) ?></h1>
        </div>

        <?php $this->Form->unlockField('nodes._ids'); ?>

        <?php echo $this->Form->control('name'); ?>

        <h2 class="my-3"><?= __('Nodes') ?></h2>

        <ul class="list-group my-3">
            <?php foreach($nodes as $id => $name): ?>

            <li class="list-group-item">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="nodes[_ids][]" class="custom-control-input" value="<?php echo $id; ?>" <?php echo (in_array($id, $children) ? 'checked="checked"' : ''); ?> id="node-<?php echo $id; ?>">
                    <label class="custom-control-label" for="node-<?php echo $id; ?>"><?php echo $name; ?></label>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
