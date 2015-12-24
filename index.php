<?php
// echo memory_get_peak_usage()/pow(1000, 2);
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Europe/Kiev');
define('EXECUTE', 1);
define(DIRSEP, DIRECTORY_SEPARATOR);
ini_set('session.gc_maxlifetime', 43200);
ini_set('session.cookie_lifetime', 43200);
session_start();
require(dirname(__FILE__).DIRSEP.'~core'.DIRSEP.'sys'.DIRSEP.'global_c.php');
require(dirname(__FILE__).DIRSEP.'~core'.DIRSEP.'cfg.php');
// Memcached init
// $mc = new Memcache();
// @$mc->connect("localhost", 11211);
$s_time = G::getmicrotime();
/*ini_set('session.save_path', $GLOBALS['PATH_root'].'sessions');*/
require($GLOBALS['PATH_core'].'routes.php');

G::Start();
/* Объявление CSS файлов */
G::AddCSS('reset.css');
G::AddCSS('../plugins/material/material.css');
G::AddCSS('../plugins/owl-carousel/owl.carousel.css');
G::AddCSS('../themes/default/css/footer.css');
G::AddCSS('../themes/default/css/style.css');
G::AddCSS('../themes/default/css/header.css');
// G::AddCSS('../themes/default/css/sidebar.css');

G::AddCSS('../themes/default/css/custom.css');

// G::AddCSS('jquery-ui.css');
/* plugins css */
// G::AddCSS('../plugins/formstyler/jquery.formstyler.css');
// G::AddCSS('../plugins/icomoon/style.css');
G::AddCSS('../themes/default/css/page_styles/'.$GLOBALS['CurrentController'].'.css');
/* Объявление JS файлов */
G::AddJS('jquery-2.1.4.min.js');
// G::AddJS('jquery-ui.min.js');
G::AddJS('../plugins/material/material.js');
G::AddJS('../plugins/owl-carousel/owl.carousel.min.js');
G::AddJS('../themes/default/js/func.js');
G::AddJS('../themes/default/js/main.js');
if($GLOBALS['CurrentController'] == 'cart'){
	G::AddJS('cart.js');
}else{
	G::AddJS('cart.js', true);
}
/* plugins js */
G::AddJS('../plugins/dropzone.js');
G::AddJS('../plugins/jquery.lazyload.min.js');
G::AddJS('../plugins/jquery.cookie.js');
// G::AddJS('../plugins/formstyler/jquery.formstyler.js');
G::AddJS('../plugins/maskedinput.min.js', true);
// G::AddJS('../plugins/icomoon/liga.js', true);
// G::AddJS('../plugins/tagcanvas/jquery.tagcanvas.min.js');

// слайдер на главной странице
if($GLOBALS['CurrentController'] == 'main'){
	$Slides = new Slides();
	$Slides->SetFieldsBySlider('main');
	$slides = $Slides->fields;
	$tpl->Assign('main_slides', $slides);
}
if(in_array($GLOBALS['CurrentController'], array('promo_cart', 'promo'))){
	G::AddJS('promo_cart.js');
}
$active_tab = 1;
if(isset($_SESSION['ActiveTab']) && $_SESSION['ActiveTab'] == '0'){
	$active_tab = 0;
}
$_SESSION['ActiveTab'] = $active_tab;
if(!isset($_SESSION['layout'])){
	$_SESSION['layout'] = 'block';
}elseif(isset($_POST['layout']) && $_POST['layout'] != $_SESSION['layout']){
	$_SESSION['layout'] = $_POST['layout'];
}
$GLOBALS['__page_h1'] = '&nbsp;';
$User = new Users();
if(isset($_SESSION['member'])){
	$User->SetUser($_SESSION['member']);
	if($_SESSION['member']['email'] != 'anonymous'){
		$GLOBALS['user'] = $User->fields;
	}
}
unset($active_tab);
$Customer = new Customers();
$Customer->SetFieldsById($User->fields['id_user']);
if(!isset($_SESSION['member']['promo_code']) || $_SESSION['member']['promo_code'] == ''){
	$SavedContragent = new Contragents();
	$SavedContragent->GetSavedFields($Customer->fields['id_contragent']);
	$tpl->Assign('SavedContragent', $SavedContragent->fields);
	unset($SavedContragent);
}else{
	$promo_supplier = new Suppliers();
	$promo_supplier->GetSupplierIdByPromoCode($_SESSION['member']['promo_code']);
	$tpl->Assign('promo_supplier', $promo_supplier->fields);
	unset($promo_supplier);
}
unset($Customer);

// Выборка просмотренных товаров
$products = new Products();
if(isset($_COOKIE['view_products'])){
	foreach(json_decode($_COOKIE['view_products']) as $value){
		$products->SetFieldsById($value);
		$product = $products->fields;
		if(isset($product['id_product']) && $product['id_product'] != ''){
			$product['images'] = $products->GetPhotoById($product['id_product']);
		}
		$result[] = $product;
	}
	$tpl->Assign('view_products_list', array_reverse($result));
	unset($result);
}

// Выборка популярных товаров
$pops = $products->GetPopularsOfCategory(0, true);
foreach($pops AS &$pop){
	$pop['images'] = $products->GetPhotoById($pop['id_product']);
}
$tpl->Assign('pops', $pops);
unset($pops);

// =========================================================

// Обработка фильтров ======================================
// if(isset($_POST['filters'])){
// 	$filters[] = $_POST['filters'];
// 	$mc->set('filters', array($GLOBALS['CurrentController'] => $filters));
// }elseif(isset($mc->get('filters')[$GLOBALS['CurrentController']])){
// 	$filters = $mc->get('filters')[$GLOBALS['CurrentController']];
// }else{
// 	$filters = false;
// }
// =========================================================

// Обработка сортировок ====================================
//print_r($GLOBALS['CurrentController']);
if(isset($_COOKIE['sorting'])){
	$sort = $_COOKIE['sorting'];
	$sort = (array)json_decode($sort, true);
}
if(isset($_POST['value']) && isset($_POST['direction'])){
	$sort_value = $_POST['value'];
	$sorting    = array('value' => $sort_value);
	setcookie('sorting', json_encode(array($GLOBALS['CurrentController']=> $sorting)), time()+3600*24*30, '/');
}elseif(!empty($sort) && isset($sort[$GLOBALS['CurrentController']])){
	$sorting = $sort[$GLOBALS['CurrentController']];
	print_r($sorting);
}
// =========================================================

require($GLOBALS['PATH_core'].'controller.php');
$tpl->Assign('css_arr', G::GetCSS());
$tpl->Assign('js_arr', G::GetJS());
$tpl->Assign('__page_description', $GLOBALS['__page_description']);
$tpl->Assign('__page_title', $GLOBALS['__page_title']);
$tpl->Assign('__page_kw', $GLOBALS['__page_kw']);
$tpl->Assign('__page_h1', $GLOBALS['__page_h1']);
$tpl->Assign('__center', $GLOBALS['__center']);
$tpl->Assign('__nav', $GLOBALS['__nav']);
$tpl->Assign('__header', $GLOBALS['__header']);
$tpl->Assign('__breadcrumbs', $GLOBALS['__breadcrumbs']);
$tpl->Assign('__sidebar_l', $GLOBALS['__sidebar_l']);
$tpl->Assign('__sidebar_r', $GLOBALS['__sidebar_r']);
$tpl->Assign('__popular', $GLOBALS['__popular']);
$tpl->Assign('__aside',  $GLOBALS['__aside']);
$Cart = new Cart();
// Создание базового массива корзины
$Cart->RecalcCart();
// $Cart->SetTotalQty();
// $Cart->SetAllSums();
// $tpl->Assign('cart_string', $Cart->GetString());
if(in_array($GLOBALS['CurrentController'], $GLOBALS['NoTemplate'])){
	if($GLOBALS['MainTemplate'] == 'main.tpl'){
		$GLOBALS['MainTemplate'] = 'main_empty.tpl';
	}
}
echo $tpl->Parse($GLOBALS['PATH_tpl_global'].$GLOBALS['MainTemplate']);
// include svg icons library
$e_time = G::getmicrotime();
//if ($GLOBALS['CurrentController'] != 'feed')
echo "<!--".date("d.m.Y H:i:s", time())." ".$_SERVER['REMOTE_ADDR']." gentime = ".($e_time-$s_time)." -->";
// echo memory_get_peak_usage()/pow(1000, 2);
session_write_close();
?>