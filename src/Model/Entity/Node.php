<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File as CakeFile;
use Cake\Filesystem\Folder;

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
     * _getTable
     *
     * Gets the Table object for this Entity.
     *
     * @return App\Model\Table\NodesTable
     */
    protected function _getTable()
    {
        return TableRegistry::getTableLocator()->get('Nodes');
    }

    /**
     * lazyLoad
     *
     * @param Array An array to feed into App\Model\Table\NodesTable::loadInto's second arg.
     *
     * @return EntityInterface|array
     */
    public function lazyLoad(Array $contain = [])
    {
        return $this->_getTable()->loadInto($this, $contain);
    }

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
}
