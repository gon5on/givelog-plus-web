<?php

/**
 * This file is part of TwigView.
 *
 ** (c) 2015 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WyriHaximus\CakePHP\Tests\TwigView\Lib;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\TestSuite\TestCase;
use WyriHaximus\TwigView\Lib\TreeScanner;

/**
 * Class TreeScannerTest
 * @package WyriHaximus\CakePHP\Tests\TwigView\Lib\Twig
 */
class TreeScannerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Configure::write(
            'App',
            [
                'paths' => [
                    'templates' => [
                        PLUGIN_REPO_ROOT . 'tests' . DS . 'test_app' . DS . 'Template' . DS,
                    ],
                ]
            ]
        );

        $this->deprecated(function () {
            Plugin::load(
                'TestTwigView',
                [
                    'path' => PLUGIN_REPO_ROOT . 'tests' . DS . 'test_app' . DS . 'Plugin' . DS . 'TestTwigView' . DS,
                ]
            );
            Plugin::load(
                'TestTwigViewEmpty',
                [
                    'path' => PLUGIN_REPO_ROOT . 'tests' . DS . 'test_app' . DS . 'Plugin' . DS . 'TestTwigViewEmpty' . DS,
                ]
            );
        });
    }

    public function tearDown()
    {
        $this->deprecated(function () {
            Plugin::unload('TestTwigView');
        });

        parent::tearDown();
    }

    public function testAll()
    {
        $this->assertEquals([
            'APP' => [
                3 => 'exception.twig',
                4 => 'layout.twig',
                5 => 'syntaxerror.twig',
                'Blog' => [
                    'index.twig',
                ],
                'Element' => [
                    'element.twig',
                ],
                'Layout' => [
                    'layout.twig',
                ],
            ],
            'TestTwigView' => [
                3 => 'twig.twig',
                'Controller' => [
                    'Component' => [
                        'magic.twig',
                    ],
                    'index.twig',
                    'view.twig',
                ],
            ],
            'Bake' => TreeScanner::plugin('Bake'),
        ], TreeScanner::all());
    }

    public function testPlugin()
    {
        $this->assertSame([
            3 => 'twig.twig',
            'Controller' => [
                'Component' => [
                    'magic.twig',
                ],
                'index.twig',
                'view.twig',
            ],
        ], TreeScanner::plugin('TestTwigView'));
    }
}
