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

    <?php $size = $nodes->count(); ?>

    <div class="tile is-ancestor is-align-items-start">
        <?php foreach ($nodes->chunk(ceil($size / 3)) as $column): ?>
            <div class="tile is-vertical is-align-items-start">
                <?php foreach ($column as $node): ?>
                    <?php echo $this->element('Nodes/tile', compact('node') + ['postLink' => true, 'linkName' => "Change to " . $node->name, 'linkUrl' => ['action' => 'adopt', $adoptee->id, $node->id]]); ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php echo $this->element('pager'); ?>
</div>
