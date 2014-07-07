<?php

/*
 * This file is part of BehatExtension for Behat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Michael Geppert <evangelion1204@aol.com>
 */

spl_autoload_register(function ($class) {
	if ( false !== strpos($class, 'QATools\\BehatExtension') ) {
		require_once (__DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php');

		return true;
	}
}, true, false);

return new QATools\BehatExtension\ServiceContainer\BehatExtension();
