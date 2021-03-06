<?php
if(!_acl::isAllow('orders_category')){
	die("Access denied");
}
$Order = new Orders();
$products = new Products();
unset($parsed_res);
$header = 'Наполнение категорий по заказам';
$tpl->Assign('h1', $header);
$ii = count($GLOBALS['IERA_LINKS']);
$GLOBALS['IERA_LINKS'][$ii]['title'] = $header;
$arr = false;
if(isset($_GET['smb'])){
	if(isset($_GET['filter_target_date']) && $_GET['filter_target_date'] !== ''){
		$arr['creation_date'] = $_GET['filter_target_date'];
		list($d,$m,$y) = explode(".", trim($arr['creation_date']));
		$arr['creation_date'] = mktime(0, 0, 0, $m , $d, $y);
	}
	if(isset($_GET['filter_id_order']) && $_GET['filter_id_order'] !== ''){
		$arr['id_order'] = $_GET['filter_id_order'];
	}
	if(isset($_GET['id_order_status']) && $_GET['id_order_status'] !== '0'){
		$arr['id_order_status'] = $_GET['id_order_status'];
	}
	if(isset($_GET['filter_contragent_name']) && $_GET['filter_contragent_name'] !== ''){
		$arr['ca.name_c'] = $_GET['filter_contragent_name'];
	}
	if(isset($_GET['filter_email']) && $_GET['filter_email'] !== ''){
		$arr['u.email'] = $_GET['filter_email'];
	}
	if(isset($_GET['filter_customer_name']) && $_GET['filter_customer_name'] !== ''){
		$arr['u.name'] = $_GET['filter_customer_name'];
	}
}elseif(isset($_GET['clear_filters'])){
	unset($_GET);
	$url = explode('?',$_SERVER['REQUEST_URI']);
	header('Location: '.$url[0]);
	exit();
}else{
	$_GET['id_order_status'] = 0;
}
if(isset($_POST['submit'])){
	$products->FillCategoryByOrder($_POST);
}
$fields = array('creation_date', 'id_order');
$orderby = "creation_date desc";
$sort_links = array();
foreach($fields as $f){
	$sort_links[$f] = $GLOBALS['URL_base'].'adm/orders/ord/'.$f.'/desc';
	if(in_array("ord", $GLOBALS['REQAR']) && in_array($f,$GLOBALS['REQAR'])){
		if(in_array("desc",$GLOBALS['REQAR'])){
			$sort_links[$f] = $GLOBALS['URL_base'].'adm/orders/ord/'.$f.'/asc';
			$orderby = $f.' desc';
		}else{
			$orderby = $f.' asc';
		}
	}
}
$arr['o.id_customer'] = 22660;
$tpl->Assign('sort_links', $sort_links);
$Order->SetList(1, $arr, $orderby);

if(isset($_GET['limit']) && is_numeric($_GET['limit'])){
	$GLOBALS['Limit_db'] = $_GET['limit'];
}
if((isset($_GET['limit']) && $_GET['limit'] != 'all') || !isset($_GET['limit'])){
	if(isset($_POST['page_nbr']) && is_numeric($_POST['page_nbr'])){
		$_GET['page_id'] = $_POST['page_nbr'];
	}
	$cnt = count($Order->list);
	$GLOBALS['paginator_html'] = G::NeedfulPages($cnt);
	$limit = ' '.$GLOBALS['Start'].', '.$GLOBALS['Limit_db'];
}else{
	$GLOBALS['Limit_db'] = 0;
	$limit = '';
}

if($Order->SetList(1, $arr, $orderby, $limit)){
	$tpl->Assign('list', $Order->list);
}
$categories = $products->generateCategory();
$tpl->Assign('categories', $categories);
$order_statuses = $Order->GetStatuses();
$tpl->Assign('order_statuses', $order_statuses);
$tpl_center .= $tpl->Parse($GLOBALS['PATH_tpl'].'cp_orders_category.tpl');