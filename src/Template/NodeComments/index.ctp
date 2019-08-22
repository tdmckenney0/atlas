<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment[]|\Cake\Collection\CollectionInterface $nodeComments
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

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-comments"></i>
                </span>&nbsp;<?php echo __('List Comments'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<div class="container-fluid">
    <h1 class="title is-1"><?= __('Comments') ?></h1>

    <div class="box">
        <?php foreach ($nodeComments as $nodeComment): ?>
            <?php echo $this->cell('Comments', [$nodeComment]); ?>
        <?php endforeach; ?>
    </div>

    <?php echo $this->element('pager'); ?>
</div>
