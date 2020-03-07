<?php

/**
 * This file is part of TwigView.
 *
 ** (c) 2014 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WyriHaximus\CakePHP\Tests\TwigView\Event;

use Cake\TestSuite\TestCase;
use Phake;
use WyriHaximus\TwigView\Event\ConstructEvent;
use WyriHaximus\TwigView\Event\ProfilerListener;

/**
 * Class ProfilerListenerTest
 * @package WyriHaximus\CakePHP\Tests\TwigView\Event
 */
class ProfilerListenerTest extends TestCase
{

	public function testImplementedEvents()
	{
		$eventsList = (new ProfilerListener)->implementedEvents();
		$this->assertInternalType('array', $eventsList);
		$this->assertSame(1, count($eventsList));
	}

	public function testConstruct()
	{
		$twig = Phake::mock('\Twig_Environment');

		$twigView = Phake::mock('WyriHaximus\TwigView\View\TwigView');
		(new ProfilerListener())->construct(ConstructEvent::create($twigView, $twig));

		Phake::verify($twig, Phake::atLeast(1))->addExtension($this->isInstanceOf('\Twig_Extension'));
	}

}