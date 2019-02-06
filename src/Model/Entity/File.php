<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Filesystem\File as CakeFile;
/**
 * File Entity
 *
 * @property string $id
 * @property string $name
 * @property string $file_extension
 * @property string $mime_type
 *
 * @property \App\Model\Entity\Node[] $nodes
 */
class File extends Entity
{
    /**
     * Absolute path to file storage.
     */
    const STORAGE = (ROOT . DS . 'files' . DS);
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
        'id' => true,
        'name' => true,
        'file_extension' => true,
        'mime_type' => true,
        'nodes' => true
    ];

    public function isImage() {
        return (strpos($this->mime_type, 'image/') !== false);
    }

    public function isText() {
        return (strpos($this->mime_type, 'text/') !== false);
    }

    protected function _getFile()
    {
        return new CakeFile(self::STORAGE . $this->id . '.' . $this->file_extension, false);
    }
}
