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


class User
{

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * User data.
	 *
	 * @var array
	 */
	protected $data;

	public function __construct($id, array $user_data)
	{
		$this->data = $user_data;
		$this->id = $id;
	}

	public function getRawData()
	{
		return $this->data;
	}

}