<?php

	/*
		class loader
	*/
	spl_autoload_register(function ($class) {
		$file = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, ROOT . '/' . $class) . '.php';
		if(!file_exists($file))
			echo $file . '<br>' . PHP_EOL;
		
		require_once $file;
	});