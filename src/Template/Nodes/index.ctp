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

    <?php echo $this->cell('NodeTile::tesselate', [$nodes]); ?>

    <?php echo $this->element('pager'); ?>
</div>
