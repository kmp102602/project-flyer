<?php

function flash($title = null, $message = null)
{
	
	$flash = app('App\Http\Flash');

	if(func_num_args() == 0) {

		return $flash;

	}

	return $flash->info($title, $message);  // flash('title', 'body')

}

/**
*
* The path to a given flyer
*
* @param App\Flyer $flyer
* @return string
*/

function flyer_path(App\Flyer $flyer)
{
	return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}