<?php
/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace evangelion1204\QAToolsExtension;


use Behat\Mink\Mink;
use Behat\Mink\Session;
use QATools\QATools\HtmlElements\TypifiedPageFactory;
use QATools\QATools\PageObject\Config\Config;
use QATools\QATools\PageObject\Page;
use QATools\QATools\PageObject\PageFactory;

class QATools
{

	/**
	 * Mink instance.
	 *
	 * @var Mink
	 */
	protected $mink;

	/**
	 * Mink session instance.
	 *
	 * @var Session
	 */
	protected $session;

	/**
	 * The used page factory.
	 *
	 * @var PageFactory
	 */
	protected $pageFactory;

	/**
	 * Current user data.
	 *
	 * @var User[]
	 */
	protected $users = array();

	/**
	 * The current active page.
	 *
	 * @var Page
	 */
	protected $activePage;

	/**
	 * Default constructor.
	 *
	 * @param Mink  $mink   Mink instance.
	 * @param array $config Config to use.
	 */
	public function __construct(Mink $mink, array $config)
	{
		$this->mink = $mink;
		$this->config = $config;
	}

	/**
	 * Initialises and loads data.
	 *
	 * @return static
	 */
	public function init()
	{
		$this->session = $this->mink->getSession();
		$this->pageFactory = new TypifiedPageFactory($this->session, new Config($this->config['qa_tools']));

		if ( isset($this->config['users']) ) {
			foreach ( $this->config['users'] as $id => $user ) {
				$this->users[$id] = new User($id, $user);
			}
		}

		return $this;
	}

	/**
	 * Get page with given name.
	 *
	 * @param string $name Name of the page.
	 *
	 * @return Page
	 */
	public function getPage($name)
	{
		$class = (isset($this->config['namespace']['pages']) ?
				'\\' . $this->config['namespace']['pages'] . '\\' : '') . $name;

		$this->activePage = $this->pageFactory->getPage($class);

		return $this->activePage;
	}

	/**
	 * Get active page.
	 *
	 * @return Page
	 */
	public function getActivePage()
	{
		return $this->activePage;
	}

}
