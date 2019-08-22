<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<script type="text/javascript">
    document.addEventListener('readystatechange', docReady => {
        if (event.target.readyState === 'complete') {
            const fileLink = document.querySelector('#add-file-to-node');
            const fileInput = document.querySelector('#add-file-to-node-input');
            const fileForm = document.querySelector('#add-file-to-node-form');

            fileLink.addEventListener('click', event => {
                event.preventDefault();
                fileInput.dispatchEvent(new MouseEvent('click'));
            });

            fileInput.addEventListener('input', event => {
                event.preventDefault();
                fileForm.submit();
            });
        }
    });
</script>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-clock']) . '&nbsp;' . __('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['escape' => false]) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-edit']) . '&nbsp;' . __('Edit Node'), ['action' => 'edit', $node->id], ['escape' => false]) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-pdf']) . '&nbsp;' . __('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['escape' => false]) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-archive']) . '&nbsp;' . __('Export to Zip'), ['action' => 'view', $node->id, '_ext' => 'zip'], ['escape' => false]) ?></li>
        <li><?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fas fa-trash']) . '&nbsp;' . __('Delete Node'), ['action' => 'delete', $node->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<?php $this->start('nodes'); ?>
    <ul class="menu-list">
        <?php if (!empty($node->child_nodes)): ?>
            <?php foreach ($node->child_nodes as $child): ?>
                <li><a href="<?php echo $this->Url->build(['action' => 'view', $child->id]); ?>"><i class="fas fa-folder"></i>&nbsp;<?php echo h($child->name); ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
        <li><a href="<?php echo $this->Url->build(['action' => 'add', $node->id]); ?>"><i class="fas fa-folder-plus" ></i>&nbsp;<?php echo __('Add Node'); ?></a></li>
    </ul>
<?php $this->end(); ?>

<?php $this->start('files'); ?>
    <ul class="menu-list">
        <?php if (!empty($node->child_nodes)): ?>
            <?php foreach ($node->files as $file): ?>
                <li><a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id, $node->id]); ?>"><i class="fas fa-file"></i>&nbsp;<?php echo h($file->name); ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
        <li><a id="add-file-to-node" title="<?php echo __('Add a new Node to {0}', $node->name); ?>" href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'add', $node->id]); ?>"><i class="fas fa-file-upload"></i>&nbsp;<?php echo __('Add File'); ?></a></li>
    </ul>
<?php $this->end(); ?>

<?php echo $this->cell('Breadcrumb', [$node->id]); ?>

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

    <?php if(!empty($comments)): ?>
        <div class="box">
            <h2 class="title is-3"><?php echo __('Comments'); ?></h2>
            <?php foreach($comments as $comment): ?>
                <?php echo $this->cell('Comments', [$comment]); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <h2 class="title is-3"><?= __('Add Comment') ?></h3>
        <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node->id]]) ?>
            <?php echo $this->Form->control('body', ['label' => false]);  ?>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
