<?php
class Suppliers extends Users {

	private $usual_fields;

	public function __construct(){
		parent::__construct();
		$this->usual_fields = array("id_user", "article", "phones", "place",
			"currency_rate", "is_partner", "next_update_date", "koef_nazen_mopt",
			"koef_nazen_opt", "make_csv", "send_mail_order", "real_email", "icq",
			"real_phone", "filial", "balance", "available_today", "personal_message",
			"example_sum", "warehouse", "area", "single_price", "self_edit");
	}
	//*******************************Заполнение рабочих дней поставщика

	// Поля по id
	public function SetFieldsById($id, $all=0){
		global $User;
		if(!$User->SetFieldsById($id, $all)){
			return false;
		}
		$active = "AND active = 1";
		if($all == 1){}
			$active = '';
		$id = mysql_real_escape_string($id);
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
			FROM "._DB_PREFIX_."supplier
			WHERE id_user = '".$id."'
			".$active;
		$this->fields = $this->db->GetOneRowArray($sql);
		if(!$this->fields){
			return false;
		}
		$this->fields = array_merge($this->fields,$User->GetFields());
		return true;
	}

	public function GetSupplierIdByArt($article){
		$article = mysql_real_escape_string(trim($article));
		$sql = "SELECT id_user
			FROM "._DB_PREFIX_."supplier
			WHERE article = '".$article."'";
		$arr = $this->db->GetOneRowArray($sql);
		if(!$arr){
			return 'null';
		}
		return $arr['id_user'];
	}

	public function GetSupplierIdByPromoCode($code){
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
			FROM "._DB_PREFIX_."supplier
			LEFT JOIN "._DB_PREFIX_."promo_code
				ON "._DB_PREFIX_."promo_code.id_supplier = "._DB_PREFIX_."supplier.id_user
			WHERE "._DB_PREFIX_."promo_code.code = '".$code."'";
		$this->fields = $this->db->GetOneRowArray($sql);
		global $User;
		if(!$User->SetFieldsById($this->fields['id_user'], $all = 0)){
			return false;
		}
		if(!$this->fields){
			return false;
		}
		$this->fields = array_merge($this->fields,$User->GetFields());
		return true;
	}

	public function GetSuppliersList(){
		$sql = "SELECT id_user, koef_nazen_mopt, koef_nazen_opt
			FROM "._DB_PREFIX_."supplier";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return 'null';
		}
		return $arr;
	}
	/* Добавление
	 *
	 */
	public function GetSuppliersForManager($sort = null, $and = null){
		$sql = "SELECT s.id_user, s.article, s.phones, s.place, s.currency_rate, s.is_partner,
			s.next_update_date, s.koef_nazen_mopt, s.koef_nazen_opt, s.make_csv, s.send_mail_order,
			s.real_email, s.real_phone, s.filial, s.icq, s.balance, s.available_today, u.name,
			u.email, u.date_add, u.active, s.single_price, s.self_edit,
			(SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
				FROM xt_assortiment AS a
				WHERE s.id_user = a.id_supplier
				AND a.inusd = 1) AS inusd
			FROM "._DB_PREFIX_."supplier AS s
			LEFT JOIN "._DB_PREFIX_."user AS u
				ON u.id_user = s.id_user";
		if(!empty($and)){
			$users = new Users();
			$sql .= $users->db->GetWhere($and);
			// $sql .= " AND u.active = 1";
		}// else{
		// 	$sql .= " WHERE u.active = 1";
		// }
		if(isset($sort)){
			$sql .= " ORDER BY ".$sort;
		}
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return 'null';
		}
		return $arr;
	}

	public function AddSupplier($arr){
		global $User;
		// user
		$arr['gid'] = _ACL_SUPPLIER_;
		$this->db->StartTrans();
		if(!$User->AddUser($arr)){
			$this->db->FailTrans();
			return false;
		}
		$id_user = $this->db->GetInsId();
		// Supplier
		$f['id_user'] = $id_user;
		$f['article'] = mysql_real_escape_string(trim($arr['article']));
		$f['phones'] = mysql_real_escape_string(trim($arr['phones']));
		$f['place'] = mysql_real_escape_string(trim($arr['place']));
		$f['currency_rate'] = mysql_real_escape_string(trim($arr['currency_rate']));
		$f['koef_nazen_mopt'] = mysql_real_escape_string(trim($arr['koef_nazen_mopt']));
		$f['koef_nazen_opt'] = mysql_real_escape_string(trim($arr['koef_nazen_opt']));
		$f['filial'] = mysql_real_escape_string(trim($arr['filial']));
		$f['is_partner'] = 0; if (isset($arr['is_partner']) && $arr['is_partner'] == "on") $f['is_partner'] = 1;
		$f['make_csv'] = 0;
		if(isset($arr['make_csv']) && $arr['make_csv'] == "on"){
			$f['make_csv'] = 1;
		}
		$f['send_mail_order'] = 0;
		if(isset($arr['send_mail_order']) && $arr['send_mail_order'] == "on"){
			$f['send_mail_order'] = 1;
		}
		if(!$this->db->Insert(_DB_PREFIX_.'supplier', $f)){
			echo $this->db->ErrorMsg();
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function GetWarehouses(){
		$sql = "SELECT ws.id_supplier, u.name
			FROM "._DB_PREFIX_."supplier AS s,
			"._DB_PREFIX_."warehouse_supplier AS ws,
			"._DB_PREFIX_."user AS u
			WHERE u.id_user = s.id_user
			AND ws.id_supplier = s.id_user
			AND u.active = 1";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function GetNonWarehouses(){
		$sql = "SELECT u.name, s.id_user, ws.id_supplier
			FROM "._DB_PREFIX_."supplier AS s
			LEFT JOIN "._DB_PREFIX_."warehouse_supplier AS ws
			ON s.id_user = ws.id_supplier,
			"._DB_PREFIX_."user AS u
			WHERE s.id_user = u.id_user
			AND u.active = 1
			HAVING id_supplier IS NULL";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}
	/* Добавление склада
	 *
	 */
	public function AddWarehouse($arr){
		$id = mysql_real_escape_string(trim($arr['id_supplier']));
		$sql = "INSERT INTO "._DB_PREFIX_."warehouse_supplier(id_supplier) VALUES (\"$id\")";
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$this->db->CompleteTrans();
		return true;
	}
	/* Удаление склада
	 *
	 */
	public function RemoveWarehouse($id){
		$sql = "DELETE FROM "._DB_PREFIX_."warehouse_supplier WHERE `id_supplier` =  $id";
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$this->db->CompleteTrans();
		return true;
	}
	/* Обновление
	 *
	 */
	public function UpdateSupplier($arr){
		global $User;
		$arr['gid'] = $User->fields['gid'];
		if(!$User->UpdateUser($arr)){
			$this->db->errno = $User->db->errno;
			$this->db->FailTrans();
			return false;
		}
		unset($f);
		$f['id_user'] = mysql_real_escape_string(trim($arr['id_user']));
		$f['article'] = mysql_real_escape_string(trim($arr['article']));
		$f['phones'] = mysql_real_escape_string(trim($arr['phones']));
		$f['place'] = mysql_real_escape_string(trim($arr['place']));
		$f['currency_rate'] = mysql_real_escape_string(trim($arr['currency_rate']));
		$f['koef_nazen_mopt'] = mysql_real_escape_string(trim($arr['koef_nazen_mopt']));
		$f['koef_nazen_opt'] = mysql_real_escape_string(trim($arr['koef_nazen_opt']));
		$f['filial'] = mysql_real_escape_string(trim($arr['filial']));
		$f['is_partner'] = 0;
		if(isset($arr['is_partner']) && $arr['is_partner'] == "on"){
			$f['is_partner'] = 1;
		}
		$f['warehouse'] = 0;
		if(isset($arr['warehouse']) && $arr['warehouse'] == "on"){
			$f['warehouse'] = 1;
		}
		$f['make_csv'] = 0;
		if(isset($arr['make_csv']) && $arr['make_csv'] == "on"){
			$f['make_csv'] = 1;
		}
		$f['real_email'] = mysql_real_escape_string(trim($arr['real_email']));
		$f['real_phone'] = mysql_real_escape_string(trim($arr['real_phone']));
		$f['send_mail_order'] = 0;
		if(isset($arr['send_mail_order']) && $arr['send_mail_order'] == "on" && $f['real_email'] != ''){
			$f['send_mail_order'] = 1;
		}
		if(!$this->db->Update(_DB_PREFIX_.'supplier', $f, "id_user = {$f['id_user']}")){
			$this->db->FailTrans();
			return false;
		}
		if(isset($arr['active']) && $arr['active'] == "on"){
			$this->SwitchEnableDisableProductsInAssort($f['id_user'], 0);
		}else{
			$this->SwitchEnableDisableProductsInAssort($f['id_user'], 1);
		}
		$this->db->CompleteTrans();
		return true;
	}
	// Удаление ассортимента поставщика
	public function DelSupplierAssort($id){
		$sql = "DELETE FROM "._DB_PREFIX_."assortiment WHERE id_supplier = ".$id;
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		return true;
	}
	// Удаление
	public function DelSupplier($id){
		$sql = "DELETE FROM "._DB_PREFIX_."supplier WHERE `id_user` = ".$id;
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$sql = "DELETE FROM "._DB_PREFIX_."user WHERE id_user = ".$id;
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$sql = "UPDATE "._DB_PREFIX_."product SET exclusive_supplier = 0 WHERE exclusive_supplier = ".$id;
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		return true;
	}

	public function SwitchEnableDisableProductsInAssort($id_supplier, $enable=0){
		if($enable == 0){
			$where = "id_supplier = \"$id_supplier\"";
		}else{
			$where = "id_supplier = \"$id_supplier\" AND product_limit > 0 AND (price_opt_otpusk > 0 OR price_mopt_otpusk > 0)";
		}
		$sql = "SELECT a.id_product
			FROM "._DB_PREFIX_."assortiment a
			WHERE id_supplier = \"$id_supplier\"";
		$arr = $this->db->GetArray($sql);
		$f['active'] = $enable;
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_.'assortiment', $f, $where)){
			$this->db->FailTrans();
			return false;
		}else{
			$product = new Products();
			foreach($arr as $p){
				$rsarr[] = $p['id_product'];
			}
			$product->RecalcSitePrices($rsarr);
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function CheckSupplierDate($date){
		global $User;
		$tmp = explode("_", $date);
		$date = $tmp[0]."-".$tmp[1]."-".$tmp[2];
		$this->db->StartTrans();
		$id_supplier = $User->fields['id_user'];
		$sql = "SELECT date, id_supplier, work_day
			FROM "._DB_PREFIX_."calendar_supplier
			WHERE id_supplier = ".$id_supplier."
			AND date = '".$date."'";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr){ // Если дата уже есть в базе
			$sql = "UPDATE "._DB_PREFIX_."calendar_supplier
				SET work_day = 1
				WHERE id_supplier = ".$id_supplier."
				AND date = '".$date."'";
			$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		}else{ // Если даты еще нет
			$sql = "INSERT INTO "._DB_PREFIX_."calendar_supplier (date, id_supplier, work_day)
				VALUES ('".$date."', ".$id_supplier.", 1)";
			$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		}
		$nextUpdateDate = $this->SetNextUpdate($id_supplier);
		$this->db->CompleteTrans();
		return true;
	}

	// Переключает рабочие дни и ночи в календаре поставщика
	public function SwitchSupplierDate($date){
		global $User;
		$tmp = explode(".", $date);
		$date = $tmp[2]."-".$tmp[1]."-".$tmp[0];
		$this->db->StartTrans();
		$id_supplier = $User->fields['id_user'];
		$sql = "SELECT date, id_supplier, work_day
			FROM "._DB_PREFIX_."calendar_supplier
			WHERE id_supplier = ".$id_supplier."
			AND date = '".$date."'";
		$switcher = 0;
		$arr = $this->db->GetOneRowArray($sql);
		if($arr){ // Если дата уже есть в базе
			$switcher = $arr['work_day'] == 1?0:1;
			$sql = "UPDATE "._DB_PREFIX_."calendar_supplier
				SET work_day = ".$switcher."
				WHERE id_supplier = ".$id_supplier."
				AND date = '".$date."'";
			$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		}else{ // Если даты еще нет
			$switcher = 1;
			$sql = "INSERT INTO "._DB_PREFIX_."calendar_supplier (date, id_supplier, work_day)
				VALUES ('".$date."', ".$id_supplier.", 1)";
			$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		}
		$this->db->CompleteTrans();
		$nextUpdateDate = $this->SetNextUpdate($id_supplier);
		return array($switcher, $nextUpdateDate);
	}

	// Устанавливает дату след обновления цен поставщиком
	public function SetNextUpdate($id_supplier){
		$sql = "SELECT date FROM "._DB_PREFIX_."calendar_supplier
			WHERE id_supplier=".$id_supplier."
			AND work_day != 0
			ORDER BY date DESC
			LIMIT 1";
		$arr = $this->db->GetOneRowArray($sql);
		if($arr){ // Если дата уже есть
			$f['next_update_date'] = $arr['date'];
			if(!$this->db->Update(_DB_PREFIX_.'supplier', $f, "id_user = $id_supplier")){
				$this->db->FailTrans();
				return false;
			}
			return $arr['date'];
		}
		return false;
	}

	// Возвращает набор дат с рабочими днями и ночами
	public function GetCalendar($start_date=null, $day_qty=30){
		if($start_date ==null) $start_date = date("Y-m-d", time());
		$end_date = date("Y-m-d", (time()+3600*24*$day_qty));
		$sql = "SELECT date, work_day
			FROM "._DB_PREFIX_."calendar_supplier
			WHERE id_supplier=".$this->fields['id_user']."
			AND date BETWEEN '$start_date' AND '$end_date'";
		$arr = $this->db->GetArray($sql, 'date');
		return $arr;
	}

	// Пересчет цен поставщика
	public function RecalcSupplierCurrency($cur, $cur_old){
		global $User;
		$id_supplier = $User->fields['id_user'];
		$k = round($cur/$cur_old, 2);
		$sql = "UPDATE "._DB_PREFIX_."assortiment SET
			price_opt_otpusk = ROUND(price_opt_otpusk*".$k." ,2),
			price_opt_recommend = ROUND(price_opt_recommend*".$k." ,2),
			price_mopt_otpusk = ROUND(price_mopt_otpusk*".$k." ,2),
			price_mopt_recommend = ROUND(price_mopt_recommend*".$k." ,2)
			WHERE id_supplier = ".$id_supplier."
			AND inusd = 1";
		$this->db->StartTrans();
		if(!$this->db->Query($sql)){
			$this->db->FailTrans();
			return false;
		}
		$f['currency_rate'] = mysql_real_escape_string($cur);
		if(!$this->db->Update(_DB_PREFIX_.'supplier', $f, "id_user = ".$id_supplier)){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		$arr = $this->GetAssortimentProductIds($id_supplier);
		$arrt = array();
		foreach($arr as $v) {
			$arrt[] = $v['id_product'];
		}
		$Products = new Products();
		if(!$Products->RecalcSitePrices($arrt)){
			return false;
		}
		return true;
	}

	public function GetAssortimentProductIds($id_supplier){
		$sql = "SELECT a.id_product
			FROM "._DB_PREFIX_."assortiment a
			WHERE a.id_supplier = ".$id_supplier;
		$arr = $this->db->GetArray($sql);
		return $arr;
	}

	//Подсчет контрольной суммы Ассортимента поставщика
	public function GetCheckSumSupplierProducts($id_supplier){
		$sql = "SELECT SUM(a.price_opt_otpusk + a.price_mopt_otpusk) AS checksum
			FROM "._DB_PREFIX_."assortiment a
			WHERE a.id_supplier = ".$id_supplier;
		$arr = $this->db->GetOneRowArray($sql);
		return $arr;
	}

	public function GetDataForAct(){
		$sql = "SELECT p.id_product, p.name, p.art, p.img_1, p.img_2, p.img_3, p.descr,
			p.inbox_qty, p.min_mopt_qty, p.qty_control, p.weight, p.height, p.width,
			p.length, p.coefficient_volume, p.volume, a.product_limit, a.price_opt_otpusk,
			a.price_opt_recommend, a.price_mopt_otpusk, a.price_mopt_recommend,
			a.price_mopt_otpusk_usd, a.price_opt_otpusk_usd, a.inusd,
			(SELECT MIN(assort.price_mopt_otpusk)
			FROM "._DB_PREFIX_."assortiment AS assort
			LEFT JOIN "._DB_PREFIX_."calendar_supplier AS cs ON (cs.id_supplier = assort.id_supplier AND cs.date = (CURDATE() + INTERVAL 2 DAY))
			WHERE cs.work_day = 1
			AND assort.active = 1
			AND assort.id_product = p.id_product
			AND price_mopt_otpusk > 0
			GROUP BY assort.id_product) AS min_mopt_price,
			(SELECT MIN(assort.price_opt_otpusk)
			FROM "._DB_PREFIX_."assortiment AS assort
			LEFT JOIN "._DB_PREFIX_."calendar_supplier AS cs ON (cs.id_supplier = assort.id_supplier AND cs.date = (CURDATE() + INTERVAL 2 DAY))
			WHERE cs.work_day = 1
			AND assort.active = 1
			AND assort.id_product = p.id_product
			AND price_opt_otpusk > 0
			GROUP BY assort.id_product) AS min_opt_price,
			(SELECT u.unit_xt
			FROM "._DB_PREFIX_."units AS u
			WHERE p.id_unit = u.id) AS unit
			FROM "._DB_PREFIX_."assortiment AS a LEFT JOIN "._DB_PREFIX_."product AS p ON p.id_product = a.id_product
			WHERE a.id_supplier = ".$this->fields['id_user']."
			AND p.visible = 1
			ORDER BY a.inusd, p.name";
		$arr = $this->db->GetArray($sql);
		return $arr;
	}

	public function GetDNByDate($id_supplier, $target_date){
		$date = date("Y-m-d", $target_date);
		$sql = "SELECT work_day
			FROM "._DB_PREFIX_."calendar_supplier
			WHERE id_supplier=$id_supplier
			AND date='".$date."'";
		$arr = $this->db->GetOneRowArray($sql);
		$retstr = "";
		if($arr['work_day'] == 1){
			$retstr .= "день";
		}
		return $retstr;
	}

	public function GetPriceOtpusk($id_supplier, $id_product, $opt){
		$optw = "opt";
		if(!$opt){$optw = "mopt";}
		$sql = "SELECT price_{$optw}_otpusk
			FROM "._DB_PREFIX_."assortiment
			WHERE id_supplier=$id_supplier
			AND id_product=$id_product";
		$arr = $this->db->GetOneRowArray($sql);
		return $arr['price_'.$optw.'_otpusk'];
	}

	public function GetFilialList(){
		$sql = "SELECT *
			FROM "._DB_PREFIX_."filial";
		$arr = $this->db->GetArray($sql);
		return $arr;
	}

	public function GetFilialById($filial){
		$sql = "SELECT *
			FROM "._DB_PREFIX_."filial
			WHERE filial=".$filial;
		$arr = $this->db->GetOneRowArray($sql);
		return $arr;
	}

	public function GetPromoCodes($id_supplier = null){
		$sql = "SELECT *
			FROM "._DB_PREFIX_."promo_code";
		if(is_numeric($id_supplier)){
			$sql .= " WHERE id_supplier=".$id_supplier;
		}
		$sql .= " ORDER BY id";
		$arr = $this->db->GetArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function GetPromoCodeById($id){
		$sql = "SELECT *
			FROM "._DB_PREFIX_."promo_code
				WHERE id = ".$id;
		$arr = $this->db->GetOneRowArray($sql);
		if(!$arr){
			return false;
		}
		return $arr;
	}

	public function AddPromoCode($percent, $name){
		do{
			$chars = "qazxswedcvfrtgbnhyujmkiolp1234567890";
			$max = 6;
			$size = StrLen($chars)-1;
			$f['code'] = null;
			while($max--){
				$f['code'] .= $chars[rand(0,$size)];
			}
		}while($this->CheckCodeUniqueness($f['code']) === false);
		$f['name']= mysql_real_escape_string(trim($name));
		$f['percent']= mysql_real_escape_string(trim($percent));
		$f['id_supplier']= $_SESSION['member']['id_user'];
		$this->db->StartTrans();
		if(!$this->db->Insert(_DB_PREFIX_.'promo_code', $f)){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function DeletePromoCode($id){
		$promo_code_data = $this->GetPromoCodeById($id);
		$f['promo_code'] = 'NULL';
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_.'user', $f, "promo_code = '".$promo_code_data['code']."'")){
			$this->db->FailTrans();
			return false;
		}
		$sql = "DELETE FROM "._DB_PREFIX_."promo_code WHERE id =  $id";
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$this->db->CompleteTrans();
		return true;
	}

	public function CheckCodeUniqueness($code){
		$sql = "SELECT *
			FROM "._DB_PREFIX_."promo_code
			WHERE code = '".$code."'";
		$res = $this->db->GetArray($sql);
		if(!empty($res)){
			return false;
		}
		return true;
	}

	public function EditPromoCode($id, $percent, $name){
		if($percent != ''){
			$f['percent']= mysql_real_escape_string(trim($percent));
		}
		if($name != ''){
			$f['name']= mysql_real_escape_string(trim($name));
		}
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_.'promo_code', $f, "id = $id")){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}

	public function RecalcWhSupplierSalePrice($id = null){
		// $testtimestart = microtime(true);
		if(isset($id)){
			$sql = "SELECT a.id_product, a.price_opt_otpusk, a.price_mopt_otpusk
				FROM "._DB_PREFIX_."assortiment AS a
				WHERE a.id_supplier = ".$id."";
			$arr = $this->db->GetArray($sql);
			foreach($arr AS $a){
				$sql2 = "SELECT MIN(a.price_opt_otpusk)-'0.01' AS price_opt_otpusk,
					MIN(a.price_mopt_otpusk)-'0.01' AS price_mopt_otpusk
					FROM "._DB_PREFIX_."assortiment AS a
					LEFT JOIN "._DB_PREFIX_."calendar_supplier AS cs
						ON cs.id_supplier = a.id_supplier
					WHERE a.id_supplier NOT IN (SELECT s.id_user
						FROM "._DB_PREFIX_."supplier AS s
						WHERE s.warehouse = 1)
					AND a.id_product = ".$a['id_product']."
					AND a.active = 1
					AND cs.date = (CURDATE() + INTERVAL 2 DAY)
					AND cs.work_day = 1
					GROUP BY a.id_product";
				$f = $arr2 = $this->db->GetOneRowArray($sql2);
				if($arr2['price_opt_otpusk'] == 0){
					$f['price_opt_otpusk'] = $a['price_opt_otpusk'];
				}
				if($arr2['price_mopt_otpusk'] == 0){
					$f['price_mopt_otpusk'] = $a['price_mopt_otpusk'];
				}
				$this->db->StartTrans();
				if(!$this->db->Update(_DB_PREFIX_.'assortiment', $f, "id_product = ".$a['id_product']." AND id_supplier = ".$id)){
					$this->db->FailTrans();
					return false;
				}
				$this->db->CompleteTrans();
			}
			$products = new Products();
			$products->RecalcSitePrices(array($id));
		}
		// $time = microtime(true) - $testtimestart;
		// printf('Скрипт 2 выполнялся %.4F сек.', $time);
		if(!isset($arr)){
			return false;
		}
		return $arr;
	}

	public function UpdateSinglePrice($id_user, $single_price){
		$f['single_price']= mysql_real_escape_string(trim($single_price));
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_.'supplier', $f, "id_user = ".$id_user)){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}
}?>