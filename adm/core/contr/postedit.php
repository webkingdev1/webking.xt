<?php
$Post = new Post();
unset($parsed_res);
if(isset($GLOBALS['REQAR'][1]) && is_numeric($GLOBALS['REQAR'][1])){
	$id = $GLOBALS['REQAR'][1];
}else{
	header('Location: '.$GLOBALS['URL_base'].'404/');
	exit();
}
if(!$Post->SetFieldsById($id, 1)){
	die('Ошибка при выборе статьи.');
}
$header = 'Редактирование статьи';
$ii = count($GLOBALS['IERA_LINKS']);
$GLOBALS['IERA_LINKS'][$ii]['title'] = 'Статьи';
$GLOBALS['IERA_LINKS'][$ii++]['url'] = '/adm/posts/';
$GLOBALS['IERA_LINKS'][$ii]['title'] = $header;
$tpl->Assign('h1', $header);
if(isset($_GET['upload']) == true){
	$res = $Images->upload($_FILES, $GLOBALS['PATH_post_img'].'temp/');
	echo str_replace($GLOBALS['PATH_root'], '/', $res);
	exit(0);
}
if(isset($_POST['smb'])){
	require_once ($GLOBALS['PATH_block'].'t_fnc.php'); // для ф-ции проверки формы
	list($err, $errm) = Post_form_validate();

	//Добавление миниатюры
	if(isset($_POST['thumb'])) {
		$thumb = $_POST['thumb'];
		if (strpos($thumb, '/temp/') == true) {
			$file = pathinfo(str_replace('/' . str_replace($GLOBALS['PATH_root'], '', $GLOBALS['PATH_post_img']), '', $thumb));
			$path = $GLOBALS['PATH_post_img'] . $file['dirname'] . '/';
			$bd_path = str_replace($GLOBALS['PATH_root'] . '..', '', $GLOBALS['PATH_post_img']) . trim($file['dirname']);
			$thumb = $bd_path . '/' . $file['basename'];
		} else $thumb = $thumb;
	}
	if(!$err){
		if($Post->UpdatePost($_POST, $thumb)){
			$Post->UpdatePhoto($id, $thumb);
			$tpl->Assign('msg', 'Статья обновлена.');
			unset($_POST);
			if(!$Post->SetFieldsById($id, 1)) die('Ошибка при выборе новости.');
		}else{
			$tpl->Assign('msg', 'Ошибка при обновлении статьи.');
			$tpl->Assign('errm', 1);
		}
	}else{
		// показываем все заново но с сообщениями об ошибках
		if(isset($_POST['date'])&&!isset($errm['date'])){
			list($d,$m,$y) = explode(".", trim($_POST['date']));
			$_POST['date'] = mktime(0, 0, 0, $m , $d, $y);
		}
		$tpl->Assign('msg', 'Статья не обновлена.');
		$tpl->Assign('errm', $errm);
	}
}
if(isset($_POST['test_distribution'])){
	$Mailer = new Mailer();
	$Mailer->SendNewsToCustomers1($_POST);
	// $Mailer->SendNewsToCustomersInterview($_POST);
}
if(!isset($_POST['smb'])){
	foreach($Post->fields as $k=>$v){
		$_POST[$k] = $v;
	}
}
$parsed_res = array(
	'issuccess'	=> true,
	'html'		=> $tpl->Parse($GLOBALS['PATH_tpl'].'cp_post_ae.tpl')
);
if(TRUE == $parsed_res['issuccess']){
	$tpl_center .= $parsed_res['html'];
}
?>