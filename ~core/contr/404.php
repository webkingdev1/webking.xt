<?php
header("HTTP/1.0 404 Gone");
$Page = new Page();
$Page->PagesList();
$tpl->Assign('header', '');
$tpl->Assign('list_menu', $Page->list);
// ---- center ----
G::metaTags(array('page_title' => 'Странице не найдена'));
unset($parsed_res);
$parsed_res = array(
	'issuccess'	=> true,
	'html'		=> $tpl->Parse($GLOBALS['PATH_tpl'].'cp_404.tpl')
);
if(true == $parsed_res['issuccess']){
	$tpl_center .= $parsed_res['html'];
}