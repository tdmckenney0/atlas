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

<div class="nodes">

    <ul class="nav nav-pills flex-column flex-lg-row">
        <li class="nav-item">
            <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
    </ul>

    <hr />

    <?php echo $this->cell('Breadcrumb', [$node->id]); ?>

    <h1 class="overflow-hidden"><?= h($node->name) ?></h1>

    <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
    <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>

    <div class="text-justify">
        <?php echo $this->cell('Markdown', [$node->description]); ?>
    </div>

    <div class="my-3">
        <h2>Nodes</h2>
        <div class="list-group">
            <?php if (!empty($node->child_nodes)): ?>
                <?php foreach ($node->child_nodes as $child): ?>
                    <a href="<?php echo $this->Url->build(['action' => 'view', $child->id]); ?>"  class="list-group-item list-group-item-action">
                        <div class="media atlas-node">
                            <i class="mr-3 fas fa-folder" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                            <div class="media-body overflow-hidden">
                                <h5 class="mt-0"><?= h($child->name) ?></h5>
                                <div class="text-muted"><?php echo h(substr($child->description, 0, 200)); ?>...</div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="<?php echo $this->Url->build(['action' => 'add', $node->id]); ?>" class="list-group-item list-group-item-action">
                <div class="media text-primary atlas-node">
                    <i class="mr-3 fas fa-folder-plus" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body overflow-hidden">
                        <h5 class="mt-0"><?= __('Add Node') ?></h5>
                        <div class="text-muted"><?php echo __('Add a new Node to {0}', $node->name); ?></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="my-3">
        <h2>Files</h2>
        <div class="list-group">
            <?php if (!empty($node->files)): ?>
                <?php foreach ($node->files as $file): ?>
                    <a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id]); ?>"  class="list-group-item list-group-item-action">
                        <div class="media atlas-file">
                            <i class="mr-3 fas fa-file-alt" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                            <div class="media-body overflow-hidden">
                                <h5 class="mt-0"><?= h($file->name) ?></h5>
                                <div class="text-muted"><?php echo __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type); ?></div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'add', $node->id]); ?>"  class="list-group-item list-group-item-action atlas-file-add">
                <div class="media text-primary">
                    <i class="mr-3 fas fa-plus-circle" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                    <div class="media-body overflow-hidden">
                        <h5 class="mt-0"><?= __('Add File') ?></h5>
                        <div class="text-muted"><?php echo __('Upload a new file to {0}', $node->name); ?></div>

                    </div>
                </div>
            </a>

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
