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
class ColorizeTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Change the RGB color values of the current image on the given channels <bold>red</bold>, <bold>green</bold> and <bold>blue</bold>.'.
                                    ' The input values are normalized so you have to include parameters from 100'.
                                    ' for maximum color value 0 for no change and -100 to take out all the certain color on the image.')
        );
        $parser->addArgument('red', [
            'help' => __d('CakeInterventionImage', 'Add or take out a amount of red color on the image. Use values between -100 and +100.'),
            'short' => 'r'
        ])->addArgument('green', [
            'help' => __d('CakeInterventionImage', 'Add or take out a amount of green color on the image. Use values between -100 and +100.'),
            'short' => 'g'
        ])->addArgument('blue', [
            'help' => __d('CakeInterventionImage', 'Add or take out a amount of blue color on the image. Use values between -100 and +100.'),
            'short' => 'b'
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
        $red = $this->args['red'];
        $green = $this->args['green'];
        $blue = $this->args['blue'];

        if ($red < -100 || $red > 100) {
            $this->abort(__d('CakeInterventionImage', 'Red must be between -100 and 100.'), 1);
        }
        if ($green < -100 || $green > 100) {
            $this->abort(__d('CakeInterventionImage', 'Green must be between -100 and 100.'), 1);
        }
        if ($blue < -100 || $blue > 100) {
            $this->abort(__d('CakeInterventionImage', 'Blue must be between -100 and 100.'), 1);
        }

        $this->execute(function ($img) use($red, $green, $blue) {
            $img->colorize($red, $green, $blue);
        });
    }

}
