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
class InterlaceTask extends InterventionImageTask
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
            __d('CakeInterventionImage', 'Determine whether an image should be encoded in interlaced or standard mode by toggling <bold>interlace</bold> mode with a boolean parameter.'.
                                    ' If an JPEG image is set interlaced the image will be processed as a progressive JPEG.')
        );
        $parser->addOption('inactive', [
            'help' => __d('CakeInterventionImage', 'If interlace is set to boolean true the image will be encoded interlaced. If the parameter is set to false interlaced mode is turned off. Default: true'),
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
        $active = !$this->params['inactive'];

        $this->execute(function ($img) use($active) {
            $img->interlace($active);
        });
    }

}
