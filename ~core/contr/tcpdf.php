<?php
	require('~core/model/invoice_c.php');
require('tcPDFPlugin/tcpdf.php');
$Contragents = new Contragents();
$Contragents->SetFieldsById($_POST['contragent']);
$remitter = $Contragents->GetRemitterById($_POST['recipient'], 1);
if($_POST['recipient'] == 0){
	$settings['data'] = '';
}else{
	$settings['data'] = $remitter['name'].', '.$remitter['address'].', <br> т. (097) 465-49-89, (095) 922-36-30, Р/с '.$remitter['rs'].', МФО '.$remitter['mfo'].', '.$remitter['bank'].', <br> ЕГРПОУ '.$remitter['egrpou'];
}
$settings['date'] = $_POST['date'];
$settings['doctype'] = $_POST['doctype'];
if($_POST['margin']){
	$settings['margin'] = str_replace(",",".",$_POST['margin']);
}else{
	$settings['margin'] = 1;
}
$settings['order'] = $_POST['order'];
if(isset($_POST['fact'])){
	$settings['fact'] = $_POST['fact'];
}
if(isset($_POST['stamp'])){
	$settings['stamp'] = $_POST['stamp'];
}
if(isset($_POST['NDS'])){
	$settings['NDS'] = $_POST['NDS'];
}
$settings['pay_form'] = $_POST['pay_form'];
// Получание информации о заказе
$Order = new Orders();
$Order->SetFieldsById($settings['order']);
$order_details = $Order->fields;
$Customers = new Customers();
if($_POST['personal_client']){
	$order_details['cont_person'] = $_POST['personal_client'];
}else{
	$Customers->SetFieldsById($_POST['client']);
	$cstmr = $Customers->fields;
	if($cstmr){
		$tpl->Assign("cstmr", $cstmr);
		$Citys = new Citys();
		$Citys->SetFieldsById($cstmr['id_city']);
		$order_details['address'] = $Citys->fields;
	}
}
$Invoice = new Invoice();
$ord = $Invoice->GetOrderData($settings['order']);
$tpl->Assign("order_details", $order_details);
$tpl->Assign("settings", $settings);
$tpl->Assign("order", $ord);
echo $tpl->Parse($GLOBALS['PATH_tpl'].'tcpdf.tpl');
?>