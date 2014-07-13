<?php
/*
 * This file is part of BehatExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace pages;


use QATools\QATools\HtmlElements\TypifiedPage;
use QATools\QATools\PageObject\Element\WebElement;

/**
 * Class TestPage
 *
 * @page-url('/example/fixtures/')
 */
class TestPage extends TypifiedPage
{

	/**
	 * Input elements.
	 *
	 * @var WebElement
	 * @find-by('css' => 'input[name*=test]')
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
	}

	public function waitFor($timeout, $callback)
	{
		return ;
	}

}
