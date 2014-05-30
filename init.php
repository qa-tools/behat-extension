<?php

/*
 * This file is part of QAToolsExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

spl_autoload_register(function($class) {
	echo 1;
	if (false !== strpos($class, 'evangelion1204\\QAToolsExtension')) {
		require_once(__DIR__.'/src/'.str_replace('\\', '/', $class).'.php');
		return true;
	}
}, true, false);

return new evangelion1204\QAToolsExtension\ServiceContainer\Extension;