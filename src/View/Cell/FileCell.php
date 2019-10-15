<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\File;

/**
 * File cell
 */
class FileCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display(File $file, string $template = null)
    {
        if (empty($template)) {
            if($file->isImageEmbeddable()) {
                $template = 'image';
            } else if ($file->isAudio()) {
                $template = 'audio';
            } else if ($file->isVideo()) {
                $template = 'video';
            } else if ($file->isCSV()) {
                $template = 'csv';
            } else {
                $template = 'display';
            }
        }

        $this->viewBuilder()->setTemplate($template);
        $this->set('file', $file);
    }
}
