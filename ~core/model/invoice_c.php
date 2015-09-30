<?php
class Invoice{
	public $fields;
	public $list;
	public function __construct (){
	}

	public function GetOrderData($id_order, $filial = false){
		global $db;
		$and['o.id_order'] = $id_order;
		$sql = "SELECT (SELECT "._DB_PREFIX_."supplier.article FROM "._DB_PREFIX_."supplier WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt) AS article_mopt,
				o.sum_discount, s.article, p.name, p.units, o.id_order, p.art, o.id_order_status, osp.id_product, p.img_1, osp.site_price_opt, osp.site_price_mopt,
				p.inbox_qty, osp.box_qty, osp.opt_qty, osp.mopt_qty, osp.opt_sum, osp.mopt_sum, o.strachovka, o.note2, osp.id_supplier, osp.id_supplier_mopt,
				o.target_date, osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum, osp.contragent_msum, osp.fact_qty, osp.fact_sum, osp.fact_mqty, osp.fact_msum,
				osp.return_qty, osp.return_sum, osp.return_mqty, osp.return_msum, o.id_pretense_status, o.id_return_status, p.weight, p.volume, osp.note_opt, osp.note_mopt,
				osp.price_opt_otpusk, osp.price_mopt_otpusk, osp.filial_mopt, osp.filial_opt, p.checked, osp.warehouse_quantity
				FROM "._DB_PREFIX_."osp osp
				LEFT JOIN "._DB_PREFIX_."order o ON osp.id_order=o.id_order
				LEFT JOIN "._DB_PREFIX_."supplier s ON osp.id_supplier=s.id_user
				LEFT JOIN "._DB_PREFIX_."product p ON osp.id_product=p.id_product
				".$db->GetWhere($and);
		if(isset($filial) == true && $filial != 0){
			$sql.= " AND (osp.filial_mopt = ".$filial." OR osp.filial_opt = ".$filial.") ";
		}
		$sql .= " GROUP BY osp.id_order, osp.id_product, osp.id_supplier
				ORDER BY p.name
				";
		$arr = $db->GetArray($sql);
		if(empty($arr) == true){
			return false;
		}else{
			return $arr;
		}
	}

	public function GetOrderData_fakt($id_order, $filial = false){
		global $db;
		$and['o.id_order'] = $id_order;
		$sql = "SELECT (SELECT "._DB_PREFIX_."supplier.article FROM xt_supplier WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt) AS article_mopt,
		s.article, p.name, o.id_order, p.art, o.id_order_status, osp.id_product, p.img_1, osp.site_price_opt, osp.site_price_mopt, p.inbox_qty, osp.box_qty, 
				osp.opt_qty, osp.mopt_qty, osp.opt_sum, osp.mopt_sum, o.strachovka, osp.id_supplier, osp.id_supplier_mopt, o.target_date,
				osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum, osp.contragent_msum, osp.fact_qty, osp.fact_sum, osp.fact_mqty, osp.fact_msum,
				osp.return_qty, osp.return_sum, osp.return_mqty, osp.return_msum, o.id_pretense_status, o.id_return_status, p.weight, p.volume,
				osp.note_opt, osp.note_mopt, osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum, osp.contragent_msum, osp.filial_mopt, osp.filial_opt
				FROM "._DB_PREFIX_."osp osp
				LEFT JOIN "._DB_PREFIX_."order o ON osp.id_order=o.id_order
				LEFT JOIN "._DB_PREFIX_."supplier s ON osp.id_supplier=s.id_user
				LEFT JOIN "._DB_PREFIX_."product p ON osp.id_product=p.id_product
				".$db->GetWhere($and);
		if(isset($filial) == true && $filial != 0){
			$sql.= " AND (osp.filial_mopt = ".$filial." OR osp.filial_opt = ".$filial.") ";
		}
		$sql .= " GROUP BY osp.id_order, osp.id_product, osp.id_supplier
				ORDER BY p.name
				";
		$arr = $db->GetArray($sql);
		if(empty($arr) == true){
			return false;
		}else{
			return $arr;
		}
	}

	public function GetOrderData_prise($id_order){
		global $db;
		$and['o.id_order'] = $id_order;
		$sql = "SELECT   (SELECT  "._DB_PREFIX_."supplier.article FROM xt_supplier WHERE "._DB_PREFIX_."supplier.id_user=osp.id_supplier_mopt) AS article_mopt,
				s.article, p.name, o.id_order, p.art, o.id_order_status, osp.id_product, p.img_1, p.inbox_qty, osp.box_qty, osp.opt_qty, osp.mopt_qty,
				osp.opt_sum, osp.mopt_sum, p.price_opt, p.price_mopt, o.target_date, p.weight, p.volume, osp.note_opt, osp.note_mopt, osp.filial_mopt, osp.filial_opt
				FROM "._DB_PREFIX_."osp osp
				LEFT JOIN "._DB_PREFIX_."order o ON osp.id_order=o.id_order
				LEFT JOIN "._DB_PREFIX_."supplier s ON osp.id_supplier=s.id_user
				LEFT JOIN "._DB_PREFIX_."product p ON osp.id_product=p.id_product
				".$db->GetWhere($and)."
				GROUP BY osp.id_order, osp.id_product, osp.id_supplier
				ORDER BY p.name
				";
		$arr = $db->GetArray($sql) or G::DieLoger("SQL - error: $sql");
		return $arr;
	}

	public function GetOrderData_m_diler($id_order){
		global $db;
		$and['o.id_order'] = $id_order;
		$sql = "SELECT o.id_order, o.note2, o.note, o.target_date
				FROM  "._DB_PREFIX_."order o
				".$db->GetWhere($and)."
				GROUP BY o.id_order
				";
		$arr = $db->GetArray($sql) or G::DieLoger("SQL - error: $sql");
		return $arr;
	}

	public function GenCustomerInvoiceExcel(){
		if(!file_exists("invoice_customer1.xls")){
			exit("No template file.\n");
		}
		require($GLOBALS['PATH_sys'].'excel/Classes/PHPExcel.php');
		$objPHPExcel = PHPExcel_IOFactory::load($GLOBALS['PATH_root']."invoice_customer1.xls");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
		$objWriter->save($GLOBALS['PATH_root']."1234.htm");
		echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";
	}

	public function GetSuppliersList($art){
		global $db;
		$sql = "SELECT p.art, p.name, u.name AS supp_name, s.article, s.place, s.phones, a.price_mopt_otpusk, a.price_opt_otpusk, a.active
				FROM "._DB_PREFIX_."assortiment AS a, "._DB_PREFIX_."user AS u, "._DB_PREFIX_."product AS p, "._DB_PREFIX_."supplier AS s
				WHERE p.art =\"$art\"
				AND p.id_product = a.id_product
				AND s.id_user = a.id_supplier
				AND s.id_user = u.id_user
				ORDER BY s.article
				";
		$arr = $db->GetArray($sql) or $arr = 0;
		return $arr;
	}
}
?>