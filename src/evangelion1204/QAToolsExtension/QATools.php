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

	public function setMink(Mink $mink)
	{
		$this->mink = $mink;
		$this->session = $mink->getSession();

		return $this;
	}

}