<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $parent
 */
?>
<?php if(!empty($parent)): ?>
    <?php $this->start('actions'); ?>
        <?php echo $this->element('Nodes/actions', ['node' => $parent]); ?>
    <?php $this->end(); ?>
<?php endif; ?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$parent, [__('Add')]]); ?>

<div class="container box">
    <?= $this->Form->create($node) ?>

        <div class="overflow-hidden">
            <h1 class="overflow-hidden"><?= __('Add Node') ?></h1>
        </div>

        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
            echo $this->Form->control('print', ['type' => 'select', 'options' => ['No', 'Yes']]);
            echo $this->Form->control('description');
        ?>

        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
