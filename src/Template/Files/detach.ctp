<?php $this->start('navbar'); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-medical', 'text' => 'New File', 'link' => ['controller' => 'Files', 'action' => 'add', (!empty($node->id) ? $node->id : null)]]); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-download', 'text' => 'Download File', 'link' => ['controller' => 'Files', 'action' => 'get', $file->id], 'linkOptions' => ['download' => (\Cake\Utility\Text::slug(strtolower($file->name)) . '.' . $file->file_extension)]]); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-link', 'text' => 'Attach', 'link' => ['controller' => 'Files', 'action' => 'attach', $file->id]]); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-unlink', 'text' => 'Detach', 'link' => ['controller' => 'Files', 'action' => 'detach', $file->id, (!empty($node->id) ? $node->id : null)]]); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-edit', 'text' => 'Edit File', 'link' => ['controller' => 'Files', 'action' => 'edit', $file->id, (!empty($node->id) ? $node->id : null)]]); ?>
    <?php if($file->isCompressed()): ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-archive', 'text' => 'Extract File', 'link' => ['controller' => 'Files', 'action' => 'extract', (!empty($node->id) ? $node->id : null)]]); ?>
    <?php endif; ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-trash', 'text' => 'Delete File', 'postLink' => ['action' => 'delete', $file->id, (!empty($node->id) ? $node->id : null)], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $file->name)]]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <h1 class="title is-1"><?php echo __('Detach File from Node'); ?></h1>

    <?php if(!empty($node)): ?>
        <div class="modal is-active" id="confirmAdoption">
            <div class="modal-background"></div>
            <div class="modal-content">
                <article class="message is-primary" style="margin: 1em;">
                    <div class="message-header">
                        <?php echo __('Detach from "{0}"?', $node->name); ?>
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

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$nodes, $file) {
        foreach($nodes as $node) {
            $entry = new stdClass;
            $entry->title = $node->name;
            $entry->subtitle = $node->created;
            $entry->icon = 'fa-book';
            $entry->href = $this->Url->build(['action' => 'detach', $file->id, $node->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
