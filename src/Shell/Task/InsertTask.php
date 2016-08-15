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
class InsertTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Paste a given <bold>image source</bold> over the current image with an optional <bold>position</bold> and a <bold>offset coordinate</bold>.'.
                                    'This method can be used to apply another image as watermark because the transparency values are maintained.')
        );
        $parser->addArgument('watermark', [
            'help' => __d('CakeInterventionImage', 'This method can be used to apply another image as watermark because the transparency values are maintained.')
        ])->addOption('position', [
            'help' => __d('CakeInterventionImage', 'Set a position where image will be inserted. For example if you are setting the anchor to bottom-left the image will be positioned at the bottom-left border of the current image. The position of the new image will be calculated relatively to this location.'),
            'default' => 'top-left',
            'choices' => [
                'top-left',
                'top',
                'top-right',
                'left',
                'center',
                'right',
                'bottom-left',
                'bottom',
                'bottom-right'
            ]
        ])->addOption('x', [
            'help' => __d('CakeInterventionImage', 'Optional relative offset of the new image on x-axis of the current image. Offset will be calculated relative to the position parameter. Default: 0'),
            'default' => 0
        ])->addOption('y', [
            'help' => __d('CakeInterventionImage', 'Optional relative offset of the new image on y-axis of the current image. Offset will be calculated relative to the position parameter. Default: 0'),
            'default' => 0
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
        $watermark = $this->args['watermark'];
        $position = $this->params['position'];
        $x = $this->params['x'];
        $y = $this->params['y'];

        $this->execute(function ($img) use($watermark, $position, $x, $y) {
            $img->insert($watermark, $position, $x, $y);
        });
    }

}
