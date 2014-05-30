<?php
/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

namespace evangelion1204\QAToolsExtension\Context\Initializer;

use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\Behat\Context\Context;
use Behat\Mink\Mink;

class QAToolsInitializer implements ContextInitializer
{

	/**
	 * @var Mink
	 */
	protected $mink;

	public function __construct(Mink $mink)
	{

	}

	public function initializeContext(Context $context)
	{
		if (!$context instanceof QAToolsAwareContext) {
			return;
		}

		$context->setMink($this->mink);
	}
}
