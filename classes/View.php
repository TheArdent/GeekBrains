<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 28.12.16
 * Time: 6:10
 */

class View
		implements Iterator
{
	protected $buffer = [];

	public function __set($key,$value)
	{
		$this->buffer[$key] = $value;
	}

	public function __get($key)
	{
		return $this->buffer[$key];
	}

	public function render($template)
	{
		foreach ($this->buffer as $key => $value)
		{
			$$key = $value;
		}
		ob_start();
		include __DIR__.'/../views/'.$template.'.php';
		$temp = ob_get_contents();
		ob_end_clean();
		return $temp;
	}

	public function display($template)
	{
		foreach ($this->buffer as $key => $value)
		{
			$$key = $value;
		}
		$content = $this->render($template);
		ob_start();
		include __DIR__.'/../views/v_main.php';
		$temp = ob_get_contents();
		ob_end_clean();
		echo $temp;
	}

	public function current()
	{
		// TODO: Implement current() method.
	}

	public function next()
	{
		// TODO: Implement next() method.
	}

	public function key()
	{
		// TODO: Implement key() method.
	}

	public function valid()
	{
		// TODO: Implement valid() method.
	}

	public function rewind()
	{
		// TODO: Implement rewind() method.
	}
}