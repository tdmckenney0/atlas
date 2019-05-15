<?php

namespace App\View;

use Cake\View\View;

class MarkdownView extends View
{
    /**
     * Log Path
     */
    const LOG_PATH = LOGS . DS . 'pandoc.log';

    /**
     * Default Pandoc Options
     */
    const PANDOC_MARGIN = '0.5in';
    const PANDOC_DOC_CLASS = 'report';

    /**
     * Pandoc Command
     */
    const PANDOC_COMMAND = 'PATH=/usr/bin: pandoc -V documentclass:%s -V geometry:margin=%s --toc -f markdown -o %s';

    /**
     * JSON views are located in the 'json' sub directory for controllers' views.
     *
     * @var string
     */
    protected $subDir = 'markdown';

    /**
     * The name of the layout file to render the view inside of. The name
     * specified is the filename of the layout in /src/Template/Layout without
     * the .ctp extension.
     *
     * @var string
     */
    public $layout = 'markdown';

    public function render($view = null, $layout = null)
    {
        $body = parent::render($view, $layout);
        $ext = $this->request->getParam('_ext');
        $file = TMP . time() . rand() . '.' . $ext;
        $pipes = [];

        $cmd = sprintf(self::PANDOC_COMMAND, self::PANDOC_DOC_CLASS, self::PANDOC_MARGIN, $file);

        $res = proc_open($cmd, [
            ["pipe", "r"],
            ["pipe", "w"],
            ["file", self::LOG_PATH, 'a']
        ], $pipes, TMP);

        if(is_resource($res)) {

            fwrite($pipes[0], $body);

            fclose($pipes[0]);
            fclose($pipes[1]);

            proc_close($res);

            if(file_exists($file)) {
                $rendered = file_get_contents($file);

                unlink($file);

                $this->response->withType($ext);

                return $rendered;
            }
        }
    }
}
