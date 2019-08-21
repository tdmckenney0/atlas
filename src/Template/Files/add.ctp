<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<ul class="menu-list">
    <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index'], ['class' => '']) ?></li>
    <li><?= $this->Html->link(__('Add Node'), ['controller' => 'Nodes', 'action' => 'add'], ['class' => '']) ?></li>
    <li><?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => '']) ?></li>
    <li>
        <a class=" active dont-think" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('Add File'); ?></a>
    </li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [!empty($node->id) ? $node->id : null, __('Add File')]); ?>
<div class="files">
    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <h1><?= __('Add File') ?></h1>
        <?php $this->Form->unlockField('file'); ?>
        <?php $this->Form->unlockField('nodes._ids'); ?>

        <div class="custom-file my-3">
            <input type="file" name="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>

        <h2 class="my-3"><?= __('Add to Nodes') ?></h2>

        <ul class="list-group my-3">
            <?php foreach($nodes as $id => $name): ?>

            <li class="list-group-item">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="nodes[_ids][]" class="custom-control-input" value="<?php echo $id; ?>" <?php echo (!empty($node->id) && $id == $node->id ? 'checked="checked"' : ''); ?> id="node-<?php echo $id; ?>">
                    <label class="custom-control-label" for="node-<?php echo $id; ?>"><?php echo $name; ?></label>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
