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
use evangelion1204\QAToolsExtension\Context\QAToolsAwareContext;
use evangelion1204\QAToolsExtension\QATools;

class QAToolsInitializer implements ContextInitializer
{

	/**
	 * @var QATools
	 */
	protected $qaTools;

	public function __construct(QATools $qa_tools)
	{
		$this->qaTools = $qa_tools;
	}

	public function initializeContext(Context $context)
	{
		if (!$context instanceof QAToolsAwareContext) {
			return;
		}

		$context->setQATools($this->qaTools);
	}
}
