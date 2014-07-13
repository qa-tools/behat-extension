<?php

use QATools\BehatExtension\Context\QAToolsContext;

class MainContext extends QAToolsContext
{
	protected static $folder = __DIR__;

	/**
	 * @When /^the user does the tests$/
	 */
	public function doTest()
	{
		$this->qaTools->getActivePage()->enter();
	}

	/**
	 * @Given /^the user waits for ([0-9]+) seconds$/
	 */
	public function waitFor($seconds)
	{
		sleep($seconds);
	}

}
