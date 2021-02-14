<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <?php echo $this->element('Nodes/section', compact('node', 'nodeRevision')); ?>

    <div class="columns">
        <?php $tree = (string) $this->cell('NodeTree', [$node]); ?>

        <?php if (!empty($tree)): ?>
            <div class="column is-one-third"> 
                <div id="<?php echo ('node-tree-' . $node->id); ?>" class="box">
                    <?php echo $tree; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="column">
            <?php if(empty($node->print)): ?>
                <article class="message is-info" role="error">
                    <div class="message-body"><?php echo __('This node will not be printed'); ?></div>
                </article>
            <?php endif; ?>

            <?php if(!$images->isEmpty()): ?>
                <?php echo $this->element('accordion', [
                    'id' => 'images',
                    'title' => __('Images')
                ]); ?>

                <div id="images" style="margin-bottom: 1em;">
                    <?php foreach($images as $row): ?>
                        <div class="tile is-ancestor">
                            <?php foreach($row as $file): ?>
                                <div class="tile is-parent is-4">
                                    <article class="tile is-child box">
                                        <h2 class="title is-5"><?php echo h($file->name); ?></h2>
                                        <a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id, $node->id]); ?>">
                                            <?php echo $this->cell('File', [$file, 'thumbnail']); ?>
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
                        <?php echo $this->cell('Comments', [$comment]); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="box">
                <h2 class="title is-3"><?= __('Add Comment') ?></h3>
                <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node->id]]) ?>
                    <?php echo $this->Form->control('body', ['label' => false]);  ?>
                    <?= $this->Form->submit(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
