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
     * Absolute path to file storage.
     */
    const THUMBNAILS = (self::STORAGE . DS . 'thumbnails' . DS);

    /**
     * Image Types that can be displayed by a web browser.
     */
    const DISPLAYABLE_IMAGES = [
        'image/jpeg',
        'image/webp',
        'image/gif',
        'image/png',
        'image/tiff',
        'image/tiff-fx',
        'image/bmp',
        'image/x-bmp',
        'image/x-icon',
        'image/apng',
    ];

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

    public function isImageEmbeddable()
    {
        return in_array($this->mime_type, self::DISPLAYABLE_IMAGES);
    }

    public function isText()
    {
        return (strpos($this->mime_type, 'text/') !== false);
    }

    public function isCSV()
    {
        return $this->isText() && ($this->file_extension == 'csv');
    }

    public function isAudio()
    {
        return (strpos($this->mime_type, 'audio/') !== false);
    }

    public function isVideo()
    {
        return (strpos($this->mime_type, 'video/') !== false);
    }

    public function isPdf()
    {
        return $this->mime_type === 'application/pdf' && substr($this->magic, 0, 4) == '%PDF';
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

    public function getThumbnail()
    {
        $thumbnail = new CakeFile(self::THUMBNAILS . $this->id . '.jpg', false);

        if (!$thumbnail->exists()) {
            $thumbnail->create();
            $image = null;

            switch($this->mime_type) {

                case 'image/png':
                    $image = imagecreatefrompng($this->openFile()->path);
                    break;

                case 'image/jpeg':
                    $image = imagecreatefromjpeg($this->openFile()->path);
                    break;

                case 'image/gif':
                    $image = imagecreatefromgif($this->openFile()->path);
                    break;

                case 'image/bmp':
                case 'image/x-bmp':
                    $image = imagecreatefrombmp($this->openFile()->path);
                    break;
            }

            if (!empty($image)) {
                $size = getimagesize($this->openFile()->path);
                imagejpeg($image, $thumbnail->path, 25);
                imagedestroy($image);
            } else {
                return $this->openFile();
            }
        }

        return $thumbnail;
    }

    /**
     * Can this file be embedded in the browser? 
     * 
     * @return bool
     */
    public function canEmbed(): bool
    {
        return $this->isImageEmbeddable() || $this->isText() || $this->isAudio() || $this->isVideo(); 
    }
}
