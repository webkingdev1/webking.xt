<?php
function Register_form_validate($nocheck=array()){
	$errm = array();
	$err=0;
	$varname = 'email';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>1, 'Lmax'=>255, 'PM_email'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}
	$varname = 'passwd';
	if (!in_array($varname, $nocheck))
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>4, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}else{
		$errm[$varname] = "Пользователю должен быть назначен пароль.";
		$err=1;
	}
	$varname = 'passwdconfirm';
	if (!in_array($varname, $nocheck))
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>4, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
		else{
			if ($_POST['passwd'] != $_POST['passwdconfirm']){
				$errm[$varname] = "Пароли не совпадают.";
				$err=1;
			}
		}
	}else{
		$errm[$varname] = "Требуется подтверждение пароля.";
		$err=1;
	}
	$varname = 'name';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'Lmax'=>255, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}

	/*$varname = 'confirmps';
	if (!isset($_POST[$varname])){
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}*/

	/*$varname = 'descr';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}*/

	/*$varname = 'address_ur';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}*/
/*
	$varname = 'cont_person';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'Lmax'=>255, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}

	$varname = 'phones';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}

	$varname = 'keystring';
	if (!in_array($varname, $nocheck))
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}else{
			if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
				unset($_SESSION['captcha_keystring']);
			}else{
				$errm[$varname] = "Введен неправильный код.";
				$err=1;
			}

		}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}
*/
	return array($err, $errm);
}
function Remind_form_validate($nocheck=array()){
	$errm = array();
	$err=0;
	$varname = 'email';
	if (isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>1, 'Lmax'=>255, 'PM_email'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err=1;
	}
	return array($err, $errm);
}
function Order_form_validate($nocheck = array()){
	$errm = array();
	$err = 0;
	if(!isset($_SESSION['cart']['products']) || empty($_SESSION['cart']['products'])){
		$errm["products"] = "В корзине нет товаров.";
		$err = 1;
	}
	if(isset($_POST['p_order'])){
		return array($err, $errm);
	}
	$varname = 'target_date';
	if(isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_date'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if(!$errf){
			$errm[$varname] = $errmsg;
			$err = 1;
		}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err = 1;
	}

	$varname = 'cont_person';
	if(isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'Lmax'=>255, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if(!$errf){
			$errm[$varname] = $errmsg;
			$err = 1;
		}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err = 1;
	}

	$varname = 'phones';
	if(isset($_POST[$varname]) && $_POST[$varname]){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>0, 'PM_glob'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if(!$errf){
			$errm[$varname] = $errmsg;
			$err = 1;
		}
	}else{
		$errm[$varname] = "Поле обязательно для заполнения.";
		$err = 1;
	}
/*
	$varname = 'id_delivery';
	if(isset($_POST[$varname]) && $_POST[$varname] != 0){
		$_POST[$varname] = trim($_POST[$varname]);
		$carr = array('Lmin'=>1, 'IsInt'=>1);
		list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
		if(!$errf){
			$errm[$varname] = $errmsg;
			$err = 1;
		}
		if(!$err){
			switch ($_POST[$varname]) {
				case '1':
						$varname = 'id_parking';
						if (isset($_POST[$varname]) && $_POST[$varname]!=0){
							$_POST[$varname] = trim($_POST[$varname]);
							$carr = array('Lmin'=>1, 'IsInt'=>1);
							list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
							if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
						}else{
							$errm[$varname] = "Не выбрана стоянка.";
							$err=1;
						}
				break;
				case '2':
						$varname = 'id_city';
						if (isset($_POST[$varname]) && $_POST[$varname]!=0){
							$_POST[$varname] = trim($_POST[$varname]);
							$carr = array('Lmin'=>1, 'IsInt'=>1);
							list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
							if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
						}else{
							$errm[$varname] = "Не выбран город.";
							$err=1;
						}
				break;
				case '3':
						$varname = 'id_delivery_service';
						if (isset($_POST[$varname]) && $_POST[$varname]!=0){
							$_POST[$varname] = trim($_POST[$varname]);
							$carr = array('Lmin'=>1, 'IsInt'=>1);
							list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
							if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
						}else{
							$errm[$varname] = "Не выбрана служба доставки.";
							$err=1;
						}
				break;
				default:
				;
				break;
			}
			if(!$err){
				$varname = 'id_contragent';
				if(isset($_POST[$varname]) && $_POST[$varname]!=0){
					$_POST[$varname] = trim($_POST[$varname]);
					$carr = array('Lmin'=>1, 'IsInt'=>1);
					list($errf, $errmsg) = G::CheckV($_POST[$varname], $carr);
					if (!$errf){ $errm[$varname] = $errmsg; $err=1;}
				}else{
					$errm[$varname] = "Не выбран контрагент.";
					$err=1;
				}
			}

		}
	}else{
		$errm[$varname] = "Не выбран способ доставки.";
		$err=1;
	}
*/
	return array($err, $errm);
}
?>