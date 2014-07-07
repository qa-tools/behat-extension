<?php
/*
 * This file is part of BehatExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace tests\QATools\BehatExtension;


use Behat\Mink\Mink;
use Mockery as m;
use QATools\BehatExtension\QATools;

class QAToolsTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * QATools instance.
	 *
	 * @var QATools
	 */
	protected $qaTools;

	/**
	 * Mink instance.
	 *
	 * @var Mink
	 */
	protected $mink;

	protected function setUp()
	{
		parent::setUp();

		$this->mink = m::mock('\\Behat\\Mink\\Mink[getSession,stopSessions]');
		$this->mink->shouldReceive('stopSessions')->andReturnNull();
		$this->mink->shouldReceive('getSession')->andReturnNull();
	}

	/**
	 * @dataProvider getPageDataProvider
	 */
	public function testGetPage($name, $class_with_namespace, $config)
	{
		$page_factory = m::mock('\\QATools\\QATools\\PageObject\\IPageFactory');

		$this->qaTools = m::mock('\\QATools\\BehatExtension\\QATools[createPageFactory]', array($this->mink, $config));
		$this->qaTools->shouldReceive('createPageFactory')->once()->andReturn($page_factory);

		$this->qaTools->init();

		$page_factory->shouldReceive('getPage')->with($class_with_namespace)->once()->andReturn(true);

		$this->assertEquals(true, $this->qaTools->getPage($name));
	}

	public function getPageDataProvider()
	{
		return array(
			array('TestPage', 'TestPage', array()),
			array(
				'TestPage',
				'\\QATools\\behat\\pages\\TestPage',
				array(
					'namespace' => array(
						'pages' => 'QATools\\behat\\pages',
					),
				),
			),
		);
	}

}
