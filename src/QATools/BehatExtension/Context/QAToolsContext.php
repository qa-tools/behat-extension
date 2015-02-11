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
use QATools\QATools\PageObject\IPageFactory;
use QATools\QATools\PageObject\Page;

class QAToolsContext implements Context, IQAToolsAwareContext
{

	/**
	 * QA-Tools instance.
	 *
	 * @var QATools
	 */
	protected $qaTools;

	/**
	 * The used page factory.
	 *
	 * @var IPageFactory
	 */
	protected $pageFactory;

	/**
	 * The current page.
	 *
	 * @var Page
	 */
	protected $page;

	/**
	 * Set QA-Tools instance.
	 *
	 * @param QATools $qa_tools Instance of QA-Tools.
	 *
	 * @return static
	 */
	public function setQATools(QATools $qa_tools)
	{
		$this->qaTools = $qa_tools;

		return $this;
	}

	/**
	 * Set page factory.
	 *
	 * @param IPageFactory $page_factory Used page factory.
	 *
	 * @return static
	 */
	public function setPageFactory(IPageFactory $page_factory)
	{
		$this->pageFactory = $page_factory;

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

		$this->pageFactory = $this->qaTools->getPageFactory();

		return $this;
	}

	/**
	 * Open the page with the given name.
	 *
	 * @param string $page Name of page.
	 *
	 * @Given /^I visit the "([^"]+)"$/
	 * @Given /^the user visits the "([^"]+)"$/
	 *
	 * @return void
	 */
	public function visitPage($page)
	{
		$this->page = $this->pageFactory->getPage($page);
		$this->page->open();
	}

}
