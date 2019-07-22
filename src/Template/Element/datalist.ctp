<datalist id="<?php echo $id; ?>">
    <?php foreach($options as $value => $display): ?>
        <option value="<?php echo $value; ?>"><?php echo h($display); ?></option>
    <?php endforeach; ?>
</datalist>
