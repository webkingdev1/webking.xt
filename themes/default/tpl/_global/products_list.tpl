<?foreach($list as $item){
	$in_cart = false;
		if(!empty($_SESSION['cart']['products'][$item['id_product']])){
			$in_cart = true;
		}
		$a = explode(';', $GLOBALS['CONFIG']['correction_set_'.$item['opt_correction_set']]);
	?>
	<div class="card clearfix">
		<div class="product_photo">
			<a href="#">
				<?if(!empty($item['images'])){?>
					<img alt="<?=G::CropString($item['id_product'])?>" class="lazy" data-original="http://xt.ua<?=str_replace('original', 'thumb', $item['images'][0]['src']);?>"/>
					<noscript>
						<img alt="<?=G::CropString($item['id_product'])?>" src="<?=_base_url.str_replace('original', 'thumb', $item['images'][0]['src']);?>"/>
					</noscript>
				<?}else{?>
					<img alt="<?=G::CropString($item['id_product'])?>" class="lazy" data-original="http://xt.ua<?=$item['img_1']?htmlspecialchars(str_replace("/image/", "/_thumb/image/", $item['img_1'])):"/images/nofoto.jpg"?>"/>
					<!-- <img alt="<?=G::CropString($item['id_product'])?>" class="lazy" data-original="<?=_base_url.($item['img_1']?htmlspecialchars(str_replace("/image/", "/_thumb/image/", $item['img_1'])):"/images/nofoto.jpg")?>"/> -->
					<noscript>
						<img alt="<?=G::CropString($item['id_product'])?>" src="<?=_base_url.($item['img_1']?htmlspecialchars(str_replace("/image/", "/_thumb/image/", $item['img_1'])):"/images/nofoto.jpg")?>"/>
					</noscript>
				<?}?>
			</a>
		</div>
		<p class="product_name"><a href="<?=Link::Product($item['translit']);?>"><?=G::CropString($item['name'])?></a> <span class="product_article">Арт: <?=$item['art'];?></span></p>
		<div class="product_buy" data-idproduct="<?=$item['id_product']?>">
			<div class="buy_block">
				<?if($GLOBALS['CurrentController'] != 'main'){?>
					<div class="price">
						<?=$in_cart?number_format($_SESSION['cart']['products'][$item['id_product']]['actual_prices'][$_COOKIE['sum_range']], 2, ".", ""):number_format($item['price_opt']*$a[$_COOKIE['sum_range']], 2, ".", "");?>
					</div>
					<div class="btn_buy">
						<div id="in_cart_<?=$item['id_product'];?>" class="btn_js in_cart_js <?=isset($_SESSION['cart']['products'][$item['id_product']])?null:'hidden';?>" data-name="cart"><i class="material-icons">shopping_cart</i><!-- В корзине --></div>
						<div class="mdl-tooltip" for="in_cart_<?=$item['id_product'];?>">Товар в корзине</div>
						<button class="mdl-button mdl-js-button buy_btn_js <?=isset($_SESSION['cart']['products'][$item['id_product']])?'hidden':null;?>" type="button" onClick="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), null); return false;">Купить</button>
					</div>
					<div class="quantity">
						<button class="material-icons btn_add"	onClick="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), 1); return false;">add</button>
						<input type="text" class="qty_js" value="<?=isset($_SESSION['cart']['products'][$item['id_product']]['quantity'])?$_SESSION['cart']['products'][$item['id_product']]['quantity']:$item['inbox_qty']?>" onchange="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), null);return false;" min="0" step="<?=$item['min_mopt_qty'];?>">
						<button class="material-icons btn_remove" onClick="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), 0);return false;">remove</button>
						<div class="units"><?=$item['units'];?></div>
					</div>
				<?}?>
			</div>
		</div>
		<div class="product_info clearfix">
			<div class="note clearfix">
				<textarea placeholder="Примечание: "></textarea>
				<label class="info_key">?</label>
				<div class="info_description">
					<p>Поле для ввода примечания к товару.</p>
				</div>
			</div>
		</div>
	</div>
<?}?>