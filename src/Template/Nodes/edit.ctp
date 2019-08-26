<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Edit')]]); ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container box">
    <h1 class="title is-1"><?= __('Edit {0}', $node->name) ?></h1>
    <?= $this->Form->create($node) ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
            echo $this->Form->control('print', ['type' => 'select', 'options' => ['No', 'Yes']]);
            echo $this->Form->control('description');
        ?>
    <div><?= $this->Form->button(__('Save')) ?></div>
    <?= $this->Form->end() ?>
</div>
