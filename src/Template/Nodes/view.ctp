<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php if (!empty($node->child_nodes)): ?>
    <?php $this->start('nodes'); ?>
        <ul class="menu-list">
            <?php foreach ($node->child_nodes as $child): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book', 'text' => $child->name, 'link' => ['action' => 'view', $child->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php if (!empty($node->files)): ?>
    <?php $this->start('files'); ?>
        <ul class="menu-list">
            <?php foreach ($node->files as $file): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file', 'text' => $file->name, 'link' => ['controller' => 'files', 'action' => 'view', $file->id, $node->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node]); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?= h($node->name) ?></h1>

        <div>
            <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
            <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>
        </div>

        <div class="has-text-justified content">
            <?php echo $this->cell('Markdown', [$node->description]); ?>
        </div>
    </div>

    <div class="is-hidden">
        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Files', 'action' => 'add', $node->id], 'type' => 'file', 'id' => 'add-file-to-node-form']) ?>
            <?php $this->Form->unlockField('file'); ?>
            <?php $this->Form->unlockField('nodes._ids'); ?>
            <input type="file" name="file" id="add-file-to-node-input">
            <input type="checkbox" name="nodes[_ids][]" value="<?= h($node->id) ?>" checked="checked">
        <?php echo $this->Form->end(); ?>
    </div>

    <div class="box">
        <h2 class="title is-3"><?= __('Add Comment') ?></h3>
        <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node->id]]) ?>
            <?php echo $this->Form->control('body', ['label' => false]);  ?>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
