<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * ToyDatabase Model
 *
 * @since  0.0.1
 */
class ToyDatabaseModelToyDatabase extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $message;

	/**
	 * Get the message
	 *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg()
	{
		if (!isset($this->message))
		{
			$this->message = 'Toy Database hello (from model)!';
		}

		return $this->message;
	}
}