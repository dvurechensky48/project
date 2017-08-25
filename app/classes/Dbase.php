<?php
class Dbase
{
	public function db_select($sql)
	{
		include('../config/config.php');
		$mysqli = mysqli_connect($host, $user, $pass, $db);
		$mysqli->set_charset("utf8");
		if (mysqli_connect_errno($mysqli)) 
		{
			echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
		}

		$res = mysqli_query($mysqli, $sql);


		while($row = mysqli_fetch_array($res))
		{
			$arr_result[] = $row;
		}
		mysqli_close($mysqli);   
		if(!isset($arr_result))
		{
			$arr_result[0]['id_request'] = 'Заявки отсутвуют';
			$arr_result[0]['client_phone'] = 'Заявки отсутвуют';
			$arr_result[0]['client_name'] = 'Заявки отсутвуют';
			$arr_result[0]['application_name'] = 'Заявки отсутвуют';
			$arr_result[0]['application_text'] = 'Заявки отсутвуют';
			$arr_result[0]['id_photo'] = 'no';
		}
		return $arr_result;
	}

	public function db_export_xml()
	{
		$sql = "SELECT requests.id_request,client.client_name,client.client_phone,requests.application_name,requests.application_text FROM `client`,
		`requests` WHERE client.id_client = requests.id_client";
		include('../config/config.php');
		$mysqli = mysqli_connect($host, $user, $pass, $db);
		$mysqli->set_charset("utf8");
		if (mysqli_connect_errno($mysqli)) 
		{
			echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
		}

		$res = mysqli_query($mysqli, $sql);
		$xml = '<?xml version="1.0" encoding="utf-8" standalone="yes"?>
		<clients>';     
			while($row = mysqli_fetch_object($res))
			{
				$id_request = $row->id_request;
				$client_name = $row->client_name;
				$client_phone = $row->client_phone;
				$application_name = $row->application_name;
				$application_text = $row->application_text;
				$xml.=' 

				<client name="'.$id_request.'">
					<name>'.$client_name.'</name>
					<phone>'.$client_phone.'</phone>
					<caption>'.$application_name.'</caption>
					<description>'.$application_text.'</description>
				</client>
				';
			}
			mysqli_close($mysqli); 
			$xml.='</clients>';
			echo $xml;
		}

		public function db_insert()
		{
			if(isset($_POST['name'], $_POST['phone'], $_POST['caption'], $_POST['description']) and mb_strlen($_POST['description']) > 10)
			{
				

				include('../config/config.php');
				$mysqli = mysqli_connect($host, $user, $pass, $db);
				$mysqli->set_charset("utf8");
				$name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
				$phone = mysqli_real_escape_string($mysqli, intval(trim($_POST['phone'])));
				$caption = mysqli_real_escape_string($mysqli, trim($_POST['caption']));
				$description = mysqli_real_escape_string($mysqli, trim($_POST['description']));

				$name = strip_tags($name);
				$name = htmlspecialchars($name);

				$phone = strip_tags($phone);
				$phone = htmlspecialchars($phone);

				$caption = strip_tags($caption);
				$caption = htmlspecialchars($caption);

				$description = strip_tags($description);
				$description = htmlspecialchars($description);
				
				if (mysqli_connect_errno($mysqli)) 
				{
					echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
				}
				$sql = "SELECT `id_client`, `client_name`, `client_phone` FROM `client` WHERE `client_name` = '$name' and `client_phone` = '$phone'";
				$res = mysqli_query($mysqli, $sql);
				while($row = mysqli_fetch_object($res))
				{
					$id_client = $row->id_client;
				}
				$num_rows = mysqli_num_rows($res);
				
				if($num_rows == 0)
				{
					$sql = "INSERT INTO `client`(`id_client`, `client_name`, `client_phone`) VALUES (NULL,'$name','$phone');
					INSERT INTO `requests`(`id_request`, `id_client`, `application_name`, `application_text`) VALUES (NULL,LAST_INSERT_ID(),'$caption', '$description');
					INSERT INTO `photo`(`id_photo`, `id_request`) VALUES (NULL,LAST_INSERT_ID());
					SELECT `id_photo` FROM `photo` WHERE id_photo = LAST_INSERT_ID()";
					
				}

				else if($num_rows == 1)
				{
					$sql = "INSERT INTO `requests`(`id_request`, `id_client`, `application_name`, `application_text`) VALUES (NULL,$id_client,'$caption', '$description');
					INSERT INTO `photo`(`id_photo`, `id_request`) VALUES (NULL,LAST_INSERT_ID());
					SELECT `id_photo` FROM `photo` WHERE id_photo = LAST_INSERT_ID()";

				}

				else
				{
					echo('Ошибка, в базе данных слишком много значений');
				}
				

				if ( mysqli_multi_query($mysqli, $sql) )
				{
					do 
					{
						if ( $result = mysqli_store_result( $mysqli ) ) 
						{
							while ( $row = mysqli_fetch_row( $result ) ) 
							{

								$image_name = $row[0];

							}
							mysqli_free_result( $result );
						}
					}
					while ( mysqli_more_results( $mysqli ) && mysqli_next_result( $mysqli ) );
				}
				

				if($_FILES['image']['error'] == 0 and is_uploaded_file($_FILES['image']['tmp_name']))
				{
					$fi = finfo_open(FILEINFO_MIME_TYPE);
					$mime = (string) finfo_file($fi, $_FILES['image']['tmp_name']);
					if(strpos($mime, 'image') === false)die('Можно загружать только изображения');
					
					$image = getimagesize($_FILES['image']['tmp_name']);
					$extension = image_type_to_extension($image[2]);
					
					move_uploaded_file($_FILES["image"]["tmp_name"], "./img/".$image_name.'.png');
				}
				else if($_FILES['image']['error'] != 0 and !is_uploaded_file($_FILES['image']['tmp_name']))
				{
					copy("./img/no.png", "./img/".$image_name.".png");
				}

				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
			else
			{
				echo('Вы не заполнили формы или колличество символов в заголовке меньше 10');
			}
		}

		public function db_edit()
		{
			if(isset($_POST['but'],$_POST['id_request']) and $_POST['but'] == 'edit')
			{
				include('../config/config.php');
				$mysqli = mysqli_connect($host, $user, $pass, $db);
				$mysqli->set_charset("utf8");
				$id_request = $_POST['id_request'];
				$application_name = $_POST['application_name'];
				$application_text = $_POST['application_text'];
				$sql="UPDATE  `requests` SET  `application_name` =  '$application_name', `application_text` = '$application_text' WHERE  `requests`.`id_request` = $id_request;";
				$res = mysqli_query($mysqli, $sql);
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
			else if(isset($_POST['but'],$_POST['id_request']) and $_POST['but'] == 'delete')
			{
				include('../config/config.php');
				$mysqli = mysqli_connect($host, $user, $pass, $db);
				$mysqli->set_charset("utf8");
				$id_request = $_POST['id_request'];
				$application_name = $_POST['application_name'];
				$application_text = $_POST['application_text'];
				$sql="DELETE FROM `requests` WHERE `id_request`=$id_request;
				DELETE FROM `photo` WHERE `id_request`=$id_request";
				$res = mysqli_multi_query($mysqli, $sql);
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
			else
			{
				echo('Что то пошло не так');
			}

		}
	}

	?>