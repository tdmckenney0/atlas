<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('actions'); ?>
        <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Add File')]]); ?>
<div class="container-fluid box">
    <h1 class="title"><?= __('Add File') ?></h1>
    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <div class="file field">
            <label class="file-label">
                <?php echo $this->Form->control('file', ['type' => 'file', 'label' => false, 'div' => false]); ?>
                <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Choose a file…
                    </span>
                </span>
            </label>
        </div>

        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
