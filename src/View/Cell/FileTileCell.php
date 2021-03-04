<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\File;

use InvalidArgumentException;

/**
 * FileTile cell
 */
class FileTileCell extends Cell
{
    /**
     * File methods to determine icon. 
     */
    const CALLABLE_ICON_MAP = [
        'isCompressed' => 'fa-file-archive',
        'isImage' => 'fa-file-image',
        'isPdf' => 'fa-file-pdf',
        'isText' => 'fa-file-alt',
        'isAudio' => 'fa-file-audio',
        'isVideo' => 'fa-file-video',
    ];

    /**
     * Default File Icon. 
     */
    const DEFAULT_ICON = 'fa-file';

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
     * Get Icon for a File.
     * 
     * @param File The File. 
     * @param array Optional. <span> classes.
     * @param array Optional. <i> classes. 
     * 
     * @return void
     */
    public function icon(File $file, array $spanClasses = [], array $iconClasses = [])
    {
        $icon = self::DEFAULT_ICON;

        foreach (self::CALLABLE_ICON_MAP as $method => $i) {
            if (method_exists($file, $method) && $file->{$method}()) {
                $icon = $i; 
                break;
            }
        }

        $spanClasses = implode(' ', array_map('trim', $spanClasses));
        $iconClasses = implode(' ', array_map('trim', $iconClasses));

        $this->set(compact('icon', 'spanClasses', 'iconClasses'));
    }

    /**
     * Default display method.
     * 
     * @param File The file to Display in the tile. 
     * @param string Optional. Link text.
     * @param array Optional, required for link to display. URL Array.
     * @param bool If the link should be a POST instead of a GET. Default false. 
     *
     * @return void
     */
    public function display(File $file, string $linkName = null, array $linkUrl = null, bool $postLink = false)
    {
        $this->set(compact('file', 'linkName', 'linkUrl', 'postLink'));
    }

    /**
     * Tesselate a collection of Files. 
     * 
     * @param Traversable|array must yield or contain File classes. 
     * @param int Column count; Max 12. 
     * @param string Optional. Link text. Passed to Cake's __() function, with {0} being the file name. 
     * @param callable Optional. Function that is passed each File instance, and must return a URL array. 
     * @param bool Optional. True to make into a post link. Defaults to false. 
     * 
     * @return void
     */
    public function tesselate($t, int $columns = 4, string $linkName = 'View {0}', callable $linkGenerator = null, bool $postLink = false)
    {
        if (!is_array($t) && !($t instanceof \Traversable)) {
            throw new InvalidArgumentException('Not an array or traversable object!');            
        }

        if (empty($linkGenerator)) {
            $linkGenerator = function (File $file): array {
                // Default to the File View. 
                return ['controller' => 'files', 'action' => 'view', $file->id];
            };
        }

        $collected = collection($t);
        $columns = ($columns % 12); // Max 12 columns. 

        $files = $collected->filter(function ($f) {
            return $f instanceof File;
        });

        $grouped = $files->reduce(function ($carry, $v, $k) use (&$columns) {          
            $carry[($k) % $columns][] = $v;
    
            return $carry;
        }, []);

        $this->set(compact('grouped', 'columns', 'linkName', 'linkGenerator', 'postLink'));
    }
}
