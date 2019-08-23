<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>

<?php if(!empty($node)): ?>
    <?php $this->start('actions'); ?>
        <ul class="menu-list">
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['controller' => 'Nodes', 'action' => 'add', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['controller' => 'Nodes', 'action' => 'edit', $node->id]]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
            <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['controller' => 'Nodes', 'action' => 'delete', $node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $node->name)]]); ?>
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
