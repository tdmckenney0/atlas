<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php if (!empty($node->child_nodes)): ?>
    <?php $this->start('nodes'); ?>
        <ul class="menu-list">
            <?php foreach ($node->child_nodes as $child): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book', 'text' => $child->name, 'link' => ['action' => 'view', $child->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php if (!empty($node->files)): ?>
    <?php $this->start('files'); ?>
        <ul class="menu-list">
            <?php foreach ($node->files as $file): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file', 'text' => $file->name, 'link' => ['controller' => 'files', 'action' => 'view', $file->id, $node->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node]); ?>

<div class="container-fluid">
    <?php if(empty($node->print)): ?>
        <article class="message is-info" role="error">
            <div class="message-body"><?php echo __('This node will not be printed'); ?></div>
        </article>
    <?php endif; ?>

    <div class="box">
        <h1 class="title is-1"><?= h($node->name) ?></h1>

        <div>
            <small class="text-muted"> <?= __('Created: ') . h($node->created) ?></small>
            <small class="text-muted"> <?= __('Updated: ') . h($node->modified) ?></small>
        </div>

        <div class="has-text-justified content">
            <?php echo $this->cell('Markdown', [$node->description]); ?>
        </div>
    </div>

    <?php if(!$images->isEmpty()): ?>
        <?php echo $this->element('accordion', [
            'id' => 'images',
            'title' => __('Images')
        ]); ?>

        <div id="images">
            <?php foreach($images as $row): ?>
                <div class="tile is-ancestor">
                    <?php foreach($row as $file): ?>
                        <div class="tile is-parent is-4">
                            <article class="tile is-child box">
                                <h2 class="title is-5"><?php echo h($file->name); ?></h2>
                                <a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id, $node->id]); ?>">
                                    <?php $cell = $this->cell('File', [$file]); $cell->viewBuilder()->setTemplate('image'); echo $cell; ?>
                                </a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!$audio->isEmpty()): ?>
        <?php echo $this->element('accordion', [
            'id' => 'audio',
            'title' => __('Audio')
        ]); ?>

        <div id="audio">
            <?php foreach($audio as $clip): ?>
                <div class="audio box">
                    <h2 class="title is-5"><?php echo h($clip->name); ?></h2>
                    <?php $cell = $this->cell('File', [$clip]); $cell->viewBuilder()->setTemplate('audio'); echo $cell; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!$videos->isEmpty()): ?>
        <?php echo $this->element('accordion', [
            'id' => 'videos',
            'title' => __('Videos')
        ]); ?>

        <div id="videos">
            <?php foreach($videos as $video): ?>
                <div class="video box">
                    <h2 class="title is-5"><?php echo h($video->name); ?></h2>
                    <?php $cell = $this->cell('File', [$video]); $cell->viewBuilder()->setTemplate('video'); echo $cell; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!$charts->isEmpty()): ?>
        <?php echo $this->element('accordion', [
            'id' => 'charts',
            'title' => __('Charts')
        ]); ?>

        <div id="charts">
            <?php foreach($charts as $chart): ?>
                <div class="video box">
                    <h2 class="title is-5"><?php echo h($chart->name); ?></h2>
                    <?php $cell = $this->cell('File', [$chart]); $cell->viewBuilder()->setTemplate('csv'); echo $cell; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(count($comments) > 0): ?>
        <div class="box">
            <?php foreach($comments as $comment): ?>
                <?php echo $this->cell('comments', [$comment]); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <h2 class="title is-3"><?= __('Add Comment') ?></h3>
        <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node->id]]) ?>
            <?php echo $this->Form->control('body', ['label' => false]);  ?>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
