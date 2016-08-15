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

/**
 *
 */
class GreyscaleTask extends InterventionImageTask
{

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
        $parser->description(__d('CakeInterventionImage', 'Turns image into a greyscale version.'));
        return $parser;
    }

    /**
     *
     *
     * @return void
     */
    public function main()
    {
        $this->execute(function ($img) {
            $img->greyscale();
        });
    }

}
