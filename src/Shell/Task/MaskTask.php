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
class MaskTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Apply a given <bold>image source</bold> as alpha mask to the current image to change current opacity.' .
                                    ' Mask will be resized to the current image size.' .
                                    ' By default a greyscale version of the mask is converted to alpha values, but you can set <bold>mask_with_alpha</bold> to apply the actual alpha channel' .
                                    ' Any transparency values of the current image will be maintained.')
        );
        $parser->addArgument('mask_src', [
            'help' => __d('CakeInterventionImage', 'The image source that will be applied as alpha mask.'),
        ])->addOption('mask_with_alpha', [
            'help' => __d('CakeInterventionImage', 'Set this to true to apply the actual alpha channel as mask to the current image instead of the color values. '),
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
        $maskSrcFile = $this->args['mask_src'];
        $maskWithAlpha = $this->params['mask_with_alpha'];

        $this->execute(function ($img) use($maskSrcFile, $maskWithAlpha) {
            $img->mask($maskSrcFile, $maskWithAlpha);
        });
    }

}
