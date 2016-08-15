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
class ContrastTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Changes the contrast of the current image by the given <bold>level</bold>.'.
                                    ' Use values between -100 for min. contrast 0 for no change and +100 for max. contrast.')
        );
        $parser->addArgument('level', [
            'help' => __d('CakeInterventionImage', 'Level of contrast change applied to the current image. Use values between -100 and +100.'),
            'short' => 'l'
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
        $level = $this->args['level'];

        if ($level < -100 || $level > 100) {
            $this->abort(__d('CakeInterventionImage', 'Level must be between -100 and 100.'), 1);
        }

        $this->execute(function ($img) use($level) {
            $img->contrast($level);
        });
    }

}
