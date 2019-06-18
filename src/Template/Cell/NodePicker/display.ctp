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

<div class="form-group node-picker">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <div class="btn-group d-flex flex-row">
        <button type="button" class="w-100 btn btn-outline-secondary btn-block text-nowrap dont-think node-picker-toggle" data-toggle="collapse" href="#node-picker-top">Top Level</button>
        <button type="button" class="btn btn-danger dont-think px-4 node-picker-remove">Remove</button>
    </div>

    <div class="hide node-picker-inputs">
        <?php foreach($selected as $value): ?>
            <?php echo $this->Form->control($name, ['type' => 'hidden', 'value' => $value->id]); ?>
        <?php endforeach; ?>
    </div>

    <div class="flex-column collapse" id="node-picker-top">
        <?php foreach($nodes as $node): ?>
            <?php echo $this->cell('NodePicker::child', [$node, $current, $selected]); ?>
        <?php endforeach; ?>
    </div>
</div>
