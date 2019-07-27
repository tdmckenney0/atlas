<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-folder"></i>
                </span>&nbsp;<?php echo __('List Nodes'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-file-alt"></i>
                </span>&nbsp;<?php echo __('List Files'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-user"></i>
                </span>&nbsp;<?php echo __('List Users'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeRevisions', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-clock"></i>
                </span>&nbsp;<?php echo __('List Revisions'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<div class="container">
    <h1 class="title is-1"><?php echo __('Nodes'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use ($nodes) {
        foreach($nodes as $node) {
            $entry = new stdClass;
            $entry->title = $node->name;
            $entry->subtitle = $node->created;
            $entry->icon = 'fa-folder';
            $entry->href = $this->Url->build(['action' => 'view', $node->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
