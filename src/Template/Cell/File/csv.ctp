<div class="table-container">
    <table class="table is-hoverable">
        <?php while($row = $file->readlineCSV()): ?>
            <tr>
                <?php foreach($row as $column): ?>
                    <td><?php echo h($column); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
