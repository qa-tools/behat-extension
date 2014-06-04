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

use aik099\QATools\PageObject\Config\Config;
use aik099\QATools\PageObject\Page;
use aik099\QATools\PageObject\PageFactory;
use Behat\Mink\Mink;
use Behat\Mink\Session;

class QATools
{

	/**
	 * @var Mink
	 */
	protected $mink;

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var PageFactory
	 */
	protected $pageFactory;

	/**
	 * @var User[]
	 */
	protected $users = array();

	/**
	 * The current active page.
	 *
	 * @var Page
	 */
	protected $activePage;

	public function __construct(Mink $mink, array $config)
	{
		$this->mink = $mink;
		$this->config = $config;
	}

	public function init()
	{
		$this->session = $this->mink->getSession();
		$this->pageFactory = new PageFactory($this->session, new Config($this->config['qa_tools']));

		if (isset($this->config['users'])) {
			foreach ($this->config['users'] as $id => $user) {
				$this->users[$id] = new User($id, $user);
			}
		}

		return $this;
	}

	public function getPage($name)
	{
		$class = (isset($this->config['namespace']['pages']) ? '\\' . $this->config['namespace']['pages'] . '\\' : '') . $name;

		$this->activePage = $this->pageFactory->getPage($class);

		return $this->activePage;
	}

	public function getActivePage()
	{
		return $this->activePage;
	}
}