<?php if (!empty($gen)): ?>
    <div class="columns is-vcentered is-multiline">
        <?php foreach ($gen() as $entry): ?>
            <article class="column is-one-third">
                <div class="box">
                    <a href="<?php echo h($entry->href); ?>" class="has-text-primary">
                        <div class="columns is-vcentered is-mobile">
                            <div class="column is-narrow">
                                <span class="icon is-large">
                                    <i class="fas <?php echo h($entry->icon); ?> fa-3x"></i>
                                </span>
                            </div>
                            <div class="column is-clipped">
                                <strong style="white-space: nowrap;"><?php echo h($entry->title); ?></strong><br />
                                <small><?php echo h($entry->subtitle); ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
