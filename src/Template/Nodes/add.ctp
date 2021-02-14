<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $parent
 */
?>
<?php if(!empty($parent)): ?>
    <?php $this->start('navbar'); ?>
        <?php echo $this->element('Nodes/actions', ['node' => $parent]); ?>
    <?php $this->end(); ?>
<?php endif; ?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container-fluid">
    <section class="section box">
            <div class="block">
                <h1 class="is-1 title"><?= __('Add Node') ?></h1>
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
                <?= $this->Form->submit(__('Submit')) ?>
            </div>

            <?= $this->Form->end() ?>

            <hr />

            <nav class="level is-small">
                <div class="level-left">
                    <div class="level-item">
                        <?php echo $this->cell('Breadcrumb::fromNode', [$parent, [__('Add')]]); ?>
                    </div>
                </div>
            </nav>
       
    </section>
</div>
