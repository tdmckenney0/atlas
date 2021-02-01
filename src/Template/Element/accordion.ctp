<?php $this->Html->script('accordion', ['block' => true]); ?>
<?php $this->Html->css('accordion', ['block' => true]); ?>

<a href="#<?php echo $id; ?>" class="button box is-fullwidth collapsable">
    <div style="width: 50%;" class="has-text-left">
        <span><?php echo $title; ?></span>
    </div>
    <div style="width: 50%;" class="has-text-right">
        <span class="icon has-text-right">
            <i class="fas fa-arrow-down">&nbsp;</i>
        </span>
    </div>
</a>
