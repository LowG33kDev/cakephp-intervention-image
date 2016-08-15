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
class ResizeTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Resizes current image based on given <bold>width</bold> and/or <bold>height</bold>.'.
                                    'To constraint the resize command, pass an optional Closure <bold>callback</bold> as third parameter.')
        );
        $parser->addArgument('width', [
            'help' => __d('CakeInterventionImage', 'The new width of the image.')
        ])->addArgument('height', [
            'help' => __d('CakeInterventionImage', 'The new height of the image.')
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
        $width = ($this->args['width'] == 0) ? null : $this->args['width'];
        $height = ($this->args['height'] == 0) ? null : $this->args['height'];
        $aspectRatio = $this->params['aspect_ratio'];
        $upsize = $this->params['upsize'];

        $this->execute(function ($img) use($width, $height, $aspectRatio, $upsize) {
            $img->resize($width, $height, function ($constraint) use ($aspectRatio, $upsize) {
                if ($aspectRatio) {
                    $constraint->aspectRatio();
                }
                if ($upsize) {
                    $constraint->upsize();
                }
            });
        });
    }

}
