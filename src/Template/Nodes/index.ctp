<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book', 'text' => 'Add Node', 'link' => ['action' => 'add']]); ?>
    </ul>
<?php $this->end(); ?>

<div class="container-fluid">
    <h1 class="title is-1"><?php echo __('Nodes'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$nodes) {
        foreach($nodes as $node) {
            $entry = new stdClass;
            $entry->title = $node->name;
            $entry->subtitle = $node->created;
            $entry->icon = 'fa-book';
            $entry->href = $this->Url->build(['action' => 'view', $node->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
