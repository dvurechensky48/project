<?php
class Template
{
	public function header()
	{
		include('../app/templates/header.php');
	}

	public function footer()
	{
		include('../app/templates/footer.php');
	}

	public function content_main_page()
	{
	
	$dbase = new Dbase();
	$arr_result = $dbase->db_select("SELECT * FROM `client`, `requests`, `photo` WHERE client.id_client = requests.id_client and requests.id_request = photo.id_request");
	for($i=0;$i<count($arr_result);$i++)
	{
		$id_request = $arr_result[$i]['id_request'];
		$client_phone = $arr_result[$i]['client_phone'];
		$client_name = $arr_result[$i]['client_name'];
		$application_name = $arr_result[$i]['application_name'];
		$application_text = $arr_result[$i]['application_text'];
		$id_photo = $arr_result[$i]['id_photo'];
		include('../app/templates/content.php');
	}

	}

	public function content_form()
	{
		include('../app/templates/form.php');
	}
}

?>