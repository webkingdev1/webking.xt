<?php
class Specification{
	public $db;
	public $fields;
	private $usual_fields;
	public $list;
	/** Конструктор
		 * @return
	 	 */
	 public function __construct (){
		$this->db =& $GLOBALS['db'];
		$this->usual_fields = array("id", "caption", "units");
	}
			

	// по id
	public function SetFieldsById($id){
		$sql = "SELECT ".implode(", ",$this->usual_fields)."
				FROM "._DB_PREFIX_."specs
				WHERE id = \"$id\"";
		$this->fields = $this->db->GetOneRowArray($sql);
		if(!$this->fields){
			return false;
		}
		return true;
	}	

	// Список
	public function SetList($param=0, $limit=""){
		if($limit != ""){
			$limit = " limit $limit";
		}
		$sql = "SELECT *
			FROM "._DB_PREFIX_."specs
			ORDER BY caption
			$limit";
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return true;
	}

	public function SetListByCatId($id_cat){
		$sql = "SELECT id_cat, caption, units, sc.id, id_spec
			FROM "._DB_PREFIX_."specs_cats AS sc
			LEFT JOIN "._DB_PREFIX_."specs AS s
				ON s.id = sc.id_spec
			WHERE id_cat = ".$id_cat;
				
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return true;
	}
	//Выбрать характеристики у каждого продукта
	public function SetListByProdId($id_product){
		$sql = "SELECT value, s.caption, s.units, sp.id, s.id AS id_spec
			FROM "._DB_PREFIX_."specs_prods AS sp
				LEFT JOIN "._DB_PREFIX_."specs AS s
					ON s.id = sp.id_spec
			WHERE id_prod = ".$id_product."
			UNION
			SELECT '' AS value, caption, units, '' AS id, s.id AS id_spec
			FROM "._DB_PREFIX_."specs_cats AS sc
				LEFT JOIN "._DB_PREFIX_."specs AS s
					ON s.id = sc.id_spec
			WHERE sc.id_cat = (SELECT MAX(id_category) FROM "._DB_PREFIX_."cat_prod WHERE id_product = $id_product && id_category <> 469 GROUP BY id_product)
			AND s.id NOT IN (SELECT id_spec FROM "._DB_PREFIX_."specs_prods WHERE id_prod = ".$id_product.")";
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return true;
	}

	// Добавление
	public function Add($arr){
		$f['id'] = trim($arr['id']);
		$f['caption'] = trim($arr['caption']);
		$f['units'] = trim($arr['units']);
		$this->db->StartTrans();
		if(!$this->db->Insert(_DB_PREFIX_.'specs', $f)){
			$this->db->FailTrans();
			return false;
		}
		$id = $this->db->GetLastId();
		$this->db->CompleteTrans();
		return $id;
	}

	public function AddSpecToCat($arr){
		$f['id_spec'] = trim($arr['id_specification']);
		$f['id_cat'] = trim($arr['id_category']);
		$this->db->StartTrans();
		if(!$this->db->Insert(_DB_PREFIX_.'specs_cats', $f)){
			$this->db->FailTrans();
			return false;
		}
		$id = $this->db->GetLastId();
		$this->db->CompleteTrans();
		return $id;
	}

	public function AddSpecToProd($arr, $id_product){
		$f['id_spec'] = trim($arr['id_spec']);
		$f['id_prod'] = trim($id_product);
		$f['value'] = trim($arr['value']);
		$this->db->StartTrans();
		if(!$this->db->Insert(_DB_PREFIX_.'specs_prods', $f)){
			$this->db->FailTrans();
			return false;
		}
		$id = $this->db->GetLastId();
		$this->db->CompleteTrans();
		return $id;
	}

	// Обновление
	public function Update($arr){
		$f['id'] = trim($arr['id']);
		$f['caption'] = trim($arr['caption']);
		$f['units'] = trim($arr['units']);
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_."specs", $f, "id = {$f['id']}")){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}
	// Обновление характеристик у продукта
	public function UpdateSpecsInProducts($arr){
		$f['id'] = trim($arr['id_spec_prod']);
		$f['value'] = trim($arr['value']);
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_."specs_prods", $f, "id = {$f['id']}")){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}
	public function UpdateByName($caption, $units){
		$f['caption'] = trim($caption);
		$f['units'] = trim($units);
		$this->db->StartTrans();
		if(!$this->db->Update(_DB_PREFIX_."specs", $f, "caption = '".$units."'")){
			$this->db->FailTrans();
			return false;
		}
		$this->db->CompleteTrans();
		return true;
	}
			
	// Удаление
	public function Del($id){
		$sql = "DELETE FROM "._DB_PREFIX_."specs WHERE `id` =  $id";
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		return true;
	}

	//Удаление характеристик из категорий
	public function DelSpecFromCat($id){
		$sql = "DELETE FROM "._DB_PREFIX_."specs_cats WHERE `id` = ".$id;
		$this->db->StartTrans();
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$this->db->CompleteTrans();
		return true;
	}
	public function DelSpecFromProd($id_spec_prod){
		$sql = "DELETE FROM "._DB_PREFIX_."specs_prods WHERE `id` = ".$id_spec_prod;
		$this->db->StartTrans();
		$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		$this->db->CompleteTrans();
		return true;
	}

	// Сортировка страниц
	public function Reorder($arr){
		foreach ($arr['ord'] as $id=>$ord){
			$sql = "UPDATE "._DB_PREFIX_."specs SET `ord` = $ord
					WHERE id = $id";
			$this->db->Query($sql) or G::DieLoger("<b>SQL Error - </b>$sql");
		}
	}

	// Список
	public function GetMonitoringList($limit = false){
		$sql = "SELECT c.id_category, c.name, s.id AS id_caption, s.caption, sp.value, count(*) AS count
			FROM "._DB_PREFIX_."specs_prods AS sp
			LEFT JOIN "._DB_PREFIX_."specs AS s ON s.id = sp.id_spec
			LEFT JOIN "._DB_PREFIX_."cat_prod AS cp ON sp.id_prod = cp.id_product AND sp.id_prod IS NOT NULL
			LEFT JOIN "._DB_PREFIX_."category AS c ON c.id_category = cp.id_category AND c.id_category IS NOT NULL
			GROUP BY sp.value, s.caption, c.name
			ORDER BY c.name, s.caption".
			($limit ?  " LIMIT". $limit : '');
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return true;
	}

	// Список
	public function GetProdlistModeration($category, $spec, $value){
		$sql = "SELECT sp.id_prod, p.name
			FROM "._DB_PREFIX_."specs_prods AS sp
			LEFT JOIN "._DB_PREFIX_."specs AS s ON s.id = sp.id_spec
			LEFT JOIN "._DB_PREFIX_."cat_prod AS cp ON sp.id_prod = cp.id_product AND sp.id_prod IS NOT NULL
			LEFT JOIN "._DB_PREFIX_."product AS p ON sp.id_prod = p.id_product
			WHERE cp.id_category = ".$category."
			AND s.id = ".$spec."
			AND sp.value = '".$value."'";
		$this->list = $this->db->GetArray($sql);
		if(!$this->list){
			return false;
		}
		return $this->list;
	}

}
?>