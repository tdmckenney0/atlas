<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodeComment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $node_id
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rght
 * @property string|null $body
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Node $node
 * @property \App\Model\Entity\ParentNodeComment $parent_node_comment
 * @property \App\Model\Entity\ChildNodeComment[] $child_node_comments
 */
class NodeComment extends Entity
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
}