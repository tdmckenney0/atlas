<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('navbar'); ?>
        <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
    <?php $this->end(); ?>
<?php endif; ?>

<div class="container-fluid">
    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Revisions')]]) ; ?>

    <h1 class="title is-1"><?php echo __('Latest'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php foreach($nodeRevisions as $nodeRevision): ?>
        <div class="box" style="break-inside: avoid;">
            <h2 class="title is-2"><?php echo $nodeRevision->name; ?></h1>
            <div class="has-text-justified content" style="break-inside: avoid;">
                <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
            </div>
            <div class="is-italic">
                <?php echo $this->Html->link($nodeRevision->node->name, ['controller' => 'nodes', 'action' => 'view', $nodeRevision->node->id]); ?>
                <span><?php echo __('revised by: '); ?></span>
                <?php echo $this->Html->link($nodeRevision->user->name, ['controller' => 'users', 'action' => 'view', $nodeRevision->user->id]); ?>
                <span><?php echo __('on'); ?></span>
                <?php echo $this->Html->link($nodeRevision->created->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]), ['controller' => 'node_revisions', 'action' => 'view', $nodeRevision->id]); ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php echo $this->element('pager'); ?>
</div>
