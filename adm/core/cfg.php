<?php
$root = dirname(__FILE__);
$root .= '/../';
require($root.'../config.php');
// ******************************** Начальное конфигурирование *************************************
$baseUrl = '//'.$_SERVER['SERVER_NAME'].'/';
define('_base_url', $baseUrl);
date_default_timezone_set("Europe/Moscow");
$config = array (
	'URL_base'			=> $baseUrl,
	'URL_request'		=> '//'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
	'URL_img'			=> $baseUrl.'adm/img/',
	'URL_css'			=> $baseUrl.'adm/css/',
	'URL_js'			=> $baseUrl.'adm/js/',

	'PATH_root'			=> $root,
	'PATH_core'			=> $root.'core/',
	'PATH_sys'			=> $root.'../~core/sys/',
	'PATH_model'		=> $root.'../~core/model/',
	'PATH_product_img'	=> $root.'../product_images/',
	'PATH_block'		=> $root.'core/block/',
	'PATH_contr'		=> $root.'core/contr/',
	'PATH_tpl'			=> $root.'core/tpl/',
	'PATH_tpl_global'	=> $root.'core/tpl/_global/'
);
G::ToGlobals($config);
unset($config);

$GLOBALS['DefaultController'] = 'main';
$GLOBALS['MainTemplate'] = 'main.tpl';
$GLOBALS['NoSidebarTemplControllers'] = array('404', 'msg', 'srv');
// Массив ссылок иерархии
$GLOBALS['IERA_LINKS'] = array();
$GLOBALS['IERA_LINKS'][0]['title'] = 'Главная';
$GLOBALS['IERA_LINKS'][0]['url'] = $baseUrl.'adm/';
// Лимит ссылок в навигации
$GLOBALS['Limit_nav'] = 10; // ???
// сколько брать записей из таблицы (при использовании пагинатора)
$GLOBALS['Limit_db'] = 30;
$GLOBALS['Start'] = 0;

// ********************************** Подключение и инициализация классов  **********************************
require($GLOBALS['PATH_sys'].'tpl_c.php');
require($GLOBALS['PATH_sys'].'db_c.php');
require($GLOBALS['PATH_sys'].'dbtree_c.php');
require($GLOBALS['PATH_sys'].'pages_c.php');
require($GLOBALS['PATH_sys'].'acl_c.php');
require($GLOBALS['PATH_sys'].'mailer_c.php');
require($GLOBALS['PATH_sys'].'status_c.php');
require($GLOBALS['PATH_sys'].'images_c.php');
$db = new mysqlDb($GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']);
$GLOBALS['db'] =& $db;
define ('DB_CACHE', false);
$tpl = new TPL();
$GLOBALS['tpl'] =& $tpl;
// ********************************** Подключение и инициализация моделей  **********************************
require($GLOBALS['PATH_model'].'users_c.php');
require($GLOBALS['PATH_model'].'customers_c.php');
require($GLOBALS['PATH_model'].'contragents_c.php');
require($GLOBALS['PATH_model'].'suppliers_c.php');
require($GLOBALS['PATH_model'].'page_c.php');
require($GLOBALS['PATH_model'].'news_c.php');
require($GLOBALS['PATH_model'].'locations_c.php');
require($GLOBALS['PATH_model'].'products_c.php');
require($GLOBALS['PATH_model'].'manufacturers_c.php');
require($GLOBALS['PATH_model'].'config_c.php');
require($GLOBALS['PATH_model'].'orders_c.php');
require($GLOBALS['PATH_model'].'UploadHandler.php');
require($GLOBALS['PATH_model'].'slides_c.php');
require($GLOBALS['PATH_model'].'specification_c.php');
require($GLOBALS['PATH_model'].'unit_c.php');
require($GLOBALS['PATH_model'].'post_c.php');
require($GLOBALS['PATH_model'].'wishes_c.php');
// получение всех настроек с БД
$sql = "SELECT name, value FROM "._DB_PREFIX_."config";
$arr = $db->GetArray($sql);
// формирование глобального массива настроек
foreach ($arr as $i){
	$GLOBALS['CONFIG'][$i['name']] = $i['value'];
}
unset($sql, $arr);
// почтовая конфигурация
$GLOBALS['MAIL_CONFIG']['from_name'] = $GLOBALS['CONFIG']['mail_caption']; // from (от) имя
$GLOBALS['MAIL_CONFIG']['from_email'] = $GLOBALS['CONFIG']['mail_email']; // from (от) email адрес
// На всякий случай указываем настройки
// для дополнительного (внешнего) SMTP сервера.
$GLOBALS['MAIL_CONFIG']['smtp_mode'] = 'disabled'; // enabled or disabled (включен или выключен)
$GLOBALS['MAIL_CONFIG']['smtp_host'] = null;
$GLOBALS['MAIL_CONFIG']['smtp_port'] = null;
$GLOBALS['MAIL_CONFIG']['smtp_username'] = null;
?>