<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>

<script type="text/javascript">
    $(function() {
        $('.atlas-file-add').unbind('click').click(function(event) {
            event.preventDefault();
            $('.atlas-file-add-form input[type="file"]').click();
        });

        $('.atlas-file-add-form input[type="file"]').change(function() {
            if(atlas.think) atlas.think();
            $(this).parent('form').submit();
        });
    });
</script>


<?php $this->start('actions'); ?>
    <ul class="">
        <li class="">
            <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class=""><?= $this->Html->link(__('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['class' => '']) ?></li>
        <li class=""><?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id], ['class' => '']) ?></li>
        <li class=""><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['class' => '']) ?></li>
        <li class=""><?= $this->Html->link(__('Export to Zip'), ['action' => 'view', $node->id, '_ext' => 'zip'], ['class' => '']) ?></li>
        <li class=""><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<div class="nodes">

    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title"><?= h($node->name) ?></h1>
                <h2 class="subtitle">
                    <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
                    <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>
                </h2>
            </div>
        </div>
    </section>

    <?php echo $this->cell('Breadcrumb', [$node->id]); ?>



    <div class="has-text-justified">
        <?php echo $this->cell('Markdown', [$node->description]); ?>
    </div>

    <div class="my-3">
        <h2>Nodes</h2>
        <div class="list-group">
            <?php if (!empty($node->child_nodes)): ?>
                <?php foreach ($node->child_nodes as $child): ?>
                    <?php echo $this->element('browser_item', [
                        'url' => ['action' => 'view', $child->id],
                        'title' => $child->name,
                        'body' => substr($child->description, 0, 200),
                        'icon' => 'fas fa-folder',
                        'class' => ""
                    ]); ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php echo $this->element('browser_item', [
                'url' => ['action' => 'add', $node->id],
                'title' => __('Add Node'),
                'body' => __('Add a new Node to {0}', $node->name),
                'icon' => 'fas fa-folder-plus',
                'class' => "text-primary"
            ]); ?>
        </div>
    </div>

    <div class="my-3">
        <h2>Files</h2>
        <div class="list-group">
            <?php if (!empty($node->files)): ?>
                <?php foreach ($node->files as $file): ?>
                    <?php echo $this->element('browser_item', [
                        'url' => ['controller' => 'files', 'action' => 'view', $file->id, $node->id],
                        'title' => $file->name,
                        'body' => __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type),
                        'icon' => 'fas fa-file-alt',
                        'class' => ""
                    ]); ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php echo $this->element('browser_item', [
                'url' => ['controller' => 'Files', 'action' => 'add', $node->id],
                'title' => __('Add File'),
                'body' => __('Upload a new file to {0}', $node->name),
                'icon' => 'fas fa-plus-circle',
                'class' => "text-primary atlas-file-add"
            ]); ?>

            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Files', 'action' => 'add', $node->id], 'type' => 'file', 'class' => 'atlas-file-add-form d-none']) ?>
                <?php $this->Form->unlockField('file'); ?>
                <?php $this->Form->unlockField('nodes._ids'); ?>
                <input type="file" name="file" class="custom-file-input" id="customFile">
                <input type="checkbox" name="nodes[_ids][]" value="<?= h($node->id) ?>" checked="checked">
            <?php echo $this->Form->end(); ?>
        </div>
    </div>

    <?php echo $this->cell('Comments', [$node->id]); ?>
</div>
