<?php

class Router
{
	public function start()
	{
		if ($_SERVER['REQUEST_URI'] == '/')
		{
			$page = 'index';
			$module = 'index';
			$second_module = 'index';
		}
		else
		{
			$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$url_parts = explode('/', trim($url_path, ' /'));
			$page = array_shift($url_parts);
			$module = array_shift($url_parts);
		}

		if ($page == 'index') {
			$template = new Template();
			$template->header();
			$template->content_main_page();
			$template->footer();
		}
		else if($page == 'form'){
			$template = new Template();
			$template->header();
			$template->content_form();
			$template->footer();
		}
		else if($page == 'xml'){
			header('Content-disposition: attachment; filename=db.xml');
			header('Content-type: text/plain');
			$dbase = new Dbase();
			$dbase->db_export_xml();
			
		}
		else if($page == 'insertDb')
		{
			$dbase = new Dbase();
			$dbase->db_insert();
		}
		else if($page == 'editDb')
		{
			$dbase = new Dbase();
			$dbase->db_edit();
		}
		else if($page == 'admin')
		{	
			$admin = new Admin();
			$admin->auth();
		}
		else
		{
			header("HTTP/1.0 404 Not Found");
		} 
	}
}

?>