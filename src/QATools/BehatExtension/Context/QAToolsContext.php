<?php
/*
 * This file is part of BehatExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace QATools\BehatExtension\Context;


use Behat\Behat\Context\Context;
use QATools\BehatExtension\QATools;

class IQAToolsContext implements Context, IQAToolsAwareContext
{

	/**
	 * QA-Tools instance.
	 *
	 * @var QATools
	 */
	protected $qaTools;

	/**
	 * Sets the QA-Tools instance.
	 *
	 * @param QATools $qa_tools QA-Tools instance.
	 *
	 * @return static
	 */
	public function setQATools(QATools $qa_tools)
	{
		$this->qaTools = $qa_tools;

		return $this;
	}

	/**
	 * BeforeStep hook to init QA-Tools.
	 *
	 * @BeforeStep
	 *
	 * @return static
	 */
	public function initSession()
	{
		$this->qaTools->init();

		return $this;
	}

	/**
	 * Open the page with the given name.
	 *
	 * @param string $page Name of page.
	 *
	 * @Given /^the user visits the "([^"]+)"$/
	 *
	 * @return void
	 */
	public function visitPage($page)
	{
		$page = $this->qaTools->getPage($page);
		$page->open();
	}

}
