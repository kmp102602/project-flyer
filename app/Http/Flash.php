<?php

namespace App\Http;

class Flash{

	/**
   *
   *@parm string      $title
   *@parm string      $message
   *@parm string      $level
   *@parn string|null $key
   *@return void
   *
   */  

	public function create($title, $message, $level, $key = 'flash_message')
	{
		return session()->flash($key, [
			'title'   => $title,
			'message' => $message,
			'level'   => $level
			]);
	}

	/**
	* Create an information flash message
	*
	*@param string $title
	*@param string $message
	*@return void
	*
	*/

	public function info($title, $message)
	{

		return $this->create($title, $message, 'info');
		
	}

	/**
	* Create an success flash message
	*
	*@param string $title
	*@param string $message
	*@return void
	*
	*/

	public function success($title, $message)
	{

		return $this->create($title, $message, 'success');
		
	}

	/**
	* Create an success flash message
	*
	*@param string $title
	*@param string $message
	*@return void
	*
	*/

	public function error($title, $message)
	{

		return $this->create($title, $message, 'error');
		
	}

	/**
	* Create an success flash message
	*
	*@param string $title
	*@param string $message
	*@param string $level
	*@return void
	*
	*/

	public function overlay($title, $message, $level = 'success')
	{

		return $this->create($title, $message, $level, 'flash_message_overlay');
		
	}

}