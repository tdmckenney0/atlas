<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File as CakeFile;
use Cake\Filesystem\Folder;
use App\Model\Entity\Traits\LazyLoad;

/**
 * NodeComment Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $node_id
 * @property string $parent_id
 * @property int $lft
 * @property int $rght
 * @property string|null $body
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Node $node
 * @property \App\Model\Entity\NodeComment $parent_node_comment
 * @property \App\Model\Entity\NodeComment[] $child_node_comments
 */
class NodeComment extends Entity
{
    /**
     * Lazy Loader!
     */
    use LazyLoad;

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
        'user_id' => true,
        'node_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'body' => true,
        'user' => true,
        'node' => true,
        'parent_node_comment' => true,
        'child_node_comments' => true
    ];

    /**
     * consolidate
     *
     * Grabs all child comments and concatenates them together into a single text string.
     *
     * @return String
     */
    public function consolidate()
    {
        static $node_comments;

        if(!($node_comments instanceof App\Model\Table\NodeCommentsTable)) {
            $node_comments = TableRegistry::getTableLocator()->get('NodeComments');
        }

        $node_comments->loadInto($this, ['ChildNodeComments', 'Users']);

        $buffer = $this->user->email . ': "' . trim($this->body) . '"' . PHP_EOL;

        $level = $node_comments->behaviors()->Tree->getLevel($this);

        foreach ($this->child_node_comments as $child) {
            $buffer .= str_repeat("\t", $level + 1) . $child->consolidate();
        }

        return $buffer;
    }
}
