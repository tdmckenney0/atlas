<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('actions'); ?>
        <ul class="menu-list">
            <li><?= $this->Html->link(__('Overview'), ['controller' => 'Nodes', 'action' => 'view', $node->id], ['class' => '']) ?></li>
            <li>
                <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('List Revisions'); ?></a>
            </li>
            <li><?= $this->Html->link(__('Edit Node'), ['controller' => 'Nodes', 'action' => 'edit', $node->id], ['class' => '']) ?></li>
            <li><?= $this->Html->link(__('Export to PDF'), ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'pdf'], ['class' => '']) ?></li>
            <li><?= $this->Form->postLink(__('Delete Node'), ['controller' => 'Nodes', 'action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => ' text-danger border border-danger']) ?></li>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<div class="container">

    <?php echo $this->cell('Breadcrumb', [$node->id, __('Revisions')]) ; ?>

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
