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
    public function display(File $file)
    {
        $this->set('file', $file);
    }

    /**
     *
     */
    public function image(File $file)
    {
        $this->set('file', $file);
    }

    /**
     *
     */
    public function csv(File $file)
    {
        $this->set('file', $file);
    }

    /**
     *
     */
    public function audio(File $file)
    {
        $this->set('file', $file);
    }
}
