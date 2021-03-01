<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>

<?php $this->start('navbar'); ?>
    <?php if(!empty($node)): ?>
        <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
    <?php endif; ?>
<?php $this->end(); ?>


<div class="container-fluid">
    <section class="section box">
        <h1 class="title is-1"><?php echo __('Revisions'); ?></h1>

        <?php if(!empty($node)): ?>
            <hr />

            <nav class="level is-small">
                <div class="level-left">
                    <div class="level-item">
                        <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Revisions')]]); ?>
                    </div>
                </div>

                <div class="level-right">
                    <div class="level-item">
                        <?php echo $this->element('search'); ?>
                    </div>
                </div>
            </nav>
        <?php else: ?>
            <?php echo $this->element('search'); ?>
        <?php endif; ?>
    </section>

    <?php foreach($nodeRevisions as $nodeRevision): ?>
        <div class="box" style="break-inside: avoid;">
            <div class="has-text-justified content" style="break-inside: avoid;">
                <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
            </div>

            <hr />

            <nav class="level is-small">
                <div class="level-left">
                    <div class="level-item">
                        <?php if(empty($node)): ?>
                            <?php echo $this->Html->link($nodeRevision->node->name, ['controller' => 'nodes', 'action' => 'view', $nodeRevision->node->id]); ?>
                        <?php else: ?>
                            <span class="has-text-weight-bold"><?php echo $nodeRevision->node->name; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="level-right">
                    <div class="level-item">
                        <div class="is-italic">
                            <?php if(!empty($nodeRevision->user)): ?>
                                <span><?php echo __('Revised by '); ?></span>
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
        </div>
    <?php endforeach; ?>

    <?php echo $this->element('pager'); ?>
</div>
