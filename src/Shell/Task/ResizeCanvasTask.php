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
class ResizeCanvasTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Resize the boundaries of the current image to given <bold>width</bold> and/or <bold>height</bold>.'.
                                    'An <bold>anchor</bold> can be defined to determine from what point of the image the resizing is going to happen.' .
                                    ' Set the mode to <bold>relative</bold> to add or subtract the given width or height to the actual image dimensions.' .
                                    ' You can also pass a <bold>background</bold> color for the emerging area of the image.')
        );
        $parser->addArgument('width', [
            'help' => __d('CakeInterventionImage', 'The new width in pixels of the image in absolute mode or the amount of pixels to add or subtract from height in relative mode.')
        ])->addArgument('height', [
            'help' => __d('CakeInterventionImage', 'The new height in pixels of the image in absolute mode or the amount of pixels to add or subtract from height in relative mode.')
        ])->addOption('anchor', [
            'help' => __d('CakeInterventionImage', 'Set a point from where the image resizing is going to happen. For example if you are setting the anchor to bottom-left this side is pinned and the values of width/height will be added or subtracted to the top-right corner of the image.'),
            'default' => 'center',
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
        ])->addOption('relative', [
            'help' => __d('CakeInterventionImage', 'Determine that the resizing is going to happen in relative mode. Meaning that the values of width or height will be added or substracted from the current height of the image.'),
            'boolean' => true
        ])->addOption('bgcolor', [
            'help' => __d('CakeInterventionImage', 'A background color for the new areas of the image. The background color can be passed in in different color formats.'),
            'default' => '#000000'
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
        $width = ($this->args['width'] == 0) ? null : $this->args['width'];
        $height = ($this->args['height'] == 0) ? null : $this->args['height'];
        $anchor = $this->params['anchor'];
        $relative = $this->params['relative'];
        $bgcolor = $this->params['bgcolor'];

        $this->execute(function ($img) use($width, $height, $anchor, $relative, $bgcolor) {
            $img->resizeCanvas($width, $height, $anchor, $relative, $bgcolor);
        });
    }

}
