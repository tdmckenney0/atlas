<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container-fluid">
    <section class="section box">
        <div class="block">
            <h1 class="title is-1"><?= __('Edit {0}', $node->name) ?></h1>
        </div>

        <?= $this->Form->create($node) ?>

        <div class="block">
            <?php
                echo $this->Form->control('name');
                echo $this->Form->control('description');
                echo $this->Form->control('sort');
                echo $this->Form->control('print', ['type' => 'select', 'options' => ['No', 'Yes']]);
            ?>
        </div>

        <div class="block">
            <?= $this->Form->submit(__('Save')) ?>
        </div>

        <?= $this->Form->end() ?>

        <hr />

        <nav class="level is-small">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Edit')]]); ?>
                </div>
            </div>
        </nav>
    </section>
</div>
