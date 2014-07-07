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


use QATools\BehatExtension\QATools;

interface IQAToolsAwareContext
{

	/**
	 * Set QA-Tools instance.
	 *
	 * @param QATools $qa_tools Instance of QA-Tools.
	 *
	 * @return static
	 */
	public function setQATools(QATools $qa_tools);

}
