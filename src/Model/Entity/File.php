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
     * File Object.
     */
    private $File = null;

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

    public function isCSV() {
        return $this->isText() && ($this->file_extension == 'csv');
    }

    public function readlineCSV(int $length = 0, string $delimiter = ",", string $enclosure = '"', string $escape = "\\") {
        return fgetcsv($this->openFile()->handle, $length, $delimiter, $enclosure, $escape);
    }

    public function readline(int $length = 0) {
        return fgets($this->openFile()->handle, $length);
    }

    protected function openFile() {
        if(empty($this->File)) {
            $this->File = new CakeFile(self::STORAGE . $this->id . '.' . $this->file_extension, false);
            $this->File->open();
        }
        return $this->File;
    }

    protected function _getFile()
    {
        return $this->openFile();
    }
}
