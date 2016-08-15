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
class CropTask extends InterventionImageTask
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
        $parser->description(
            __d('CakeInterventionImage', 'Cut out a rectangular part of the current image with given <bold>width</bold> and <bold>height</bold>.' .
                                    ' Define optional <bold>x,y coordinates</bold> to move the top-left corner of the cutout to a certain position.')
        );
        $parser->addArgument('width', [
            'help' => __d('CakeInterventionImage', 'Width of the rectangular cutout.')
        ])->addArgument('height', [
            'help' => __d('CakeInterventionImage', 'Height of the rectangular cutout.')
        ])->addOption('x', [
            'help' => __d('CakeInterventionImage', 'X-Coordinate of the top-left corner if the rectangular cutout. By default the rectangular part will be centered on the current image.')
        ])->addOption('y', [
            'help' => __d('CakeInterventionImage', 'Y-Coordinate of the top-left corner if the rectangular cutout. By default the rectangular part will be centered on the current image.')
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
        $width = $this->args['width'];
        $height = $this->args['height'];
        $x = (isset($this->params['x'])) ? isset($this->params['x']) : null;
        $y = (isset($this->params['y'])) ? isset($this->params['y']) : null;

        $this->execute(function ($img) use($width, $height, $x, $y) {
            $img->crop($width, $height, $x, $y);
        });
    }

}
