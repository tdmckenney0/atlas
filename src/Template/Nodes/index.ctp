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
    </ul>
<?php $this->end(); ?>

<div class="container">
    <h1 class="title is-1"><?php echo __('Nodes'); ?></h1>

    <div class="box">
        <form method="GET">
            <div class="field has-addons is-horizontal">
                <p class="control has-icons-left is-expanded">
                    <input class="input" type="text" name="search" placeholder="Search" value="<?php echo h($_GET['search']); ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </p>
                <p class="control">
                    <button type="submit" class="button is-primary">Search</button>
                </p>
            </div>
        </form>
    </div>

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
