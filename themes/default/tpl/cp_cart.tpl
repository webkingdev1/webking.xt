<!-- <h4 class="title_cart">Корзина</h4> -->
<script>
	var randomManager,
	qtycontrol = [],
	notecontrol = [];
</script>
<?if(empty($list)){
	if(isset($cart['id_order'])){
		if($_GET['type'] == 'order'){?>
			<script>
				ga('ecommerce:addTransaction', {
					id: '<?=$cart['id_order'];?>',									// Transaction ID. Required.
					affiliation: '<?=$GLOBALS['CONFIG']['invoice_logo_text']?>',	// Affiliation or store name.
					revenue: '<?=$cart['sum_discount']?>'							// Grand Total.
				});
			</script>
			<?foreach($cart['products'] as $p){?>
				<script>
					ga('ecommerce:addItem', {
						'id': '<?=$cart['id_order']?>',								// Transaction ID. Required.
						'name': '<?=str_replace("'", '"', $p['name'])?>',			// Product name. Required.
						'sku': '<?=$p['art']?>',									// SKU/code.
						'category': '<?=$p['id_category']?>',						// Category or variation.
						'price': '<?=$p['site_price_opt']?>',						// Unit price.
						'quantity': '<?=$p['order_opt_qty']+$p['order_mopt_qty']?>'	// Quantity.
					});
				</script>
			<?}?>
			<?if($p['order_opt_qty'] > 0){?>
				<!-- <script>
					ga('ecommerce:addItem', {
					'id': '<?=$cart['id_order']?>',								// Transaction ID. Required.
					'name': '<?=str_replace("'", '"', $p['name'])?>',			// Product name. Required.
					'sku': '<?=$p['art']?>',									// SKU/code.
					'category': '<?=$p['id_category']?>',						// Category or variation.
					'price': '<?=$p['site_price_opt']?>',						// Unit price.
					'quantity': '<?=$p['order_opt_qty']?>'						// Quantity.
					});
				</script>-->
			<?}
			if($p['order_mopt_qty'] > 0){?>
				<!-- <script>
					ga('ecommerce:addItem', {
					'id': '<?=$cart['id_order']?>',								// Transaction ID. Required.
					'name': '<?=str_replace("'", '"', $p['name'])?>',			// Product name. Required.
					'sku': '<?=$p['art']?>',									// SKU/code.
					'category': '<?=$p['id_category']?>',						// Category or variation.
					'price': '<?=$p['site_price_mopt']?>',						// Unit price.
					'quantity': '<?=$p['order_mopt_qty']?>'						// Quantity.
					});
				</script> -->
			<?}?>
			<!-- <script>ga('ecommerce:send');</script> -->
		<?}?>
		<div class="success_order">
			<?if($_GET['type'] == 'draft'){?>
				<h2>Черновик сохранен</h2>
				<img src="<?=file_exists($GLOBALS['PATH_root'].'/images/draft__saved.png')?_base_url.'/images/draft__saved.png':'/images/nofoto.png'?>" alt="draft saved">
				<p>
					<a href="/customer_order/<?=$cart['id_order']?>" class="btn-m-green">Посмотреть состав черновика</a>
					<a href="/cabinet/" class="btn-m-green">Перейти в личный кабинет</a>
				</p>
			<?}else{?>
				<h2>Спасибо за Ваш заказ</h2>
				<img src="<?=file_exists($GLOBALS['PATH_root'].'/images/operator.png')?_base_url.'/images/operator.png':'/images/nofoto.png'?>" alt="draft saved">
				<div class="order_info">
					<p>Заказ <b>№<?=$cart['id_order']?></b> принят.</p>
					<p>В ближайшее время с Вами свяжется менеджер.</p>
				</div>
				<p>
					<a href="/customer_order/<?=$cart['id_order']?>" class="btn-m-green">Посмотреть состав заказа</a>
					<a href="/cabinet/" class="btn-m-green">Перейти в личный кабинет</a>
				</p>
			<?}?>
		</div>
	<?}?>
<?}else{?>
	<!-- Недоступные товары -->
	<?if(!empty($_SESSION['cart']['unavailable_products'])){?>
		<div class="msg-warning">
			<p>
				<?=$count = count($unlist);?>
				<?if($count == 1){?>
					товар сейчас недоступен.
				<?}elseif(substr($count, -1) == 1 && substr($count, -2, 1) != 1){?>
					товар сейчас недоступен.
				<?}elseif(substr($count, -1) == 2 || substr($count, -1) == 3 || substr($count, -1) == 4 && substr($count, -2, 1) != 1){?>
					товара сейчас недоступно.
				<?}else{?>
					товаров сейчас недоступно.
				<?}?>
			</p>
		</div>
	<?}?>
	<?if(G::IsLogged() && $_SESSION['member']['gid'] == _ACL_MANAGER_){?>
		<?if(!empty($unlist)){?>
			<a href="#" class="show_btn" onclick="$(this).next().toggleClass('hidden'); return false;">Показать недоступные товары</a>
			<div class="unavailable_products hidden animate" id="unavailable_products">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table paper_shadow_1">
					<colgroup>
						<col width="20%">
						<col width="80%">
					</colgroup>
					<thead>
						<tr>
							<td class="left">Артикул</td>
							<td class="left">Название</td>
						</tr>
					</thead>
					<tbody>
						<?foreach($unlist as $ul){?>
							<tr>
								<td class="left"><?=$ul['art']?></td>
								<td class="left">
									<a href="/product/<?=$ul['id_product'].'/'.$ul['translit']?>/"><?=$ul['name']?></a>
								</td>
							</tr>
						<?}?>
					</tbody>
				</table>
			</div>
		<?}?>
	<?}?>
	<!-- END Недоступные товары -->
	<!-- NEW Товары в корзине -->
	<div class="order_wrapp">
		<?$i = 0;
		$summ_prod = count($_SESSION['cart']['products']);
		$summ_many = $_SESSION['cart']['cart_sum'];
		foreach($list as $item){
			$item['price_mopt'] > 0 ? $mopt_available = true : $mopt_available = false;
			$item['price_opt'] > 0 ? $opt_available = true : $opt_available = false;?>
			<div class="card" id="cart_item_<?=$item['id_product']?>">
				<div class="card_wrapper">
					<div class="product_photo">
						<a href="<?=Link::Product($item['translit']);?>">
							<?if(!empty($item['images'])){?>
								<img alt="<?=G::CropString($item['name'])?>" src="http://xt.ua<?=str_replace('/original/', '/thumb/', $item['images'][0]['src']);?>"/>
							<?}else{?>
								<img alt="<?=G::CropString($item['name'])?>" src="http://xt.ua<?=($item['img_1'])?str_replace("image/", "_thumb/image/", $item['img_1']):"/images/nofoto.png"?>"/>
							<?}?>
						</a>
					</div>
					<div class="product_name">
						<a href="<?=Link::Product($item['translit']);?>" class="description_<?=$item['id_product'];?>">
							<?=G::CropString($item['name'], 180)?>
						</a>
						<span class="product_article">Артикул: <?=$item['art']?></span>						
						<span class="prod_qty_control" data-qtycontr="<?=$item['qty_control']?>"></span>
						<div class="product_info">
							<div class="note in_cart">
								<textarea class="note_field" cols="30" rows="3" placeholder="Примечание к товару" id="mopt_note_<?=$item['id_product']?>" data-id="<?=$item['id_product']?>" form="edit" name="note" <?=$item['note_control'] != 0 ? 'required':null?>><?=isset($_SESSION['cart']['products'][$item['id_product']]['note'])?$_SESSION['cart']['products'][$item['id_product']]['note']:null?></textarea>
								<label class="info_key">?</label>
								<div class="info_description hidden">
									<p>Поле для ввода примечания к товару.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="product_buy" data-idproduct="<?=$item['id_product']?>">
						<input class="opt_cor_set_js" type="hidden" value="<?=$GLOBALS['CONFIG']['correction_set_'.$item['opt_correction_set']]?>">
						<input class="price_opt_js" type="hidden" value="<?=$item['price_opt']?>">
						<div class="buy_block">
							<div class="price"><?=number_format($_SESSION['cart']['products'][$item['id_product']]['actual_prices'][$_SESSION['cart']['cart_column']], 2, ",", "");?></div>
							<div class="prodPrices hidden">
								<div class="itemProdQty"><?=$item['min_mopt_qty']?></div>
								<?for ($i = 0; $i < 4; $i++){?>
									<input class="priceOpt<?=$i?>" value="<?=$item['prices_opt'][$i]?>">
									<input class="priceMopt<?=$i?>" value="<?=$item['prices_mopt'][$i]?>">
								<?}?>
							</div>
							<div class="quantity">
								<button id="cart_btn_add<?=$item['id_product']?>" class="material-icons btn_add btn_qty_js"	onClick="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), 1); return false;">add</button>
								<div class="mdl-tooltip mdl-tooltip--top tooltipForBtnAdd_js hidden" for="cart_btn_add<?=$item['id_product']?>">Больше</div>

								<input type="text" class="minQty hidden" value="<?=$item['inbox_qty']?>">
								<input type="text" class="qty_js" value="<?=isset($_SESSION['cart']['products'][$item['id_product']]['quantity'])?$_SESSION['cart']['products'][$item['id_product']]['quantity']:$item['inbox_qty']?>" onchange="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), null);return false;" min="0" step="<?=$item['min_mopt_qty'];?>">
								

								<button id="cart_btn_remove<?=$item['id_product']?>" class="material-icons btn_remove btn_qty_js" onClick="ChangeCartQty($(this).closest('.product_buy').data('idproduct'), 0);return false;">remove</button>								
								<div class="mdl-tooltip tooltipForBtnRemove_js hidden" for="cart_btn_remove<?=$item['id_product']?>">Меньше</div>

								<div class="units"><?=$item['units'];?></div>
							</div>
						</div>
						<div class="priceMoptInf<?=($_SESSION['cart']['products'][$item['id_product']]['quantity'] < $item['inbox_qty'])?'':' hidden'?>">Малый опт</div>
					</div>
					<div class="summ">
						<span class="order_mopt_sum_<?=$item['id_product']?>">
							<?=isset($_SESSION['cart']['products'][$item['id_product']]['summary'][$_SESSION['cart']['cart_column']])?number_format($_SESSION['cart']['products'][$item['id_product']]['summary'][$_SESSION['cart']['cart_column']],2,",",""):"0.00"?>
						</span>
					</div>
					<div class="remove_prod">
						<i id="tt<?=$item['id_product']?>" class="material-icons" onClick="removeFromCart('<?=$item['id_product']?>')">cancel</i>
						<div class="mdl-tooltip" for="tt<?=$item['id_product']?>">Удалить из корзины</div>
					</div>
				</div>
			</div>
		<?}
		$cart_sum = $_SESSION['cart']['products_sum']['3'];
		$percent_sum = $total = 0;
		if($cart_sum >= 0 && $cart_sum < $GLOBALS['CONFIG']['retail_order_margin']) {
			$percent = $percent_sum = 0;
			$total = $cart_sum;
		}elseif($cart_sum >= $GLOBALS['CONFIG']['retail_order_margin'] && $cart_sum < $GLOBALS['CONFIG']['wholesale_order_margin']) {
			$percent = 10;
			$percent_sum = $cart_sum * 0.10;
			$total = $cart_sum - $percent_sum;
		}elseif($cart_sum >= $GLOBALS['CONFIG']['wholesale_order_margin'] && $cart_sum < $GLOBALS['CONFIG']['full_wholesale_order_margin']) {
			$percent = 16;
			$percent_sum = $cart_sum * 0.16;
			$total = $cart_sum - $percent_sum;
		}elseif($cart_sum >= $GLOBALS['CONFIG']['full_wholesale_order_margin']){
			$percent = 21;
			$percent_sum = $cart_sum * 0.21;
			$total = $cart_sum - $percent_sum;
		};?>
	</div>
	<div class="cart_footer">
		<div id="total">
			<div class="total">
				<div class="label totaltext">Итого:</div>
				<div class="total_summ totalnumb">
					<span class="summ_many"><?=isset($cart_sum)?number_format($cart_sum, 2, ",", ""):"0,00"?></span> грн.
				</div>
			</div>
			<div class="total">
				<div class="label totaltext">Вы экономите:</div>
				<div class="total_summ totalnumb">
					<span class="summ_many"><?=number_format($percent_sum, 2, ",", "")?></span> грн.
				</div>
			</div>
			<div class="total">
				<div class="label totaltext">К оплате:</div>
				<div class="total_summ">
					<span class="summ_many"><?=number_format($total, 2, ",", "")?></span> грн.
				</div>
			</div>
		</div>
		<div class="order_balance_cart">
			<!-- <table id="percent">
				<tr <?=$percent == 0 ? '': "style='display:none'"?>>
					<td>Добавьте:</td>
					<td><?=round(500-$cart_sum,2)?>грн</td>
					<td>Получите скидку:</td>
					<td>50грн (10%)</td>
				</tr>
				<tr <?=($percent == 0 || $percent == 10) ? '': "style='display:none'"?>>
					<td><?=$percent == 10 ? 'Добавьте:' : ''?></td>
					<td <?=($percent == 0) ? "style=\"color: #9E9E9E\"" : ''?>><?=round(3000-$cart_sum,2)?>грн</td>
					<td><?=$percent == 10 ? 'Получите скидку:' : ''?></td>
					<td <?=($percent == 0) ? "style=\"color: #9E9E9E\"" : ''?>>480грн (16%)</td>
				</tr>
				<tr <?=($percent == 0 || $percent == 10 || $percent == 16) ? '': "style='display:none'"?>>
					<td><?=$percent == 16 ? 'Добавьте:' : ''?></td>
					<td <?=($percent == 10 || $percent == 0) ? "style=\"color: #9E9E9E\"" : ''?>><?=round(10000-$cart_sum,2)?>грн</td>
					<td><?=$percent == 16 ? 'Получите скидку:' : ''?></td>
					<td <?=($percent == 10 || $percent == 0) ? "style=\"color: #9E9E9E\"" : ''?>>2100грн (21%)</td>
				</tr>
				<tr><td><?=$percent == 21 ? 'Ваша скидка 21%' : ''?></td></tr>
			</table> -->

			<div id="discountBlock">
				<div id="discountTable">
					<div class="mediaDiscountBlocks">
						<div class="addMoreProducts discountTableElem <?=($percent == 0 || $percent == 10 || $percent == 16) ? '': "hidden"?>">
							Добавьте:
						</div>
						<div class="neededSum discountTableElem">
							<span id="sumPer0" <?=$percent == 0 ? '': "class='hidden'"?>><?=number_format(round(500-$cart_sum,2), 2, ",", "")?> грн</span>
							<span id="sumPer10" <?=($percent == 0 || $percent == 10) ? '': "class='hidden'"?>><?=number_format(round(3000-$cart_sum,2), 2, ",", "")?> грн</span>
							<span id="sumPer16" <?=($percent == 0 || $percent == 10 || $percent == 16) ? '': "class='hidden'"?>><?=number_format(round(10000-$cart_sum,2), 2, ",", "")?> грн</span>
						</div>
					</div>
					<div class="mediaDiscountBlocks">
						<div class="getNewDiscount discountTableElem <?=($percent == 0 || $percent == 10 || $percent == 16) ? '': "hidden"?>" >
							Получите скидку:
						</div>
						<div class="nextDiscount discountTableElem">
							<span id="dicsPer0" <?=$percent == 0 ? '': "class='hidden'"?>>50 грн (10%)</span>
							<span id="dicsPer10" <?=($percent == 0 || $percent == 10) ? '': "class='hidden'"?>>480грн (16%)</span>
							<span id="dicsPer16" <?=($percent == 0 || $percent == 10 || $percent == 16) ? '': "class='hidden'"?>>2100грн (21%)</span>
						</div>
					</div>
				</div>
				<div class="currentDiscountBlock">
					<span>Ваша скидка:</span>
					<span id="currentDiscount">
						<?=$percent == 0 ? '0%': ""?>
						<?=$percent == 10 ? '10%': ""?>
						<?=$percent == 16 ? '16%': ""?>
						<?=$percent == 21 ? '21%': ""?>
					</span>
				</div>
			</div>
			<div class="price_nav"></div>
		</div>
	</div>
	<div class="orderNote">
		<textarea name="orderNote" placeholder="Примечания к заказу..."></textarea>
	</div>
	<div class="action_block">
		<div class="wrapp">
			<form action="">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<label for="user_number">*Телефон</label>
					<input class="mdl-textfield__input phone" type="text" id="user_number"
					pattern="\+\d{2}\s\(\d{3}\)\s\d{3}\-\d{2}\-\d{2}\" value="<?=isset($phone) ? $phone : null ?>">
					<label class="mdl-textfield__label" for="user_number"></label>
					<span class="mdl-textfield__error err_tel orange">Поле обязательное для заполнения!</span>
				</div>
				<p class="err_msg"></p>
				<!-- <a href="#" class="mdl-button mdl-js-button login_btn cart_login_btn hidden">Войти</a> -->

				<?if(G::IsLogged() || _acl::isAdmin()){?>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label promo_input_js promo_input" id="promo_input">
						<label for="promo_input">Промокод</label>
						<input class="mdl-textfield__input" type="text" id="promo_input" value="<?=isset($_SESSION['cart']['promo']) && $_SESSION['cart']['promo'] != ''?$_SESSION['cart']['promo']:null;?>">
						<label class="mdl-textfield__label" for="promo_input"></label>
						<span class="mdl-textfield__error err_promo orange"></span>
					</div>
					<span class="del_promo_wrapp_js hidden"><i class="material-icons del_promoCode del_promoCode_js btn_js">clear</i></span>
					<?if(isset($_SESSION['cart']['promo']) && $_SESSION['cart']['promo'] != '') {?>
						<i class="material-icons del_promoCode del_promoCode_js btn_js">clear</i>
						<div class="cart_warning_js cart_warning clearBoth hidden">
							<p>Удаление промокода приведет к удалению всех совместно организованных заказов.</p>
							<p>Вы уверенны, что хотите удалить промокод?</p>
							<input type="hidden" value="<?=isset($_SESSION['cart']['id'])?$_SESSION['cart']['id']:'';?>">
							<input type="button" class="confirm_del_promoCode_js mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" value="Да"/>
							<input type="button" class="cancel_del_promoCode_js mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" value="Нет"/>
						</div>
					<?}else{?>
						<input type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect apply_promoCode apply_promoCode_js" value="Применить"/>
					<?}?>
					<?if(isset($_SESSION['cart']['promo']) && $_SESSION['cart']['adm'] == 1) {?>
						<div class="clearBoth">
							<div class="info_admin">Для управления совместной покупкой, перейдите личный кабинет.</div>
							<a href="<?=Link::Custom('cabinet', 'cooperative')?>?t=joactive"><input type="button" class="order_management order_management_js mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" value="Управление заказом"/></a>
						</div>
					<?}else if(isset($_SESSION['cart']['promo']) && $_SESSION['cart']['adm'] == 0) {?>
						<div class="<?=isset($_SESSION['cart']['promo']) && $_SESSION['cart']['adm'] == 0?null:'hidden';?> clearBoth">
							<input type="hidden" value="<?=$_SESSION['cart']['id']?>">
							<?if(isset($_SESSION['cart']['ready']) && $_SESSION['cart']['ready'] == 0) {?>
								<div class="info_client ic_waiting">Подтвердите свой заказ и ожидайте подтверждения администратора.</div>
							<?}else{?>
								<div class="info_client ic_ready">Заказ подтвержден. </div>
							<?}?>
							<div class="info_client">Детали заказа можно посмотреть в <a href="<?=Link::Custom('cabinet', 'cooperative')?>?t=joactive">личном кабинете</a></div>
							<input type="button" class="confirm_order_js mdl-button mdl-js-button mdl-button--raised <?=isset($_SESSION['cart']['ready']) && $_SESSION['cart']['ready']==1?'mdl-button--colored':null;?> mdl-js-ripple-effect" value="Готово"/>
						</div>
					<?}?>
				
					<?if(!isset($_SESSION['cart']['promo'])){?>
						<div class="cart_choiсe_wrapp_js">
							<!--<div class="tooltip_wrapp joint_cart_js">
								<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect add_cart_state">
									<input type="radio" class="mdl-radio__button" name="options" value="1">
									<span class="mdl-radio__label">Совместная корзина</span>
										<label class="info_key" style="position: initial;">?</label>
										<div class="info_description">Создать совместную корзину и стать ее администратором.</div>
								</label>
							</div>-->
							<div class="tooltip_wrapp joint_purchase_js">
								<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect add_cart_state">
									<input type="radio" class="mdl-radio__button"  id="joint_cart" name="options" value="2">
									<span class="mdl-radio__label">Cовместный заказ</span>
										<label class="info_key" style="position: initial;">?</label>
										<div class="info_description">Перейти к оформлению совместного заказа</div>
								</label>
							</div>
							<input type="button" class="cart_continue_js cart_continue mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect hidden joint_cart_continue_js joint_purchase_continue_js" value="Продолжить"/>
						</div>
					<?}?>
				<?}?>
				<?if(!G::IsLogged() || !_acl::isAdmin()){?>
					<div id="button-cart1" class="<?=isset($_SESSION['cart']['promo'])?'hidden':null;?>">
						<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" type='submit' value="Отправить">Оформить заказ</button>
					</div>
				<?}else{?>
					<p>Вы не можете использовать корзину</p>
				<?}?>
				<!-- <div id="button-cart2">
					<button class="mdl-button mdl-js-button btn_js" type='submit' data-href="<?=Link::custom('cabinet','cooperative?t=working')?>" value="Отправить">Отправить форму</button>
				</div>
				<div id="button-cart3">
					<button class="mdl-button mdl-js-button btn_js" type='submit' data-href="<?=Link::custom('cabinet','?t=working')?>" value="Отправить"></button>
				</div> -->
			</form>
			
			<script type='text/javascript'>
				//   radio button magic
				componentHandler.upgradeDom();

				var checked = false;

				$('#cart .joint_cart_js').on('click', function () {
					if (checked == false) {
						$('.action_block #button-cart1 [type="submit"]').addClass('hidden');
						$('.cart_continue_js').addClass('joint_cart_continue_js').removeClass('hidden').removeClass('joint_purchase_continue_js');
					}
				});
				$('#cart .joint_purchase_js').on('click', function () {
					if (checked == false) {
						$('.action_block #button-cart1 [type="submit"]').addClass('hidden');
						$('.cart_continue_js').addClass('joint_purchase_continue_js').removeClass('hidden').removeClass('joint_cart_continue_js');
					}
				});
				$('#cart .action_block .mdl-radio').on('mousedown', function (e) {
					checked = $(this).hasClass('is-checked');
				}).on('click', function () {
					if (checked == true) {
						$(this).removeClass('is-checked').find('input').attr('checked', false);
						$('.action_block #button-cart1 [type="submit"]').removeClass('hidden');
						$('.cart_continue_js').addClass('hidden');
					}
				});

				$('.joint_purchase_continue_js').click(function(event) {
					ajax('cart', 'CreateJointOrder', {prefix: $('.joint_purchase_js label').hasClass('is-checked')?'JO':''}).done(function(resp) {
						$('.promo_input_js').removeClass('hidden').find('input').attr('value', resp);
						openObject('cart', {reload: true});
					}).fail(function(resp) {
						console.log('fail ajax');
					});
				});
				$('.joint_cart_continue_js').click(function(event) {
					// ajax('cart', 'CreateJointCart', {jointCart: jointCart}).done(function(data){
					// 	console.log(data);
					// }).fail(function(data){
					// 	console.log('fail ajax');
					// });
				});
				//   radio button magic (end)


				$('.apply_promoCode_js').click(function(event) {
					ajax('cart', 'CheckPromo', {promo: $('.promo_input_js input').val()}).done(function(data) {
						console.log(data);
						if (data.promo) {
							$('cart_choiсe_wrapp_js').addClass('hidden');
							GetCartAjax(true);
							console.log("success promo");
							$('.action_block form').removeClass('for_err_promo');
							$('.err_promo').removeClass('visibleForUser');
						}else{
							$('.action_block form').addClass('for_err_promo');
							$('.err_promo').addClass('visibleForUser').text(data.msg);
							componentHandler.upgradeDom();
						}
						
						// $('.confirm_order_js').closest('div').removeClass('hidden');
						// $('#button-cart1').addClass('hidden');
					}).fail(function(data) {
						console.log("fail promo");
					});
				});
				$('.confirm_del_promoCode_js').click(function(event) {
					ajax('cart', 'DeletePromo', {id_cart: $(this).closest('div').find('[type="hidden"]').val()}).done(function(event) {
						$('.promo_input_js input').attr('value', '');
						// $('.cart_warning_js').addClass('hidden');
						openObject('cart', {reload: true});
					}).fail(function(event) {
						console.log("fail del promo");
					});
				});
				$('.cancel_del_promoCode_js').click(function(event) {
					$('.cart_warning_js').addClass('hidden');
				});
				$('.del_promoCode_js').click(function(event) {
					$('.cart_warning_js').removeClass('hidden');
				});
				$('.confirm_order_js').click(function(event) {
					// console.log($(this).closest('div').find('[type="hidden"]').val());
					ajax('cart', 'ReadyUserJO', {id_cart: $(this).closest('div').find('[type="hidden"]').val()}).done(function(){
						console.log("success ");
						openObject('cart', {reload: true});
					}).fail(function(event) {
						console.log("fail ");
					});
				});
			</script>
		</div>
	</div>


	<!-- END NEW Товары в корзине -->
	<script type="text/javascript">
		$(window).resize(function() {
    		Position($('#cart'));
		});


		$(function(){
			if(IsLogged){
				// console.log('loggedin');
			}
			// Инициалзация маски для ввода телефонных номеров
			$(".phone").mask("+38 (099) ?999-99-99");
			// Создание заказа, нового пользователя только с телефоном (start)

			$('.remove_prod i, .remove_prod_mob').on('click', function(e){
				$(this).closest('.card').addClass('hidden');
				$('#removingProd').removeClass('hidden');
			});

			$('.clear_cart').on('click', function(e){
				$('#clearCart').removeClass('hidden');
			});

			$(".note_field").blur(function() {
				 var id_product = $(this).data('id'),
				 	 note = $(this).val();
				ajax('cart', 'updateCartQty', {id_product: id_product, note: note});
			});


			$('#cart').on('click', '#button-cart1 button', function(e){
				e.preventDefault();
				var phone = $('.action_block input.phone').val().replace(/[^\d]+/g, "");
				//Проверка на ввод примечания к товару					
				var qtyControl = 0;
				$('#cart .product_name').each(function(){
					var currentQtyControl = $(this).find('.prod_qty_control').data('qtycontr');
					var noteText = $(this).find('textarea').val();
					$(this).find('.note').removeClass('activeNoteArea');
					if (currentQtyControl === 1 && noteText == '') {
						qtyControl = 1;
						$(this).find('.note').addClass('activeNoteArea');
						$(this).find('textarea').attr('placeholder', 'ПРИМЕЧАНИЕ ОБЯЗАТЕЛЬНО!!!');
						$('#fillNote').removeClass('hidden');

						setTimeout (function(){
							$("#fillNote").addClass('hidden');
						}, 3000);						
					}
				});
				if(phone.length == 12){
					if (qtyControl === 0){
						addLoadAnimation('#cart');
						ajax('cart', 'makeOrder', {phone: phone}).done(
							function(data){
							switch(data.status){
								case 200:
									// closeObject('cart');
									window.location.hash = "quiz";
									ajax('auth', 'GetUserProfile', false, 'html').done(function(data){
										console.log(data);
										$('#user_profile').append('<img src="/images/noavatar.png"/>');
										$('.user_profile_js').html(data);

										$('.cabinet_btn').removeClass('hidden');
										$('.login_btn').addClass('hidden');
										$('header .cart_item a.cart i').removeClass('mdl-badge');
										$('.card .buy_block .btn_buy').find('.in_cart_js').addClass('hidden');
										$('.card .buy_block .btn_buy').find('.buy_btn_js').removeClass('hidden');
									});
									if (data.new_user === true) {
										window.location.href = '<?=Link::Custom('cabinet')?>#quiz';
									}
									openObject('quiz');
									break;
								case 500:
									console.log('error');
									removeLoadAnimation('#cart');
									break;
								case 501:
									removeLoadAnimation('#cart');
									$('.err_msg').html(data.message);
									setTimeout(function() {
										$('.err_msg + .cart_login_btn').removeClass('hidden');
									}, 1000);
									$('.err_msg + .cart_login_btn').click(function(event) {
										event.preventDefault;
										openObject('auth');
									});
									break;
								default:
									console.log('default statemant');
							}

							/*window.location.href = '<?=Link::Custom('cabinet')?>';*/
						});
					}
				}else{
					removeLoadAnimation('#cart');
					$('.err_tel').css('visibility', 'visible');
				}				
			});
			if(!IsLogged){
				$('input.send_order, input.save_order').click(function(e){
					var name = $('#edit #name').val().length;
					var phone = $('#edit #phone').val().length;
					var id_manager = $('#edit #id_manager').val();
					var id_city = $('#edit #id_delivery_department').val();
					if(name > 3){
						if(phone > 0){
							if(id_manager != null){
								if(id_city != null){
									$(this).submit();
								}else{
									e.preventDefault();
									alert("Город не выбран");
								}
							}else{
								e.preventDefault();
								alert("Менеджер не выбран");
							}
						}else{
							e.preventDefault();
							$("#phone").removeClass().addClass("unsuccess");
							alert("Телефон не указан");
						}
					}else{
						e.preventDefault();
						$("#name").removeClass().addClass("unsuccess");
						alert("Контактное лицо не заполнено");
					}
				});
			}
			$("#name").blur(function(){
				var name = this.value;
				var nName = name.replace(/[^A-zА-я ]+/g, "");
				var count = nName.length;
				if (count < 3) {
					$(this).removeClass().addClass("unsuccess");
				} else {
					$("#name").prop("value", nName);
					$(this).removeClass().addClass("success");
				}
			});
			$("#phone").blur(function(){
				var phone = this.value;
				var nPhone = phone.replace(/[^0-9]+/g, "");
				var count = nPhone.length;
				$("#phone").prop("value", nPhone);
				if (count == 10) {
					$(this).removeClass().addClass("success");
				} else {
					$(this).removeClass().addClass("unsuccess");
				}
			});
			// Set Random contragent
			if(randomManager == 1){
				var arr = new Array();
				var n = 1;
				$("#id_manager option").each(function(){
					arr.push(n);
					n++;
				});
				var random = Math.ceil(Math.random()*arr.length);
				$("#id_manager .cntr_"+random).prop("selected", "true");
			}
			function ResetForm(){
				$("#id_delivery").val(0);
				$("#id_city").val(0);
				$("#cityblock").fadeOut();
				$("#id_delivery_service").val(0);
				$("#delivery_serviceblock").fadeOut();
				$("#id_parking").val(0);
				$("#parkingblock").fadeOut();
				$("#id_contragent").val(0);
				$("#contragentblock").fadeOut();
				$("#addressdescr").val(0);
				$("#addressdescr").fadeOut();
				$("#contrlink").val(0);
				$("#contrlink").fadeOut();
			}
			//---------Проверка на ввод телефона
			/*$('#button-cart1').click(function(){
				if(!$('.phone').val()){
					$(this).click(function(){
						$(this).attr('disabled', 'disabled');
					});
					$('.err_tel').css('visibility', 'visible');
				}else{
					$(this).removeAttr("disabled");
					$('.err_tel').css('visibility', '')
				}
			});*/			
		});
	</script>
<?}?>

<div class="no_items <?=isset($_SESSION['cart']['products']) && !empty($_SESSION['cart']['products'])?'hidden':null;?>">
	<h2 class="cat_no_items">Ваша корзина пуста!</h2>
	<img src="<?=file_exists($GLOBALS['PATH_root'].'/images/kharkov/empty-cart.jpg')?_base_url.'/images/kharkov/empty-cart.jpg':'/images/nofoto.png'?>" alt="Ваша корзина пуста!">
	<p>Перейдите в <a href="/">каталог</a> для совершения покупок</p>
</div>