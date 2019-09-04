<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $adoptee]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <h1 class="title is-1"><?php echo __('Change Parent'); ?></h1>

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

    <?php echo $this->cell('Breadcrumb::fromNode', [$adoptee, [__('Change Parent')]]); ?>

    <div class="box">
        <?php echo $this->Form->postLink('Move to Top Level', ['action' => 'adopt', $adoptee->id], ['class' => 'button is-warning is-fullwidth', 'confirm' => __('Are you sure you want to send this node top level?')]); ?>
    </div>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$nodes, $adoptee) {
        foreach($nodes as $node) {
            $entry = new stdClass;
            $entry->title = $node->name;
            $entry->subtitle = $node->created;
            $entry->icon = 'fa-book';
            $entry->href = $this->Url->build(['action' => 'adopt', $adoptee->id, $node->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
