<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('actions'); ?>
        <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
    <?php $this->end(); ?>
<?php endif; ?>

<div class="container">
    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Revisions')]]) ; ?>

    <h1 class="title is-1"><?php echo __('Revisions'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$nodeRevisions, $node) {
        foreach($nodeRevisions as $nodeRevision) {
            $entry = new stdClass;

            if (!empty($node)) {
                $entry->title = $nodeRevision->created;
                $entry->subtitle = __('Created By: {0}', (!empty($nodeRevision->user->email) ? $nodeRevision->user->email : 'Atlas'));
            } else {
                $entry->title = $nodeRevision->node->name;
                $entry->subtitle = $nodeRevision->created;
            }

            $entry->icon = 'fa-clock';
            $entry->href = $this->Url->build(['action' => 'view', $nodeRevision->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
