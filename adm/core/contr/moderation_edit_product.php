<?php
if(!_acl::isAllow('moderation_edit_product')){
	die("Access denied");
}
unset($parsed_res);
if(isset($GLOBALS['REQAR'][1]) && is_numeric($GLOBALS['REQAR'][1])){
	$id = $GLOBALS['REQAR'][1];
}else{
	header('Location: /adm/404/');
	exit();
}
$Unit = new Unit();
$products = new Products();
$header = "Редактирование товара на модерации";
array_push($GLOBALS['IERA_LINKS'], array('url' => '/adm/product_moderation', 'title' => 'Товары на модерации'));
array_push($GLOBALS['IERA_LINKS'], array('url' => '/adm/moderation_edit_product', 'title' => $header));
$tpl->Assign('units', $Unit->GetUnitsList());
if(isset($_POST['smb'])){
	$products->AddSupplierProduct($_POST);
}
$tpl->Assign('header', $header);
$list = $products->GetProductOnModeration($id);
foreach($list as $k=>$l){
	$_POST[$k] = $l;
}


$parsed_res = array(
	'issuccess'	=> true,
	'html'		=> $tpl->Parse($GLOBALS['PATH_tpl'].'moderation_edit_product.tpl')
);
if(true == $parsed_res['issuccess']){
	$tpl_center .= $parsed_res['html'];
}

// $tpl->Assign();




// }elseif(isset($cabinet_page) && $cabinet_page == "editproduct"){
// 	$GLOBALS['IERA_LINKS'] = array();
// 	$header = "Добавление товара";
// 	$GLOBALS['IERA_LINKS'][1]['title'] = $header;
// 	$tpl->Assign('units', $Unit->GetUnitsList());
// 	if(isset($_GET['upload'])){
// 		$upload_handler = new UploadHandler(array(
// 			'download_via_php' => true
// 		));
// 		exit(0);
// 	}elseif(isset($_GET['delete']) == true){
// 		if($products->CheckPhotosOnModeration($_POST['image'])){
// 			unlink($_SERVER['DOCUMENT_ROOT'].str_replace($GLOBALS['URL_base'], '/', $_POST['image']));
// 		}
// 		exit(0);
// 	}elseif(isset($_POST['editionsubmit']) == true){
// 		if($products->AddSupplierProduct($_POST)){
// 			header('Location: /cabinet/productsonmoderation/');
// 		}
// 	}
// 	if(isset($_GET['id']) == true && is_numeric($_GET['id']) && $_GET['type'] == 'moderation'){
// 		$list = $products->GetProductOnModeration($_GET['id']);
// 		foreach($list as $k=>$l){
// 			$_POST[$k] = $l;
// 		}
// 	}
// 		
// }
?>