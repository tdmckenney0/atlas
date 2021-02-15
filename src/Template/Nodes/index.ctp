<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['action' => 'add']]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?php echo __('Nodes'); ?></h1>
        <?php echo $this->element('search'); ?>
    </div> 

    <?php $size = $nodes->count(); ?>

    <div class="tile is-ancestor is-align-items-start">
        <?php foreach ($nodes->chunk(ceil($size / 3)) as $column): ?>
            <div class="tile is-vertical is-align-items-start">
                <?php foreach ($column as $node): ?>
                    <?php echo $this->element('Nodes/tile', compact('node') + ['linkName' => "View Node", 'linkUrl' => ['controller' => 'nodes', 'action' => 'view', $node->id]]); ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php echo $this->element('pager'); ?>
</div>
