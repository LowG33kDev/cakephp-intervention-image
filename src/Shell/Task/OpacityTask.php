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
class OpacityTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Set the <bold>opacity</bold> in percent of the current image ranging from 100% for opaque and 0% for full transparency.'.
            "\n\n".
            '<info>Note: Performance intensive on larger images. Use with care.</info>')
        );
        $parser->addArgument('transparency', [
            'help' => __d('CakeInterventionImage', 'The new percent of transparency for the current image.')
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
        $transparency = $this->args['transparency'];

        if ($transparency < 0 || $transparency > 100) {
            $this->abort(__d('CakeInterventionImage', 'Transparency must be between 0 and 100.'), 1);
        }

        $this->execute(function ($img) use($transparency) {
            $img->opacity($transparency);
        });
    }

}
