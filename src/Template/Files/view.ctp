<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<?php $this->start('navbar'); ?>
    <?php echo $this->element('Files/actions', compact('file', 'node')); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <section class="section box">
        <h1 class="title is-1"><?= h($file->name) ?></h1>

        <hr />

        <nav class="level is-clipped">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [$file->name]]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <div class="is-italic">
                        <span><?= __('Type: {0}; Created: {1}; Modified: {2}', $file->mime_type, $file->created, $file->modified); ?></span>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <div class="columns">
        <div class="column">
            <div class="box">
                <?php echo $this->cell('File', [$file]); ?>
            </div>
        </div>

        <?php if (!empty($file->nodes)): ?>
            <div class="column is-one-third">
                <aside class="menu box">
                    <p class="menu-label">
                        Nodes
                    </p>
                    <ul class="menu-list">
                        <?php foreach($file->nodes as $node): ?>
                            <?php echo $this->element('Menu/link', ['name' => $node->name, 'icon' => 'fas fa-book', 'url' => ['controller' => 'nodes', 'action' => 'view', $node->id] ]); ?>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            </div>
        <?php endif; ?>
    </div>
</div>
