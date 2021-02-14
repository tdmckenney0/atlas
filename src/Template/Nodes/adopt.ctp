<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $adoptee]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <?php if(!empty($adopter)): ?>
        <div class="modal is-active" id="confirmAdoption">
            <div class="modal-background"></div>
            <div class="modal-content">
                <article class="message is-primary" style="margin: 1em;">
                    <div class="message-header">
                        <?php echo __('Change Parent to "{0}"?', $adopter->name); ?>
                    </div>
                    <div class="message-body">
                        <?php echo $this->Form->create(null); ?>
                            <div class="columns">
                                <div class="column is-half">
                                    <input class="button is-primary is-fullwidth" type="submit" value="Yes" />
                                </div>
                                <div class="column is-half">
                                    <button class="button is-fullwidth" onclick="document.getElementById('confirmAdoption').remove(); ">No</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </article>
            </div>
        </div>
    <?php endif; ?>

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
        </nav>
    </section>    

    <div class="box">
        <?php echo $this->Form->postLink('Move to Top Level', ['action' => 'adopt', $adoptee->id], ['class' => 'button is-warning is-fullwidth', 'confirm' => __('Are you sure you want to send this node top level?')]); ?>
    </div>

    <?php echo $this->element('search'); ?>

    <?php $size = $nodes->count(); ?>

    <div class="tile is-ancestor is-align-items-start">
        <?php foreach ($nodes->chunk(ceil($size / 3)) as $column): ?>
            <div class="tile is-vertical is-align-items-start">
                <?php foreach ($column as $node): ?>
                    <?php echo $this->element('Nodes/tile', compact('node') + ['linkName' => "Change to " . $node->name, 'linkUrl' => ['action' => 'adopt', $adoptee->id, $node->id]]); ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php echo $this->element('pager'); ?>
</div>
