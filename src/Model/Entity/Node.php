<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

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
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'parent_node' => true,
        'node_comments' => true,
        'child_nodes' => true,
        'files' => true
    ];
}
