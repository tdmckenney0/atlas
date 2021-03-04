<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
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
    <section class="section box">
        <div class="content">
            <h1 class="title is-1"><?= h($file->name) ?></h1>
            <?php echo $this->cell('File', [$file]); ?>
        </div>

        <hr />

        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <?php echo $this->cell('Breadcrumb::fromNode', [$node]); ?>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                    <small class="text-muted"> <?= __('Created: ') . h($file->created) ?></small>&nbsp;
                    <small class="text-muted"> <?= __('Updated: ') . h($file->modified) ?></small>
                </div>
            </div>
        </nav>   
    </section>
</div>
