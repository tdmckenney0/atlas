<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<?php $this->start('navbar'); ?>
    <?php echo $this->element('Files/actions', compact('node', 'file')); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <section class="section box">
        <h1 class="title is-1"><?= h($file->name) ?></h1>

        <hr />

        <nav class="level is-clipped">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [
                        $file->name => ['controller' => 'files', 'action' => 'view', $file->id, $node->id ?? null], 
                        __('Edit')
                    ]]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <div class="is-italic">
                        <span><?= __('Type: {0}; Created: {1}; Modified: {2}', $file->mime_type, $file->created, $file->modified); ?></span>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <div class="columns">
        <div class="column is-one-third">
            <div class="box">
                <?php echo $this->cell('File', [$file, $file->isImageEmbeddable() ? 'thumbnail' : null]); ?>
            </div>
        </div>

        <div class="column is-two-thirds">
            <div class="box">
                <?= $this->Form->create($file, ['type' => 'file']) ?>
                    <?php echo $this->Form->control('name'); ?>
                    <?= $this->Form->submit(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
