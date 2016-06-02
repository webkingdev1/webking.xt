<div id="cab_left_bar" class="cab_left_bar_js" data-lvl="1">
	<!-- <h5>Личный кабинет</h5> -->
	<ul>
		<li id="icon_face" class="<?=$_GET['t']=='delivery' || $_GET['t']=='contacts' || $_GET['t']==''?'active':null;?>">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">face</i><span class="textInALink">Личные данные</span></a>
				<span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span>
				<div class="mdl-tooltip" for="icon_face">Личные данные</div>
			</span>
			</span>
			<ul class="nav <?=!isset($GLOBALS['Rewrite'])?'active show':null;?>">
				<li class="child <?=$_GET['t']=='contacts' || $_GET['t']==''?'active':null;?>">
					<a name="t" value="contacts" <?=(isset($_GET['t']) && $_GET['t'] == 'contacts') || !isset($_GET['t'])?'class="active"':null;?>  href="<?=Link::Custom('cabinet')?>?t=contacts">Основная информация</a>
				</li>
				<li class="<?=$_GET['t']=='delivery'?'active':null;?>">
					<a name="t" value="delivery" <?=isset($_GET['t']) && $_GET['t'] == 'delivery'?'class="active"':null;?>  href="<?=Link::Custom('cabinet')?>?t=delivery">Адрес доставки</a>
				</li>
			</ul>
		</li>
		<li id="icon_shopping_cart" class="<?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite']=='orders'?'active':null;?>">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">shopping_cart</i><span class="textInALink">Мои заказы</span></a>
				<span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span>
				<div class="mdl-tooltip" for="icon_shopping_cart">Мои заказы</div>
			</span>
			<ul class="nav <?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'orders'?'active show':null;?>">
				<li class="nav <?=!isset($GLOBALS['Rewrite'])?'active':null;?>">
					<a name="t" value="all" class="all <?=(isset($_GET['t']) && $_GET['t']=='all')?'active':null;?>" href="<?=Link::Custom('cabinet', 'orders')?>?t=all">Все</a>
				</li>
				<li class="nav <?=!isset($GLOBALS['Rewrite'])?'active':null;?>">
					<a name="t" value="working" class="working <?=(isset($_GET['t']) && $_GET['t']=='working')?'active':null;?>" href="<?=Link::Custom('cabinet', 'orders')?>?t=working">Выполняются</a>
				</li>
				<li class="nav <?=!isset($GLOBALS['Rewrite'])?'active':null;?>">
					<a name="t" value="completed" class="completed <?=(isset($_GET['t']) && $_GET['t']=='completed')?'active':null;?>" href="<?=Link::Custom('cabinet', 'orders')?>?t=completed">Выполненные</a>
				</li>
				<li class="nav <?=!isset($GLOBALS['Rewrite'])?'active':null;?>">
					<a name="t" value="canceled" class="canceled <?=(isset($_GET['t']) && $_GET['t']=='canceled')?'active':null;?>" href="<?=Link::Custom('cabinet', 'orders')?>?t=canceled">Отмененные</a>
				</li>
				<li class="nav <?=!isset($GLOBALS['Rewrite'])?'active':null;?>">
					<a name="t" value="drafts" class="drafts <?=(isset($_GET['t']) && $_GET['t']=='drafts')?'active':null;?>" href="<?=Link::Custom('cabinet', 'orders')?>?t=drafts">Черновики</a>
				</li>
			</ul>
		</li>
		<li id="icon_person_add" class="<?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite']=='cooperative'?'active':null;?>">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">person_add</i><span class="textInALink">Совместные заказы</span></a>
				<span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span>
				<div class="mdl-tooltip" for="icon_person_add">Совместные заказы</div>
			</span>
			<ul class="nav <?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'cabinet/cooperative'?'active show':null;?>">
				<!--<li>
					<a name="t" value="joall" class="all <?=(isset($_GET['t']) && $_GET['t']=='joall')?'active':null;?>" href="<?=Link::Custom('cabinet', 'cooperative')?>?t=joall">Все</a>
				</li>-->
				<li class="active_order_js">
					<!--<input type="hidden" data-idcart="<?=$_SESSION['cart']['id']?>" data-iduser="<?=$_SESSION['member']['id_user']?>" data-promo="<?=$_SESSION['cart']['promo']?>" />
					<a class="working <?=(isset($_GET['t']) && $_GET['t']=='working')? 'active' : null;?>" >Активный</a>-->
					<a name="t" value="joactive" class="working <?=(isset($_GET['t']) && $_GET['t']=='joactive')? 'active' : null;?>" href="<?=Link::Custom('cabinet', 'cooperative')?>?t=joactive">Активный</a>
				</li>
				<li>
					<a name="t" value="jocompleted" class="completed <?=(isset($_GET['t']) && $_GET['t']=='jocompleted')?'active':null;?>" href="<?=Link::Custom('cabinet', 'cooperative')?>?t=jocompleted">Выполненные</a>
				</li>
			 </ul>
		</li>
		<li id="icon_people">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">people</i><span class="textInALink">Списки друзей</span></a>
				<!-- <span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span> -->
				<div class="mdl-tooltip" for="icon_people">Списки друзей</div>
			</span>
		</li>
		<li id="icon_settings" class="<?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'settings'?'active':null;?>">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">settings</i><span class="textInALink">Настройки</span></a>
				<span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span>
				<div class="mdl-tooltip" for="icon_settings">Настройки</div>
			</span>
			<ul class="nav <?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'settings'?'show':null;?>">
				<li class="<?=isset($_GET['t']) && $_GET['t'] == 'basic'?'active':null;?>">
					<a name="t" value="basic" class="<?=isset($_GET['t']) && $_GET['t'] == 'basic'?'active':null;?>" href="<?=Link::Custom('cabinet','settings')?>?t=basic">Настройки</a>
				</li>
				<li class="<?=isset($_GET['t']) && $_GET['t'] == 'password'?'active':null;?>">
					<a name="t" value="password" class="<?=isset($_GET['t']) && $_GET['t'] == 'password'?'active':null;?>" href="<?=Link::Custom('cabinet','settings')?>?t=password">Смена пароля</a>
				</li>
			</ul>
		</li>
		<li id="icon_add_shopping_cart" class="<?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'bonus'?'active':null;?>">
			<span class="link_wrapp">
				<a href="#"><i class="material-icons">add_shopping_cart</i><span class="textInALink">Бонусная программа</span></a>
				<span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span>
				<div class="mdl-tooltip" for="icon_add_shopping_cart">Бонусная программа</div>
			</span>
			<ul class="nav <?=isset($GLOBALS['Rewrite']) && $GLOBALS['Rewrite'] == 'bonus'?'active show':null;?>">
				<li class="child <?=isset($_GET['t']) && $_GET['t'] == 'bonus_info'?'active':null;?>">
					<a name="t" value="bonus_info" class="<?=isset($_GET['t']) && $_GET['t'] == 'bonus_info'?'active':null;?>" href="<?=Link::Custom('cabinet','bonus')?>?t=bonus_info">Мой бонусный счет</a>
				</li>
				<li class="child <?=isset($_GET['t']) && $_GET['t'] == 'change_bonus'?'active':null;?>">
					<a name="t" value="change_bonus" class="<?=isset($_GET['t']) && $_GET['t'] == 'change_bonus'?'active':null;?>" href="<?=Link::Custom('cabinet','bonus')?>?t=change_bonus">
						<?=isset($Customer['bonus_card']) ? 'Смена бонусной карты' : 'Активация бонусной карты';?>
					</a>
				</li>
			</ul>
		</li>
		<li id="icon_flag">
			<span class="link_wrapp">
				<a href="<?=Link::Custom('cabinet','favorites')?>"><i class="material-icons">flag</i><span class="textInALink">Избраное</span></a>
				<div class="mdl-tooltip" for="icon_flag">Избраное</div>
				<!-- <span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span> -->
			</span>
		</li>
		<li id="icon_timeline">
			<span class="link_wrapp">
				<a href="<?=Link::Custom('cabinet','waitinglist')?>"><i class="material-icons">timeline</i><span class="textInALink">Лист ожидания</span></a>
				<div class="mdl-tooltip" for="icon_timeline">Лист ожидания</div>
				<!-- <span class="more_cat"><i class="material-icons">keyboard_arrow_right</i></span> -->
			</span>
		</li>
	</ul>
</div>
<!-- <ul>
	<li><a href=""></a></li>
	<li><a href=""></a></li>
	<li>
		<a href=""></a>
		<ul>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</li>
	<li><a href=""></a></li>
	<li><a href=""></a></li>
</ul> -->
<script>
	$(document).ready(function() {
		if ($(document).outerWidth() > 1150) {
			$('.cab_left_bar_js').on('click','.link_wrapp', function() {
				var parent = $(this).closest('li'),
					parent_active = parent.hasClass('active');
				$(this).closest('ul').find('li').removeClass('active').find('ul').stop(true, true).slideUp('slow');

				if(!parent_active){
					parent.addClass('active').find('> ul').stop(true, true).slideDown('slow');
				}
			});
			$('.show').slideDown('slow');
		}

		$('.cab_left_bar_js > ul > li').click(function(event) {
			if($(this).hasClass('active_icon')){
				$(this).removeClass('active_icon');
			}else if(($(this).closest('ul').find('li.active_icon')).length == 1) {
				$('.cab_left_bar_js li.active_icon').removeClass('active_icon');
				$(this).find('.link_wrapp i').removeClass('active');
				$(this).addClass('active_icon_js active_icon');
				$(this).find('.link_wrapp i').addClass('active');
			}else{
				$(this).addClass('active_icon_js active_icon');
				$(this).find('.link_wrapp i').addClass('active');
			}			
		});

		/*$('.cab_left_bar_js').on('click','.active_order_js', function() {
			var id_cart = $(this).find('input').data('idcart'),
				id_user = $(this).find('input').data('iduser'),
				promo = $(this).find('input').data('promo');
			data = {id_cart:id_cart, id_user:id_user, promo:promo, condition:'active'};
			ajax('cabinet','GetJOCart', data).done(function(){
				console.log(1);
			}).fail(function(){
				console.log(2);
			});
		});*/
	});
</script>