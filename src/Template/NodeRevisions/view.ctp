<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision $nodeRevision
 * @var \App\Model\Entity\Node $node
 */
?>
<div class="nodes">

    <ul class="nav nav-pills flex-column flex-lg-row">
        <li class="nav-item">
            <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item"><?= $this->Html->link(__('Export to PDF'), ['action' => 'view', $nodeRevision->id, '_ext' => 'pdf'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $nodeRevision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeRevision->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
    </ul>

    <hr />

    <?php echo $this->cell('Breadcrumb', [$node->id, [
        $this->Html->link(__('Revisions'), ['action' => 'index', $node->id]),
        $nodeRevision->created
    ]]); ?>

    <h1 class="overflow-hidden"><?= h($nodeRevision->name) ?></h1>

    <small class="text-muted"> <?= __('Created: {0}, by: {1}', $nodeRevision->created, $nodeRevision->has('user') ? $nodeRevision->user->email : __('Atlas')) ?></small>

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
