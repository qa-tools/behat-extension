<?php
/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace evangelion1204\QAToolsExtension\Context;


use Behat\Behat\Context\Context;
use evangelion1204\QAToolsExtension\QATools;

class QAToolsContext implements Context, QAToolsAwareContext
{

	/**
	 * @var QATools
	 */
	protected $qaTools;

	public function setQATools(QATools $qa_tools)
	{
		$this->qaTools = $qa_tools;

		return $this;
	}

	/**
	 * @BeforeStep
	 */
	public function initSession()
	{
		$this->qaTools->init();
	}

	/**
	 * @Given /^the user visits the "([^"]+)"$/
	 */
	public function visitPage($page)
	{
		$page = $this->qaTools->getPage($page);
		$page->open();
	}
}