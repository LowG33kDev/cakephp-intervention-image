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
class FlipTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Mirror the current image horizontally or vertically by specifying the <bold>mode</bold>.')
        );
        $parser->addOption('mode', [
            'help' => __d('CakeInterventionImage', 'Specify the mode the image will be flipped. You can set h for horizontal (default) or v for vertical flip.'),
            'default' => 'h',
            'short' => 'm',
            'choices' => ['h', 'v']
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
        $mode = $this->params['mode'];

        $this->execute(function ($img) use($mode) {
            $img->flip($mode);
        });
    }

}
