<?php
define('EXECUTE', 1);
// phpinfo();
require(dirname(__FILE__).'/../~core/sys/global_c.php');
require(dirname(__FILE__).'/core/cfg.php');
$s_time = G::getmicrotime();
session_start();
G::Start();
require($GLOBALS['PATH_core'].'routes.php');
require($GLOBALS['PATH_core'].'controller.php');
G::AddCSS('reset.css');
G::AddCSS('bootstrap-grid-3.3.2.min.css');
G::AddCSS('style.css');
G::AddCSS('header.css');
G::AddCSS('sidebar.css');
G::AddCSS('highslide.css');
G::AddJS('jquery-2.1.1.min.js');
G::AddJS('jquery.lazyload.min.js');
G::AddJS('jquery-ui.js');
G::AddJS('main.js');
G::AddJS('func.js');
$GLOBALS['__page_h1'] = '&nbsp;';
if($GLOBALS['CurrentController'] != 'productedit'){
	// G::AddCSS('adm.css');
}
// var_dump(file_exists('adm/css/page_styles/'.$GLOBALS['CurrentController'].'.css'));
// if(file_exists('adm/css/page_styles/'.$GLOBALS['CurrentController'].'.css')){
	G::AddCSS('page_styles/'.$GLOBALS['CurrentController'].'.css');
// }
$tpl->Assign('css_arr', G::GetCSS());
$tpl->Assign('js_arr', G::GetJS());
$tpl->Assign('__page_title', $GLOBALS['__page_title']);
$tpl->Assign('__center', $GLOBALS['__center']);
$tpl->Assign('__sidebar_l', $GLOBALS['__sidebar_l']);
$tpl->Assign('__header', $tpl->Parse($GLOBALS['PATH_tpl_global'].'main_header.tpl'));
echo $tpl->Parse($GLOBALS['PATH_tpl_global'].$GLOBALS['MainTemplate']);
$e_time = G::getmicrotime();
//if ($GLOBALS['CurrentController'] != 'feed')
echo "<!--".date("d.m.Y H:i:s", time())."  ".$_SERVER['REMOTE_ADDR']." gentime = ".($e_time - $s_time)." -->";
session_write_close();
?>