<?php

	$GLOBALS['IERA_LINKS'][] = array(
		'title' => $header,
		'url' => _base_url.'/cabinet/waitinglist/'
	);

	$Customer = new Customers();

	$success = false;

	$Customer->SetFieldsById($User->fields['id_user']);

	//Список ожидания
	$waiting_list = $Customer->GetWaitingList($User->fields['id_user']);
	foreach ($waiting_list as $key => $value) {
		if($value['price_opt'] == 0 && $value['price_mopt'] == 0){
			$waiting_list[$key]['availability'] = 'нет';
		}else{
			$waiting_list[$key]['availability'] = 'есть';
		}
	}
	$User->SetUser($_SESSION['member']);

	$tpl->Assign('waiting_list', $waiting_list);
	$tpl->Assign('User', $User->fields);
	$tpl->Assign('Customer', $Customer->fields);

	$parsed_res = array('issuccess' => TRUE,
 						'html' 		=> $tpl->Parse($GLOBALS['PATH_tpl'].'cp_customer_cab_waitinglist.tpl'));

?>