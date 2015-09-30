<?php
class Orders {
	public $db;
	public $fields;
	private $usual_fields;
	private $usual_fields2;
	public $list;
	public function __construct (){
		$this->db =& $GLOBALS['db'];
		$this->usual_fields = array("o.id_order", "o.id_order_status", "o.phones",
			"o.id_delivery", "o.id_parking", "o.id_city", "o.id_delivery_service",
			"o.id_contragent", "o.id_customer", "o.cont_person", "o.need_sertificate",
			"o.descr", "o.creation_date", "o.target_date", "o.return_date",
			"o.pretense_date", "o.sum_opt", "o.sum_mopt", "o.sum", "o.discount",
			"o.sum_discount", "o.id_pretense_status", "o.id_return_status", "o.skey",
			"o.otpusk_prices_sum", "o.sum_nac", "o.note", "o.note2", "o.strachovka",
			"o.order_discount", "o.freight","o.bonus_card"
			);
		$this->usual_fields2 = array("o.id_order", "o.id_order_status", "o.id_contragent",
			"o.id_customer", "o.cont_person", "o.need_sertificate", "o.descr",
			"o.creation_date", "o.target_date", "o.return_date", "o.pretense_date",
			"o.sum_opt", "o.sum_mopt", "o.sum", "o.discount", "o.sum_discount",
			"o.id_pretense_status", "o.id_return_status", "o.skey", "o.otpusk_prices_sum",
			"o.sum_nac", "o.order_discount", "o.freight"
			);
	}

	public function SetNote($id_order, $note){
		$note = mysql_real_escape_string($note);
		$sql = "UPDATE "._DB_PREFIX_."order SET note='$note' WHERE id_order=$id_order";
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function SetNote2($id_order, $note2){
		$note2 = mysql_real_escape_string($note2);
		$sql = "UPDATE "._DB_PREFIX_."order SET note2='$note2' WHERE id_order=$id_order";
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function SetNote_diler($id_order, $note_diler){
		$note_diler = mysql_real_escape_string($note_diler);
		$sql = "UPDATE "._DB_PREFIX_."order SET id_klient='$note_diler' WHERE id_order=$id_order";
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function SetNote_customer($id_order, $note_customer){
		$note_customer = mysql_real_escape_string($note_customer);
		$sql = "UPDATE "._DB_PREFIX_."order SET note_customer='$note_customer' WHERE id_order=$id_order";
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function SetNote_klient($id_order, $note_klient){
		$note_klient = mysql_real_escape_string($note_klient);
		$sql = "SELECT cu.phones, cu.cont_person
				FROM "._DB_PREFIX_."customer cu
				WHERE id_user='$note_klient'
				";
		$arr = $this->db->GetOneRowArray($sql);
		foreach($arr as $ord){
			$a=$arr['cont_person'];
			$b=$arr['phones'];
		}
		$this->db->StartTrans();
		$sql = "UPDATE "._DB_PREFIX_."order SET id_klient='$note_klient', cont_person='$a' ,  phones='$b' WHERE id_order=$id_order";
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	// по id
	public function SetFieldsById($id){
		$id = mysql_real_escape_string($id);
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
			FROM "._DB_PREFIX_."order o
			WHERE o.id_order = \"$id\"";
		$this->fields = $this->db->GetOneRowArray($sql);
		if(!$this->fields){
			return false;
		}
		return true;
	}

	public function Suplir_prov($arr = false){
		$date2 = date("Y-m-d", (time()+3600*24*2));
		$sql = "SELECT u.name, u.id_user, c.work_day, s.koef_nazen_mopt, s.koef_nazen_opt,  COUNT(DISTINCT a.id_assortiment) AS cnt, s.currency_rate
				FROM  "._DB_PREFIX_."assortiment a, "._DB_PREFIX_."user u, "._DB_PREFIX_."calendar_supplier c, "._DB_PREFIX_."supplier s
				WHERE a.active = 1
				AND u.id_user = s.id_user
				AND u.id_user = c.id_supplier
				AND  c.date = \"$date2\"
				AND u.id_user = a.id_supplier
				group by a.id_supplier";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	// Список
	public function SetList($param = 0, $and = false, $orderby = "", $limit = ""){
		if($limit != ""){
			$limit = " limit $limit";
		}
		$add_table_users = "";
		//contragent_name
		//customer_name
		$like = "";
		// if(isset($and['contragent_name']) && isset($and['customer_name'])){
		// 	$add_table_users = " LEFT JOIN "._DB_PREFIX_."user AS u ON (o.id_customer = u.id_user OR o.id_contragent = u.id_user)";
		// 	$like = count($and) > 2?" AND ":" WHERE ";
		// 	$like .= "(u.name LIKE '%".$and['contragent_name']."%' AND u.gid = 4)";
		// 	$like .= " OR (u.name LIKE '%".$and['customer_name']."%' AND u.gid = 5)";
		// 	unset($and['contragent_name']);
		// 	unset($and['customer_name']);
		// }elseif(isset($and['contragent_name'])){
		// 	$add_table_users = " LEFT JOIN "._DB_PREFIX_."user AS u ON o.id_contragent = u.id_user";
		// 	$like = count($and) > 1?" AND ":" WHERE ";
		// 	$like .= "u.name LIKE '%".$and['contragent_name']."%'";
		// 	unset($and['contragent_name']);
		// }elseif(isset($and['customer_name'])){
		// 	$add_table_users = " LEFT JOIN "._DB_PREFIX_."user AS u ON o.id_customer = u.id_user";
		// 	$like = count($and) > 1?" AND ":" WHERE ";
		// 	$like .= "u.name LIKE '%".$and['customer_name']."%'";
		// 	unset($and['customer_name']);
		// }
		$sql = "SELECT ".implode(", ",$this->usual_fields).",
			ca.name_c AS contragent_name,
			u.name AS customer_name,
			u.email AS customer_email
			FROM "._DB_PREFIX_."order AS o ".$add_table_users."
			LEFT JOIN "._DB_PREFIX_."user AS u
				ON u.id_user = o.id_customer
			LEFT JOIN "._DB_PREFIX_."contragent AS ca
				ON ca.id_user = o.id_contragent
			".$this->db->GetWhere($and)."
			$like
			ORDER BY $orderby, id_order desc
			$limit";
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return true;
	}

	// Список по поставщикам
	public function SetList_sup($param = 0, $and = false, $orderby = "", $limit = ""){
		if($limit != ""){
			$limit = " limit $limit";
		}
		$dates = false;
		$date_where = array();
		if(isset($and['target_date_start'])){
			$date_where[] = "target_date>".$and['target_date_start'];
			unset($and['target_date_start']);
			$dates = true;
		}
		if(isset($and['target_date_end'])){
			$date_where[] = "target_date<".$and['target_date_end'];
			unset($and['target_date_end']);
			$dates = true;
		}
		$add_table_users = "";
		//contragent_name
		//customer_name
		$like = "";
		if(isset($and['contragent_name']) && isset($and['customer_name'])){
			$add_table_users = " LEFT JOIN "._DB_PREFIX_."user u ON (o.id_customer=u.id_user OR o.id_contragent=u.id_user)";
			$like = count($and)>2?" AND ":" WHERE ";
			$like .= "(u.name LIKE \"%".$and['contragent_name']."%\" AND u.gid=4)";
			$like .= " OR (u.name LIKE \"%".$and['customer_name']."%\" AND u.gid=5)";
			unset($and['contragent_name']);
			unset($and['customer_name']);
		}elseif(isset($and['contragent_name'])){
			$add_table_users = " LEFT JOIN "._DB_PREFIX_."user u ON o.id_contragent=u.id_user";
			$like = count($and)>1?" AND ":" WHERE ";
			$like .= "u.name LIKE \"%".$and['contragent_name']."%\"";
			unset($and['contragent_name']);
		}elseif(isset($and['customer_name'])){
			$add_table_users = " LEFT JOIN "._DB_PREFIX_."user u ON o.id_customer=u.id_user";
			$like = count($and)>1?" AND ":" WHERE ";
			$like .= "u.name LIKE \"%".$and['customer_name']."%\"";
			unset($and['customer_name']);
		}
		$dw = "";
		if($dates)
		if(count($and)){
			$dw = " AND ".implode(" AND ", $date_where);
		}else{
			$dw = " WHERE ".implode(" AND ", $date_where);
		}
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
			FROM "._DB_PREFIX_."order o $add_table_users
			".$this->db->GetWhere($and)."
			$like
			$dw
			order by $orderby, id_order desc
			$limit";
		$arr = $this->db->GetArray($sql);
		$rows = array();
		$ii = 0;
		foreach($arr as $ord){
			if($ord['id_order_status'] != 3){
				$sql = "SELECT *
					FROM "._DB_PREFIX_."osp osp
					WHERE osp.id_order = {$ord['id_order']}";
				$arr2 = $this->db->GetArray($sql);
				$supp_sums = array();
				$supp_otpusk_sums = array();
				foreach($arr2 as $a2){
					if($a2['id_supplier']!=0){
						if(isset($supp_sums[$a2['id_supplier']])){
							$supp_sums[$a2['id_supplier']] = round($supp_sums[$a2['id_supplier']] + $a2['opt_sum'], 2);
							$supp_otpusk_sums[$a2['id_supplier']] = round($supp_otpusk_sums[$a2['id_supplier']] + ($a2['opt_qty']*$a2['price_opt_otpusk']) , 2);
						}else{
							$supp_sums[$a2['id_supplier']] = $a2['opt_sum'];
							$supp_otpusk_sums[$a2['id_supplier']] = round($a2['opt_qty']*$a2['price_opt_otpusk'] , 2);
						}
					}
					if($a2['id_supplier_mopt']!=0){
						if(isset($supp_sums[$a2['id_supplier_mopt']])){
							$supp_sums[$a2['id_supplier_mopt']] = round($supp_sums[$a2['id_supplier_mopt']] + $a2['mopt_sum'], 2);
							$supp_otpusk_sums[$a2['id_supplier_mopt']] = round($supp_otpusk_sums[$a2['id_supplier_mopt']] + ($a2['mopt_qty']*$a2['price_mopt_otpusk']) , 2);
						}else{
							$supp_sums[$a2['id_supplier_mopt']] = $a2['mopt_sum'];
							$supp_otpusk_sums[$a2['id_supplier_mopt']] = round($a2['mopt_qty']*$a2['price_mopt_otpusk'] , 2);
						}
					}
				}
				$suppliers = array();
				foreach($arr2 as $a2){
					if($a2['id_supplier'] != 0 && !in_array($a2['id_supplier'], $suppliers)){
						$a2['id_supplier_t'] = $a2['id_supplier'];
						$a2['sup_sum_t'] = $supp_sums[$a2['id_supplier']];
						$a2['sup_otpusk_sum_t'] = $supp_otpusk_sums[$a2['id_supplier']];
						$rows[$ii++] = array_merge($ord,$a2);
						$suppliers[] = $a2['id_supplier'];
					}
					if($a2['id_supplier_mopt'] != 0 && !in_array($a2['id_supplier_mopt'], $suppliers)){
						$a2['id_supplier_t'] = $a2['id_supplier_mopt'];
						$a2['sup_sum_t'] = $supp_sums[$a2['id_supplier_mopt']];
						$a2['sup_otpusk_sum_t'] = $supp_otpusk_sums[$a2['id_supplier_mopt']];
						$rows[$ii++] = array_merge($ord,$a2);
						$suppliers[] = $a2['id_supplier_mopt'];
					}
				}
			}else{
				$rows[$ii++] = $ord;
			}
		}
		$this->list = $rows;
		if(!$this->list){
			return false;
		}else{
			return true;
		}
	}

	public function ContragentsList($arr){
		$sql = "SELECT u.id_user, u.name
			FROM "._DB_PREFIX_."user AS u
			WHERE u.id_user IN (".implode(",", $arr).")";
		return $this->db->GetArray($sql, 'id_user');
	}

	public function CustomersList($arr){
		$sql = "SELECT u.id_user, u.name
			FROM "._DB_PREFIX_."user u
			WHERE u.id_user IN (".implode(",", $arr).")";
		return $this->db->GetArray($sql, 'id_user');
	}

	public function SuppliersList($arr){
		$sql = "SELECT u.id_user, u.name, s.article, s.is_partner
			FROM "._DB_PREFIX_."user AS u
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON s.id_user = u.id_user
			WHERE u.id_user IN (".implode(",", $arr).")";
		return $this->db->GetArray($sql, 'id_user');
	}

	public function GetSuppliers($id_order){
		$id_supplier = '';
		$sql = "SELECT DISTINCT s.id_user AS id_supplier, u.name, s.article,
			s.phones, s.place, s.is_partner, s.make_csv, s.send_mail_order,
			s.real_email, s.real_phone, s.icq, s.balance, s.personal_message,
			s.example_sum, s.pickers, s.area, s.currency_rate,
			(SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
				FROM "._DB_PREFIX_."assortiment AS a
				WHERE s.id_user = a.id_supplier
				AND a.inusd = 1) AS inusd
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON (osp.id_supplier = s.id_user OR osp.id_supplier_mopt = s.id_user)
			LEFT JOIN "._DB_PREFIX_."user AS u
				ON u.id_user = s.id_user
			WHERE osp.id_order = ".$id_order."
			AND s.id_user IS NOT NULL";
		if($id_supplier){
			$sql .= " AND s.id_user = ".$id_supplier;
		}
		$sql .= " ORDER BY s.article";
		$this->list = $this->db->GetArray($sql, 'id_supplier');
		if(!$this->list){
			return false;
		}
		return true;
	}

	public function GetSuppliersAltern($id_order){
		$sql = "SELECT DISTINCT s.id_user AS id_supplier, u.name, s.article, s.phones, s.place, s.is_partner
			FROM "._DB_PREFIX_."osp osp, "._DB_PREFIX_."supplier s
			LEFT JOIN "._DB_PREFIX_."user u ON u.id_user = s.id_user
			WHERE osp.id_order = $id_order
			AND (osp.id_supplier_altern = s.id_user
				OR osp.id_supplier_mopt_altern = s.id_user)";
		$this->list = $this->db->GetArray($sql,'id_supplier');
		if(!$this->list){
			return false;
		}else{
			return true;
		}
	}

	public function GetSupplier($id_supplier){
		$id_supplier = mysql_real_escape_string($id_supplier);
		$sql = "SELECT u.id_user as id_supplier, u.name
			FROM "._DB_PREFIX_."user u
			WHERE u.id_user = $id_supplier
			";
		$this->list = $this->db->GetOneRowArray($sql);
		if(!$this->list){
			return false;
		}else{
			return true;
		}
	}

	public function SetListBySupplier($id_supplier = false, $id_order, $pretense = false, $type = false, $filial = false){
		if($type){
			$where = "((osp.id_supplier = ".$id_supplier." AND osp.opt_qty > 0)
				OR (osp.id_supplier_mopt = ".$id_supplier." AND osp.mopt_qty > 0))";
		}else{
			$where = "((osp.id_supplier = ".$id_supplier."
					AND osp.opt_qty > 0
					AND osp.contragent_qty <= 0
					AND osp.note_opt NOT LIKE '%Отмена#%')
				OR (osp.id_supplier_mopt = ".$id_supplier."
					AND osp.mopt_qty > 0
					AND osp.contragent_mqty <= 0
					AND osp.note_mopt NOT LIKE '%Отмена#%'))";
		}
		if(isset($filial) == true && $filial != 0){
			$where .= " AND (osp.filial_opt =".$filial." OR osp.filial_mopt = ".$filial.") ";
		}
		$sql = "SELECT o.id_order, o.id_order_status, osp.id_product, p.name,
			p.img_1, osp.site_price_opt, osp.site_price_mopt, p.inbox_qty,
			osp.box_qty, osp.supplier_quantity_opt AS opt_qty,
			osp.supplier_quantity_mopt AS mopt_qty, osp.opt_sum,
			osp.mopt_sum, s.article,  p.art,
			(SELECT "._DB_PREFIX_."supplier.article FROM "._DB_PREFIX_."supplier WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt) AS article_mopt,
			osp.id_supplier, osp.id_supplier_mopt, o.target_date, o.return_date, o.pretense_date, o.creation_date,
			osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum, osp.contragent_msum,
			osp.fact_qty, osp.fact_sum, osp.fact_mqty, osp.fact_msum,
			osp.return_qty, osp.return_sum, osp.return_mqty, osp.return_msum,
			o.id_pretense_status, o.id_return_status, osp.price_opt_otpusk, osp.price_mopt_otpusk,
			osp.id_supplier_altern, osp.id_supplier_mopt_altern, osp.filial_opt, osp.filial_mopt,
			(SELECT "._DB_PREFIX_."supplier.article FROM "._DB_PREFIX_."supplier WHERE "._DB_PREFIX_."supplier.id_user=osp.id_supplier_altern) AS article_altern,
			(SELECT "._DB_PREFIX_."supplier.article FROM "._DB_PREFIX_."supplier WHERE "._DB_PREFIX_."supplier.id_user=osp.id_supplier_mopt_altern) AS article_mopt_altern,
			p.weight, p.volume, osp.note_opt, osp.note_mopt, p.sertificate, p.checked, osp.warehouse_quantity
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			LEFT JOIN "._DB_PREFIX_."assortiment AS a
				ON (osp.id_product = a.id_product AND a.id_supplier = ".$id_supplier.")
			WHERE ".$where."
			AND osp.id_order = ".$id_order."
			ORDER BY p.name";
		if($pretense){
			$sql .= " AND (osp.opt_qty != osp.fact_qty OR osp.mopt_qty != osp.fact_mqty)";
		}
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}else{
			return true;
		}
	}

	// Добавление заказа
	public function Add($arr){
		//************************************************************
		$discount = 0;
		if(isset($_SESSION['cart']['discount'])){
			if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 1){
				$discount = 1;
			}else{
				$discount = $_SESSION['cart']['discount'];
			}
		}
		//*************************************************************
		if(count($_SESSION['cart']['products']) == 0){
			return false;
		}
		global $cart;
		$this->UpdateSuppliersTurn();
		$cart->IsActualPrices($err, $warn, $errm, $warnings);
		if($err){
			if(isset($_SESSION['errm'])){
				$_SESSION['errm'] = array_merge($_SESSION['errm'], $errm);
			}else{
				$_SESSION['errm'] = $errm;
				header('Location: '._base_url.'/cart/');
				exit();
			}
		}

		$order_status = 0;
		if(isset($_SESSION['member']['promo_code']) && $_SESSION['member']['promo_code'] != ''){
			$f['id_order_status'] = $order_status = 11; // Промо-заказ
		}else{
			if(isset($arr['p_order'])){
				$f['id_order_status'] = $order_status = 3; // Черновик
			}elseif(isset($arr['order'])){
				$f['id_order_status'] = $order_status = 1; // Обычный заказ
				if($_SESSION['cart']['cart_sum'] >= 0 && $_SESSION['cart']['cart_sum'] < $GLOBALS['CONFIG']['min_sum_order']){
					$_SESSION['errm'][] = "Минимальная сумма заказа: ".$GLOBALS['CONFIG']['min_sum_order'];
					header('Location: '._base_url.'/cart/');
					exit();
				}
			}
		}
		// Сохранение исходного номера заказа
		if(isset($_SESSION['cart']['base_order'])){
			$f['base_order'] = $_SESSION['cart']['base_order'];
		}
		$f['target_date'] = $target_date = strtotime('+2 day', time());
		$f['creation_date'] = time();
		$f['id_customer'] = $_SESSION['member']['id_user'];
		if($f['id_order_status'] == 3){
			$customers = new Customers();
			$customers->SetFieldsById($_SESSION['member']['id_user']);
			$customer = $customers->fields;
			$f['id_delivery'] = 1;
			$f['id_contragent'] = $customer['id_contragent'];
			$f['id_city'] = 0;
			$f['strachovka'] = 0;
			$f['sum_opt'] = $f['sum_mopt'] = $f['sum'] = $f['sum_discount'] = $_SESSION['cart']['cart_sum'];
		}else{
			$f['phones'] = mysql_real_escape_string(trim('38'.substr(preg_replace("/[^0-9,.]/", "", $arr['phones']), -10)));
			$f['id_delivery'] = mysql_real_escape_string(trim($arr['id_delivery']));
			$f['id_city'] = mysql_real_escape_string(trim($arr['id_delivery_department']));
			$f['id_delivery_service'] = mysql_real_escape_string(trim(isset($arr['id_delivery_service'])?$arr['id_delivery_service']:0));
			$f['id_contragent'] = mysql_real_escape_string(trim($arr['id_manager']));
			$f['cont_person'] = mysql_real_escape_string(trim($arr['cont_person']));
			$f['strachovka'] = mysql_real_escape_string(trim($arr['strachovka']));
			if(isset($arr['bonus_card']) && $arr['bonus_card'] != ''){
				$f['bonus_card'] = mysql_real_escape_string(trim($arr['bonus_card']));
			}
			if(isset($arr['promo-code']) && $arr['promo-code'] != ''){
				$f['promo_code'] = mysql_real_escape_string(trim($arr['promo-code']));
			}
			$f['descr'] = mysql_real_escape_string(trim($arr['description']));
			if(isset($arr['price_column']) && $arr['price_column'] != $_SESSION['cart']['cart_column']){
				// Исскуственное изменение колонки менеджером
				$f['sum_opt'] = $f['sum_mopt'] = $f['sum_discount'] = $f['sum'] = $_SESSION['cart']['products_sum'][$arr['price_column']];
				$f['manual_price_change'] = $arr['price_column'].' - '.$arr['reason'];
			}else{
				$f['sum_opt'] = $f['sum_mopt'] = $f['sum_discount'] = $f['sum'] = $_SESSION['cart']['cart_sum'];
			}
			$f['discount'] = mysql_real_escape_string(trim($arr['discount']));
			if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 0){
				$f['discount'] = null;
			}
		}
		$sum_total = $f['sum_discount'];
		$f['skey'] = md5(time().'jWfUsd');
		$this->db->StartTrans();
		if(!$this->db->Insert(_DB_PREFIX_.'order', $f)){
			$this->db->FailTrans();
			return false;
		}
		// Получаем id нового заказа
		$_SESSION['cart']['id_order'] = $id_order = $this->db->GetInsId();

		// Заполнение связки заказ-товары
		$id_contragent = $f['id_contragent'];
		$Supplier = new Suppliers();
		$order_otpusk_prices_sum = 0;
		$ii = 0;
		$f = array();
		//** Нужно получить ошибки по всем товарам
		// foreach($_SESSION['cart']['products'] as $id_product=>$i){
		// 	$opt = false;
		// 	if($i['mode'] == 'opt'){
		// 		$opt = true;
		// 	}
		// 	$this->GetSupplierForProduct($id_product, $target_date, $i['quantity'], $opt);
		// }
		foreach($_SESSION['cart']['products'] as $id_product=>$i){
			$f[$ii]['id_order'] = $id_order;
			if(isset($arr['p_order'])){ // Черновик
				$f[$ii]['id_supplier'] = 0;
				$f[$ii]['id_supplier_mopt'] = 0;
			}elseif(isset($arr['order'])){ // Обычный заказ
				$sup_nb = 0;
				$f[$ii]['filial_mopt'] = 1;
				$f[$ii]['filial_opt'] = 1;
				if($i['mode'] == 'opt'){
					// Определяем оптового поставщика для товара
					if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['quantity'], true)){
						$f[$ii]['id_supplier'] = $ids[0]['id_supplier'];
						$f[$ii]['price_opt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, true);
						$order_otpusk_prices_sum += round($f[$ii]['price_opt_otpusk']*$i['quantity'], 2);
						$GLOBALS['temp_product_limit'] = $i['quantity'];
						$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier'], $i['quantity']);
						$f[$ii]['id_supplier_altern'] = $ids[1];
						$sup_nb++;
					}
				}else{
					$f[$ii]['id_supplier'] = 0;
					$f[$ii]['id_supplier_altern'] = 0;
					$f[$ii]['price_opt_otpusk'] = 0;
				}
				// if($i['order_opt_qty'] > 0){
				// 	if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['order_opt_qty'], true)){
				// 		$f[$ii]['id_supplier'] = $ids[0]['id_supplier'];
				// 		$f[$ii]['filial_opt'] = $ids[0]['filial'];
				// 		$f[$ii]['price_opt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, true);
				// 		$order_otpusk_prices_sum += round($f[$ii]['price_opt_otpusk']*$i['order_opt_qty'], 2);
				// 		$GLOBALS['temp_product_limit'] = $i['order_opt_qty'];
				// 		$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier'], $i['order_opt_qty']);
				// 		$f[$ii]['id_supplier_altern'] = $ids[1];
				// 		$sup_nb++;
				// 	}
				// }else{
				// 	$f[$ii]['id_supplier'] = 0;
				// 	$f[$ii]['id_supplier_altern'] = 0;
				// 	$f[$ii]['price_opt_otpusk'] = 0;
				// }

				if($i['mode'] == 'mopt'){
					// Определяем розничного поставщика для товара
					if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['quantity'], false)){
						$f[$ii]['id_supplier_mopt'] = $ids[0]['id_supplier'];
						$f[$ii]['price_mopt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, false);
						$order_otpusk_prices_sum += round($f[$ii]['price_mopt_otpusk']*$i['quantity'], 2);
						$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier_mopt'], $i['quantity']);
						$f[$ii]['id_supplier_mopt_altern'] = $ids[1];
						$sup_nb++;
					}
				}else{
					$f[$ii]['id_supplier_mopt'] = 0;
					$f[$ii]['id_supplier_mopt_altern'] = 0;
					$f[$ii]['price_mopt_otpusk'] = 0;
				}
				// if($i['order_mopt_qty'] > 0){
				// 	if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['order_mopt_qty'], false)){
				// 		$f[$ii]['id_supplier_mopt'] = $ids[0]['id_supplier'];
				// 		$f[$ii]['filial_mopt'] = $ids[0]['filial'];
				// 		$f[$ii]['price_mopt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, false);
				// 		$order_otpusk_prices_sum += round($f[$ii]['price_mopt_otpusk']*$i['order_mopt_qty'], 2);
				// 		$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier_mopt'], $i['order_mopt_qty']);
				// 		$f[$ii]['id_supplier_mopt_altern'] = $ids[1];
				// 		$sup_nb++;
				// 	}
				// }else{
				// 	$f[$ii]['id_supplier_mopt'] = 0;
				// 	$f[$ii]['id_supplier_mopt_altern'] = 0;
				// 	$f[$ii]['price_mopt_otpusk'] = 0;
				// }
				if(isset($GLOBALS['temp_product_limit'])){
					unset($GLOBALS['temp_product_limit']);
				}
				if($sup_nb < 1){
					$_SESSION['errm']['limit'] = "Невозможно сформировать заказ. Недостаточное количество одного ли нескольких товаров на складе. Остаток недостающего товара отображен в поле названия товара.";
					$this->db->FailTrans();
					return false;
				}
				// Сохранить сумму заказа по отпускным ценам
				$order_otpusk_prices_sum = round($order_otpusk_prices_sum,2);
				$sql = "UPDATE "._DB_PREFIX_."order SET otpusk_prices_sum = $order_otpusk_prices_sum
						WHERE id_order = $id_order";
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
			}
			// $f[$ii]['id_product'] = $id_product;
			// $f[$ii]['opt_qty'] = $i['order_opt_qty'];
			// $f[$ii]['box_qty'] = $i['order_box_qty'];
			// $f[$ii]['mopt_qty'] = $i['order_mopt_qty'];
			$f[$ii]['id_product'] = $id_product;
			if($i['mode']=='opt'){
				$f[$ii]['opt_qty'] = $i['quantity'];
				$f[$ii]['mopt_qty'] = 0;
				$f[$ii]['note_opt'] = $i['note'];
				$f[$ii]['note_mopt'] = '';
				$f[$ii]['default_sum_opt'] = $i['summary'][$_SESSION['cart']['cart_column']];
				$f[$ii]['default_sum_mopt'] = 0;
			}else{
				$f[$ii]['opt_qty'] = 0;
				$f[$ii]['mopt_qty'] = $i['quantity'];
				$f[$ii]['note_mopt'] = $i['note'];
				$f[$ii]['note_opt'] = '';
				$f[$ii]['default_sum_opt'] = 0;
				$f[$ii]['default_sum_mopt'] = $i['summary'][$_SESSION['cart']['cart_column']];
			}
			$Products = new Products();
			$Products->SetFieldsById($id_product);
			$product_arr = $Products->fields;
			$f[$ii]['box_qty'] = $i['quantity']/$product_arr['inbox_qty'];
			//$f[$ii]['box_qty'] = $i['order_box_qty'];
			//************
			// if(!isset($i['basic_opt_price'])){
			// 	$i['basic_opt_price'] = $i['site_price_opt'];
			// }
			// if(!isset($i['basic_mopt_price'])){
			// 	$i['basic_mopt_price'] = $i['site_price_mopt'];
			// }
			// $f[$ii]['default_sum_opt'] = round($i['order_opt_qty']*$i['site_price_opt'], 2);
			// $f[$ii]['default_sum_mopt'] =round($i['order_mopt_qty']*$i['site_price_mopt'], 2);
			if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 1){
				if($i['mode']=='opt'){
					$f[$ii]['opt_sum'] = $i['summary'][$_SESSION['cart']['cart_column']];
					$f[$ii]['mopt_sum'] = 0;
					$f[$ii]['site_price_opt'] = $i['actual_prices'][$_SESSION['cart']['cart_column']];
					$f[$ii]['site_price_mopt'] = 0;
				}else{
					$f[$ii]['opt_sum'] = 0;
					$f[$ii]['mopt_sum'] = $i['summary'][$_SESSION['cart']['cart_column']];
					$f[$ii]['site_price_opt'] = 0;
					$f[$ii]['site_price_mopt'] = $i['actual_prices'][$_SESSION['cart']['cart_column']];
				}
				//$f[$ii]['opt_sum'] = round(round($i['basic_opt_price']*$_SESSION['cart']['personal_discount'],2)*$i['order_opt_qty'],2);
				//$f[$ii]['mopt_sum'] = round(round($i['basic_mopt_price']*$_SESSION['cart']['personal_discount'],2)*$i['order_mopt_qty'],2);
				// $f[$ii]['site_price_opt'] = round($i['basic_opt_price']*$_SESSION['cart']['personal_discount'],2);
				// $f[$ii]['site_price_mopt'] = round($i['basic_mopt_price']*$_SESSION['cart']['personal_discount'],2);
			}else{
				$f[$ii]['opt_sum'] = 0;
				$f[$ii]['mopt_sum'] = 0;
				$f[$ii]['site_price_opt'] = 0;
				$f[$ii]['site_price_mopt'] = 0;

				if(isset($arr['price_column']) && $arr['price_column'] != $_SESSION['cart']['cart_column']){
					$price_column = $arr['price_column'];
				}elseif(isset($_SESSION['cart']['cart_column'])){
					$price_column = $_SESSION['cart']['cart_column'];
				}else{
					$price_column = 3;
				}
				if($i['mode']=='opt'){
					$f[$ii]['opt_sum'] = $i['summary'][$price_column];
					$f[$ii]['site_price_opt'] = $i['actual_prices'][$price_column];
				}else{
					$f[$ii]['mopt_sum'] = $i['summary'][$price_column];
					$f[$ii]['site_price_mopt'] = $i['actual_prices'][$price_column];
				}
				// if(!empty($i['opt_correction_set'])){
				// 	$f[$ii]['opt_sum'] = round(round($i['basic_opt_price']*$i['opt_correction_set'][$price_column],2)*$i['order_opt_qty'],2);
				// 	$f[$ii]['site_price_opt'] = round($i['basic_opt_price']*$i['opt_correction_set'][$price_column],2);
				// }
				// if(!empty($i['mopt_correction_set'])){
				// 	$f[$ii]['mopt_sum'] = round(round($i['basic_mopt_price']*$i['mopt_correction_set'][$price_column],2)*$i['order_mopt_qty'],2);
				// 	$f[$ii]['site_price_mopt'] = round($i['basic_mopt_price']*$i['mopt_correction_set'][$price_column],2);
				// }
			}
			//****************
			if(isset($arr['order'])){
				// Вычесть лимит товара
				// Поставить птицу поставщику, что у него уже был заказ
				if($f[$ii]['id_supplier'] != 0){ // оптовые позиции
					$this->SupplierWasOrder($f[$ii]['id_supplier']);
				}
				if($f[$ii]['id_supplier_mopt'] != 0){ // мелкооптовые позиции
					$this->SupplierWasOrder($f[$ii]['id_supplier_mopt']);
				}
				$CorrectContragentLimitSum = true;
			}
			$ii++;
		}
		if(!$this->db->InsertArr(_DB_PREFIX_.'osp', $f)){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		if(!isset($_SESSION['member']['promo_code']) || $_SESSION['member']['promo_code'] == ''){
			if($order_status == 1){
				$User = new Users();
				$User->SetFieldsById($_SESSION['member']['id_user']);
				if($User->fields['gid'] != _ACL_ANONIM_ && $User->fields['gid'] != _ACL_TERMINAL_){
					$Mailer = new Mailer();
					//$Mailer->SendOrderInvoicesToContragent($id_order);
					//$Mailer->SendOrderInvoicesToAllSuppliers($id_order);
					$Mailer->SendOrderInvoicesToCustomers($id_order);
				}
				if($User->fields['gid'] == _ACL_CUSTOMER_ || $User->fields['gid'] == _ACL_ANONIM_){
					$Gateway = new APISMS($GLOBALS['CONFIG']['sms_key_private'], $GLOBALS['CONFIG']['sms_key_public'], 'http://atompark.com/api/sms/', false);
					$Contragents = new Contragents();
					$string = $Contragents->GetSavedFields($id_contragent);
					$manager2send = $string['name_c'].' '.preg_replace("/[,]/i",", ",preg_replace("/[a-z\\(\\)\\-\\040]/i","",$string['phones']));
					if($arr['phones'] != '' && strlen($arr['phones']) == 10){
						$res = $Gateway->execCommad(
							'sendSMS',
							array(
								'sender' => $GLOBALS['CONFIG']['invoice_logo_text'],
								'text' => 'Заказ № '.$id_order.' принят. Ваш менеджер '.$manager2send,
								'phone' => '38'.$arr['phones'],
								'datetime' => null,
								'sms_lifetime' => 0
							)
						);
					}
				}
			}
		}
		if($_SESSION['member']['gid'] == _ACL_CONTRAGENT_){
			unset($_SESSION['member']['bonus_card']);
		}
		return $id_order;
	}
// public function Add($arr){
// 		//************************************************************
// 		$discount = 0;
// 		if(isset($_SESSION['Cart']['discount'])){
// 			if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 1){
// 				$discount = 1;
// 			}else{
// 				$discount = $_SESSION['Cart']['discount'];
// 			}
// 		}
// 		//*************************************************************
// 		if(count($_SESSION['Cart']['products']) == 0){
// 			return false;
// 		}
// 		global $cart;
// 		$this->UpdateSuppliersTurn();
// 		$cart->IsActualPrices($err, $warn, $errm, $warnings);
// 		if($err){
// 			if(isset($_SESSION['errm'])){
// 				$_SESSION['errm'] = array_merge($_SESSION['errm'], $errm);
// 			}else{
// 				$_SESSION['errm'] = $errm;
// 				header('Location: /cart/');
// 				exit();
// 			}
// 		}
// 		$order_status = 0;
// 		if(isset($_SESSION['member']['promo_code']) && $_SESSION['member']['promo_code'] != ''){
// 			$f['id_order_status'] = 11; // Промо-заказ
// 			$order_status = 11;
// 		}else{
// 			if(isset($arr['p_order'])){
// 				$f['id_order_status'] = 3; // Прогнозный заказ
// 				$order_status = 3;
// 			}elseif(isset($arr['order'])){
// 				$f['id_order_status'] = 1; // Обычный заказ
// 				$order_status = 1;
// 				if(($_SESSION['Cart']['order_opt_sum'] != 0 || $_SESSION['Cart']['order_mopt_sum'] != 0)
// 					&& ($_SESSION['Cart']['order_opt_sum']+$_SESSION['Cart']['order_mopt_sum']) < $GLOBALS['CONFIG']['min_sum_order']){
// 					$_SESSION['errm'][] = "Минимальная сумма заказа: ".$GLOBALS['CONFIG']['min_sum_order_nac'];
// 					header('Location: /cart/');
// 					exit();
// 				}
// 			}
// 		}
// 		if(isset($_SESSION['Cart']['base_order'])){
// 			$f['base_order'] = $_SESSION['Cart']['base_order'];
// 		}
// 		$f['phones'] = mysql_real_escape_string(trim('38'.substr(preg_replace("/[^0-9,.]/", "", $arr['phones']), -10)));
// 		$f['id_delivery'] = mysql_real_escape_string(trim($arr['id_delivery']));
// 		$f['id_city'] = mysql_real_escape_string(trim($arr['id_delivery_department']));
// 		$f['id_delivery_service'] = mysql_real_escape_string(trim(isset($arr['id_delivery_service'])?$arr['id_delivery_service']:0));
// 		$f['id_contragent'] = mysql_real_escape_string(trim($arr['id_manager']));
// 		$f['id_customer'] = $id_customer = $_SESSION['member']['id_user'];
// 		$f['cont_person'] = mysql_real_escape_string(trim($arr['cont_person']));
// 		$f['need_sertificate'] = 0;
// 		if(isset($arr['need_sertificate']) && $arr['need_sertificate'] == "on"){
// 			$f['need_sertificate'] = 1;
// 		}
// 		$f['strachovka'] = mysql_real_escape_string(trim($arr['strachovka']));
// 		if(isset($arr['bonus_card']) && $arr['bonus_card'] != ''){
// 			$f['bonus_card'] = mysql_real_escape_string(trim($arr['bonus_card']));
// 		}
// 		if(isset($arr['promo-code']) && $arr['promo-code'] != ''){
// 			$f['promo_code'] = mysql_real_escape_string(trim($arr['promo-code']));
// 		}
// 		$f['descr'] = mysql_real_escape_string(trim($arr['description']));
// 		$f['creation_date'] = time();
// 		if(isset($arr['price_column']) && $arr['price_column'] != $_SESSION['price_column']){
// 			$f['sum_opt'] = $_SESSION['Cart']['opt_sum_default'][$arr['price_column']];
// 			$f['sum_mopt'] = $_SESSION['Cart']['mopt_sum_default'][$arr['price_column']];
// 			$f['sum_discount'] = $f['sum'] = $_SESSION['Cart']['order_sum'][$arr['price_column']];
// 			$f['manual_price_change'] = $arr['price_column'].' - '.$arr['reason'];
// 		}else{
// 			$f['sum_opt'] = $_SESSION['Cart']['order_opt_sum'];
// 			$f['sum_mopt'] = $_SESSION['Cart']['order_mopt_sum'];
// 			$f['sum'] = $_SESSION['Cart']['sum'];
// 			$f['sum_discount'] = $_SESSION['Cart']['sum_discount'];
// 		}
// 		$f['discount'] = mysql_real_escape_string(trim($arr['discount']));
// 		if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 0){
// 			$f['discount'] = null;
// 		}
// 		$sum_total = $f['sum_discount'];
// 		$f['skey'] = md5(time().'jWfUsd');
// 		$this->db->StartTrans();
// 		if(!$this->db->Insert(_DB_PREFIX_.'order', $f)){
// 			$this->db->FailTrans();
// 			return false;
// 		}
// 		$id_order = $this->db->GetInsId();
// 		list($d,$m,$y) = explode(".", trim($arr['target_date']));
// 		$arr['target_date'] = mktime(0, 0, 0, $m , $d, $y);
// 		// Заполнение связки заказ-товары
// 		$target_date = $arr['target_date'];
// 		$id_contragent = $f['id_contragent'];
// 		$Supplier = new Suppliers();
// 		$order_otpusk_prices_sum = 0;
// 		$ii = 0;
// 		$f = array();
// 		//** Нужно получить ошибки по всем товарам
// 		foreach($_SESSION['Cart']['products'] as $id_product=>$i){
// 			if($i['order_opt_sum'] > 0) $this->GetSupplierForProduct($id_product, $target_date, $i['order_opt_qty'], true);
// 			if($i['order_mopt_sum'] > 0) $this->GetSupplierForProduct($id_product, $target_date, $i['order_mopt_qty'], false);
// 		}
// 		//**
// 		foreach($_SESSION['Cart']['products'] as $id_product=>$i){
// 			$f[$ii]['id_order'] = $id_order;
// 			if(isset($arr['p_order'])){ // Прогнозный заказ
// 				$f[$ii]['id_supplier'] = 0;
// 				$f[$ii]['id_supplier_mopt'] = 0;
// 			}elseif(isset($arr['order'])){ // Обычный заказ
// 				$sup_nb = 0;
// 				$f[$ii]['id_supplier'] = 0;
// 				$f[$ii]['id_supplier_mopt'] = 0;
// 				$f[$ii]['price_opt_otpusk'] = 0;
// 				$f[$ii]['price_mopt_otpusk'] = 0;
// 				$f[$ii]['filial_mopt'] = 0;
// 				$f[$ii]['filial_opt'] = 0;
// 				if($i['order_opt_qty'] > 0){
// 					if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['order_opt_qty'], true)){
// 						$f[$ii]['id_supplier'] = $ids[0]['id_supplier'];
// 						$f[$ii]['filial_opt'] = $ids[0]['filial'];
// 						$f[$ii]['price_opt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, true);
// 						$order_otpusk_prices_sum += round($f[$ii]['price_opt_otpusk']*$i['order_opt_qty'], 2);
// 						$GLOBALS['temp_product_limit'] = $i['order_opt_qty'];
// 						$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier'], $i['order_opt_qty']);
// 						$f[$ii]['id_supplier_altern'] = $ids[1];
// 						$sup_nb++;
// 					}
// 				}else{
// 					$f[$ii]['id_supplier'] = 0;
// 					$f[$ii]['id_supplier_altern'] = 0;
// 					$f[$ii]['price_opt_otpusk'] = 0;
// 				}
// 				if($i['order_mopt_qty'] > 0){
// 					if($ids = $this->GetSupplierForProduct($id_product, $target_date, $i['order_mopt_qty'], false)){
// 						$f[$ii]['id_supplier_mopt'] = $ids[0]['id_supplier'];
// 						$f[$ii]['filial_mopt'] = $ids[0]['filial'];
// 						$f[$ii]['price_mopt_otpusk'] = $Supplier->GetPriceOtpusk($ids[0]['id_supplier'], $id_product, false);
// 						$order_otpusk_prices_sum += round($f[$ii]['price_mopt_otpusk']*$i['order_mopt_qty'], 2);
// 						$this->CorrectProductLimit($id_product, $f[$ii]['id_supplier_mopt'], $i['order_mopt_qty']);
// 						$f[$ii]['id_supplier_mopt_altern'] = $ids[1];
// 						$sup_nb++;
// 					}
// 				}else{
// 					$f[$ii]['id_supplier_mopt'] = 0;
// 					$f[$ii]['id_supplier_mopt_altern'] = 0;
// 					$f[$ii]['price_mopt_otpusk'] = 0;
// 				}
// 				if(isset($GLOBALS['temp_product_limit'])) unset($GLOBALS['temp_product_limit']);
// 				if($sup_nb < 1){
// 					$_SESSION['errm']['limit'] = "Невозможно сформировать заказ. Недостаточное количество одного ли нескольких товаров на складе. Остаток недостающего товара отображен в поле названия товара.";
// 					$this->db->FailTrans();
// 					return false;
// 				}
// 				// Сохранить сумму заказа по отпускным ценам
// 				$order_otpusk_prices_sum = round($order_otpusk_prices_sum,2);
// 				$sql = "UPDATE "._DB_PREFIX_."order SET otpusk_prices_sum = $order_otpusk_prices_sum
// 						WHERE id_order = $id_order";
// 				if(!$this->db->Query($sql)){
// 					$this->db->FailTrans();
// 					G::DieLoger("SQL error - $sql");
// 					return false;
// 				}
// 			}
// 			$f[$ii]['id_product'] = $id_product;
// 			$f[$ii]['opt_qty'] = $i['order_opt_qty'];
// 			$f[$ii]['box_qty'] = $i['order_box_qty'];
// 			$f[$ii]['mopt_qty'] = $i['order_mopt_qty'];
// 			//************
// 			if(!isset($i['basic_opt_price'])){
// 				$i['basic_opt_price'] = $i['site_price_opt'];
// 			}
// 			if(!isset($i['basic_mopt_price'])){
// 				$i['basic_mopt_price'] = $i['site_price_mopt'];
// 			}
// 			$f[$ii]['default_sum_opt'] = round($i['order_opt_qty']*$i['site_price_opt'], 2);
// 			$f[$ii]['default_sum_mopt'] =round($i['order_mopt_qty']*$i['site_price_mopt'], 2);
// 			if(isset($_SESSION['price_mode']) && $_SESSION['price_mode'] == 1){
// 				$f[$ii]['opt_sum'] = round(round($i['basic_opt_price']*$_SESSION['Cart']['personal_discount'],2)*$i['order_opt_qty'],2);
// 				$f[$ii]['mopt_sum'] = round(round($i['basic_mopt_price']*$_SESSION['Cart']['personal_discount'],2)*$i['order_mopt_qty'],2);
// 				$f[$ii]['site_price_opt'] = round($i['basic_opt_price']*$_SESSION['Cart']['personal_discount'],2);
// 				$f[$ii]['site_price_mopt'] = round($i['basic_mopt_price']*$_SESSION['Cart']['personal_discount'],2);
// 			}else{
// 				$f[$ii]['opt_sum'] = 0;
// 				$f[$ii]['mopt_sum'] = 0;
// 				$f[$ii]['site_price_opt'] = 0;
// 				$f[$ii]['site_price_mopt'] = 0;

// 				if(isset($arr['price_column']) && $arr['price_column'] != $_SESSION['price_column']){
// 					$price_column = $arr['price_column'];
// 				}elseif(isset($_SESSION['price_column'])){
// 					$price_column = $_SESSION['price_column'];
// 				}else{
// 					$price_column = 3;
// 				}
// 				if(!empty($i['opt_correction_set'])){
// 					$f[$ii]['opt_sum'] = round(round($i['basic_opt_price']*$i['opt_correction_set'][$price_column],2)*$i['order_opt_qty'],2);
// 					$f[$ii]['site_price_opt'] = round($i['basic_opt_price']*$i['opt_correction_set'][$price_column],2);
// 				}
// 				if(!empty($i['mopt_correction_set'])){
// 					$f[$ii]['mopt_sum'] = round(round($i['basic_mopt_price']*$i['mopt_correction_set'][$price_column],2)*$i['order_mopt_qty'],2);
// 					$f[$ii]['site_price_mopt'] = round($i['basic_mopt_price']*$i['mopt_correction_set'][$price_column],2);
// 				}
// 			}
// 			//****************
// 			$f[$ii]['note_opt'] = $i['note_opt'];
// 			$f[$ii]['note_mopt'] = $i['note_mopt'];
// 			if(isset($arr['order'])){
// 				// Вычесть лимит товара
// 				// Поставить птицу поставщику, что у него уже был заказ
// 				if($f[$ii]['id_supplier'] != 0){ // оптовые позиции
// 					$this->SupplierWasOrder($f[$ii]['id_supplier']);
// 				}
// 				if($f[$ii]['id_supplier_mopt'] != 0){ // мелкооптовые позиции
// 					$this->SupplierWasOrder($f[$ii]['id_supplier_mopt']);
// 				}
// 				$CorrectContragentLimitSum = true;
// 			}
// 			$ii++;
// 		}
// 		if(!$this->db->InsertArr(_DB_PREFIX_.'osp', $f)){
// 			$this->db->FailTrans();
// 			return false;
// 		}
// 		$this->db->CompleteTrans();
// 		if(!isset($_SESSION['member']['promo_code']) || $_SESSION['member']['promo_code'] == ''){
// 			if($order_status == 1){
// 				$User = new Users();
// 				$User->SetFieldsById($id_customer);
// 				if($User->fields['gid'] != _ACL_ANONIM_ && $User->fields['gid'] != _ACL_TERMINAL_){
// 					$Mailer = new Mailer();
// 					//$Mailer->SendOrderInvoicesToContragent($id_order);
// 					//$Mailer->SendOrderInvoicesToAllSuppliers($id_order);
// 					$Mailer->SendOrderInvoicesToCustomers($id_order);
// 				}
// 				if($User->fields['gid'] == _ACL_CUSTOMER_ || $User->fields['gid'] == _ACL_ANONIM_){
// 					$Gateway = new APISMS($GLOBALS['CONFIG']['sms_key_private'], $GLOBALS['CONFIG']['sms_key_public'], 'http://atompark.com/api/sms/', false);
// 					$Contragents = new Contragents();
// 					$string = $Contragents->GetSavedFields($id_contragent);
// 					$manager2send = $string['name_c'].' '.preg_replace("/[,]/i",", ",preg_replace("/[a-z\\(\\)\\-\\040]/i","",$string['phones']));
// 					if($arr['phones'] != '' && strlen($arr['phones']) == 10){
// 						$res = $Gateway->execCommad(
// 							'sendSMS',
// 							array(
// 								'sender' => $GLOBALS['CONFIG']['invoice_logo_text'],
// 								'text' => 'Заказ № '.$id_order.' принят. Ваш менеджер '.$manager2send,
// 								'phone' => '38'.$arr['phones'],
// 								'datetime' => null,
// 								'sms_lifetime' => 0
// 							)
// 						);
// 					}
// 				}
// 			}
// 		}
// 		if($User->fields['gid'] == _ACL_CONTRAGENT_){
// 			unset($_SESSION['member']['bonus_card']);
// 		}
// 		return $id_order;
// 	}

	// Обновление
	public function GetStatuses(){
		$sql = "SELECT id_order_status, name
				FROM "._DB_PREFIX_."order_status
				order by id_order_status";
		$arr = $this->db->GetArray($sql);
		foreach($arr as $i){
			$a[$i['id_order_status']] = $i;
		}
		return $a;
	}

	// Возвращает id вычисленного поставщика для товара
	public function GetSupplierForProduct($id_product, $target_date, $product_limit, $opt = true){
		// если продукт имеет эксклюзивного поставщика
		if($id = $this->ExclusivSupplier($id_product, $target_date, $product_limit, $opt)){
			return array($id,0);
		}else{
			// определение списка доступных поставщиков
			$sql = "SELECT a.id_product, a.id_supplier, a.price_opt_otpusk, a.price_mopt_otpusk, a.product_limit, s.was_order, s.filial
					FROM "._DB_PREFIX_."assortiment a, "._DB_PREFIX_."supplier s
					WHERE a.active=1
					AND ((a.price_opt_otpusk!=0 AND a.price_opt_recommend!=0) OR (a.price_mopt_otpusk!=0 AND a.price_mopt_recommend!=0))
					AND a.id_supplier=s.id_user
					AND a.id_product=$id_product
					ORDER BY ";
			$sql .= $opt?"a.price_opt_otpusk":"a.price_mopt_otpusk";
			$arr = $this->db->GetArray($sql);
			$sups = array();
			foreach($arr as $i){
				if($i['product_limit'] >= $product_limit && $i['was_order'] == 0 &&
					$this->IsAvailableSupplierInDate($i['id_supplier'], $target_date) &&
					$this->CheckRentabPrice($id_product, $i['id_supplier'], $opt)){
					$sups[] = $i;
				}
			}
			$retarr = array();
			if(count($sups)>1){
				return array($sups[0],$sups[1]);
			}elseif(count($sups)){
				$retarr[0] = $sups[0];
			}
			$sups = array();$sups_limit = array();
			foreach($arr as $i){
				if($this->IsAvailableSupplierInDate($i['id_supplier'], $target_date)  &&
					$this->CheckRentabPrice($id_product, $i['id_supplier'], $opt)){
					if($i['product_limit'] >= $product_limit){
						$sups[] = $i;
					}else{
						$sups_limit[] = $i;
					}
				}
			}
			if(isset($retarr[0]) && !count($sups)){ // есть основной поставщик, а еще не нашли
				return array($retarr[0], 0);
			}
			if(isset($retarr[0]) && count($sups)){ // есть основной поставщик и нашли еще
				return array($retarr[0], $sups[0]);
			}elseif(!isset($retarr[0]) && count($sups)>1){	// не было основного и нашли больше одного
				return array($sups[0], $sups[1]);
			}elseif(!isset($retarr[0]) && count($sups)){ // не было основного и нашли только одного
				return array($sups[0], 0);
			}elseif(count($sups_limit)){
				$max_available_limit = 0;
				foreach($sups_limit as $k=>$v){
					if($v['product_limit']>$max_available_limit){
						$max_available_limit = $v['product_limit'];
					}
				}
			if(isset($GLOBALS['temp_product_limit'])) $max_available_limit += $GLOBALS['temp_product_limit'];
				$_SESSION['errm']['products'][$id_product]['order_qty'] = "Доступное количество: ".$max_available_limit;
				return false;
			}else{
				$_SESSION['errm']['products'][$id_product]['order_qty'] = "Данного товара нет на складе.";
				return false;
			}
		}
	}

	// Проверка на эксклюзивного поставщика
	public function ExclusivSupplier($id_product, $target_date, $product_limit, $opt){
		$sql = "SELECT p.exclusive_supplier as id_supplier, p.filial
				FROM "._DB_PREFIX_."product p LEFT JOIN "._DB_PREFIX_."supplier AS s ON p.exclusive_supplier = s.id_user
				WHERE p.id_product=$id_product";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr['id_supplier'] == 0){
			return false;
		}else{ // Если поставщик доступен по дате и у него достаточное количество товара
			if($this->IsAvailableSupplierInDate($arr['id_supplier'], $target_date) && $this->CheckProductLimit($id_product, $arr['id_supplier'],$target_date, $product_limit) && $this->CheckRentabPrice($id_product, $arr['id_supplier'], $opt)){
				return $arr;
			}else{
				return false;
			}
		}
	}

	// Проверка на рентабельность цен поставщика
	public function CheckRentabPrice($id_product, $id_supplier, $opt){
		if($opt){
			$opt = "opt";
		}else{
			$opt = "mopt";
		}
		$sql = "SELECT p.price_{$opt} as site_price, a.price_{$opt}_otpusk as price_otpusk
				FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."assortiment a
				WHERE p.id_product=a.id_product
				AND p.id_product=$id_product
				AND a.id_supplier=$id_supplier
				";
		$arr = $this->db->GetOneRowArray($sql);
		$delta = round(($arr['site_price'] * $GLOBALS['CONFIG']['proc_supplier'] / 100) , 2);
		if($arr['price_otpusk']>($arr['site_price']-$delta) || $arr['price_otpusk']<=0){
			return false;
		}else{
			return true;
		}
	}
	// Проверка на доступность поставщика в этот день */*
	public function IsAvailableSupplierInDate($id_supplier, $target_date){
		$target_date = date("Y-m-d",$target_date);
		$sql = "SELECT date
				FROM "._DB_PREFIX_."calendar_supplier
				WHERE id_supplier=$id_supplier
				AND date=\"$target_date\"
				AND work_day = 1";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr){
			return true;
		}else{
			return false;
		}
	}

	// Проверить доступное количество товара
	public function CheckProductLimit($id_product, $id_exclusive_supplier, $target_date, $product_limit){
		$sql = "SELECT a.product_limit
				FROM "._DB_PREFIX_."assortiment a
				WHERE id_supplier=$id_exclusive_supplier
				AND a.id_product=$id_product";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr['product_limit'] >= $product_limit){
			return true;
		}else{
			//$_SESSION['errm'][] = "Превышено доступное количество товара.";
			//$_SESSION['Supplier']['limit_err'][$id_product] = "Количество, доступное для заказа: ".$arr['product_limit'];
			return false;
		}
	}
	public function CorrectProductLimit($id_product, $id_supplier, $limit){
		$sql = "UPDATE "._DB_PREFIX_."assortiment SET product_limit=product_limit-$limit
				WHERE id_product=$id_product
				AND id_supplier=$id_supplier";
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			return false;
		}
		return true;
	}
	public function SupplierWasOrder($id_supplier){
		$sql = "UPDATE "._DB_PREFIX_."supplier SET was_order=1
				WHERE id_user=$id_supplier";
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			return false;
		}
		return true;
	}
	// Проверка контрагента на доступность по дате и сумме
	public function IsAvailableContragentInDateSum($id_contragent, $target_date, $sum){
		$target_date = date("Y-m-d",$target_date);
		$sql = "SELECT date
				FROM "._DB_PREFIX_."calendar_contragent
				WHERE id_contragent = ".$id_contragent."
				AND date = '".$target_date."'
				AND (work_day != 0 || work_night != 0)
				AND (limit_sum_day > $sum || limit_sum_night != $sum)";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr){
			return true;
		}else{
			return false;
		}
	}
	public function CorrectContragentLimitSum($id_contragent, $limit_sum, $target_date){
		$sql = "SELECT limit_sum_day, limit_sum_night
			FROM "._DB_PREFIX_."calendar_contragent
			WHERE id_contragent = ".$id_contragent."
			AND date='".date("Y-m-d",$target_date)."'";
		$arr = $this->db->GetOneRowArray($sql);

		if($arr['limit_sum_day'] > $limit_sum){
			$dn = 'day';
		}elseif($arr['limit_sum_night'] > $limit_sum){
			$dn = 'night';
		}else{
			$this->db->FailTrans();
			return false;
		}
		$sql = "UPDATE "._DB_PREFIX_."calendar_contragent
			SET limit_sum_".$dn." = limit_sum_".$dn-$limit_sum."
			WHERE id_contragent = ".$id_contragent."
			AND date='".date("Y-m-d",$target_date)."'";
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			return false;
		}
		return true;
	}

	public function GetOrderForContragent($and){
		$sql = "SELECT o.id_order, o.id_order_status, o.sum_discount,
				o.note, osp.id_product, p.name, p.img_1, p.art, p.inbox_qty,
				osp.site_price_opt, osp.site_price_mopt, osp.box_qty,
				osp.mopt_qty, osp.opt_sum, osp.mopt_sum, s.article, osp.opt_qty,
				osp.id_supplier, osp.id_supplier_mopt, o.target_date,
				osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum,
				osp.contragent_msum, osp.fact_qty, osp.fact_sum, osp.fact_mqty,
				osp.fact_msum, osp.return_qty, osp.return_sum, osp.return_mqty,
				osp.return_msum, o.id_pretense_status, o.id_return_status,
				osp.id_supplier_altern, osp.id_supplier_mopt_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt
				) AS article_mopt,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_altern
				) AS article_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt_altern
				) AS article_mopt_altern
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_order, osp.id_product
			ORDER BY article, article_mopt, p.name
			";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	public function GetOrderForMdiler($and){
		$sql = "SELECT o.id_order, o.id_order_status, o.sum_discount,
				osp.id_product, p.name, p.art, p.img_1, osp.site_price_opt,
				osp.site_price_mopt, osp.opt_qty, osp.mopt_qty, osp.opt_sum,
				osp.mopt_sum, s.article, osp.id_supplier, osp.id_supplier_mopt,
				o.target_date, osp.contragent_qty, osp.contragent_mqty,
				osp.contragent_sum, osp.contragent_msum, osp.price_opt_otpusk,
				osp.price_mopt_otpusk, osp.id_supplier_altern, osp.id_supplier_mopt_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt
				) AS article_mopt,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_altern
				) AS article_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt_altern
				) AS article_mopt_altern
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_order, osp.id_product
			ORDER BY p.name";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function ExecuteContragentOrder($arr, $id_order){
		$Supplier = new Suppliers();
		$sql = "SELECT id_product, site_price_opt, site_price_mopt
			FROM "._DB_PREFIX_."osp
			WHERE id_order = ".$id_order;
		$prices = $this->db->GetArray($sql, "id_product");
		if(isset($arr['contr_qty'])){
			foreach($arr['contr_qty'] as $id_product=>$contr_qty){
				$contr_qty = mysql_real_escape_string($contr_qty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET contragent_qty = ".$contr_qty.",
						contragent_sum = ".round($arr['contr_qty'][$id_product]*$prices[$id_product]['site_price_opt'],2).",
						id_supplier = {$Supplier->GetSupplierIdByArt($arr['article'][$id_product])}
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				$this->db->StartTrans();
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
				$this->db->CompleteTrans();
			}
		}
		if(isset($arr['contr_mqty'])){
			foreach($arr['contr_mqty'] as $id_product=>$contr_mqty){
				$contr_mqty = mysql_real_escape_string($contr_mqty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET contragent_mqty = ".$contr_mqty.",
						contragent_msum = ".round($arr['contr_mqty'][$id_product]*$prices[$id_product]['site_price_mopt'],2).",
						id_supplier_mopt = {$Supplier->GetSupplierIdByArt($arr['article_mopt'][$id_product])}
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				$this->db->StartTrans();
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
				$this->db->CompleteTrans();
			}
		}
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 2
			WHERE id_order = ".$id_order;
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function CancelContragentOrder($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 4
			WHERE id_order = ".$id_order;
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function RunContragentOrder($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 6
			WHERE id_order = ".$id_order;
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function OffUserOrder($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 5,
				visibility = 0
			WHERE id_order = ".$id_order;
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function CancelCustomerOrder($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 5
			WHERE id_order = ".$id_order;
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			G::DieLoger("SQL error - $sql");
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function ExecuteContragentPretense($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_pretense_status = 2
			WHERE id_order = ".$id_order;
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		return true;
	}

	public function UpdateStatus($id_order, $status, $date = false){
		if(isset($date)){
			$sql = "UPDATE "._DB_PREFIX_."order
				SET id_order_status = ".$status.",
					target_date = UNIX_TIMESTAMP('".$date."')
				WHERE id_order = ".$id_order;
		}else{
			$sql = "UPDATE "._DB_PREFIX_."order
				SET id_order_status = ".$status."
				WHERE id_order = ".$id_order;
		}
		if(!$this->db->Query($sql)){
			G::DieLoger("SQL error - $sql");
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function GetOrderForCustomer($and){
		$sql = "SELECT o.id_order, o.id_order_status, o.sum_discount,
				osp.id_product, osp.id_supplier_altern, osp.return_qty,
				osp.site_price_opt, osp.site_price_mopt, p.inbox_qty,
				osp.box_qty, osp.opt_qty, osp.mopt_qty, osp.opt_sum,
				osp.mopt_sum, s.article, osp.id_supplier, p.name, p.art,
				o.target_date, osp.contragent_qty, osp.contragent_mqty,
				osp.contragent_sum, osp.contragent_msum, osp.fact_qty,
				osp.fact_sum, osp.fact_mqty, osp.fact_msum, p.img_1,
				osp.return_sum, osp.return_mqty, osp.return_msum, p.units,
				o.id_pretense_status, o.id_return_status, p.translit,
				osp.id_supplier_mopt_altern, osp.id_supplier_mopt,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt
				) AS article_mopt,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_altern
				) AS article_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt_altern
				) AS article_mopt_altern
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_order, osp.id_product
			ORDER BY p.name";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	public function GetOrderForPricelist($and){
		$sql = "SELECT DISTINCT cp.id_category, c.name
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			LEFT JOIN "._DB_PREFIX_."cat_prod AS cp
				ON osp.id_product = cp.id_product
			LEFT JOIN "._DB_PREFIX_."category AS c
				ON cp.id_category = c.id_category
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_product
			ORDER BY p.name";
		$arr['cats'] = $this->db->GetArray($sql);
		$ii = 0;
		$sql = "SELECT o.id_order, o.id_order_status, cp.id_category,
				o.sum_discount, osp.id_product, p.name, p.art, p.img_1,
				osp.site_price_opt, osp.site_price_mopt, p.inbox_qty,
				osp.opt_qty, osp.mopt_qty, osp.opt_sum, osp.mopt_sum,
				osp.id_supplier, osp.id_supplier_mopt, o.target_date,
				osp.contragent_qty, osp.contragent_mqty, osp.contragent_sum,
				osp.fact_qty, osp.fact_sum, osp.fact_mqty, osp.fact_msum,
				osp.return_qty, osp.return_sum, osp.return_mqty, osp.return_msum,
				p.min_mopt_qty, p.units, osp.box_qty, o.id_pretense_status,
				o.id_return_status, osp.contragent_msum
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			LEFT JOIN "._DB_PREFIX_."cat_prod AS cp
				ON osp.id_product = cp.id_product
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_order, osp.id_product
			ORDER BY p.name";
		$arr['products'] = $this->db->GetArray($sql);
		foreach($arr['cats'] as $k=>$c){
			foreach($arr['products'] as $p){
				if($p['id_category'] == $c['id_category']){
					$arr['cats'][$k]['products'][] = $p;
				}
			}
		}
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	public function GetOrderForAdmin($and){
		$sql = "SELECT o.id_order, o.id_order_status, osp.id_product,
				p.name, p.img_1, osp.site_price_opt, osp.site_price_mopt,
				p.inbox_qty, osp.box_qty, osp.opt_qty, osp.mopt_qty,
				osp.opt_sum, osp.mopt_sum, s.article, osp.id_supplier,
				osp.id_supplier_mopt, o.target_date, osp.contragent_qty,
				osp.contragent_mqty, osp.contragent_sum, osp.contragent_msum,
				osp.fact_qty, osp.fact_sum, osp.fact_mqty, osp.fact_msum,
				osp.return_qty, osp.return_sum, osp.return_mqty, osp.return_msum,
				o.id_pretense_status, o.id_return_status, osp.id_supplier_altern,
				osp.id_supplier_mopt_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt
				) AS article_mopt,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_altern
				) AS article_altern,
				(SELECT "._DB_PREFIX_."supplier.article
					FROM "._DB_PREFIX_."supplier
					WHERE "._DB_PREFIX_."supplier.id_user = osp.id_supplier_mopt_altern
				) AS article_mopt_altern
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			LEFT JOIN "._DB_PREFIX_."supplier AS s
				ON osp.id_supplier = s.id_user
			LEFT JOIN "._DB_PREFIX_."product AS p
				ON osp.id_product = p.id_product
			".$this->db->GetWhere($and)."
			GROUP BY osp.id_order, osp.id_product";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	// Создание претензии
	public function CreatePretense($arr, $id_order){
		$sql = "SELECT id_product, site_price_opt, site_price_mopt
			FROM "._DB_PREFIX_."osp
			WHERE id_order = ".$id_order;
		$prices = $this->db->GetArray($sql, "id_product");
		$this->db->StartTrans();
		// Заполнение факт кол-ва существующих позиций
		if(isset($arr['fact_qty'])){
			foreach($arr['fact_qty'] as $id_product=>$fact_qty){
				$fact_qty = mysql_real_escape_string($fact_qty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET fact_qty = ".$fact_qty.",
						fact_sum = ".round($arr['fact_qty'][$id_product]*$prices[$id_product]['site_price_opt'],2)."
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
			}
		}
		if(isset($arr['fact_mqty'])){
			foreach($arr['fact_mqty'] as $id_product=>$fact_mqty){
				$fact_mqty = mysql_real_escape_string($fact_mqty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET fact_mqty = ".$fact_mqty.",
						fact_msum = ".round($arr['fact_mqty'][$id_product]*$prices[$id_product]['site_price_mopt'],2)."
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
			}
		}
		// Заполнение новых (добавленных юзером) позиций
		$this->db->DeleteRowFrom(_DB_PREFIX_."pretense", "id_order", $id_order);
		if(isset($arr['pretense_article'])){
			foreach($arr['pretense_article'] as $ii=>$pretense_article){
				$f['id_order'] = $id_order;
				$f['article'] = mysql_real_escape_string($pretense_article);
				$f['name'] = mysql_real_escape_string($arr['pretense_name'][$ii]);
				$f['price'] = mysql_real_escape_string($arr['pretense_price'][$ii]);
				$f['qty'] = mysql_real_escape_string($arr['pretense_qty'][$ii]);
				if(!$this->db->Insert(_DB_PREFIX_.'pretense', $f)){
					$this->db->FailTrans();
					return false;
				}
			}
		}
		// Установка статуса "В работе" претензии заказа
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_pretense_status = 1,
				pretense_date = '".time()."'
			WHERE id_order = ".$id_order;
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function GetPretenseAdditionalRows($id_order){
		$sql = "SELECT article, name, price, qty
			FROM "._DB_PREFIX_."pretense
			WHERE id_order = ".$id_order;
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	public function CreateReturn($arr,$id_order) {
		$sql = "SELECT id_product, site_price_opt, site_price_mopt
			FROM "._DB_PREFIX_."osp
			WHERE id_order = ".$id_order;
		$prices = $this->db->GetArray($sql, "id_product");
		$this->db->StartTrans();
		// обработка строк по крупному опту
		if(isset($arr['return_qty'])){
			foreach($arr['return_qty'] as $id_product=>$return_qty){
				$return_qty = mysql_real_escape_string($return_qty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET return_qty = ".$return_qty.",
						return_sum = ".round($arr['return_qty'][$id_product]*$prices[$id_product]['site_price_opt'], 2)."
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
			}
		}
		// обработка строк по мелкому опту
		if(isset($arr['return_mqty'])){
			foreach($arr['return_mqty'] as $id_product=>$return_mqty){
				$return_mqty = mysql_real_escape_string($return_mqty);
				$sql = "UPDATE "._DB_PREFIX_."osp
					SET return_mqty = ".$return_mqty.",
						return_msum = ".round($arr['return_mqty'][$id_product]*$prices[$id_product]['site_price_mopt'], 2)."
					WHERE id_order = ".$id_order."
					AND id_product = ".$id_product;
				if(!$this->db->Query($sql)){
					$this->db->FailTrans();
					G::DieLoger("SQL error - $sql");
					return false;
				}
			}
		}
		// Установка статуса "В работе" возврата заказа
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_return_status = 1,
				return_date = '".time()."'
			WHERE id_order = ".$id_order;
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	// Перевод заказа в статус "Выполнен"
	public function ExecuteContragentReturn($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_return_status = 2
			WHERE id_order = ".$id_order;
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		return true;
	}

	// Проверка и обновление даты обнуления очереди пооставщиков
	public function UpdateSuppliersTurn(){
		// Проверка даты очистки очереди
		$date = date("Y-m-d", time());
		if($date > $GLOBALS['CONFIG']['turn_date']){
			// если дата устарела - устанавливаем новую
			$new_date = date("Y-m-d", (time()+3600*24*$GLOBALS['CONFIG']['turn_days']));
			$f['value'] = $new_date;
			$this->db->StartTrans();
			$this->db->Update(_DB_PREFIX_."config", $f, "name = 'turn_date'");
			$f = array('was_order'=>0);
			$this->db->Update(_DB_PREFIX_."supplier", $f, "1");
			$this->db->CompleteTrans();
		}
	}

	public function GetOrderForCart($and){
		$sql = "SELECT o.id_order, osp.id_product,
				osp.box_qty, osp.opt_qty, osp.mopt_qty,
				osp.opt_sum, osp.mopt_sum, osp.note_opt,
				osp.note_mopt, osp.default_sum_opt, osp.default_sum_mopt
			FROM "._DB_PREFIX_."osp AS osp
			LEFT JOIN "._DB_PREFIX_."order AS o
				ON osp.id_order = o.id_order
			".$this->db->GetWhere($and);
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}else{
			return $arr;
		}
	}

	// Объявление полей для экспорта "Заказы по поставщикам"
	public function GetExcelOrdersSupColumnsArray(){
		$ii = 0;
		$ca[$ii++] = array('h'=>'Дата', 						'n' => 'target_date',			'w'=>'14');
		$ca[$ii++] = array('h'=>'Статус', 						'n' => 'status_name', 			'w'=>'20');
		$ca[$ii++] = array('h'=>'Заказ',						'n' => 'id_order',		 		'w'=>'16');
		$ca[$ii++] = array('h'=>'Код части заказа', 			'n' => 'id_order_supart', 		'w'=>'20');
		$ca[$ii++] = array('h'=>'Покупатель', 					'n' => 'customer_name',		 	'w'=>'62');
		$ca[$ii++] = array('h'=>'Контрагент', 					'n' => 'contragent_name',		'w'=>'34');
		$ca[$ii++] = array('h'=>'Поставщик', 					'n' => 'supplier_name', 		'w'=>'34');
		$ca[$ii++] = array('h'=>'Группа',						'n' => 'partner', 				'w'=>'16');
		$ca[$ii++] = array('h'=>'Сумма по заказу, грн',			'n' => 'order_sum', 			'w'=>'20');
		$ca[$ii++] = array('h'=>'Сумма по отпуск ценам, грн',	'n' => 'otpusk_prices_sum',		'w'=>'20');
		$ca[$ii++] = array('h'=>'Претензия',					'n' => 'pretense', 				'w'=>'20');
		$ca[$ii++] = array('h'=>'Статус',						'n' => 'pretense_status',		'w'=>'20');
		$ca[$ii++] = array('h'=>'Возврат',						'n' => 'return', 				'w'=>'20');
		$ca[$ii++] = array('h'=>'Статус',						'n' => 'return_status',			'w'=>'20');
		return $ca;
	}

	// Генерация и выдача для скачивания файла excel "Заказы по поставщикам"
	public function GenExcelOrdersSupFile($rows){
		require($GLOBALS['PATH_sys'].'excel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Generator xtorg")
			->setLastModifiedBy("Generator xtorg")
			 ->setTitle("Products")
			 ->setSubject("Generator xtorg: products")
			 ->setDescription("Generator xtorg.")
			 ->setKeywords("office 2007 openxml php")
			 ->setCategory("result file");
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15);
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
		$ca = $this->GetExcelOrdersSupColumnsArray();
		$ii=1;
		foreach($ca as $i){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($ii+64).'1', $i['h']);
			$objPHPExcel->getActiveSheet()->getStyle(chr($ii+64).'1')->getFont()->setBold(true);
			$ii++;
		}
		$charcnt = 0;
		foreach($ca as $i){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr((++$charcnt)+64))->setWidth($i['w']);
		}
		$ii=2;
		foreach($rows as $r){
			$charcnt = 0;
			foreach ($ca as $i){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr((++$charcnt)+64).$ii, $r[$i['n']]);
			}
			$ii++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Заказы по поставщикам.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function ClearDB($date){
		list($d,$m,$y) = explode(".", trim($date));
		$date = mktime(0, 0, 0, $m , $d, $y);
		$sql = "SELECT id_order
			FROM "._DB_PREFIX_."order
			WHERE creation_date < '".$date."'";
		$arr = $this->db->GetArray($sql);
		if(count($arr)){
			$a = array();
			foreach($arr as $id){
				$a[] = $id['id_order'];
			}
			$ids = implode(",", $a);
			$this->db->StartTrans();
			$sql = "DELETE FROM "._DB_PREFIX_."order WHERE id_order IN($ids)";
			if(!$this->db->Query($sql)){
				$this->db->FailTrans();
				G::DieLoger("SQL error - $sql");
				return false;
			}
			$sql = "DELETE FROM "._DB_PREFIX_."osp WHERE id_order IN($ids)";
			if(!$this->db->Query($sql)){
				$this->db->FailTrans();
				G::DieLoger("SQL error - $sql");
				return false;
			}
			$sql = "DELETE FROM "._DB_PREFIX_."pretense WHERE id_order IN($ids)";
			if(!$this->db->Query($sql)){
				$this->db->FailTrans();
				G::DieLoger("SQL error - $sql");
				return false;
			}
			$this->db->CompleteTrans();
		}
		return true;
	}

	public function RestoreDeleted($id_order){
		$sql = "UPDATE "._DB_PREFIX_."order
			SET id_order_status = 6
			WHERE id_order = ".$id_order;
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			G::DieLoger("SQL error - $sql");
			return false;
		}
		return true;
	}

	public function GetOrdersByDate($from_i, $to_i){
		$from_date = time()-3600*24*30*$from_i;
		$to_date = time()-3600*24*30*$to_i;
		$sql = "SELECT ".implode(", ",$this->usual_fields2).",
				(SELECT name
					FROM "._DB_PREFIX_."user AS u
					LEFT JOIN "._DB_PREFIX_."contragent AS ca
						ON ca.id_user = u.id_user
					WHERE ca.id_user = o.id_contragent
				) AS contragent_name,
				(SELECT name
					FROM "._DB_PREFIX_."user AS u
					LEFT JOIN "._DB_PREFIX_."customer AS cu
						ON cu.id_user = u.id_user
					WHERE cu.id_user = o.id_customer
				) AS customer_name,
				(SELECT email
					FROM "._DB_PREFIX_."user AS u
					LEFT JOIN "._DB_PREFIX_."customer AS cu
						ON cu.id_user = u.id_user
					WHERE cu.id_user = o.id_customer
				) AS customer_email
			FROM "._DB_PREFIX_."order AS o
			WHERE creation_date >= '".$to_date."'
			AND creation_date <= '".$from_date."'
			ORDER BY creation_date DESC";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function GetOrdersByPromoSupplier($id_supplier){
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
			FROM "._DB_PREFIX_."order AS o
			LEFT JOIN "._DB_PREFIX_."user AS u
				ON u.id_user = o.id_customer
			LEFT JOIN "._DB_PREFIX_."promo_code AS pc
				ON pc.code = u.promo_code
			WHERE o.id_order_status IN (11, 5)
			AND pc.id_supplier = ".$id_supplier."
			ORDER BY o.creation_date DESC";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function GetOrdersCountListByDate($date){
		$sql = "SELECT '".$date."' AS date, IFNULL((SELECT COUNT(o.id_order)
			FROM "._DB_PREFIX_."order AS o
			WHERE DATE_FORMAT(from_unixtime(o.creation_date),'%d-%m-%Y') = '".$date."'
			GROUP BY DATE_FORMAT(from_unixtime(o.creation_date),'%d-%m-%Y')), 0) AS count";
		if(!$arr = $this->db->GetOneRowArray($sql)){
			return false;
		}
		return $arr;
	}

	//Выборка заказов сделанных на протяжении недели
	public function GetOrdersCountListByWeek($date_start, $date_end){
		$sql = "SELECT '".$date_start."' AS date_start,
			'".$date_end."' AS date_end,
			IFNULL((SELECT COUNT(o.id_order)
			FROM "._DB_PREFIX_."order AS o
			WHERE o.creation_date > ".strtotime($date_start)."
			AND o.creation_date <= ".strtotime($date_end)."), 0) AS count";
		if(!$arr = $this->db->GetOneRowArray($sql)){
			return false;
		}
		return $arr;
	}
}
?>