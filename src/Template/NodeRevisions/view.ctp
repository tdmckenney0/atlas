<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision $nodeRevision
 * @var \App\Model\Entity\Node $node
 */
?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $nodeRevision->node]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <section class="section box node-view">
        <div class="block">
            <h1 class="title is-1"><?= h($nodeRevision->name) ?></h1>
        </div>

        <div class="has-text-justified content block">
            <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
        </div>

        <hr />

        <nav class="level is-small">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$nodeRevision->node, [
                        'Revisions' => ['action' => 'index', $nodeRevision->node_id]
                    ]]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <div class="is-italic">
                        <?php if(!empty($nodeRevision->user)): ?>
                            <span><?php echo __('Revised by: '); ?></span>
                            <?php echo $this->Html->link($nodeRevision->user->name, ['controller' => 'users', 'action' => 'view', $nodeRevision->user->id]); ?>
                            <span><?php echo __('on'); ?></span>
                        <?php else: ?>
                            <span><?php echo __('Revised on'); ?></span>
                        <?php endif; ?>
                        
                        <?php echo $this->Html->link($nodeRevision->created->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]), ['controller' => 'node_revisions', 'action' => 'view', $nodeRevision->id]); ?>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <nav class="pagination is-centered box">
        <a class="pagination-previous" href="<?php echo !empty($first) ? $this->Url->build(['action' => 'view', $first->id]) : ""; ?>" aria-label="First" <?php echo (empty($first) ? 'disabled' : ''); ?>>
            <span aria-hidden="true"><span aria-hidden="true">&laquo;</span>&nbsp;<?php echo __('Earliest'); ?></span>
        </a>

        <a class="pagination-next" href="<?php echo !empty($last) ? $this->Url->build(['action' => 'view', $last->id]) : ''; ?>" aria-label="Last" <?php echo (empty($last) ? 'disabled' : ''); ?>>
            <span aria-hidden="true"><?php echo __('Latest'); ?>&nbsp;<span aria-hidden="true">&raquo;</span></span>
        </a>

        <ul class="pagination-list" role="navigation" aria-label="pagination">
            <?php if(!empty($nodeRevision->parent_id)): ?>
                <li>
                    <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', $nodeRevision->parent_id]); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>&nbsp;<?php echo $nodeRevision->parent_node_revision->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT]); ?>
                    </a>
                </li>
            <?php endif; ?>

            <li>
                <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?php echo $nodeRevision->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT]); ?></a>
            </li>

            <?php if(!empty($nodeRevision->child_node_revisions) && count($nodeRevision->child_node_revisions) >= 1): ?>
                <li>
                    <a class="pagination-link" href="<?php echo $this->Url->build(['action' => 'view', reset($nodeRevision->child_node_revisions)->id]); ?>" aria-label="Next">
                        <?php echo $nodeRevision->child_node_revisions[0]->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT]); ?>&nbsp;<span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    
</div>
