<h1><?=$h1?></h1>
<?if (isset($errm) && isset($msg)){?><div class="notification error"> <span class="strong">Ошибка!</span><?=$msg?></div>
<?}elseif(isset($msg)){?><div class="notification success"> <span class="strong">Сделано!</span><?=$msg?></div><?}?>
<div id="productae">
	<form action="<?=$GLOBALS['URL_request']?>" method="post" class="grid">
		<div class="prod_head">
			<?if($GLOBALS['CurrentController'] == 'productedit'){?>
				<div class="fl">
					<span><b>Артикул:</b> <?=isset($_POST['art'])?htmlspecialchars($_POST['art']):null?></span>
					<span><b>Название:</b> <?=isset($_POST['name'])?htmlspecialchars($_POST['name']):null?></span>
				</div>
				<div class="fr">
					<span>Наличие</span>
					<span>Дублировать</span>
					<span class="product_view"><a href="<?=$GLOBALS['URL_base']?>product/<?=$_POST['id_product']?>/<?=isset($_POST['translit'])?$_POST['translit']:null?>" target="_blank">Просмотр товара</a></span>
					<input type="hidden" name="id_product" id="id_product" value="<?=isset($_POST['id_product'])?$_POST['id_product']:0?>">
					<button name="smb_new" type="submit" class="btn-m-default">Сохранить и создать новый</button>
					<button name="smb" type="submit" class="btn-m-default fr">Сохранить</button>
				</div>
			<?}else{?>
				<button name="smb" type="submit" class="save-btn btn-m-default fr">Сохранить</button>
			<?}?>
		</div>
		<div id="second_navigation">
			<ul>
				<li><a href="#nav_product">Товар</a></li>
				<li><a href="#nav_seo">SEO</a></li>
				<li><a href="#nav_content">Контент товара</a></li>
				<li><a href="#nav_params">Параметры товара</a></li>
				<li><a href="#nav_delivery">Доставка</a></li>
				<li><a href="#nav_connection">Категория и связь</a></li>
				<li><a href="#nav_photo">Фото, видео</a></li>
				<li><a href="#nav_information">Информация</a></li>
				<li><a href="#nav_visible">Видемость и индексация</a></li>
			</ul>
			<div id="nav_product">
				<h2>Товар</h2>
				<div class="row">
					<div class="col-md-2">
						<label for="art">Артикул:</label><?=isset($errm['art'])?"<span class=\"errmsg\">".$errm['art']."</span><br>":null?>
						<input type="text" name="art" id="art" class="input-l" value="<?=isset($_POST['art'])?htmlspecialchars($_POST['art']):null?>">
					</div>
					<div class="col-md-10">
						<label for="name">Название:</label><?=isset($errm['name'])?"<span class=\"errmsg\">".$errm['name']."</span><br>":null?>
						<input type="text" name="name" id="name" class="input-l" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):null?>">
					</div>
				</div>
			</div>
			<div id="nav_seo">
				<h2>SEO</h2>
				<div class="row">
					<div class="col-md-12">
						<?if(isset($_POST['translit'])){?>
							<div id="translit">
								<label>URL сраницы:</label>
								<p>http:<?=$GLOBALS['URL_base'].'product/'.$_POST['id_product'].'/'.$_POST['translit']?></p>
								<a href="#" id="updtrans" class="refresh_btn icon-font" title="Нажимать, только при полной замене товара" onclick="updateTranslit();">f</a>
							</div>
						<?}?>
						<label for="page_title">Мета-заголовок (title):</label>
						<?=isset($errm['page_title'])?"<span class=\"errmsg\">".$errm['page_title']."</span><br>":null?>
						<input type="text" name="page_title" id="page_title" class="input-l" value="<?=isset($_POST['page_title'])?htmlspecialchars($_POST['page_title']):null?>">
						<label for="page_description">Мета-описание (description):</label>
						<?=isset($errm['page_description'])?"<span class=\"errmsg\">".$errm['page_description']."</span><br>":null?>
						<textarea name="page_description" id="page_description" size="20" cols="223" rows="5" class="input-l"><?=isset($_POST['page_description'])?htmlspecialchars($_POST['page_description']):null?></textarea>
						<label for="keywords">Ключевые слова (keywords):</label>
						<?=isset($errm['page_keywords'])?"<span class=\"errmsg\">".$errm['page_keywords']."</span><br>":null?>
						<textarea class="input-l" name="page_keywords" id="keywords" cols="10" rows="5"><?=isset($_POST['page_keywords'])?htmlspecialchars($_POST['page_keywords']):null?></textarea>
					</div>
				</div>
			</div>
			<div id="nav_content">
				<h2>Контент товара</h2>
				<div class="row">
					<?if($GLOBALS['CurrentController'] == 'productedit'){?>
						<div class="col-md-12">
							<label>Привязанные характеристики:</label>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list paper_shadow_1">
								<colgroup>
									<col width="30%">
									<col width="30%">
									<col width="30%">
									<col width="10%">
								</colgroup>
								<thead>
									<tr>
										<td class="left">Описание характеристики</td>
										<td class="left">Единицы измерения</td>
										<td class="left">Значение</td>
										<td class="left">Управление</td>
									</tr>
								</thead>
								<tbody>
									<?if(!empty($product_specs)){
										foreach($product_specs as $i){
											$ids[] = $i['id_spec'];?>
											<tr id="spec<?=$i['id_spec']?>" class="animate">
												<td>
													<?=$i['caption']?>
												</td>
												<td>
													<?=$i['units']?>
												</td>
												<td>
													<input class="input-m" type="text" name="value" onchange="insertValueLink($(this));" value="<?=$i['value']?>">
													<input type="hidden" name="id_spec_prod" value="<?=$i['id']?>">
													<input type="hidden" name="id_spec" value="<?=$i['id_spec']?>">
												</td>
												<td class="left actions">
													<nobr>
														<?if(isset($i['id']) && $i['id'] > 0){?>
															<a class="btn-m-green-inv" href="/adm/productedit/<?=$_POST['id_product']?>/?action=update_spec&id_spec_prod=<?=$i['id']?>&id_spec=<?=$i['id_spec']?>&value=" onclick="insertValueLink($(this)); return false;">Обновить</a>
															<a class="btn-m-red-inv" href="/adm/productedit/<?=$_POST['id_product']?>/?action=delete_spec&id_spec_prod=<?=$i['id']?>" onclick="return confirm('Точно удалить?');">Удалить</a>
														<?}?>
													</nobr>
												</td>
											</tr>
										<?}
									}else{?>
										<tr id="empty2" class="animate">
											<td colspan="4">Не привязано ни одной характеристики</td>
										</tr>
									<?}?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<label for="sid">Добавление характеристики:</label>
							<?=isset($errm['sid'])?"<span class=\"errmsg\">".$errm['sid']."</span><br>":null?>
							<select name="sid" id="sid" class="select_unit input-m">
								<?$i = 0;
								foreach($specs as $s){
									if(!in_array($s['id'], $ids)){
										$i++;?>
										<option value="<?=$s['id']?>"><?=$s['caption']?>
										<?if($s['units'] !== ''){
											echo('('.$s['units'].')');
										}?>
										</option>
									<?}
								}
								if($i == 0){?>
									 <option disabled="disabled" selected="selected">Все характеристики добавлены</option>
								<?}?>
							</select>
							<input type="text" class="units_input input-m" <?=$i == 0?'disabled="disabled"':null;?>>
							<button class="btn-m-default addspec" <?=$i == 0?'disabled="disabled"':null;?> onclick="insertSpecToProd($(this));">Добавить</button>
						</div>
						<div class="col-md-12">
							<label for="descr">Описание x-torg.com:</label><?=isset($errm['descr'])?"<span class=\"errmsg\">".$errm['descr']."</span><br>":null?>
							<textarea name="descr" id="descr" class="input-l" rows="5" cols="50"><?=isset($_POST['descr'])?htmlspecialchars($_POST['descr']):null?></textarea>
							<label for="descr">Описание xt.ua(краткое):</label><?=isset($errm['descr'])?"<span class=\"errmsg\">".$errm['descr']."</span><br>":null?>
							<textarea name="descr_xt_short" id="descr_xt_short" class="input-l" rows="5" cols="50"><?=isset($_POST['descr_xt_short'])?htmlspecialchars($_POST['descr_xt_short']):null?></textarea>
							<label for="descr">Описание xt.ua(полное):</label><?=isset($errm['descr'])?"<span class=\"errmsg\">".$errm['descr']."</span><br>":null?>
							<textarea name="descr_xt_full" id="descr_xt_full" class="input-l" rows="5" cols="50"><?=isset($_POST['descr_xt_full'])?htmlspecialchars($_POST['descr_xt_full']):null?></textarea>
							<label for="note_control"><b>Требовать заполнение примечания &nbsp;</b>
								<input type="checkbox" name="note_control" id="note_control" class="input-m" <?=isset($_POST['note_control'])&&($_POST['note_control'])?'checked="checked" value="on"':null?>>
							</label>
						</div>
					<?}?>
				</div>
			</div>
			<div id="nav_params">
				<h2>Параметры товара</h2>
				<label for="id_unit_xt">Единицы измерения для x-torg.com</label>
				<select class="input-l" name="id_unit" id="id_unit_xt" style="width:150px;">
					<?foreach($unitslist as $value){?>
						<option value="<?=$value['id']?>"<?=(isset($_POST['id_unit']) && $_POST['id_unit'] == $value['id'])?'selected="true"':null?>><?=$value['unit_xt']?></option>
					<?}?>
				</select>
				<label for="id_unit_prom">Единицы измерения для prom.ua</label>
				<input type="text" class="input-l" id="id_unit_prom" value="<?=isset($_POST['unit_prom'])?$_POST['unit_prom']:null?>" disabled="disabled" style="width:150px;">
				<label for="max_supplier_qty">Максимальное количество:</label><?=isset($errm['max_supplier_qty'])?"<span class=\"errmsg\">".$errm['max_supplier_qty']."</span><br>":null?>
				<input type="text" name="max_supplier_qty" id="max_supplier_qty" class="input-l" value="<?=isset($_POST['max_supplier_qty'])?htmlspecialchars($_POST['max_supplier_qty']):1000?>">
				<label for="min_mopt_qty">Минимальное количество по мелкому опту:</label><?=isset($errm['min_mopt_qty'])?"<span class=\"errmsg\">".$errm['min_mopt_qty']."</span><br>":null?>
				<input type="text" name="min_mopt_qty" id="min_mopt_qty" class="input-l" value="<?=isset($_POST['min_mopt_qty'])?htmlspecialchars($_POST['min_mopt_qty']):1?>">
				<label for="inbox_qty">Количество в ящике:</label><?=isset($errm['inbox_qty'])?"<span class=\"errmsg\">".$errm['inbox_qty']."</span><br>":null?>
				<input type="text" name="inbox_qty" id="inbox_qty" class="input-l" value="<?=isset($_POST['inbox_qty'])?htmlspecialchars($_POST['inbox_qty']):null?>">
				<label for="qty_control">
					<input style="vertical-align:middle;" type="checkbox" name="qty_control" id="qty_control" class="input-l" <?=isset($_POST['qty_control'])&&($_POST['qty_control'])?'checked="checked" value="on"':null?>>
					<b>Необходима кратность &nbsp;</b>
				</label>
				<input type="hidden" name="price_opt" value="<?=isset($_POST['price_opt'])?htmlspecialchars($_POST['price_opt']):0?>">
				<input type="hidden" name="price_coefficient_opt" id="price_coefficient_opt" class="input-l" value="<?=isset($_POST['price_coefficient_opt'])?htmlspecialchars($_POST['price_coefficient_opt']):1?>">
				<input type="hidden" name="price_mopt" value="<?=isset($_POST['price_mopt'])?htmlspecialchars($_POST['price_mopt']):0?>">
				<input type="hidden" name="price_coefficient_mopt" id="price_coefficient_mopt" class="input-l" value="<?=isset($_POST['price_coefficient_mopt'])?htmlspecialchars($_POST['price_coefficient_mopt']):1?>">
			</div>
			<div id="nav_delivery">
				<h2>Доставка</h2>
				<div class="fl">
					<label for="height">Высота (cм):</label>
					<input type="number" name="height" id="height" class="input-l" value="<?=isset($_POST['height'])?htmlspecialchars($_POST['height']):0?>">
				</div>
				<div class="fl">
					<label for="width">Ширина (см):</label>
					<input type="number" name="width" id="width" class="input-l" value="<?=isset($_POST['width'])?htmlspecialchars($_POST['width']):0?>">
				</div>
				<div class="fl">
					<label for="length">Длина (см):</label>
					<input type="number" name="length" id="length" class="input-l" value="<?=isset($_POST['length'])?htmlspecialchars($_POST['length']):0?>">
				</div>
				<label for="coefficient_volume">Коэффициент реального обьема:</label>
				<input type="number" name="coefficient_volume" id="coefficient_volume" class="input-l" value="<?=isset($_POST['coefficient_volume'])?htmlspecialchars($_POST['coefficient_volume']):0?>">
				<label class="weight">Объем: <span><?=isset($_POST['weight']) && $_POST['weight'] == 0?'Заполните поля (ВхШхД)':htmlspecialchars($_POST['weight']).' м3'?></span></label>
				<input type="hidden" name="weight" id="weight" class="input-l" value="<?=isset($_POST['weight'])?htmlspecialchars($_POST['weight']):0?>">
				<label for="volume">Вес:</label><?=isset($errm['volume'])?"<span class=\"errmsg\">".$errm['volume']."</span><br>":null?>
				<input type="text" name="volume" id="volume" class="input-l" value="<?=isset($_POST['volume'])?htmlspecialchars($_POST['volume']):0?>">
			</div>
			<div id="nav_connection">
				<h2>Категория и связь</h2>
				<?foreach($_POST['categories_ids'] as $cid){?>
					<div id="catblock">
						<label>Категория:</label><?=isset($errm['categories_ids'])?"<span class=\"errmsg\">".$errm['categories_ids']."</span><br>":null?>
						<select name="categories_ids[]" class="input-l">
						<?foreach($list as $item){?>
							<option <?=($item['id_category']==$cid)?'selected="true"':null?> value="<?=$item['id_category']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;", $item['category_level'])?> <?=$item['name']?></option>
						<?}?>
						</select>
					</div>
				<?}?>
				<div id="addlink"><a class="dashed" href="javascript://" onclick="AddCat(this)">Добавить категорию</a></div>
				<?if($GLOBALS['CurrentController'] == 'productedit'){?>
					<label>Cопутствующие товары:</label>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list paper_shadow_1">
						<colgroup>
							<col width="20%">
							<col width="20%">
							<col width="50%">
							<col width="10%">
						</colgroup>
						<thead>
							<tr>
								<td class="left">Изображение товара</td>
								<td class="left">Артикул</td>
								<td class="left">Название товара</td>
								<td class="left">Управление</td>
							</tr>
						</thead>
						<tbody>
							<?if(!empty($related_prods_list)){
								foreach($related_prods_list as $rpl){?>
									<tr id="rel_prod<?=$rpl['id_product']?>" class="animate">
										<td>
											<img class="pic_block" src="<?=$rpl['img_1']?>" alt="<?=$rpl['name']?>">
										</td>
										<td>
											<?=$rpl['art']?>
										</td>
										<td>
											<?=$rpl['name']?>
										</td>
										<td class="left actions">
											<nobr>
												<button class="btn-m-red-inv" onclick="if(confirm('Точно удалить?')){editRelatedProds(<?=$rpl['id_product']?>, 'remove');} return false;">Удалить</button>
											</nobr>
										</td>
									</tr>
								<?}
							}else{?>
								<tr id="empty2" class="animate">
									<td colspan="4">Не привязано ни одного товара</td>
								</tr>
							<?}?>
					 	</tbody>
					</table>
					<div class="row">
						<div class="col-md-12">
							<p>Привязать товар по артикулу:</p>
							<input list="character" class="input-m" id="article" name="article">
							<datalist id="character"></datalist>
							<button class="btn-m-default addspec" onclick="editRelatedProds($('#article').val().substr($('#article').val().lastIndexOf('|') + 2), 'insert'); return false;">Привязать</button>
						</div>
					</div>
				<?}?>
			</div>
			<div id="nav_photo">
				<h2>Фото, видео</h2>
				<label>Изображения товара:</label>
				<div class="row" id="preview1">
					<div class="col-md-2">
						<img class="pic_block" id="i1" src="<?=(isset($_POST['img_1'])&&$_POST['img_1']!='')?htmlspecialchars(str_replace("/efiles/", "/efiles/_thumb/", $_POST['img_1'])):"/efiles/_thumb/nofoto.jpg"?>">
					</div>
					<div class="col-md-10">
						<input type="text" id="img_1" name="img_1" class="input-l" value="<?=isset($_POST['img_1'])?htmlspecialchars($_POST['img_1']):null?>">
					</div>
				</div>
				<div class="row" id="preview2">
					<div class="col-md-2">
						<img class="pic_block" id="i2" src="<?=(isset($_POST['img_2'])&&$_POST['img_2']!='')?htmlspecialchars(str_replace("/efiles/", "/efiles/_thumb/", $_POST['img_2'])):"/efiles/_thumb/nofoto.jpg"?>">
					</div>
					<div class="col-md-10">
						<input type="text" id="img_2" name="img_2" class="input-l" value="<?=isset($_POST['img_2'])?htmlspecialchars($_POST['img_2']):null?>">
					</div>
				</div>
				<div class="row" id="preview3">
					<div class="col-md-2">
						<img class="pic_block" id="i3" src="<?=(isset($_POST['img_3'])&&$_POST['img_3']!='')?htmlspecialchars(str_replace("/efiles/", "/efiles/_thumb/", $_POST['img_3'])):"/efiles/_thumb/nofoto.jpg"?>">
					</div>
					<div class="col-md-10">
						<input type="text" id="img_3" name="img_3" class="input-l" value="<?=isset($_POST['img_3'])?htmlspecialchars($_POST['img_3']):null?>">
					</div>
				</div>
			</div>
			<div id="nav_information">
				<h2>Информация</h2>
				<label for="opt_correction_set">Набор корректироки по оптовой цене:</label>
				<select name="opt_correction_set" id="opt_correction_set" disabled="disabled" class="input-l">
					<option value="0">Без корректировки</option>
					<?$i = 0;
					while(isset($GLOBALS['CONFIG']['correction_set_'.$i])){?>
						<option value="<?=$i?>" <?=(isset($_POST['opt_correction_set']) && $_POST['opt_correction_set'] == $i)?'selected':null?> ><?=$GLOBALS['CONFIG']['correction_set_'.$i]?></option>
						<?$i++;
					}?>
				</select>
				<label for="mopt_correction_set">Набор корректироки по розничной цене:</label>
				<select name="mopt_correction_set" id="mopt_correction_set" disabled="disabled" class="input-l">
					<option value="0">Без корректировки</option>
					<?$i = 0;
					while(isset($GLOBALS['CONFIG']['correction_set_'.$i])){?>
						<option value="<?=$i?>" <?=(isset($_POST['mopt_correction_set']) && $_POST['mopt_correction_set'] == $i)?'selected':null?>><?=$GLOBALS['CONFIG']['correction_set_'.$i]?></option>
						<?$i++;
					}?>
				</select>
				<?if($GLOBALS['CurrentController'] == 'productedit'){?>
					<div class="edition">
						Последнее редактирование: <b><?=isset($_POST['edit_date'])?$_POST['edit_date']:'-';?></b><br>
						Пользователь: <b><?=isset($_POST['username'])?$_POST['username']:'-'?></b>
					</div>
				<?}?>
			</div>
			<div id="nav_visible">
				<h2>Видемость и индексация</h2>
				<label for="visible"><b>Скрыть товар &nbsp;</b>
					<input type="checkbox" name="visible" id="visible" class="input-m" <?=isset($_POST['visible'])&&(!$_POST['visible'])?'checked="checked" value="on"':null?>>
				</label>
			</div>
		</div>
	</form>
</div>
<div id="templates" class="hidden">
	<div id="catblock">
		<select name="categories_ids[]" class="input-m">
		<?foreach($list as $item){?>
			<option value="<?=$item['id_category']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;", $item['category_level'])?> <?=$item['name']?></option>
		<?}?>
		</select>
	</div>
</div>
<script type="text/javascript">
	// AjexFileManager.init({
	// 	returnTo: 'function'
	// });
	$(function(){
		$("#article").keyup(function() {
			var inputvalue = $(this).val();
			dataList(inputvalue);
		});
		$("#second_navigation").tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    	$("#second_navigation li").removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    	$("#height, #width, #length").keyup(function( event ) {
    		var height = $("#height").val(),
    			width = $("#width").val(),
    			length = $("#length").val(),
    			volume = 0;
    		volume = height * width * length;
    		$(".weight span").html(((volume*0.000001).toFixed(2))+" м3");
    	});
	});
	function insertValueLink(link) {
		var id_spec_prod = link.closest('tr').find('[name="id_spec_prod"]').val(),
			id_spec = link.closest('tr').find('[name="id_spec"]').val(),
			value = link.closest('tr').find('[name="value"]').val();
		console.log(id_spec_prod+','+ id_spec+','+value);
		$.ajax({
			url: URL_base+'ajaxproducts',
			type: "POST",
			cache: false,
			dataType : "json",
			data: {
				"action": 'specification_update',
				"id_spec_prod": id_spec_prod,
				"id_spec": id_spec,
				"value": value,
				"id_product": <?=$_POST['id_product']?>
			}
		});
		// var href = link.attr('href');
		// href += link.closest('tr').find('[name="value"]').val();
		// window.location.replace(href);
	}
	function updateTranslit(){
		$.ajax({
			url: URL_base+'ajaxproducts',
			type: "POST",
			cache: false,
			dataType: "json",
			data: {
				"action":'update_translit',
				"id_product": <?=$_POST['id_product']?>
			}
		}).done(function(data){
			$('#translit p').text(data);
			$('#updtrans').animate({  borderSpacing: 360 }, {
				step: function(now,fx) {
					$(this).css('-webkit-transform','rotate('+now+'deg)');
					$(this).css('-moz-transform','rotate('+now+'deg)');
					$(this).css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			},'linear');
		});
	}
	function insertSpecToProd(link) {
		var value = link.prev().val(),
			id_spec = link.prev().prev().val();
		//console.log(id_spec+','+value);
		$.ajax({
			url: URL_base+'ajaxproducts',
			type: "POST",
			cache: false,
			dataType : "json",
			data: {
				"action": 'specification_update',
				"id_spec_prod": null,
				"id_spec": id_spec,
				"value": value,
				"id_product": <?=$_POST['id_product']?>
			}
		});
	}
	function dataList(article) {
		$.ajax({
			url: URL_base+'ajaxproducts',
			type: "POST",
			cache: false,
			dataType : "json",
			data: {
				"action": 'datalist',
				"article": article,
				"id_product": <?=$_POST['id_product']?>
			}
		}).done(function(data){
			var optionlist = '';
			// console.log(data);
			$.each(data, function(k, v){
				// if(v !=){
					optionlist += '<option>'+v['response']+' | '+v['id_product']+'</option>';
				// }
			});

			// $('#character option').remove();
			$('#character').html(optionlist);
		});
	}
	function editRelatedProds(id, action) {
		$.ajax({
			url: URL_base+'ajaxproducts',
			type: "POST",
			cache: false,
			dataType : "json",
			data: {
				"action": action+'_related',
				"id_prod": <?=$_POST['id_product']?>,
				"id_related_prod": id
			}
		}).done(function(){
			location.reload();
		});

	}
	function insertValueImg1(filePath) {
		document.getElementById('img_1').value = filePath;
		var re = /(\/efiles\/)(.*?)/;
		filePath = filePath.replace(re, "$1_thumb/$2");
		document.getElementById('i1').src = filePath;
		return;
	}
	function insertValueImg2(filePath) {
		document.getElementById('img_2').value = filePath;
		var re = /(\/efiles\/)(.*?)/;
		filePath = filePath.replace(re, "$1_thumb/$2");
		document.getElementById('i2').src = filePath;
		return;
	}
	function insertValueImg3(filePath) {
		document.getElementById('img_3').value = filePath;
		var re = /(\/efiles\/)(.*?)/;
		filePath = filePath.replace(re, "$1_thumb/$2");
		document.getElementById('i3').src = filePath;
		return;
	}
	function insertValueSertificate(filePath){
		document.getElementById('sertificate').value = filePath;
	}
	function AddCat(){
		$('#templates #catblock').clone().insertBefore('#addlink');
	}

	$(window).scroll(function(){
		//Фиксация Заголовка продукта
		if($(this).scrollTop() >= 100){
			if(!$('.prod_head').hasClass('fixed_head')){
				var width = $('#productae').width();
				$('.prod_head').css("width", width).addClass('fixed_head');
				$('#second_navigation').css("margin-top", "50px");
			}
		}else{
			if($('.prod_head').hasClass('fixed_head')){
				$('.prod_head').removeClass('fixed_head');
				$('#second_navigation').css("margin-top", "0");
			}
		}

		/** Плавающий блок secons меню*/
		// var params = $('#second_navigation ul');
		// var start = 100;
		// if($(this).scrollTop() >= start){
		// 	params.css("top", $(this).scrollTop()-start);
		// }else{
		// 	params.css("top", '0');
		// }
	});
</script>