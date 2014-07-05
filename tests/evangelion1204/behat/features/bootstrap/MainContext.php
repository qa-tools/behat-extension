<?php

use evangelion1204\QAToolsExtension\Context\IQAToolsContext;
use lounge\testing\Manager;

class MainContext extends IQAToolsContext
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