<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision $nodeRevision
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li class="">
            <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class=""><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $nodeRevision->id, '_ext' => 'pdf'], ['class' => '']) ?></li>
        <li class=""><?= $this->Form->postLink(__('Delete Revision'), ['action' => 'delete', $nodeRevision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeRevision->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php $this->end(); ?>

<div class="container">

    <?php echo $this->cell('Breadcrumb', [$nodeRevision->node_id, [
        $this->Html->link(__('Revisions'), ['action' => 'index', $nodeRevision->node_id]),
        $nodeRevision->created
    ]]); ?>

    <h1 class="title is-1"><?= h($nodeRevision->name) ?></h1>

    <small class="text-muted"> <?= __('Created: {0}, by: {1}', $nodeRevision->created, $nodeRevision->has('user') ? $nodeRevision->user->email : __('Atlas')) ?></small>

    <div class="is-justified content">
        <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
    </div>

    <nav class="p-2">
        <ul class="pagination-list justify-content-center">
            <?php if(!empty($nodeRevision->parent_id)): ?>

                <?php if(!empty($first)): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $this->Url->build(['action' => 'view', $first->id]); ?>" aria-label="First">
                            <span aria-hidden="true"><span aria-hidden="true">&laquo;</span>&nbsp;<?php echo __('First'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="page-item">
                    <a class="page-link" href="<?php echo $this->Url->build(['action' => 'view', $nodeRevision->parent_id]); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>&nbsp;<?php echo __('Prev'); ?>
                    </a>
                </li>
            <?php endif; ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Current"><?php echo h($nodeRevision->created); ?></a>
            </li>
            <?php if(!empty($nodeRevision->child_node_revisions) && count($nodeRevision->child_node_revisions) == 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $this->Url->build(['action' => 'view', reset($nodeRevision->child_node_revisions)->id]); ?>" aria-label="Next">
                        <?php echo __('Next'); ?>&nbsp;<span aria-hidden="true">&raquo;</span>
                    </a>
                </li>

                <?php if(!empty($last)): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $this->Url->build(['action' => 'view', $last->id]); ?>" aria-label="Last">
                            <span aria-hidden="true"><?php echo __('Last'); ?>&nbsp;<span aria-hidden="true">&raquo;</span></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>
</div>
