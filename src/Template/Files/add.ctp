<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>

<?php $this->start('navbar'); ?>
    <?php if(!empty($node)): ?>
        <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
    <?php else: ?>
        <?php echo $this->element('Files/actions', compact('file', 'node')); ?>
    <?php endif; ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <section class="section box">
        <h1 class="title is-1"><?= __('Add File'); ?></h1>

        <hr />

        <nav class="level is-clipped">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Add File')]]); ?>
                </div>
            </div>
        </nav>
    </section>

    <?= $this->Form->create($file, ['type' => 'file']) ?>
        <div class="columns">
            <div class="column is-one-third">
                <div class="file is-large is-boxed has-name is-centered">
                    <label class="file-label">
                        <?php echo $this->Form->control('file', ['type' => 'file', 'label' => false, 'div' => false, 'class' => 'file-input', 'id' => 'add-file-input']); ?>
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose File...
                            </span>
                        </span>
                        <span class="file-name" id="add-file-name"></span>
                    </label>
                </div>
            </div>

            <div class="column is-two-thirds">
                <div class="box">                    
                    <?php echo $this->Form->control('name', ['required' => false]); ?>
                    <?= $this->Form->submit(__('Submit')) ?>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>

<script>
    const input = document.querySelector('#add-file-input');
    
    input.addEventListener('change', () => {
        if (input.files.length > 0) {
            const name = document.querySelector('#add-file-name');

            name.textContent = input.files[0].name;
        }
    });
</script>
