<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $adoptee]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <section class="section box">
        <div class="block">
            <h1 class="title is-1"><?php echo __('Change Parent'); ?></h1>
        </div>

        <hr />

        <nav class="level is-small">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$adoptee, [__('Change Parent')]]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <?php echo $this->element('search'); ?>
                </div>

                <?php if(!empty($adoptee->parent_id)): ?>
                    <div class="level-item">
                        <?php echo $this->Form->create(null, ['url' => ['action' => 'adopt', $adoptee->id]]); ?>
                            <button type="submit" class="button is-warning is-fullwidth">
                                <span class="icon is-small">
                                    <i class="fas fa-arrow-up"></i>
                                </span>
                                <span><?php echo __("Move to Top Level"); ?></span>
                            </button>
                        <?php echo $this->Form->end(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </section>    

    <?php echo $this->cell('NodeTile::tesselate', [$nodes, 4, "Change to {0}", function ($node) use ($adoptee): array {
        return ['controller' => 'nodes', 'action' => 'adopt', $adoptee->id, $node->id];
    }, true]); ?>

    <?php echo $this->element('pager'); ?>
</div>
