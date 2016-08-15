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
class PixelateTask extends InterventionImageTask
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
        $parser->description(__d('CakeInterventionImage', 'Applies a pixelation effect to the current image with a given <bold>size</bold> of pixels.'));
        $parser->addArgument('size', [
            'help' => __d('CakeInterventionImage', 'Size of the pixels.')
        ]);
        return $parser;
    }

    /**
     *
     *
     * @return void
     */
    public function main()
    {
        $size = $this->args['size'];

        $this->execute(function ($img) use($size) {
            $img->pixelate($size);
        });
    }

}
