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



<div class="nodes container">
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

    <div class="columns is-vcentered is-multiline">
        <?php foreach ($nodes as $node): ?>
            <article class="column is-one-third">
                <div class="box">
                    <a href="<?php echo $this->Url->build(['action' => 'view', $node->id]); ?>" class="has-text-primary">
                        <div class="columns is-vcentered is-mobile">
                            <div class="column is-narrow">
                                <span class="icon is-large">
                                    <i class="fas fa-folder fa-3x"></i>
                                </span>
                            </div>
                            <div class="column is-clipped">
                                <strong style="white-space: nowrap;"><?php echo h($node->name); ?></strong><br />
                                <small><?php echo h($node->created); ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <nav class="paginator mt-3">
        <ul class="pagination-list">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
