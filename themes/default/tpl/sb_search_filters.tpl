<div class="filters">
	<div class="filter_block">
		<p>Сезонные товары</p>
		<ul>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Новый год</span>
					<span class="qnt_products fright">201</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Снег</span>
					<span class="qnt_products fright">2222</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Дождь</span>
					<span class="qnt_products fright">224</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Град</span>
					<span class="qnt_products fright">23</span>
				</label>
			</li>
		</ul>
	</div>
	<div class="filter_block">
		<p>Сезонные товары</p>
		<ul>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Новый год</span>
					<span class="qnt_products fright">201</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Снег</span>
					<span class="qnt_products fright">2222</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Дождь</span>
					<span class="qnt_products fright">224</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Град</span>
					<span class="qnt_products fright">23</span>
				</label>
			</li>
		</ul>
	</div>
	<div class="filter_block">
		<p>Сезонные товары</p>
		<ul>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Новый год</span>
					<span class="qnt_products fright">201</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Снег</span>
					<span class="qnt_products fright">2222</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Дождь</span>
					<span class="qnt_products fright">224</span>
				</label>
			</li>
			<li>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
					<input type="checkbox" class="mdl-checkbox__input">
					<span class="mdl-checkbox__label">Град</span>
					<span class="qnt_products fright">23</span>
				</label>
			</li>
		</ul>
	</div>
</div>
<!--
<?if(!empty($list) && (!isset($_SESSION['member']) || $_SESSION['member']['gid'] != _ACL_TERMINAL_)){?>
	<div class="sb_block">
		<h4>Фильтры</h4>
		<div class="sb_container">
			<form action="<?=_base_url."/".preg_replace("#^(.*?)/(p[0-9]+)(.*?)$#is", "\$1\$3/", preg_replace("#^/(.*?)$#i", "\$1", $_SERVER['REQUEST_URI']));?>" method="post" name="search_form" id="filters">
				<input type="hidden" name="query" value="<?=isset($_SESSION['search']['query'])?$_SESSION['search']['query']:null;?>"/>
				<?if(isset($_POST['category2search'])){?>
					<input type="hidden" name="category2search" value="<?=$_SESSION['search']['category2search']?>">
				<?}else{?>
					<input type="hidden" name="searchincat" value="<?=$curcat['id_category']?>">
				<?}?>
				<input type="hidden" name="minprice" id="minprice" value="<?=isset($_SESSION['filters']['minprice'])?$_SESSION['filters']['minprice']:null;?>"/>
				<input type="hidden" name="maxprice" id="maxprice" value="<?=isset($_SESSION['filters']['maxprice'])?$_SESSION['filters']['maxprice']:null;?>"/>
				<?if(isset($_SESSION['filters']['minprice']) && isset($_SESSION['filters']['maxprice']) && $_SESSION['filters']['minprice'] != $_SESSION['filters']['maxprice']){?>
					<div class="price_filter">
						<p>Цена,грн</p>
						<label for="price_from">от
							<input type="number" name="pricefrom" id="price_from" min="<?=$_SESSION['filters']['minprice'];?>" max="<?=$_SESSION['filters']['maxprice'];?>" value="<?=isset($_SESSION['filters']['pricefrom']) && $_SESSION['filters']['pricefrom'] != ''?$_SESSION['filters']['pricefrom']:0?>" required>
						</label>
						<label for="price_to">до
							<input type="number" name="priceto" id="price_to" min="<?=$_SESSION['filters']['minprice']+1;?>" max="<?=$_SESSION['filters']['maxprice']+1;?>" value="<?=isset($_SESSION['filters']['priceto']) && $_SESSION['filters']['pricefrom'] != ''?$_SESSION['filters']['priceto']:0?>" required>
						</label>
					</div>
				<?}?>
				<div class="manufacturer_filter hidden">
					<p class="filter_title">Производители<span class="icon-font">arrow_down</span></p>
					<ul class="filter_block">
						<li>
							<label for="manuf_atlant">
								<input id="manuf_atlant" type="checkbox">Atlant
							</label>
						</li>
						<li>
							<label for="manuf_bosh">
								<input id="manuf_bosh" type="checkbox">Bosh
							</label>
						</li>
						<li>
							<label for="manuf_intertool">
								<input id="manuf_intertool" type="checkbox">Intertool
							</label>
						</li>
					</ul>
				</div>
				<div class="color_filter hidden">
					<p class="filter_title">Цвет<span class="icon-font">arrow_down</span></p>
					<ul class="filter_block">
						<li>
							<label class="color_yellow selected">
								<input id="yellow" type="checkbox">
							</label>
						</li>
						<li>
							<label class="color_red">
								<input id="red" type="checkbox">
							</label>
						</li>
						<li>
							<label class="color_blue">
								<input id="blue" type="checkbox">
							</label>
						</li>
					</ul>
				</div>
				<a href="#" class="reset fright">Сбросить фильтр</a>
				<button type="submit" class="btn-m-green fleft">Применить</button>
			</form>
		</div>
	</div>
<?}?>
-->