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
class RotateTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Rotate the current image counter-clockwise by a given <bold>angle</bold>.'.
                                    ' Optionally define a <bold>background color</bold> for the uncovered zone after the rotation.')
        );
        $parser->addArgument('angle', [
            'help' => __d('CakeInterventionImage', 'The rotation angle in degrees to rotate the image counter-clockwise.')
        ])->addOption('bgcolor', [
            'help' => __d('CakeInterventionImage', 'A background color for the uncovered zone after the rotation. The background color can be passed in in different color formats. Default: #000000'),
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
        $angle = $this->args['angle'];
        $bgColor = $this->params['bgcolor'];

        $this->execute(function ($img) use($angle, $bgColor) {
            $img->rotate($angle, $bgColor);
        });
    }

}
