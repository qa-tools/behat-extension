<?php
/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace evangelion1204\behat\pages;

use QATools\QATools\HtmlElements\TypifiedPage;
use QATools\QATools\PageObject\Element\WebElement;

/**
 * Class TestPage
 *
 * @page-url('http://test.qa-tools.io/tests/aik099/QATools/HtmlElementsLive/Element/')
 */
class TestPage extends TypifiedPage
{

	/**
	 * Input elements.
	 *
	 * @var WebElement
	 * @find-by('css' => '[name*=test]')
	 */
	protected $inputs;

	/**
	 * Test function.
	 *
	 * @return void
	 */
	public function enter()
	{
		$this->inputs->click();

		foreach ( $this->inputs as $input ) {
			$input->click();
		}
	}

}
