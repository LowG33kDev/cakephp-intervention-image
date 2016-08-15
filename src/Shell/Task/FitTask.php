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
class FitTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Combine cropping and resizing to format image in a smart way.'.
                                    ' The method will find the best fitting aspect ratio of your given <bold>width and height<bold>'.
                                    ' on the current image automatically, cut it out and resize it to the given dimension.'.
                                    ' You may pass an optional Closure <bold>callback</bold> as third parameter,'.
                                    ' to prevent possible upsizing and a custom <bold>position</bold> of the cutout as fourth parameter.')
        );
        $parser->addArgument('width', [
            'help' => __d('CakeInterventionImage', 'The width the image will be resized to after cropping out the best fitting aspect ratio.')
        ])->addOption('height', [
            'help' => __d('CakeInterventionImage', 'The height the image will be resized to after cropping out the best fitting aspect ratio. If no height is given, method will use same value as width.')
        ])->addOption('position', [
            'help' => __d('CakeInterventionImage', 'Set a position where cutout will be positioned. By default the best fitting aspect ration is centered.'),
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
        ])->addOption('aspect_ratio', [
            'help' => __d('CakeInterventionImage', 'Constraint the current aspect-ratio if the image.'),
            'boolean' => true
        ])->addOption('upsize', [
            'help' => __d('CakeInterventionImage', 'Keep image from being upsized.'),
            'boolean' => true
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
        $height = (isset($this->params['height'])) ? $this->params['height'] : null;
        $position = $this->params['position'];
        $aspectRatio = $this->params['aspect_ratio'];
        $upsize = $this->params['upsize'];

        $this->execute(function ($img) use($width, $height, $aspectRatio, $upsize, $position) {
            $img->fit($width, $height, function ($constraint) use ($aspectRatio, $upsize){
                if ($aspectRatio) {
                    $constraint->aspectRatio();
                }
                if ($upsize) {
                    $constraint->upsize();
                }
            }, $position);
        });
    }

}
