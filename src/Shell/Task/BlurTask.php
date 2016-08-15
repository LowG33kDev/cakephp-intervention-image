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
class BlurTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Apply a gaussian blur filter with a optional <bold>amount</bold> on the current image.'.
                                    ' Use values between 0 and 100.'.
            "\n\n".
                                    '<bold>Note: Performance intensive on larger amounts of blur with GD driver. Use with care.</bold>')
        );
        $parser->addOption('amount', [
            'help' => __d('CakeInterventionImage', 'The amount of the blur strength. Use values between 0 and 100. Default: 1'),
            'default' => 1,
            'short' => 'a'
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
        $amount = $this->params['amount'];

        if ($amount < 0 || $amount > 100) {
            $this->abort(__d('CakeInterventionImage', 'Amount must be between 0 and 100.'), 1);
        }

        $this->execute(function ($img) use($amount) {
            $img->blur($amount);
        });
    }

}
