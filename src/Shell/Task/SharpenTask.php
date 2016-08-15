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
class SharpenTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Sharpen current image with an optional <bold>amount</bold>. Use values between 0 and 100.')
        );
        $parser->addOption('amount', [
            'help' => __d('CakeInterventionImage', 'The amount of the sharpening strength. Method accepts values between 0 and 100. Default: 10'),
            'default' => 10,
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
            $img->sharpen($amount);
        });
    }

}
