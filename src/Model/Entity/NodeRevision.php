<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodeRevision Entity
 *
 * @property string $id
 * @property string $node_id
 * @property string|null $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Node $node
 * @property \App\Model\Entity\ParentNodeRevision $parent_node_revision
 * @property \App\Model\Entity\ChildNodeRevision[] $child_node_revisions
 */
class NodeRevision extends Entity
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
        'node_id' => true,
        'user_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'node' => true,
        'parent_node_revision' => true,
        'child_node_revisions' => true
    ];
}
