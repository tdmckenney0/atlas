<?php $this->start('navbar'); ?>
    <?php echo $this->element('Files/actions', compact('file', 'node')); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?php echo __('Attach File to Node'); ?></h1>
        
        <hr />

        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [
                        $file->name => ['controller' => 'Files', 'action' => 'view', $file->id, (!empty($node->id) ? $node->id : null)], 
                        __('Attach')
                    ]]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <?php echo $this->element('search'); ?>
                </div>
            </div>
        </nav>   
    </div>

    <?php echo $this->cell('NodeTile::tesselate', [$nodes, 4, "Attach to {0}", function ($node) use ($file): array {
        return ['controller' => 'files', 'action' => 'attach', $file->id, $node->id];
    }, true]); ?>

    <?php echo $this->element('pager'); ?>
</div>
