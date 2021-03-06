<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File as CakeFile;
use Cake\Filesystem\Folder;
use App\Model\Entity\Traits\LazyLoad;

/**
 * Node Entity
 *
 * @property string $id
 * @property string|null $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ParentNode $parent_node
 * @property \App\Model\Entity\NodeComment[] $node_comments
 * @property \App\Model\Entity\NodeRevision[] $node_revisions
 * @property \App\Model\Entity\ChildNode[] $child_nodes
 * @property \App\Model\Entity\File[] $files
 */
class Node extends Entity
{
    /**
     * Lazy Loader!
     */
    use LazyLoad;

    /**
     * Pandoc constants.
     */
    const PANDOC_LOG_PATH = LOGS . DS . 'pandoc.log';
    const PANDOC_MARGIN = '0.5in';
    const PANDOC_DOC_CLASS = 'report';
    const PANDOC_DOC_COMMAND = 'PATH=/usr/bin: pandoc -V documentclass:%s -V geometry:margin=%s --toc -f markdown -o %s';
    const PANDOC_HTML_COMMAND = 'pandoc -f markdown -t html';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'sort' => true,
        'print' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'parent_node' => true,
        'node_comments' => true,
        'node_revisions' => true,
        'child_nodes' => true,
        'files' => true
    ];

    /**
     * getLevel()
     *
     * Gets the current node's level in the tree.
     *
     * @return Int Level in the tree.
     */
    public function getLevel()
    {
        return $this->_getTable()->behaviors()->Tree->getLevel($this);
    }

    /**
     * gets the current nodes path
     *
     * @return array The path
     */
    public function getPath()
    {
        return $this->_getTable()->find('path', ['for' => $this->id]);
    }

    /**
     * consolidate
     *
     * Grabs all child nodes and files and concatenates them together into a single markdown stream.
     *
     * @return String [Markdown]
     */
    public function consolidate()
    {
        $this->lazyLoad(['Files', 'ChildNodes']);

        $level = $this->getLevel();

        $buffer = str_repeat('#', $level) . ' ' . trim($this->name) . PHP_EOL . PHP_EOL . trim($this->description) . PHP_EOL  . PHP_EOL;

        foreach ($this->files as $file) {
            if ($file->isImage() && $file->file_extension != 'psd') {
                $buffer .= sprintf('![%s](%s)', $file->name, $file->File->path) . PHP_EOL . PHP_EOL . PHP_EOL;
            }
        }

        foreach($this->child_nodes as $node) {
            if ($node->print) {
                $buffer .= $node->consolidate();
            }
        }

        return $buffer;
    }

    /**
     * toFolder
     *
     * Writes a node structure out to a folder.
     *
     * @return Folder
     */
    public function toFolder(Folder $target = null)
    {
        if(empty($target)) {
            $target = new Folder(TMP . $this->id, true);
        }

        $overview = new CakeFile($target->path . DS . 'overview.md', true);
        $overview->write($this->description);

        $this->lazyLoad([
            'Files',
            'ChildNodes',
            'NodeRevisions',
            'NodeComments' => [
                'conditions' => ['NodeComments.parent_id IS' => null]
            ]
        ]);

        foreach ($this->files as $file) {
            $file->File->copy($target->path . DS . $file->name . '.' . $file->file_extension, true);
        }

        foreach ($this->child_nodes as $node) {
            $node->toFolder(new Folder($target->path . DS . $node->name, true));
        }

        if (!empty($this->node_comments)) {

            $comments = new CakeFile($target->path . DS . 'comments.md', true);

            foreach ($this->node_comments as $comment) {
                $comments->write($comment->consolidate(), 'a');
            }
        }

        if (!empty($this->node_revisions)) {
            $revisions = new Folder($target->path . DS . 'revisions', true);

            foreach ($this->node_revisions as $revision) {
                $revisionFile = new CakeFile($revisions->path . DS . $revision->created->getTimestamp() . '.md', true);
                $revisionFile->write($revision->description);
            }
        }

        return $target;
    }

    /**
     * toZip
     *
     * Coverts the Node and children into a Zip file.
     *
     * @return CakeFile
     */
    public function toZip()
    {
        $zipFile = new CakeFile(TMP . $this->id . '.zip', false);
        $folder = $this->toFolder();

        if ($zipFile->exists()) {
            $zipFile->delete();
        }

        $logFile = LOGS . 'zip.log';
        $cmd = sprintf("cd %s; zip -r %s * 2>&1", $folder->pwd(), $zipFile->pwd());

        $result = shell_exec($cmd);

        file_put_contents($logFile, date('Y-m-d H:i:s') . ' $ ' . $cmd . PHP_EOL . $result . PHP_EOL, FILE_APPEND | LOCK_EX);

        $folder->delete();

        return $zipFile;
    }

    /**
     * toPdf
     * 
     * Generates a PDF from the node and its children.
     * 
     * @return CakeFile
     */
    public function toPdf()
    {
        $consolidated = $this->consolidate();
        $file = new CakeFile(TMP . $this->id . '.pdf', false);
        $pipes = [];

        $cmd = sprintf(self::PANDOC_DOC_COMMAND, self::PANDOC_DOC_CLASS, self::PANDOC_MARGIN, $file->path);

        $res = proc_open($cmd, [
            ["pipe", "r"],
            ["pipe", "w"],
            ["file", self::PANDOC_LOG_PATH, 'a']
        ], $pipes, TMP);

        if(is_resource($res)) {

            fwrite($pipes[0], $consolidated);

            fclose($pipes[0]);
            fclose($pipes[1]);

            proc_close($res);
        }

        return $file;
    }
}
