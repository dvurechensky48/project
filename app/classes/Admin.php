<?php
class Admin
{
	public function auth()
	{
		if(!isset($_SESSION['login']) and !isset($_SESSION['pass']))
		{
			if(!empty($_POST['login']) and !empty($_POST['pass']))
			{
				include('../config/config.php');
				$mysqli = mysqli_connect($host, $user, $pass, $db);
				$login = mysqli_real_escape_string($mysqli, trim($_POST['login']));
				$pass = mysqli_real_escape_string($mysqli, trim($_POST['pass']));
				$login = strip_tags($login);
				$login = htmlspecialchars($login);
				$pass = strip_tags($pass);
				$pass = htmlspecialchars($pass);
				$pass = md5($pass);

				$dbase = new Dbase();
				$arr_result = $dbase->db_select("SELECT `login`, `pass` FROM `admin` WHERE login = '$login' and pass = '$pass'");
				if(isset($arr_result[0]['login']) and isset($arr_result[0]['pass']))
				{
					$_SESSION['login'] = $arr_result[0]['login'];
					$_SESSION['pass'] = $arr_result[0]['pass'];
					$template = new Template();
					$template->header();
					$template->auth_on();
					$template->footer();
				}
				else
				{
					$info = "Ошибка в логине или пароле";
					include('../app/templates/auth_off.php');
				}

				
			}
			else if(empty($_POST['login']) || empty($_POST['pass']))
			{
				$info = "Заполните форму";
				include('../app/templates/auth_off.php');
			}
			else if(!isset($_POST['login']) and !isset($_POST['pass']))
			{
				$info = "Заполните форму";
				include('../app/templates/auth_off.php');
			}
		}
		else
		{
			$template = new Template();
			$template->header();
			$template->auth_on();
			$template->footer();
		}
	}
}

?>