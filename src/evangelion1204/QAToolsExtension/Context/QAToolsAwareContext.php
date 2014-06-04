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

use evangelion1204\QAToolsExtension\QATools;

interface QAToolsAwareContext
{

	/**
	 * Set QA-Tools instance.
	 *
	 * @param QATools $qa_tools
	 *
	 * @return $this
	 */
	public function setQATools(QATools $qa_tools);
}