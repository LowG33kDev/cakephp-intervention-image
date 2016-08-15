<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         1.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace CakeInterventionImage\Shell\Task;

use Cake\Console\Shell;
use Cake\Filesystem\File;
use Intervention\Image\ImageManagerStatic as Image;

/**
 *
 */
class InterventionImageTask extends Shell
{

    /**
     * Initializes the Shell
     * acts as constructor for subclasses
     * allows configuration of tasks prior to shell execution
     *
     * @return void
     * @link http://book.cakephp.org/3.0/en/console-and-shells.html#Cake\Console\ConsoleOptionParser::initialize
     */
    public function initialize()
    {
        // Create bold style
        $this->_io->styles('bold', ['bold' => true]);
    }

    /**
     * Starts up the Shell and displays the welcome message.
     * Allows for checking and configuring prior to command or main execution
     *
     * Override this method if you want to remove the welcome information,
     * or otherwise modify the pre-command flow.
     *
     * @return void
     * @link http://book.cakephp.org/3.0/en/console-and-shells.html#Cake\Console\ConsoleOptionParser::startup
     */
    public function startup()
    {
        $args = [];
        foreach ($this->args as $v) {
            list($key, $value) = explode('=', $v);
            $args[$key] = $value;
        }
        $this->args = $args;

        return parent::startup();
    }

    /**
     * Displays a header for the shell
     *
     * @return void
     */
    protected function _welcome(){

    }

    /**
     * Gets the option parser instance and configures it.
     *
     * By overriding this method you can configure the ConsoleOptionParser before returning it.
     *
     * @return \Cake\Console\ConsoleOptionParser
     * @link http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('src', [
            'required' => true,
            'help' => 'Source file'
        ])->addOption('dest', [
            'help' => 'Destination file. Is required if your source is external source (from http source for example)'
        ])->addOption('driver', [
            'help' => 'Driver used to generate images',
            'default' => 'gd',
            'choices' => ['gd', 'imagick']
        ]);
        return $parser;
    }

    protected function execute(\Closure $callback)
    {
        $imgFilePath = '';
        $imgFile = null;
        $dest = $this->param('dest');
        $imgFileDest = null;

        if (strpos($this->args['src'], '/') === 0) { // absolute path from local file system
            $imgFile = new File($this->args['src']);
        } else if (strpos($this->args['src'], 'http') === 0) { // from web source
            if (ini_get('allow_url_fopen') || ini_get('allow_url_fopen') === 'Off') { // if url fopen not allow
                $this->abort(__d('CakeInterventionImage', 'Your php configuration not allowed to get external file. Use allow_url_fopen=On on your php.ini file.'), 1);
            }
            if ($dest === null) {
                $this->abort(__d('CakeInterventionImage', 'Destination path is required from external source.'), 1);
            }
            $imgFile = new File($this->args['src']);
        } else { // relative path from CakePhp ROOT folder
            $imgFile = new File(ROOT . DS . $this->args['src']);
        }

        if (is_string($imgFile)) {
            $imgFilePath = $imgFile;
        } else {
            if (!$imgFile->exists()) {
                $this->abort(__d('CakeInterventionImage', 'Files {0} not exists.', [$imgFile->pwd()]), 1);
            }
            $imgFilePath = $imgFile->path;
        }

        $img = Image::make($imgFilePath);
        $callback($img);

        if ($dest === null) { // generate destination filename
            $tmpDest = '';
            for($i = 1; $i <= 100; $i++) {
                $tmpDest = $imgFile->Folder->path . DS . $imgFile->name() . '(' . $i . ').' . $imgFile->ext();
                if (!(new File($tmpDest))->exists()) {
                    break;
                }
            }
            $dest = $tmpDest;
        } else {
            $dest = str_replace('{width}', $img->width(), $dest);
            $dest = str_replace('{height}', $img->height(), $dest);
        }

        $imgFileDest = new File($dest);
        if (empty($imgFileDest->ext())) {
            $imgFileDest = new File($dest . '.' . $imgFile->ext());
        }
        $img->save($imgFileDest->pwd());
    }
}
