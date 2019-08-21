<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-clock']) . '&nbsp;' . __('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['escape' => false]) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-edit']) . '&nbsp;' . __('Edit Node'), ['action' => 'edit', $node->id], ['escape' => false]) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-pdf']) . '&nbsp;' . __('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['escape' => false, 'download' => 'download']) ?></li>
        <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-archive']) . '&nbsp;' . __('Export to Zip'), ['action' => 'view', $node->id, '_ext' => 'zip'], ['escape' => false, 'download' => 'download']) ?></li>
        <li><?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fas fa-trash']) . '&nbsp;' . __('Delete Node'), ['action' => 'delete', $node->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container">
    <div class="box">
        <?= $this->Form->create($nodeComment) ?>
        <fieldset>
            <h1 class="title"><?= __('Edit Comment') ?></h1>
            <?php echo $this->Form->control('body', ['label' => false]); ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
