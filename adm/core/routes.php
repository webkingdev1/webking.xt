<?php
// Отрезаем завершающий слеш `/`
$_SERVER['REQUEST_URI'] = preg_replace('#/$#is', '', $_SERVER['REQUEST_URI']);
preg_match_all('#/([^/]+)#is', $_SERVER['REQUEST_URI'], $ma);

//print_r($ma);
if ($ma[1][0] == 'adm'){
	//unset($ma[1]);
	array_shift($ma[1]);
}
//print_r($ma);
/* Далее, если REQUEST_URI пуст - устанавливается контроллер по-умолчанию
 * если контроллер не найден среди файлов, то устанавливается контроллер 404 ошибки
 */
if (empty($ma[1])){
	$ma[1][0] = $GLOBALS['DefaultController'];
}elseif (!in_array($ma[1][0], $GLOBALS['Controllers'])){
	array_unshift($ma[1], '404');
}
$GLOBALS['CurrentController'] = $ma[1][0];
$GLOBALS['REQAR'] = $ma[1];

if (!G::IsLogged()){
	$GLOBALS['CurrentController'] = 'login';
	$GLOBALS['REQAR'] = array();
}else{
	$User = new Users();
	$User->SetUser($_SESSION['member']) or exit('Ошибка пользователя.');
	_acl::load($User->fields['gid']);
}
//print_r($GLOBALS['REQAR']);
/**
 * Для удобства некоторые переменные из REQUEST_URI объявляются в массиве $_GET
 */
foreach ($ma[1] as $item){

	if (preg_match('#^p([\d]+)$#is', $item, $ma1)){
		$_GET['page_id'] = $ma1[1];
	}
}

unset($ma);unset($ma1);
?>