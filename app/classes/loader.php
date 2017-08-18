<?php

class Loader 
{
	public function loadClass($class_name)
	{
		if($class_name == 'Router')
		{
			$file = '../app/classes/router.php';
		} 
		else if($class_name == 'Template')
		{
			$file = '../app/classes/template.php';
		}
		else if($class_name == 'Dbase')
		{
			$file = '../app/classes/dbase.php';
		}
		else if($class_name == 'Setting')
		{
			$file = '../app/classes/setting.php';
		}
			
		

		if(is_file($file))
		{
			require_once $file;
		}
	}
}