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
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
			switch ($id)
			{
				case 2:
					$this->message = 'Goodbye Toy Database';
					break;
				default:
				case 1:
					$this->message = 'Hello Toy Database';
					break;
			}
		}

		return $this->message;
	}
}