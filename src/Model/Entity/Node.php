<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Node Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ParentNode $parent_node
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
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'parent_node' => true,
        'child_nodes' => true,
        'files' => true
    ];
}
