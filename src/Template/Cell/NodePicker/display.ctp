<?php if (!empty($options['top'])): ?>
    <script type="text/javascript">
        $(function() {

            $('button.node-picker-select').click(function(e) {
                $('div.node-picker-field input').val($(this).attr('data-node-id'));
                $($(this).parents('div.collapse')).collapse('hide');
                $('.node-picker-toggle')
                    .removeClass('btn-outline-secondary')
                    .addClass('btn-warning')
                    .html($(this).siblings('.node-picker-drop') .html());
            });

            $('button.node-picker-remove').click(function(e) {
                $(this).parents('.node-picker-field')
                    .find('input')
                    .val('')
                    .end()
                    .find('.node-picker-toggle')
                    .html(' - TOP LEVEL - ')
                    .removeClass('btn-outline-secondary')
                    .addClass('btn-warning');
            });
        });

    </script>

    <?php $top_id = time() ^ rand(); ?>

    <div class="form-group node-picker-field">
        <label for="<?php echo $options['name'] ?? 'node_id'; ?>"><?php echo $options['label'] ?? 'Node'; ?></label>
        <div class="btn-group d-flex flex-row">
            <button type="button" class="w-100 btn btn-outline-secondary btn-block text-nowrap dont-think node-picker-toggle" data-toggle="collapse" href="#node-picker-<?php echo $top_id; ?>"><?php echo $this->Html->tag('i', '', ['class' => 'fas fa-folder']); ?>&nbsp;<?php echo $options['value']->name ?? 'Top Level'; ?>&nbsp;<?php echo $this->Html->tag('i', '', ['class' => 'fas fa-angle-down']); ?></button>
            <button type="button" class="btn btn-danger dont-think px-4 node-picker-remove">Remove</button>
        </div>
        <?php echo $this->Form->control($options['name'] ?? 'node_id', ['type' => 'hidden', 'value' => ($options['value']->id ?? null)]); ?>
    </div>
    <?php $options['top'] = false; ?>
<?php endif; ?>

<div class="flex-column collapse" id="node-picker-<?php echo ($top_id ?? $current->id); ?>">
    <?php $folderIcon = $this->Html->tag('i', '', ['class' => 'fas fa-folder']); ?>
    <?php $dropdownIcon = $this->Html->tag('i', '', ['class' => 'fas fa-angle-down']); ?>
    <?php foreach($nodes as $node): ?>
        <div class="my-4">
            <div class="btn-group d-flex flex-row">

                <?php if(!empty($options['value']) && $options['value']->id == $node->id): ?>
                    <?php $selectClass = $class = 'btn-primary'; ?>
                    <?php $disabled = 'disabled="disabled"'; ?>
                    <?php $disabledDrop = ''; ?>
                <?php elseif(!empty($options['this']) && $options['this']->id == $node->id): ?>
                    <?php $selectClass = $class = 'btn-danger'; ?>
                    <?php $disabledDrop = $disabled = 'disabled="disabled"'; ?>
                <?php else: ?>
                    <?php $class = 'btn-outline-secondary'; ?>
                    <?php $selectClass = 'btn-success'; ?>
                    <?php $disabledDrop = ''; ?>
                    <?php $disabled = ''; ?>
                <?php endif; ?>

                <?php printf('<button type="button" class="w-100 overflow-hidden text-left btn text-nowrap dont-think node-picker-drop %s" data-toggle="collapse" href="#node-picker-%s" %s>%s&nbsp;%s&nbsp;%s</button>', $class, $node->id, $disabledDrop, $folderIcon, $node->name, $dropdownIcon); ?>

                <?php printf('<button type="button" class="px-4 btn %s text-nowrap dont-think node-picker-select" %s data-node-id="%s">Select</button>', $selectClass, $disabled, $node->id); ?>
            </div>
            <?php if (empty($options['this']) || $options['this']->id != $node->id): ?>
                <div class="ml-4">
                    <?php echo $this->cell('NodePicker', [$node, $options]); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
