<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         1.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace CakeInterventionImage\Shell;

use Cake\Console\Shell;
use Cake\Utility\Inflector;

/**
 *
 */
class InterventionImageShell extends Shell
{

    /**
     * Contains tasks to load and instantiate
     *
     * @var array
     * @link http://book.cakephp.org/3.0/en/console-and-shells.html#Shell::$tasks
     */
    public $tasks = [
        'CakeInterventionImage.Blur',
        'CakeInterventionImage.Brightness',
        'CakeInterventionImage.Colorize',
        'CakeInterventionImage.Contrast',
        'CakeInterventionImage.Crop',
        'CakeInterventionImage.Fit',
        'CakeInterventionImage.Flip',
        'CakeInterventionImage.Gamma',
        'CakeInterventionImage.Greyscale',
        'CakeInterventionImage.Insert',
        'CakeInterventionImage.Interlace',
        'CakeInterventionImage.Invert',
        'CakeInterventionImage.Mask',
        'CakeInterventionImage.Opacity',
        'CakeInterventionImage.Pixelate',
        'CakeInterventionImage.Resize',
        'CakeInterventionImage.ResizeCanvas',
        'CakeInterventionImage.Rotate',
        'CakeInterventionImage.Sharpen'
    ];

    /**
     *
     *
     *  @return void
     */
    public function main()
    {
        $this->out(__d('CakeInterventionImage', 'The following commands can be used to modify pictures.'), 2);
        $this->info(__d('CakeInterventionImage', 'This is a wrapper for library Intervention (http://image.intervention.io)'));
        $data = [
            ['', '    JPEG', '    PNG', '    GIF', '    TIF', '    BMP', '    ICO', '    PSD'],
            ['GD', 'Read/Write', 'Read/Write', 'Read/Write', '     -', '     -', '     -', '     -'],
            ['Imagick', 'Read/Write', 'Read/Write', 'Read/Write', 'Read/Write', 'Read/Write', 'Read/Write', 'Read/Write'],
        ];
        $this->helper('Table')->output($data);
        $this->out('', 2);
        $this->info(__d('CakeInterventionImage', 'Available intervention commands:'), 2);
        $names = [];
        foreach ($this->tasks as $task => $t) {
            list(, $name) = pluginSplit($task);
            $names[] = Inflector::underscore($name);
        }
        sort($names);
        foreach ($names as $name) {
            $this->out('- ' . $name);
        }
        $this->out('');
        $this->out(__d('CakeInterventionImage', 'By using <info>`cake intervention [name]`</info> you can invoke a specific intervention task.'));
    }

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
        $parser->addSubcommand('blur', [
            'help' => __d('CakeInterventionImage', 'Apply a gaussian blur filter with a optional <bold>amount</bold> on the current image.'),
            'parser' => $this->Blur->getOptionParser(),
        ])->addSubcommand('brightness', [
            'help' => __d('CakeInterventionImage', 'Changes the brightness of the current image by the given <bold>level</bold>.'),
            'parser' => $this->Brightness->getOptionParser(),
        ])->addSubcommand('colorize', [
            'help' => __d('CakeInterventionImage', 'Change the RGB color values of the current image on the given channels <bold>red</bold>, <bold>green</bold> and <bold>blue</bold>.'),
            'parser' => $this->Colorize->getOptionParser(),
        ])->addSubcommand('contrast', [
            'help' => __d('CakeInterventionImage', 'Changes the contrast of the current image by the given <bold>level</bold>.'),
            'parser' => $this->Contrast->getOptionParser(),
        ])->addSubcommand('crop', [
            'help' => __d('CakeInterventionImage', 'Cut out a rectangular part of the current image with given <bold>width</bold> and <bold>height</bold>.'),
            'parser' => $this->Crop->getOptionParser(),
        ])->addSubcommand('fit', [
            'help' => __d('CakeInterventionImage', 'Combine cropping and resizing to format image in a smart way.'),
            'parser' => $this->Fit->getOptionParser(),
        ])->addSubcommand('flip', [
            'help' => __d('CakeInterventionImage', 'Mirror the current image horizontally or vertically by specifying the <bold>mode</bold>.'),
            'parser' => $this->Flip->getOptionParser(),
        ])->addSubcommand('gamma', [
            'help' => __d('CakeInterventionImage', 'Performs a gamma correction operation on the current image.'),
            'parser' => $this->Gamma->getOptionParser(),
        ])->addSubcommand('greyscale', [
            'help' => __d('CakeInterventionImage', 'Turns image into a greyscale version.'),
            'parser' => $this->Greyscale->getOptionParser(),
        ])->addSubcommand('insert', [
            'help' => __d('CakeInterventionImage', 'Paste a given <bold>image source</bold> over the current image with an optional <bold>position</bold> and a <bold>offset coordinate</bold>.'),
            'parser' => $this->Insert->getOptionParser(),
        ])->addSubcommand('interlace', [
            'help' => __d('CakeInterventionImage', 'Determine whether an image should be encoded in interlaced or standard mode.'),
            'parser' => $this->Interlace->getOptionParser(),
        ])->addSubcommand('invert', [
            'help' => __d('CakeInterventionImage', 'Reverses all colors of the current image.'),
            'parser' => $this->Invert->getOptionParser(),
        ])->addSubcommand('mask', [
            'help' => __d('CakeInterventionImage', 'Apply a given <bold>image source</bold> as alpha mask to the current image to change current opacity.'),
            'parser' => $this->Mask->getOptionParser(),
        ])->addSubcommand('opacity', [
            'help' => __d('CakeInterventionImage', 'Set the opacity in percent of the current image'),
            'parser' => $this->Opacity->getOptionParser(),
        ])->addSubcommand('pixelate', [
            'help' => __d('CakeInterventionImage', 'Applies a pixelation effect to the current image.'),
            'parser' => $this->Pixelate->getOptionParser(),
        ])->addSubcommand('resize', [
            'help' => __d('CakeInterventionImage', 'Resizes current image based on given <bold>width</bold> and/or <bold>height</bold>.'),
            'parser' => $this->Resize->getOptionParser(),
        ])->addSubcommand('resize_canvas', [
            'help' => __d('CakeInterventionImage', 'Resize the boundaries of the current image to given <bold>width</bold> and/or <bold>height</bold>.'),
            'parser' => $this->ResizeCanvas->getOptionParser(),
        ])->addSubcommand('rotate', [
            'help' => __d('CakeInterventionImage', 'Rotate the current image counter-clockwise by a given <bold>angle</bold>.'),
            'parser' => $this->Rotate->getOptionParser(),
        ])->addSubcommand('sharpen', [
            'help' => __d('CakeInterventionImage', 'Sharpen current image with an optional <bold>amount</bold>.'),
            'parser' => $this->Sharpen->getOptionParser(),
        ]);
        return $parser;
    }

}
