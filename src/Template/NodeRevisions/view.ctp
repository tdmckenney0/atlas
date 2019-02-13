<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision $nodeRevision
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Node Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Node Revision'), ['controller' => 'NodeRevisions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Node Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Node Revision'), ['controller' => 'NodeRevisions', 'action' => 'add']) ?> </li>
    </ul>
</nav>

<div class="nodes">

    <ul class="nav nav-pills flex-column flex-lg-row">
        <li class="nav-item">
            <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item"><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $nodeRevision->id, '_ext' => 'pdf'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $nodeRevision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeRevision->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
    </ul>

    <hr />

    <?php echo $this->cell('Breadcrumb', [$nodeRevision->has('node') ? $nodeRevision->node->id : null, [
        $this->Html->link(__('Revisions'), ['action' => 'index']),
        $nodeRevision->id
    ]]); ?>

    <h1 class="overflow-hidden"><?= h($nodeRevision->name) ?></h1>

    <small class="text-muted"> <?= __('Created: ') . h($nodeRevision->created) ?></small>

    <div class="text-justify">
        <?php echo $this->cell('Markdown', [$nodeRevision->description]); ?>
    </div>

    <div class="my-3">
        <h2>Next Revisions</h2>
        <div class="list-group">
            <?php if (!empty($nodeRevision->child_node_revisions)): ?>
                <?php foreach ($nodeRevision->child_node_revisions as $child): ?>
                    <?php echo $this->element('browser_item', [
                        'url' => ['action' => 'view', $child->id],
                        'title' => $child->name,
                        'body' => substr($child->description, 0, 200),
                        'icon' => 'fas fa-folder',
                        'class' => ""
                    ]); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
