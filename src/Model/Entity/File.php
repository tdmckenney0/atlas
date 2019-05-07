<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Filesystem\File as CakeFile;
use Cake\Filesystem\Folder;
/**
 * File Entity
 *
 * @property string $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
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
     *
     */
    private $magic = null;

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
        'created' => true,
        'modified' => true,
        'file_extension' => true,
        'mime_type' => true,
        'nodes' => true
    ];

    protected function openFile()
    {
        if(empty($this->File)) {
            $this->File = new CakeFile(self::STORAGE . $this->id . '.' . $this->file_extension, false);
            $this->File->open();
            $this->magic = $this->File->read(8);
        }
        return $this->File;
    }

    protected function _getFile()
    {
        return $this->openFile();
    }

    /**
     * unzip
     *
     * Unzips a Zip file to the tmp directory and returns a Folder object
     *
     * @param File - An initialized Cake\Filesystem\File object to the compressed file.
     * @param Folder - Option, the destination Cake\Filesystem\Folder object.
     *
     * @return Folder - The folder object from the second argument, or a temporary directory.
     */
    protected function unzip(Folder $destination = null)
    {
        if(empty($destination)) {
            $destination = new Folder(TMP . $this->File->name() . time(), true);
        }

        $zip = new \ZipArchive();

        \Cake\Log\Log::write('error', $destination->path);

        if($zip->open($this->File->path) === true) {
            $zip->extractTo($destination->path);
            $zip->close();
        }

        return $destination;
    }

    public function isCompressed()
    {
        return $this->isZip();
    }

    public function isZip()
    {
        $this->openFile();
        return (substr($this->magic, 0, 2) == 'PK' && $this->file_extension == 'zip');
    }

    public function isImage()
    {
        return (strpos($this->mime_type, 'image/') !== false);
    }

    public function isText()
    {
        return (strpos($this->mime_type, 'text/') !== false);
    }

    public function isCSV()
    {
        return $this->isText() && ($this->file_extension == 'csv');
    }

    public function readlineCSV(int $length = 0, string $delimiter = ",", string $enclosure = '"', string $escape = "\\")
    {
        return fgetcsv($this->openFile()->handle, $length, $delimiter, $enclosure, $escape);
    }

    public function readline(int $length = 0)
    {
        return fgets($this->openFile()->handle, $length);
    }

    public function getMagic()
    {
        return $this->magic;
    }

    public function decompress(Folder $destination = null)
    {
        if($this->isZip()) {
            return $this->unzip($destination);
        }
    }
}
