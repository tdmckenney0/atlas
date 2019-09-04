<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision $nodeRevision
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['action' => 'add', $nodeRevision->node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $nodeRevision->node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $nodeRevision->node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['action' => 'edit', $nodeRevision->node->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['action' => 'view', $nodeRevision->node->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['action' => 'view', $nodeRevision->node->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['action' => 'delete', $nodeRevision->node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $nodeRevision->node->name)]]); ?>
    </ul>
<?php $this->end(); ?>

<div class="container-fluid">

    <?php echo $this->cell('Breadcrumb::fromNode', [$nodeRevision->node, [
        'Revisions' => ['action' => 'index', $nodeRevision->node_id],
        $nodeRevision->created->i18nFormat()
    ]]); ?>

    <div class="box">
        <h1 class="title"><?= h($nodeRevision->name) ?></h1>
        <small class="text-muted"> <?= __('Created: {0}, by: {1}', $nodeRevision->created, $nodeRevision->has('user') ? $nodeRevision->user->email : __('Atlas')) ?></small>

        <div class="is-justified content">
            <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
        </div>
    </div>

    <div class="box">
        <nav class="pagination is-centered">
            <ul class="pagination-list" role="navigation" aria-label="pagination">
                <?php if(!empty($nodeRevision->parent_id)): ?>
                    <?php if(!empty($first)): ?>
                        <li>
                            <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', $first->id]); ?>" aria-label="First">
                                <span aria-hidden="true"><span aria-hidden="true">&laquo;</span>&nbsp;<?php echo __('Earliest'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', $nodeRevision->parent_id]); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>&nbsp;<?php echo __('Prev'); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="page-item">
                    <a class="pagination-link is-current" aria-label="Current"><?php echo h($nodeRevision->created); ?></a>
                </li>

                <?php if(!empty($nodeRevision->child_node_revisions) && count($nodeRevision->child_node_revisions) == 1): ?>
                    <li>
                        <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', reset($nodeRevision->child_node_revisions)->id]); ?>" aria-label="Next">
                            <?php echo __('Next'); ?>&nbsp;<span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>

                    <?php if(!empty($last)): ?>
                        <li>
                            <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', $last->id]); ?>" aria-label="Last">
                                <span aria-hidden="true"><?php echo __('Latest'); ?>&nbsp;<span aria-hidden="true">&raquo;</span></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
