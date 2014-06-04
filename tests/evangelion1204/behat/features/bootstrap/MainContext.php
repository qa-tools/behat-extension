<?php

use lounge\testing\Manager;
use evangelion1204\QAToolsExtension\Context\QAToolsAwareContext;
use evangelion1204\QAToolsExtension\Context\QAToolsContext;

use Behat\MinkExtension\Context\MinkContext;

class MainContext extends QAToolsContext
{
	protected static $folder = __DIR__;
}